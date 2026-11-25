<?php
/**
 * Pure-PHP Gmail SMTP Mailer (Zero external Composer dependencies)
 * Supports TLS/SSL SMTP AUTH, UTF-8 HTML + plain-text emails, Reply-To, and MIME file attachments.
 */

if (!function_exists('sanitizeMailHeader')) {
    function sanitizeMailHeader(string $value): string {
        return trim(str_replace(["\r", "\n", "\0"], '', $value));
    }
}

if (!function_exists('encodeMimeHeader')) {
    function encodeMimeHeader(string $value): string {
        $clean = sanitizeMailHeader($value);
        if ($clean === '') {
            return '';
        }
        return preg_match('/[^\x20-\x7E]/', $clean)
            ? '=?UTF-8?B?' . base64_encode($clean) . '?='
            : $clean;
    }
}

if (!function_exists('formatMailAddress')) {
    function formatMailAddress(string $email, string $name = ''): string {
        $cleanEmail = sanitizeMailHeader($email);
        $cleanName = sanitizeMailHeader($name);
        if ($cleanName === '') {
            return "<{$cleanEmail}>";
        }
        $quotedName = str_replace('"', '\"', $cleanName);
        if (preg_match('/[^\x20-\x7E]/', $cleanName)) {
            return encodeMimeHeader($cleanName) . " <{$cleanEmail}>";
        }
        return "\"{$quotedName}\" <{$cleanEmail}>";
    }
}

if (!function_exists('smtpReadResponse')) {
    function smtpReadResponse($socket): array {
        $raw = '';
        $code = 0;
        while (($line = fgets($socket, 2048)) !== false) {
            $raw .= $line;
            if (strlen($line) >= 3 && is_numeric(substr($line, 0, 3))) {
                $code = (int) substr($line, 0, 3);
            }
            if (strlen($line) < 4 || substr($line, 3, 1) === ' ') {
                break;
            }
        }
        if ($raw === '') {
            throw new RuntimeException('SMTP server closed connection unexpectedly.');
        }
        return ['code' => $code, 'raw' => trim($raw)];
    }
}

if (!function_exists('smtpSendCommand')) {
    function smtpSendCommand($socket, string $command, array $expectedCodes): array {
        fwrite($socket, $command . "\r\n");
        $resp = smtpReadResponse($socket);
        if (!in_array($resp['code'], $expectedCodes, true)) {
            throw new RuntimeException('SMTP error (' . $resp['code'] . '): ' . $resp['raw']);
        }
        return $resp;
    }
}

if (!function_exists('buildMimePayload')) {
    function buildMimePayload(array $config, array $mail): string {
        $toEmail = sanitizeMailHeader($mail['to_email'] ?? $config['to_email']);
        $toName = sanitizeMailHeader($mail['to_name'] ?? ($config['to_name'] ?? ''));
        $fromEmail = sanitizeMailHeader($config['smtp_username'] ?: $toEmail);
        $fromName = sanitizeMailHeader($config['from_name'] ?? 'Shree Tech Website');
        $replyEmail = sanitizeMailHeader($mail['reply_to_email'] ?? '');
        $replyName = sanitizeMailHeader($mail['reply_to_name'] ?? '');
        $subject = encodeMimeHeader($mail['subject'] ?? 'Website Submission');

        $altBoundary = '=_alt_' . bin2hex(random_bytes(12));
        $mixedBoundary = '=_mix_' . bin2hex(random_bytes(12));
        $attachments = $mail['attachments'] ?? [];
        $hasAttachments = !empty($attachments);

        $hostPart = sanitizeMailHeader($_SERVER['HTTP_HOST'] ?? 'shreetech.local');
        $hostPart = preg_replace('/[^a-zA-Z0-9.\-]/', '', $hostPart) ?: 'shreetech.local';

        $headers = [
            'Date: ' . date('r'),
            'From: ' . formatMailAddress($fromEmail, $fromName),
            'To: ' . formatMailAddress($toEmail, $toName),
        ];
        if ($replyEmail !== '') {
            $headers[] = 'Reply-To: ' . formatMailAddress($replyEmail, $replyName);
        }
        $headers[] = 'Subject: ' . $subject;
        $headers[] = 'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . $hostPart . '>';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'X-Mailer: ShreeTech-PHP-SMTP/1.0';

        $altBody =
            "--{$altBoundary}\r\n" .
            "Content-Type: text/plain; charset=UTF-8\r\n" .
            "Content-Transfer-Encoding: base64\r\n\r\n" .
            chunk_split(base64_encode((string) ($mail['text'] ?? ''))) . "\r\n" .
            "--{$altBoundary}\r\n" .
            "Content-Type: text/html; charset=UTF-8\r\n" .
            "Content-Transfer-Encoding: base64\r\n\r\n" .
            chunk_split(base64_encode((string) ($mail['html'] ?? ''))) . "\r\n" .
            "--{$altBoundary}--\r\n";

        if (!$hasAttachments) {
            $headers[] = "Content-Type: multipart/alternative; boundary=\"{$altBoundary}\"";
            $message = implode("\r\n", $headers) . "\r\n\r\n" . $altBody;
        } else {
            $headers[] = "Content-Type: multipart/mixed; boundary=\"{$mixedBoundary}\"";
            $body =
                "--{$mixedBoundary}\r\n" .
                "Content-Type: multipart/alternative; boundary=\"{$altBoundary}\"\r\n\r\n" .
                $altBody;

            foreach ($attachments as $att) {
                $fileName = sanitizeMailHeader(basename((string) ($att['name'] ?? 'attachment.bin')));
                $fileType = sanitizeMailHeader((string) ($att['type'] ?? 'application/octet-stream'));
                $fileData = (string) ($att['content'] ?? '');
                $encodedName = encodeMimeHeader($fileName);
                $body .=
                    "--{$mixedBoundary}\r\n" .
                    "Content-Type: {$fileType}; name=\"{$encodedName}\"\r\n" .
                    "Content-Transfer-Encoding: base64\r\n" .
                    "Content-Disposition: attachment; filename=\"{$encodedName}\"\r\n\r\n" .
                    chunk_split(base64_encode($fileData)) . "\r\n";
            }
            $body .= "--{$mixedBoundary}--\r\n";
            $message = implode("\r\n", $headers) . "\r\n\r\n" . $body;
        }

        // Normalize CRLF and dot-stuff per RFC 5321 Section 4.5.2
        $message = str_replace(["\r\n", "\r"], "\n", $message);
        $message = str_replace("\n", "\r\n", $message);
        $message = preg_replace('/^\./m', '..', $message);
        return $message;
    }
}

if (!function_exists('sendSmtpEmail')) {
    function sendSmtpEmail(array $mail): array {
        $config = require __DIR__ . '/mail-config.php';
        $host = trim((string) ($config['smtp_host'] ?? 'smtp.gmail.com'));
        $port = (int) ($config['smtp_port'] ?? 465);
        $encryption = strtolower(trim((string) ($config['smtp_encryption'] ?? 'ssl')));
        $username = sanitizeMailHeader((string) ($config['smtp_username'] ?? ''));
        $password = preg_replace('/\s+/', '', (string) ($config['smtp_app_password'] ?? ''));
        $timeout = max(5, (int) ($config['timeout'] ?? 20));
        $toEmail = sanitizeMailHeader((string) ($mail['to_email'] ?? ($config['to_email'] ?? '')));

        if ($toEmail === '' || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
            return ['ok' => false, 'code' => 'INVALID_RECIPIENT', 'error' => 'Invalid recipient email address configured.'];
        }

        if ($encryption !== 'none' && ($username === '' || $password === '')) {
            $web3Key = trim((string) ($config['web3forms_access_key'] ?? ''));
            if ($web3Key !== '') {
                $isBrowserAjax = strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';
                if ($isBrowserAjax) {
                    return prepareWeb3FormsClientPayload($config, $mail, $web3Key);
                }
                if (function_exists('curl_init')) {
                    return sendWeb3FormsRelay($config, $mail, $web3Key);
                }
            }
            if (!empty($config['use_formsubmit_fallback']) && function_exists('curl_init')) {
                return sendFormSubmitFallback($config, $mail);
            }
            return [
                'ok' => false,
                'code' => 'MISSING_CONFIG',
                'error' => 'Gmail App Password is not configured yet. Please add your 16-character Google App Password or Web3Forms key in includes/mail-config.local.php.'
            ];
        }

        $caCandidates = array_filter([
            ini_get('openssl.cafile') ?: null,
            ini_get('curl.cainfo') ?: null,
            'C:\\xampp\\apache\\bin\\curl-ca-bundle.crt',
        ]);
        $caFile = null;
        foreach ($caCandidates as $candidate) {
            if (is_file($candidate)) {
                $caFile = $candidate;
                break;
            }
        }

        $sslOptions = [
            'verify_peer' => true,
            'verify_peer_name' => true,
            'allow_self_signed' => false,
        ];
        if ($caFile !== null) {
            $sslOptions['cafile'] = $caFile;
        }

        $remote = ($encryption === 'ssl' ? 'ssl://' : 'tcp://') . $host . ':' . $port;
        $context = stream_context_create(['ssl' => $sslOptions]);
        $errno = 0;
        $errstr = '';
        $socket = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);
        if (!$socket) {
            return [
                'ok' => false,
                'code' => 'CONNECT_FAILED',
                'error' => "Could not connect to SMTP server ({$host}:{$port}): {$errstr} ({$errno})"
            ];
        }

        stream_set_timeout($socket, $timeout);

        try {
            $greeting = smtpReadResponse($socket);
            if ($greeting['code'] !== 220) {
                throw new RuntimeException('Unexpected SMTP greeting: ' . $greeting['raw']);
            }

            $ehloHost = preg_replace('/[^a-zA-Z0-9.\-]/', '', gethostname() ?: 'localhost') ?: 'localhost';
            smtpSendCommand($socket, "EHLO {$ehloHost}", [250]);

            if ($encryption === 'tls') {
                smtpSendCommand($socket, 'STARTTLS', [220]);
                $cryptoMethod = STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
                if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
                    $cryptoMethod |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
                }
                if (!@stream_socket_enable_crypto($socket, true, $cryptoMethod)) {
                    throw new RuntimeException('Failed to establish TLS encryption with SMTP server.');
                }
                smtpSendCommand($socket, "EHLO {$ehloHost}", [250]);
            }

            if ($username !== '' && $password !== '') {
                smtpSendCommand($socket, 'AUTH LOGIN', [334]);
                smtpSendCommand($socket, base64_encode($username), [334]);
                smtpSendCommand($socket, base64_encode($password), [235]);
            }

            $fromEmail = $username !== '' ? $username : $toEmail;
            smtpSendCommand($socket, "MAIL FROM:<{$fromEmail}>", [250]);
            smtpSendCommand($socket, "RCPT TO:<{$toEmail}>", [250, 251]);
            smtpSendCommand($socket, 'DATA', [354]);

            $payload = buildMimePayload($config, $mail);
            fwrite($socket, $payload . "\r\n.\r\n");
            $dataResp = smtpReadResponse($socket);
            if ($dataResp['code'] !== 250) {
                throw new RuntimeException('SMTP rejected message data: ' . $dataResp['raw']);
            }

            @fwrite($socket, "QUIT\r\n");
            @fgets($socket, 512);
            @fclose($socket);
            return ['ok' => true, 'message' => 'Email delivered successfully to ' . $toEmail];
        } catch (Throwable $ex) {
            @fclose($socket);
            return [
                'ok' => false,
                'code' => 'SMTP_FAILED',
                'error' => $ex->getMessage()
            ];
        }
    }
}

if (!function_exists('postHttpsMailRelay')) {
    function postHttpsMailRelay(string $endpoint, array $fields, array $attachments, array $headers, int $timeout, ?string $referer = null): array {
        $tmpFiles = [];
        $ch = curl_init($endpoint);
        if (!$ch) {
            return ['ok' => false, 'httpCode' => 0, 'decoded' => null, 'error' => 'Failed to initialize HTTPS mail relay.'];
        }

        try {
            if (!empty($attachments)) {
                $att = $attachments[0];
                $tmpPath = tempnam(sys_get_temp_dir(), 'st_att_');
                if ($tmpPath !== false && file_put_contents($tmpPath, (string) ($att['content'] ?? '')) !== false) {
                    $tmpFiles[] = $tmpPath;
                    $fields['attachment'] = new CURLFile(
                        $tmpPath,
                        sanitizeMailHeader((string) ($att['type'] ?? 'application/octet-stream')),
                        sanitizeMailHeader(basename((string) ($att['name'] ?? 'resume.pdf')))
                    );
                }
                $postBody = $fields;
            } else {
                $headers[] = 'Content-Type: application/json';
                $postBody = json_encode($fields);
            }

            $caBundle = ini_get('curl.cainfo') ?: 'C:\\xampp\\apache\\bin\\curl-ca-bundle.crt';
            $opts = [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_TIMEOUT => $timeout,
                CURLOPT_HTTPHEADER => $headers,
            ];
            if ($referer !== null && $referer !== '') {
                $opts[CURLOPT_REFERER] = $referer;
            }
            if (stripos($endpoint, 'https://') === 0 && is_file($caBundle)) {
                $opts[CURLOPT_CAINFO] = $caBundle;
            }
            curl_setopt_array($ch, $opts);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody);

            $raw = curl_exec($ch);
            $curlErr = curl_error($ch);
            $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($raw === false) {
                return ['ok' => false, 'httpCode' => $httpCode, 'decoded' => null, 'error' => 'Could not reach mail relay: ' . $curlErr];
            }

            return ['ok' => true, 'httpCode' => $httpCode, 'decoded' => json_decode((string) $raw, true), 'error' => ''];
        } finally {
            curl_close($ch);
            foreach ($tmpFiles as $tf) {
                @unlink($tf);
            }
        }
    }
}

if (!function_exists('saveResumeUploadSafely')) {
    function saveResumeUploadSafely(array $attachment): ?string {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'resumes';
        if (!is_dir($dir) && !@mkdir($dir, 0750, true)) {
            return null;
        }
        $htaccess = $dir . DIRECTORY_SEPARATOR . '.htaccess';
        if (!is_file($htaccess)) {
            @file_put_contents($htaccess, "Deny from all\n");
        }
        $safeBase = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename((string) ($attachment['name'] ?? 'resume.pdf')));
        $targetName = date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '_' . $safeBase;
        $targetPath = $dir . DIRECTORY_SEPARATOR . $targetName;
        if (@file_put_contents($targetPath, (string) ($attachment['content'] ?? '')) === false) {
            return null;
        }
        return 'uploads/resumes/' . $targetName;
    }
}

if (!function_exists('buildWeb3FormsFields')) {
    function buildWeb3FormsFields(array $config, array $mail, string $accessKey, bool $archiveAttachment = false): array {
        $fields = $mail['fields'] ?? [];
        $attachments = $mail['attachments'] ?? [];

        if ($archiveAttachment && !empty($attachments)) {
            $savedPath = saveResumeUploadSafely($attachments[0]);
            if ($savedPath !== null) {
                $fields['Saved Resume Copy'] = $savedPath;
            }
        }

        $phone = sanitizeMailHeader((string) ($fields['Phone Number'] ?? ($fields['Mobile Number'] ?? '')));
        $messageBody = trim((string) ($fields['Project Description'] ?? ($fields['Cover Letter'] ?? '')));
        if ($messageBody === '') {
            $messageBody = trim((string) ($mail['text'] ?? ''));
        }

        $payload = [
            'access_key' => $accessKey,
            'subject'    => sanitizeMailHeader((string) ($mail['subject'] ?? 'Website Submission')),
            'from_name'  => sanitizeMailHeader((string) ($config['from_name'] ?? 'Shree Tech Website')),
            'name'       => sanitizeMailHeader((string) ($mail['reply_to_name'] ?? '')),
            'email'      => sanitizeMailHeader((string) ($mail['reply_to_email'] ?? '')),
            'replyto'    => sanitizeMailHeader((string) ($mail['reply_to_email'] ?? '')),
        ];

        if ($phone !== '') {
            $payload['phone'] = $phone;
        }

        $skipKeys = ['Full Name', 'Applicant Name', 'Business Email', 'Email', 'Phone Number', 'Mobile Number', 'Project Description', 'Cover Letter'];
        foreach ($fields as $label => $value) {
            if (in_array($label, $skipKeys, true)) {
                continue;
            }
            $strVal = trim((string) $value);
            if ($strVal !== '') {
                $payload[$label] = $strVal;
            }
        }

        $payload['message'] = $messageBody;
        return $payload;
    }
}

if (!function_exists('prepareWeb3FormsClientPayload')) {
    function prepareWeb3FormsClientPayload(array $config, array $mail, string $accessKey): array {
        $endpoint = trim((string) ($config['web3forms_endpoint'] ?? '')) ?: 'https://api.web3forms.com/submit';
        return [
            'ok' => true,
            'mode' => 'web3forms_client',
            'endpoint' => $endpoint,
            'payload' => buildWeb3FormsFields($config, $mail, $accessKey, true),
        ];
    }
}

if (!function_exists('sendWeb3FormsRelay')) {
    function sendWeb3FormsRelay(array $config, array $mail, string $accessKey): array {
        $toEmail = sanitizeMailHeader((string) ($mail['to_email'] ?? ($config['to_email'] ?? '')));
        $endpoint = trim((string) ($config['web3forms_endpoint'] ?? '')) ?: 'https://api.web3forms.com/submit';
        $timeout = max(5, (int) ($config['timeout'] ?? 20));

        $fields = buildWeb3FormsFields($config, $mail, $accessKey, false);

        $res = postHttpsMailRelay($endpoint, $fields, $mail['attachments'] ?? [], ['Accept: application/json'], $timeout);
        if (!$res['ok']) {
            return ['ok' => false, 'code' => 'RELAY_NETWORK_ERROR', 'error' => $res['error']];
        }

        $decoded = $res['decoded'];
        $isOk = is_array($decoded) && ($decoded['success'] === true || $decoded['success'] === 'true');
        if ($isOk) {
            return ['ok' => true, 'message' => 'Email delivered successfully to ' . $toEmail];
        }

        $msg = is_array($decoded) ? trim((string) ($decoded['message'] ?? '')) : '';
        return [
            'ok' => false,
            'code' => 'WEB3FORMS_ERROR',
            'error' => $msg !== '' ? $msg : "Web3Forms relay failed (HTTP {$res['httpCode']})."
        ];
    }
}

if (!function_exists('sendFormSubmitFallback')) {
    function sendFormSubmitFallback(array $config, array $mail): array {
        $toEmail = sanitizeMailHeader((string) ($mail['to_email'] ?? ($config['to_email'] ?? '')));
        $customEndpoint = trim((string) ($config['formsubmit_endpoint'] ?? ''));
        $endpoint = $customEndpoint !== '' ? $customEndpoint : ('https://formsubmit.co/ajax/' . rawurlencode($toEmail));
        $timeout = max(5, (int) ($config['timeout'] ?? 20));

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $reqHost = sanitizeMailHeader((string) ($_SERVER['HTTP_HOST'] ?? 'localhost'));
        $referer = "{$scheme}://{$reqHost}/";

        $fields = array_merge($mail['fields'] ?? [], [
            '_subject' => sanitizeMailHeader((string) ($mail['subject'] ?? 'Website Submission')),
            '_replyto' => sanitizeMailHeader((string) ($mail['reply_to_email'] ?? '')),
            '_template' => 'table',
        ]);

        $headers = [
            'Accept: application/json',
            "Origin: {$scheme}://{$reqHost}",
        ];

        $res = postHttpsMailRelay($endpoint, $fields, $mail['attachments'] ?? [], $headers, $timeout, $referer);
        if (!$res['ok']) {
            return ['ok' => false, 'code' => 'RELAY_NETWORK_ERROR', 'error' => $res['error']];
        }

        $decoded = $res['decoded'];
        $isOk = is_array($decoded) && ($decoded['success'] === true || $decoded['success'] === 'true');
        if ($isOk) {
            return ['ok' => true, 'message' => 'Email delivered successfully to ' . $toEmail];
        }

        $msg = is_array($decoded) ? trim((string) ($decoded['message'] ?? '')) : '';
        if (stripos($msg, 'activat') !== false) {
            return [
                'ok' => false,
                'code' => 'FORMSUBMIT_ACTIVATION_REQUIRED',
                'error' => "One-time activation email sent to {$toEmail}! Open your Gmail inbox and click 'Activate Form' (note: if formsubmit.co shows Error 520, configure a Gmail App Password or Web3Forms key in includes/mail-config.local.php instead)."
            ];
        }

        if ($res['httpCode'] >= 500) {
            return [
                'ok' => false,
                'code' => 'FORMSUBMIT_SERVER_ERROR',
                'error' => "FormSubmit external server is temporarily returning Error {$res['httpCode']}. Please add your Gmail App Password or Web3Forms Access Key in includes/mail-config.local.php for 100% reliable delivery."
            ];
        }

        return [
            'ok' => false,
            'code' => 'FORMSUBMIT_ERROR',
            'error' => $msg !== '' ? $msg : "Mail relay failed (HTTP {$res['httpCode']})."
        ];
    }
}

if (!function_exists('renderEmailDetailTable')) {
    function renderEmailDetailTable(string $heading, string $subtitle, array $rows, string $messageLabel, string $messageBody): string {
        $rowHtml = '';
        foreach ($rows as $label => $value) {
            $safeLabel = htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8');
            $safeVal = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
            $rowHtml .= '<tr>'
                . '<td style="padding:10px 14px;border-bottom:1px solid #F1E6EE;color:#64748B;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;width:165px;">' . $safeLabel . '</td>'
                . '<td style="padding:10px 14px;border-bottom:1px solid #F1E6EE;color:#0F172A;font-size:14px;font-weight:600;">' . $safeVal . '</td>'
                . '</tr>';
        }
        $safeHeading = htmlspecialchars($heading, ENT_QUOTES, 'UTF-8');
        $safeSub = htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8');
        $safeMsgLabel = htmlspecialchars($messageLabel, ENT_QUOTES, 'UTF-8');
        $safeMsgBody = nl2br(htmlspecialchars($messageBody, ENT_QUOTES, 'UTF-8'));

        return '<!DOCTYPE html><html><body style="margin:0;padding:24px;background:#F8FAFC;font-family:\'Plus Jakarta Sans\',Segoe UI,Arial,sans-serif;">'
            . '<div style="max-width:620px;margin:0 auto;background:#FFFFFF;border:1px solid #F1E6EE;border-radius:20px;overflow:hidden;box-shadow:0 12px 30px rgba(15,23,42,0.06);">'
            . '<div style="padding:22px 26px;background:linear-gradient(135deg,#FF6B00 0%,#C01858 55%,#8B5CF6 100%);color:#FFFFFF;">'
            . '<div style="font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;opacity:0.9;">Shree Tech Innovations</div>'
            . '<h2 style="margin:6px 0 2px;font-size:20px;font-weight:800;line-height:1.25;">' . $safeHeading . '</h2>'
            . '<div style="font-size:13px;opacity:0.92;">' . $safeSub . '</div>'
            . '</div>'
            . '<div style="padding:22px 26px;">'
            . '<table style="width:100%;border-collapse:collapse;margin-bottom:18px;">' . $rowHtml . '</table>'
            . '<div style="padding:14px 16px;background:#FFF7FA;border:1px solid #F1E6EE;border-radius:14px;">'
            . '<div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#C01858;margin-bottom:6px;">' . $safeMsgLabel . '</div>'
            . '<div style="font-size:14px;line-height:1.6;color:#1E293B;">' . $safeMsgBody . '</div>'
            . '</div>'
            . '<div style="margin-top:16px;font-size:11px;color:#94A3B8;">Submitted on ' . date('Y-m-d H:i:s T') . '</div>'
            . '</div></div></body></html>';
    }
}

if (!function_exists('sendProjectInquiryEmail')) {
    function sendProjectInquiryEmail(array $formData): array {
        $name = trim((string) ($formData['name'] ?? ''));
        $email = trim((string) ($formData['email'] ?? ''));
        $phone = trim((string) ($formData['phone'] ?? ''));
        $service = trim((string) ($formData['service'] ?? 'Website Development'));
        $message = trim((string) ($formData['message'] ?? ''));

        $rows = [
            'Full Name' => $name,
            'Business Email' => $email,
            'Phone Number' => $phone,
            'Service Offering' => $service,
        ];

        $html = renderEmailDetailTable(
            'New Project Inquiry Received',
            'Website Contact Form — ' . $service,
            $rows,
            'Project Description',
            $message
        );

        $text = "New Project Inquiry - Shree Tech Website\n"
            . "========================================\n"
            . "Full Name: {$name}\n"
            . "Business Email: {$email}\n"
            . "Phone Number: {$phone}\n"
            . "Service Offering: {$service}\n\n"
            . "Project Description:\n{$message}\n\n"
            . 'Submitted: ' . date('Y-m-d H:i:s T') . "\n";

        return sendSmtpEmail([
            'subject' => "[Shree Tech Inquiry] {$service} - {$name}",
            'reply_to_email' => $email,
            'reply_to_name' => $name,
            'fields' => $rows + ['Project Description' => $message],
            'html' => $html,
            'text' => $text,
        ]);
    }
}

if (!function_exists('sendCareerApplicationEmail')) {
    function sendCareerApplicationEmail(array $data, ?array $attachment = null): array {
        $position = trim((string) ($data['position'] ?? 'General Application'));
        $name = trim((string) ($data['name'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $phone = trim((string) ($data['phone'] ?? ''));
        $coverLetter = trim((string) ($data['cover_letter'] ?? ''));

        $rows = [
            'Position' => $position,
            'Applicant Name' => $name,
            'Email' => $email,
            'Mobile Number' => $phone,
            'Resume File' => $attachment['name'] ?? 'Not provided',
        ];

        $html = renderEmailDetailTable(
            'New Career Application Received',
            'Careers Portal — ' . $position,
            $rows,
            'Resume Cover Letter',
            $coverLetter !== '' ? $coverLetter : '(No cover letter text provided)'
        );

        $text = "New Career Application - Shree Tech Website\n"
            . "==========================================\n"
            . "Position: {$position}\n"
            . "Applicant Name: {$name}\n"
            . "Email: {$email}\n"
            . "Mobile Number: {$phone}\n"
            . 'Resume Attached: ' . ($attachment['name'] ?? 'None') . "\n\n"
            . "Cover Letter:\n" . ($coverLetter !== '' ? $coverLetter : '(No cover letter text provided)') . "\n\n"
            . 'Submitted: ' . date('Y-m-d H:i:s T') . "\n";

        return sendSmtpEmail([
            'subject' => "[Shree Tech Careers] {$position} - {$name}",
            'reply_to_email' => $email,
            'reply_to_name' => $name,
            'fields' => $rows + ['Cover Letter' => ($coverLetter !== '' ? $coverLetter : '(None provided)')],
            'html' => $html,
            'text' => $text,
            'attachments' => $attachment ? [$attachment] : [],
        ]);
    }
}

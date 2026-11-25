<?php
/**
 * Shared Form Security & Input Validation Helpers
 * Handles session CSRF tokens, honeypot anti-spam, strict name/email/10-digit phone checks, and file validation.
 */

if (!function_exists('ensureFormCsrfToken')) {
    function ensureFormCsrfToken(): string {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
        if (empty($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('verifyFormCsrfAndHoneypot')) {
    function verifyFormCsrfAndHoneypot(array $post): ?string {
        if (trim((string) ($post['company_website'] ?? '')) !== '') {
            return 'Automated submission rejected.';
        }
        $sessionToken = $_SESSION['csrf_token'] ?? '';
        $submittedToken = (string) ($post['csrf_token'] ?? '');
        if ($sessionToken === '' || $submittedToken === '' || !hash_equals($sessionToken, $submittedToken)) {
            return 'Security token expired or invalid. Please refresh the page and try again.';
        }
        return null;
    }
}

if (!function_exists('validateFormName')) {
    function validateFormName(string $raw): array {
        $name = preg_replace('/\s+/', ' ', trim($raw));
        $len = strlen($name);
        if ($len < 2 || $len > 80 || !preg_match("/^[A-Za-z][A-Za-z\s.'-]{1,79}$/", $name)) {
            return ['value' => $name, 'error' => 'Please enter a valid full name using letters only (2-80 chars).'];
        }
        return ['value' => $name, 'error' => null];
    }
}

if (!function_exists('validateFormEmail')) {
    function validateFormEmail(string $raw): array {
        $email = trim($raw);
        if (
            $email === '' ||
            strlen($email) > 120 ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/', $email)
        ) {
            return ['value' => $email, 'error' => 'Please enter a valid email address (e.g. name@company.com).'];
        }
        return ['value' => $email, 'error' => null];
    }
}

if (!function_exists('validateTenDigitPhone')) {
    function validateTenDigitPhone(string $raw): array {
        $digits = preg_replace('/\D+/', '', trim($raw));
        if (!preg_match('/^[0-9]{10}$/', $digits) || $digits === '0000000000') {
            return ['value' => $digits, 'error' => 'Please enter a valid 10-digit mobile number.'];
        }
        return ['value' => $digits, 'error' => null];
    }
}

if (!function_exists('validateContactFields')) {
    function validateContactFields(array $post, array $allowedServices): array {
        $errors = [];
        $nameRes = validateFormName((string) ($post['name'] ?? ''));
        $emailRes = validateFormEmail((string) ($post['email'] ?? ''));
        $phoneRes = validateTenDigitPhone((string) ($post['phone'] ?? ''));

        $rawService = trim((string) ($post['service'] ?? 'Website Development'));
        $service = in_array($rawService, $allowedServices, true) ? $rawService : $allowedServices[0];

        $message = trim((string) ($post['message'] ?? ''));
        $msgLen = strlen($message);

        if ($nameRes['error']) $errors['name'] = $nameRes['error'];
        if ($emailRes['error']) $errors['email'] = $emailRes['error'];
        if ($phoneRes['error']) $errors['phone'] = $phoneRes['error'];
        if ($msgLen < 15 || $msgLen > 2000) {
            $errors['message'] = 'Project description must be between 15 and 2000 characters.';
        }

        return [
            'data' => [
                'name' => $nameRes['value'],
                'email' => $emailRes['value'],
                'phone' => $phoneRes['value'],
                'service' => $service,
                'message' => $message,
            ],
            'errors' => $errors,
        ];
    }
}

if (!function_exists('validateCareerFields')) {
    function validateCareerFields(array $post, array $files, array $allowedPositions): array {
        $errors = [];
        $position = trim((string) ($post['position'] ?? ''));
        if ($position === '' || !in_array($position, $allowedPositions, true)) {
            $errors['position'] = 'Please select a valid opening position.';
        }

        $coverLetter = trim((string) ($post['cover_letter'] ?? ''));
        if (strlen($coverLetter) > 3000) {
            $errors['cover_letter'] = 'Cover letter must be 3000 characters or fewer.';
        }

        $nameRes = validateFormName((string) ($post['name'] ?? ''));
        $emailRes = validateFormEmail((string) ($post['email'] ?? ''));
        $phoneRes = validateTenDigitPhone((string) ($post['phone'] ?? ''));

        if ($nameRes['error']) $errors['name'] = $nameRes['error'];
        if ($emailRes['error']) $errors['email'] = $emailRes['error'];
        if ($phoneRes['error']) $errors['phone'] = $phoneRes['error'];

        $attachment = null;
        if (!isset($files['resume']) || $files['resume']['error'] !== UPLOAD_ERR_OK) {
            $errors['resume'] = 'Please attach your resume (PDF, DOC, or DOCX up to 10MB).';
        } else {
            $file = $files['resume'];
            $maxBytes = 10 * 1024 * 1024;
            $ext = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
            $allowedExt = ['pdf', 'doc', 'docx'];
            if (!in_array($ext, $allowedExt, true)) {
                $errors['resume'] = 'Resume must be a PDF, DOC, or DOCX file.';
            } elseif ((int) $file['size'] <= 0 || (int) $file['size'] > $maxBytes) {
                $errors['resume'] = 'Resume file size must be between 1 byte and 10MB.';
            } else {
                $mimeValid = true;
                if (function_exists('finfo_open')) {
                    $finfo = @finfo_open(FILEINFO_MIME_TYPE);
                    $detected = $finfo ? @finfo_file($finfo, $file['tmp_name']) : false;
                    if ($finfo) @finfo_close($finfo);
                    $allowedMimes = [
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/zip',
                        'application/x-ole-storage',
                        'application/octet-stream',
                    ];
                    if ($detected && !in_array($detected, $allowedMimes, true)) {
                        $mimeValid = false;
                    }
                }
                if (!$mimeValid) {
                    $errors['resume'] = 'Invalid file format detected. Upload a valid PDF, DOC, or DOCX file.';
                } else {
                    $content = @file_get_contents($file['tmp_name']);
                    if ($content === false) {
                        $errors['resume'] = 'Could not read the uploaded resume file.';
                    } else {
                        $mimeMap = [
                            'pdf' => 'application/pdf',
                            'doc' => 'application/msword',
                            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        ];
                        $attachment = [
                            'name' => basename((string) $file['name']),
                            'type' => $mimeMap[$ext] ?? 'application/octet-stream',
                            'content' => $content,
                        ];
                    }
                }
            }
        }

        return [
            'data' => [
                'position' => $position,
                'cover_letter' => $coverLetter,
                'name' => $nameRes['value'],
                'email' => $emailRes['value'],
                'phone' => $phoneRes['value'],
            ],
            'attachment' => $attachment,
            'errors' => $errors,
        ];
    }
}

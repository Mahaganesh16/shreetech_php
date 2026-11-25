<?php
/**
 * Gmail SMTP Mail Configuration for Shree Tech Innovations
 *
 * Configure your 16-character Google App Password in EITHER:
 *   1. includes/mail-config.local.php (recommended, gitignored):
 *        <?php return ['smtp_app_password' => 'your-16-char-app-password'];
 *   2. Environment variable: SHREETECH_SMTP_APP_PASSWORD
 *   3. Directly in 'smtp_app_password' below (if not committing secrets).
 */

$baseMailConfig = [
    'to_email'                => 'st.mahaganesh@gmail.com',
    'to_name'                 => 'Shree Tech Innovations',
    'smtp_host'               => 'smtp.gmail.com',
    'smtp_port'               => 465,
    'smtp_encryption'         => 'ssl', // 'ssl' (port 465) or 'tls' (port 587 STARTTLS)
    'smtp_username'           => 'st.mahaganesh@gmail.com',
    'smtp_app_password'       => '',
    'web3forms_access_key'    => '', // Free access key from https://web3forms.com (no 520 confirm issue)
    'web3forms_endpoint'      => 'https://api.web3forms.com/submit',
    'use_formsubmit_fallback' => true, // Used when both smtp_app_password and web3forms_access_key are empty
    'formsubmit_endpoint'     => '', // Optional custom FormSubmit hash URL (defaults to formsubmit.co/ajax/<to_email>)
    'from_name'               => 'Shree Tech Website',
    'timeout'                 => 20,
];

$localOverridePath = __DIR__ . '/mail-config.local.php';
if (is_file($localOverridePath)) {
    $localOverride = require $localOverridePath;
    if (is_array($localOverride)) {
        $baseMailConfig = array_merge($baseMailConfig, $localOverride);
    }
}

$envPass = getenv('SHREETECH_SMTP_APP_PASSWORD');
if ($envPass !== false && trim($envPass) !== '') {
    $baseMailConfig['smtp_app_password'] = trim($envPass);
}

return $baseMailConfig;

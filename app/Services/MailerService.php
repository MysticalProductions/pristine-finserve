<?php

namespace App\Services;

class MailerService
{
    private array $config;

    public function __construct()
    {
        $this->config = [
            'host' => getenv('MAIL_HOST') ?: 'smtp.gmail.com',
            'port' => (int) (getenv('MAIL_PORT') ?: 587),
            'auth' => true,
            'username' => getenv('MAIL_USERNAME') ?: '',
            'password' => getenv('MAIL_PASSWORD') ?: '',
            'secure' => getenv('MAIL_ENCRYPTION') ?: 'tls',
        ];
    }

    public function send(string $to, string $subject, string $body, ?string $replyTo = null): bool
    {
        if (!$this->isConfigured()) {
            error_log("MailerService: Mail not configured. Set MAIL_USERNAME and MAIL_PASSWORD in .env");
            return false;
        }

        $fromEmail = getenv('MAIL_FROM_ADDRESS') ?: $this->config['username'];
        $fromName = getenv('MAIL_FROM_NAME') ?: getenv('APP_NAME') ?: 'Pristine Finserve';

        // Validate reply-to to prevent email header injection
        if ($replyTo) {
            $replyTo = filter_var($replyTo, FILTER_VALIDATE_EMAIL);
        }

        $headers = [
            'From' => "{$fromName} <{$fromEmail}>",
            'To' => $to,
            'Subject' => $subject,
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Content-Transfer-Encoding' => '8bit',
        ];

        if ($replyTo) {
            $headers['Reply-To'] = $replyTo;
        }

        return $this->sendViaSmtp($to, $headers, $body);
    }

    public function sendHtml(string $to, string $subject, string $htmlBody, ?string $replyTo = null): bool
    {
        if (!$this->isConfigured()) {
            error_log("MailerService: Mail not configured. Set MAIL_USERNAME and MAIL_PASSWORD in .env");
            return false;
        }

        $fromEmail = getenv('MAIL_FROM_ADDRESS') ?: $this->config['username'];
        $fromName = getenv('MAIL_FROM_NAME') ?: getenv('APP_NAME') ?: 'Pristine Finserve';

        // Validate reply-to to prevent email header injection
        if ($replyTo) {
            $replyTo = filter_var($replyTo, FILTER_VALIDATE_EMAIL);
        }

        $headers = [
            'From' => "{$fromName} <{$fromEmail}>",
            'To' => $to,
            'Subject' => $subject,
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/html; charset=UTF-8',
            'Content-Transfer-Encoding' => '8bit',
        ];

        if ($replyTo) {
            $headers['Reply-To'] = $replyTo;
        }

        return $this->sendViaSmtp($to, $headers, $htmlBody);
    }

    public function isConfigured(): bool
    {
        return !empty($this->config['username']) && !empty($this->config['password']);
    }

    private function sendViaSmtp(string $to, array $headers, string $body): bool
    {
        // Attempt PEAR Mail first, fall back to PHP mail()
        if (@class_exists('\Mail')) {
            $smtpParams = [
                'host' => $this->config['secure'] ? "{$this->config['secure']}://{$this->config['host']}" : $this->config['host'],
                'port' => $this->config['port'],
                'auth' => $this->config['auth'],
                'username' => $this->config['username'],
                'password' => $this->config['password'],
            ];

            $smtp = \Mail::factory('smtp', $smtpParams);
            $result = $smtp->send($to, $headers, $body);

            if (!\PEAR::isError($result)) {
                return true;
            }

            error_log("MailerService: PEAR Mail failed - " . $result->getMessage() . ". Falling back to mail().");
        }

        // Fallback to PHP mail()
        $headerStr = '';
        foreach ($headers as $k => $v) {
            $headerStr .= "{$k}: {$v}\r\n";
        }

        return mail($to, $headers['Subject'], $body, $headerStr);
    }
}

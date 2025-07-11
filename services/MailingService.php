<?php

namespace Services;



require_once __DIR__ . "/../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

class MailingService
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);

        // Load .env 
        $dotenv = Dotenv::createImmutable(dirname(__DIR__), 'mailing.env');
        $dotenv->safeLoad();

        // Configure PHPMailer 
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['MAIL_HOST'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['MAIL_USERNAME'];
            $this->mailer->Password = $_ENV['MAIL_PASSWORD'];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $_ENV['MAIL_PORT'];
            $this->mailer->setFrom(
                $_ENV['MAIL_FROM_EMAIL'],
                $_ENV['MAIL_FROM_NAME']
            );
        } catch (Exception $e) {
            error_log("PHPMailer Error: " . $e->getMessage());
        }
    }
    
    public function mailTo(string $toEmail, string $subject, string $body)
    {
        try {
            $this->mailer->clearAllRecipients();
            $this->mailer->addAddress($toEmail);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            $this->mailer->send();
            error_log("Email inviata a $toEmail");

        } catch (Exception $e) {
            error_log("Errore invio email: " . $e->getMessage());
        }
    }
}

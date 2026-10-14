<?php

namespace App\Service;

use Pimcore\Mail;
use Pimcore\Model\Document\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class EmailService
{
    public function sendEmail(
        string $emailDocumentPath,
        string $to,
        array $params = [],
        ?string $subject = null,
        ?string $from = null
    ): void {
        /** @var Email|null $emailDoc */
        $emailDoc = Email::getByPath($emailDocumentPath);

        if (!$emailDoc) {
            throw new \RuntimeException("Email document not found: {$emailDocumentPath}");
        }

        $mail = new Mail();

        if ($subject) {
            $mail->subject($subject);
        }

        if ($from) {
            $mail->from($from);
        }

        $mail->to($to);

        // Pass variables to Twig email
        foreach ($params as $key => $value) {
            $mail->setParam($key, $value);
        }

        $mail->setDocument($emailDoc);
        //$mail->debug(true);
        try {
            $mail->send();
            dump('MAIL SENT');
        } catch (TransportExceptionInterface $e) {
            throw new \RuntimeException('Email sending failed', 0, $e);
        }
    }
}

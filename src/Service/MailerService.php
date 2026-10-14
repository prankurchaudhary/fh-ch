<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Pimcore\Model\DataObject\WebsiteUser;
use Twig\Environment;



class MailerService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {}

    public function sendVerificationEmail(WebsiteUser $user, string $link): void
    {
        $email = (new Email())
            ->from('Your Site <yourgmail@gmail.com>')
            ->to($user->getEmail())
            ->subject('Verify your email address');
        $html = $this->twig->render('emails/verify_email.html.twig', [
                'user' => $user,
                'verifyUrl' => $link
            ]);
        $email->html($html);
            
        $this->mailer->send($email);
    }

    public function sendResetPasswordEmail(WebsiteUser $user, string $link): void
    {
        $email = (new Email())
            ->from('Your Site <yourgmail@gmail.com>')
            ->to($user->getEmail())
            ->subject('Reset your password');
        $html = $this->twig->render('emails/reset_password.html.twig', [
                'user' => $user,
                'verifyUrl' => $link
            ]);
        $email->html($html);
            
        $this->mailer->send($email);
    }


}

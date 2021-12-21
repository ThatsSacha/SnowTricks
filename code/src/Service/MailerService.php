<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $to, string $object, string $template)
    {
        $email = (new Email())
            ->from(new Address('no-reply@snowtricks.sacha-cohen.fr', 'SnowTricks'))
            ->to($to)
            ->subject($object)
            ->html($template);

        $this->mailer->send($email);
    }
}
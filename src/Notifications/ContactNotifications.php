<?php
namespace App\Notifications;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactNotifications
{
    // private $mailer;
    // private $transport;
    // public function __construct($mailer)
    // {
    //     $this->mailer =
    // }

    public function notify(Contact $contact)
    {
        // $mailer = new MailerInterface();
        // $email = (new Email())
        //     ->from('noreply@agence.fr')
        //     ->to('ilyas.mewa@gmail.com')
        //     ->subject('Test Symfony Mailer! | Agence'.$contact->getProperty()->getTitle())
        //     ->text($contact->getMessage());
        
        // $mailer->send($email);
    }
}
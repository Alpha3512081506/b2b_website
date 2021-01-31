<?php

namespace App\EventDispatcher;

use App\Entity\User;
use App\Event\PurchaseSuccessEvent;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PurchaseSuccessEmailSubscriber  implements EventSubscriberInterface
{
    private $mailer;
    private $security;
    public  function __construct(MailerInterface $mailerInterface, Security $security)
    {
        $this->mailer = $mailerInterface;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            'purchase.succes' => 'sendSuccessEmail'
        ];
    }
    public function sendSuccessEmail(PurchaseSuccessEvent $purchaseSuccessEvent)
    {
        /**@var User */
        $currentUser = $this->security->getUser();
        $purchase = $purchaseSuccessEvent->getPurchase();
        $email = new TemplatedEmail();
        $email->to(
            new Address($currentUser->getEmail()),
            $currentUser->getFullName()
        )->from("mamadoualphabarry780@gmail.com
         ")
            ->subject("Bravo il suo ordine {$purchase->getId()} è stato confermato con successo")
            ->htmlTemplate("emails/purchase_success.html.twig")->context(
                ['purchase' => $purchase, 'user' => $currentUser]
            );
        $this->mailer->send($email);
    }
}

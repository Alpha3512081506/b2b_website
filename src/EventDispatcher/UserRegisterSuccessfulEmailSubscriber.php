<?php

namespace App\EventDispatcher;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegisterSuccessfulEmailSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'userRegister.success' => 'sendSuccessRegisterEmail'
        ];
    }
    public function sendSuccessRegisterEmail()
    {
        // dd("l'utilisateur à bien ete enregister");
    }
}

<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleListener implements EventSubscriberInterface
{
 
    public function onKernelRequest($event)
    {     
        $request =  $event->getRequest();
        $languages =  $request->headers->get('accept-language');
        $prefLanguage = explode(',', explode(';', $languages)[0])[0];

        $request->attributes->set('preferedLanguage', $prefLanguage);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 10)),
        );
    }
}
<?php
namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Repository\InvoiceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class InvoiceChronoSubscriber implements EventSubscriberInterface{

    private $security;
    private $repository;

    public function __construct(Security $security, InvoiceRepository $repository){
        $this->security = $security;
        $this->repository = $repository;

    }

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW=>['setChronoForInvoice', EventPriorities::PRE_VALIDATE]
        ];
    }
    public function setChronoForInvoice(GetResponseForControllerResultEvent $event){
        dd($this->repository->findLastChrono($this->security->getUser()));

        //1. j'ai besoin de trouver l'utilisateur actuellement connecté(security)

        //2. j'ai besoin du repo des factures (invoicerepository)

        //3. dans cette facture, on donne le dernier numéros +1


    }
}
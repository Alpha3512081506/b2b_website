<?php

namespace App\Doctrine\Listner;

use App\Entity\Prodotto;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductSlugListner
{
    private $slug;
    public function __construct(SluggerInterface $slug)
    {
        $this->slug = $slug;
    }

    public function prePersist(Prodotto $entity, LifecycleEventArgs $lifecycleEventArgs): void
    {

        /*  $entity = $lifecycleEventArgs->getObject();
        if (!$entity instanceof Prodotto) {
            return;
        } */
        if (empty($entity->getSlug())) {
            $entity->setSlug($this->slug->slug(strtolower($entity->getNomeStile())));
        }
    }
}

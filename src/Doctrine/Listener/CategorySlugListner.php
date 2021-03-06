<?php

namespace App\Doctrine\Listener;

use App\Entity\Categoria;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategorySlugListner
{
    private $slugger;
    public function __construct(SluggerInterface $sluggerInterface)
    {
        $this->slugger = $sluggerInterface;
    }
    public function prePersist(Categoria $entity, LifecycleEventArgs $lifecycleEventArgs)
    {

        if (empty($entity->getSlug())) {
            $entity->setSlug(strtolower($this->slugger->slug($entity->getNomeCategoria())));
        }
    }
}

<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploaderImage
{
    private $container;
    private $field;
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;
    }
    public function getDirectory()
    {
        return $this->container->getParameter('images_directory');
    }
    public function move($field, $fichier)
    {
        try {
            $field->move(
                $this->getDirectory(),
                $fichier
            );
        } catch (FileException $e) {
        };
        return $this->container->getParameter('images_directory');
    }

    public function getField()
    {
        return $this->container->getParameter('images_directory');
    }
}

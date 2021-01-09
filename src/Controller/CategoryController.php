<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{
    private $entityManagerInterface;
    private $sluggerInterface;
    public function __construct(EntityManagerInterface $entityManagerInterface, SluggerInterface $sluggerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->sluggerInterface = $sluggerInterface;
    }
    /**
     * @Route("/admin/category/create", name="category_create")
     */
    public function createCategory(Request $request): Response
    {
        $category = new Categoria;
        $form = $this->createForm(CategoriaType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category->setSlug(strtolower($this->sluggerInterface->slug($category->getNomeCategoria())));
            $this->entityManagerInterface->persist($category);
            $this->entityManagerInterface->flush();
            $this->addFlash('success', "la categoria è stata   creata");
            return $this->redirectToRoute('home_index', []);
        }
        return $this->render('category/create.html.twig', [
            'formView' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function editCategory($id, CategoriaRepository $categoriaRepository, Request $request): Response
    {
        $category = $categoriaRepository->find($id);
        $form = $this->createForm(CategoriaType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManagerInterface->persist($category);

            $this->entityManagerInterface->flush();
            $this->addFlash('success', "la categoria è stata  modificato");

            return $this->redirectToRoute('home_index', []);
        }



        return $this->render('category/edit.html.twig', [
            'formView' => $form->createView(),

        ]);
    }
}

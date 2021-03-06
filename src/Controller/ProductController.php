<?php

namespace App\Controller;


use App\Entity\Prodotto;
use App\Entity\Categoria;
use App\Form\ProdottoType;
use App\Repository\ProdottoRepository;
use App\Repository\CategoriaRepository;
use App\Service\UploaderFile;
use App\Service\UploaderImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProductController extends AbstractController
{
    private $entityManagerInterface;
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }
    /**
     * @Route("/{slug}", name="prodotto_categorie" , priority=-1)
     * @IsGranted("ROLE_USER")
     */
    public function categorie($slug, CategoriaRepository $categoriaRepository): Response
    {
        $categoria = $categoriaRepository->findOneBy([
            'slug' => $slug
        ]);
        if (!$categoria) {

            throw $this->createNotFoundException("La cetegoria richiest non esiste");
        }
        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'categoria' => $categoria,


        ]);
    }
    /**
     * @Route("/{slug_categoria}/{slug_prodotto}", name="prodotto_show", priority=-1)
     * @IsGranted("ROLE_USER")
     */
    public function show($slug_prodotto, ProdottoRepository $prodottoRepository): Response
    {
        $product = $prodottoRepository->findOneBy([
            'slug' => $slug_prodotto
        ]);
        if (!$product) {
            throw $this->createNotFoundException("Il prodotto richiesto no esiste");
        }
        return $this->render('product/show.html.twig', [
            'product' => $product,


        ]);
    }
    /**
     *  @Route("/admin/product/{id}/edit", name="prodotto_edit")
     */
    public function edit($id, ProdottoRepository $prodottoRepository, Request $request, UploaderImage $uploaderImage): Response
    {
        $prodotto = $prodottoRepository->find($id);
        if (!$prodotto) {
            throw $this->createNotFoundException("Il prodotto richiesta non esiste");
        }
        $form = $this->createForm(ProdottoType::class, $prodotto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('coverImage')->getData();
            $fichier =  md5(uniqid()) . '.' . $image->guessExtension();
            $uploaderImage->move($image, $fichier);
            $prodotto->setCoverImage($fichier);
            $this->entityManagerInterface->persist($prodotto);
            $this->entityManagerInterface->flush();
            $this->addFlash('success', "Il prodotto è stato modificato!");

            return $this->redirectToRoute('prodotto_show', [
                'slug_categoria' => $prodotto->getCategoria()->getSlug(),
                'slug_prodotto' => $prodotto->getSlug()
            ]);
        }

        $formView = $form->createView();


        return $this->render("product/edit.html.twig", compact('formView', 'prodotto'));
    }

    /**
     * @Route("/admin/product/create", name="prodotto_create")
     */
    public function create(Request $request, UploaderImage $uploaderImage): Response
    {
        /*  $image = new Imaggine;
        $image->setCaption("caption")->setLinkImaggine("uri"); */

        $prodotto = new Prodotto;
        // $prodotto->addImaggine($image);
        // $builder = $formFactoryInterface->createBuilder(ProdottoType::class);
        $form = $this->createForm(ProdottoType::class, $prodotto);
        //$form = $builder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //  $prodotto->setSlug(strtolower($sluggerInterface->slug($prodotto->getNomeStile())));
            $image = $form->get('coverImage')->getData();
            //$image->guessExtension();
            $fichier =  md5(uniqid()) . '.' . $image->guessExtension();
            $uploaderImage->move($image, $fichier);



            $prodotto->setCoverImage($fichier);
            $this->entityManagerInterface->persist($prodotto);
            $this->entityManagerInterface->flush();
            $this->addFlash('success', "Il prodotto è stato modificato");
            return $this->redirectToRoute('prodotto_show', [
                'slug_categoria' => $prodotto->getCategoria()->getSlug(),
                'slug_prodotto' => $prodotto->getSlug()
            ]);
        }

        return $this->render('product/create.html.twig', [
            'formView' => $form->createView()
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @Route("/register", name="account_register")
     */
    public function register(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordEncoderInterface $userPasswordEncoder): Response
    {
        $user = new User;
        $formRegister =  $this->createForm(RegistrationType::class, $user);
        $formRegister->handleRequest($request);
        if ($formRegister->isSubmitted() && $formRegister->isValid()) {
            $hash = $userPasswordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $entityManagerInterface->persist($user);

            $entityManagerInterface->flush();
            $this->addFlash('success', 'ti sei registrato con successo riceverai una mail di conferma dall\'amministratore');
        }
        $formRegister = $formRegister->createView();
        return $this->render('account/registration.html.twig', compact('formRegister'));
    }
    /**
     * @Route("/account/profile", name="account_profile",priority=1)
     */
    public function profile(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash("success", "Hai modificato con successo il tuo profilo");
        }
        return $this->render('account/editProfile.html.twig', [
            'formAccountEdit' => $form->createView()
        ]);
    }

    /**
     * @Route("/account/update-password", name="account_update_password",priority=1)
     */
    public function updatePassword(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $userPasswordEncoderInterface): Response
    {
        $passwordUpdat = new PasswordUpdate;

        $user = $this->getUser();
        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!password_verify($passwordUpdat->getOldPassword(), $user->getPassword())) {
                $form->get("oldPassword")->addError(new  FormError("la password inserita non è la tua password attuale, inserisci la password corretta per cambiarla"));
            } else {
                $newPassword = $passwordUpdat->getNewPassword();
                $hash = $userPasswordEncoderInterface->encodePassword($user, $newPassword);
                $user->setPassword($hash);
                $em->flush();
                $this->addFlash("success", "Hai modificato con successo la password");
                return $this->redirectToRoute("home_index");
            }
        }
        return $this->render('account/password.html.twig', [
            'formAccountPasswordUpdate' => $form->createView()
        ]);
    }
}

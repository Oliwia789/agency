<?php

namespace App\Controller;

use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{

    #[Route("/inscription", name: "security_registration")]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $userPasswordHasherInterface->hashPassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render("security/registration.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route("/connexion", name: "security_login")]
    public function login()
    {
        return $this->render("security/login.html.twig");
    }

    #[Route("/deconnexion", name: "security_logout")]
    public function logout()
    {
    }
}

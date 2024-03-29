<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    private $passwordHasher;
    private $manager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $manager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->manager = $manager;
    }

    #[Route('/inscription', name: 'register')]
    public function index(Request $request,): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );

            $user->setPassword($hashedPassword);

            //fait persister les données dans le temps
            $this->manager->persist($user);

            //ecrit dans la base de données
            $this->manager->flush();

            $this->addFlash(
                'success',
                'Le compte '.$user->getEmail().' a bien été créé.'
            );
        return $this->redirectToRoute('app_login');

        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

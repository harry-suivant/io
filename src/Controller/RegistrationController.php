<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\HybrideDigitalAuthenticator;
use App\Service\PasswordManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @IsGranted("ROLE_ADMIN")
     */
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        GuardAuthenticatorHandler $guardHandler,
        HybrideDigitalAuthenticator $authenticator,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        PasswordManager $passwordManager
    ): ?Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordManager->generate(8);
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $password
                )
            )
                ->setFirstConnection(false);

            $entityManager->persist($user);
            $entityManager->flush();

            $url = $request->getSchemeAndHttpHost();

            $mailParameter = $this->getParameter('mailer_from');
            if (isset($mailParameter)) {
                $email = new Email();
                $email->from(strval($mailParameter))
                    ->to((string)$user->getEmail())
                    ->html($this->renderView(
                        'admin/registrationEmail.html.twig',
                        [
                            'user' => $user,
                            'password' => $password,
                            'url' => $url,
                        ]
                    ));
                $mailer->send($email);
                $this->addFlash('success', "Nouvel utilisateur créé!");
            }

            return $this->redirectToRoute('app_register', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

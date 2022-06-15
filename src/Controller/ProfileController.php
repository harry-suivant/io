<?php

namespace App\Controller;

use App\Entity\SocialMedia;
use App\Entity\User;
use App\Form\SocialMediaType;
use App\Repository\UserRepository;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\PasswordChangeType;
use App\Service\PasswordManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/profile", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('customer/profile/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/update", name="update", methods={"GET", "POST"})
     */
    public function update(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('profile_index', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/update.html.twig', [
            'updateForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/newSocialMedias", name="newSocialMedias", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $socialMedias = new SocialMedia();
        $user = $this->getUser();
        if ($user instanceof User) {
            $socialMedias->setUser($user);
        }
        $form = $this->createForm(SocialMediaType::class, $socialMedias);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($socialMedias);
            $entityManager->flush();

            return $this->redirectToRoute('profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer/profile/newSocialMedias.html.twig', [
            'SocialMedias' => $socialMedias,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/SocialMediaUpdate", name="SocialMediaUpdate", methods={"GET", "POST"})
     */
    public function socialMediaUpdate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $socialMedias = null;
        $user = $this->getUser();
        if ($user instanceof User) {
            $socialMedias = $user->getSocialMedias();
        }
        $form = $this->createForm(SocialMediaType::class, $socialMedias);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer/profile/updateSocialMedia.html.twig', ['updateform' => $form->createView()]);
    }

    /**
     * @Route("/password", name="password")
     */
    public function changePassword(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        PasswordManager $passwordManager
    ): Response {
        $user = $this->getUser();

        if ($user && ($user instanceof User)) {
            $form = $this->createForm(PasswordChangeType::class);
            $form->handleRequest($request);

            if (
                $form->isSubmitted() &&
                $form->isValid() &&
                is_array($request->get('password_change'))
            ) {
                $currentGivenPassword = $request->get('password_change')['currentPassword'];

                if ($userPasswordHasher->isPasswordValid($user, $currentGivenPassword)) {
                    $newPassword = $request->get('password_change')['newPassword'];
                    $newPasswordConfirm = $request->get('password_change')['newPasswordConfirm'];

                    if (
                        $passwordManager->isPasswordValid(
                            $currentGivenPassword,
                            $newPassword,
                            $newPasswordConfirm
                        )
                    ) {
                        $user->setPassword(
                            $userPasswordHasher->hashPassword(
                                $user,
                                $newPassword
                            )
                        );
                        $user->setFirstConnection(true);
                        $entityManager->persist($user);
                        $entityManager->flush();

                        $this->addFlash(
                            'success',
                            'Votre mot de passe a été changé avec succès! Veuillez vous reconnecter.'
                        );

                        return $this->redirectToRoute('app_login');
                    } else {
                        $this->addFlash(
                            'danger',
                            'Votre nouveau mot de passe doit être différent du précédent.'
                        );
                    }
                } else {
                    $this->addFlash('danger', 'Les champs sont incorrects.');
                }
            }

            return $this->render('security/passwordUpdate.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
}

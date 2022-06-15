<?php

namespace App\Controller;

use App\Entity\RoadmapCheck;
use App\Entity\User;
use App\Form\NewRoadmapType;
use App\Form\UserType;
use App\Repository\RoadmapRepository;
use App\Service\RoadmapManagement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user", name="user_")
 * @IsGranted("ROLE_ADMIN")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render(
            'user/index.html.twig',
            ['users' => $users]
        );
    }

    /**
     * @Route("/{id}", name="show", methods={"GET", "POST"})
     */
    public function show(
        Request $request,
        User $user,
        RoadmapManagement $roadmapManagement,
        RoadmapRepository $roadmapRepository
    ): Response {
        $roadmapCheck = new RoadmapCheck();
        $form = $this->createForm(NewRoadmapType::class, $roadmapCheck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if ($data instanceof RoadmapCheck) {
                $dataRoadmap = $data->getRoadmap();
                if (!is_null($dataRoadmap)) {
                    $roadmapId = (int)$dataRoadmap->getId();
                    $roadmap = $roadmapRepository->getRoadmap($roadmapId);
                    if (!is_null($roadmap)) {
                        $roadmapManagement->newRoadmap($roadmap, $user);
                    }
                }
            }
        }

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
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

            return $this->redirectToRoute('user_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/update.html.twig', [
            'updateForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}

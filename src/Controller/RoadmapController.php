<?php

namespace App\Controller;

use App\Entity\Roadmap;
use App\Entity\User;
use App\Form\RoadmapType;
use App\Repository\RoadmapRepository;
use App\Repository\StepRepository;
use App\Service\RoadmapManagement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/roadmap")
 * @IsGranted("ROLE_USER")
 */
class RoadmapController extends AbstractController
{
    /**
     * @Route("/", name="roadmap_index", methods={"GET"})
     */
    public function index(RoadmapRepository $roadmapRepository): Response
    {
        return $this->render('roadmap/index.html.twig', [
            'roadmaps' => $roadmapRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="roadmap_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $roadmap = new Roadmap();
        $form = $this->createForm(RoadmapType::class, $roadmap);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($roadmap);
            $entityManager->flush();

            return $this->redirectToRoute('roadmap_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('roadmap/new.html.twig', [
            'roadmap' => $roadmap,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="roadmap_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Roadmap $roadmap): Response
    {
        return $this->render('roadmap/show.html.twig', [
            'roadmap' => $roadmap,
        ]);
    }

    /**
     * @Route("/user/roadmapShow", name="roadmap_showUser", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function showUser(): Response
    {
        $user = $this->getUser();
        return $this->render('roadmap/showUser.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="roadmap_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(
        Request $request,
        Roadmap $roadmap,
        EntityManagerInterface $entityManager,
        RoadmapManagement $roadmapManagement,
        StepRepository $stepRepository
    ): Response {
        $form = $this->createForm(RoadmapType::class, $roadmap);
        $stepsStart = $roadmap->getSteps();
        $arrayStartSteps = [];
        foreach ($stepsStart as $stepStart) {
            $arrayStartSteps[] = $stepStart->getId();
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stepsSubmited = $roadmap->getSteps();
            $arrayEndSteps = [];
            foreach ($stepsSubmited as $stepSubmited) {
                $arrayEndSteps[] = $stepSubmited->getId();
            }
            $steps = array_diff($arrayEndSteps, $arrayStartSteps);
            if (!(count($steps) == 0)) {
                foreach ($steps as $step) {
                    $stepSelect = $stepRepository->find($step);
                    if ($stepSelect) {
                        $roadmapManagement->updateRoadmap($stepSelect, $roadmap);
                    }
                }
            }
            $entityManager->flush();

            return $this->redirectToRoute('roadmap_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('roadmap/edit.html.twig', [
            'roadmap' => $roadmap,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="roadmap_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(
        Request $request,
        Roadmap $roadmap,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $roadmap->getId(), (string)$request->request->get('_token'))) {
            $entityManager->remove($roadmap);
            $entityManager->flush();
        }

        return $this->redirectToRoute('roadmap_index', [], Response::HTTP_SEE_OTHER);
    }
}

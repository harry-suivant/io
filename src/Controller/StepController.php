<?php

namespace App\Controller;

use App\Entity\ActionCheck;
use App\Entity\Step;
use App\Entity\StepCheck;
use App\Form\StepType;
use App\Repository\ActionRepository;
use App\Repository\StepRepository;
use App\Service\RoadmapManagement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/step", name="step_")
 * @IsGranted("ROLE_USER")
 */
class StepController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(StepRepository $stepRepository): Response
    {
        return $this->render('step/index.html.twig', [
            'steps' => $stepRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $step = new Step();
        $form = $this->createForm(StepType::class, $step);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($step);
            $entityManager->flush();

            return $this->redirectToRoute('step_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('step/new.html.twig', [
            'step' => $step,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/{id}", name="show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Step $step): Response
    {
        return $this->render('step/show.html.twig', [
            'step' => $step,
        ]);
    }

    /**
     * @Route("/user/{id}", name="userShow", methods={"GET"})
     */
    public function showUser(StepCheck $stepCheck): Response
    {
        $user = $this->getUser();
        if (!is_null($stepCheck->getRoadmapCheck())) {
            $userCheck = $stepCheck->getRoadmapCheck()->getUser();

            if ($userCheck === $user) {
                $step = $stepCheck->getStep();
                $actionChecks = $stepCheck->getActionChecks();
                $stepCheck = $stepCheck->getIsComplete();

                return $this->render('step/showUser.html.twig', [
                    'step' => $step,
                    'action_checks' => $actionChecks,
                    'step_check' => $stepCheck,
                ]);
            }
        }
        return new Response("Vous n'avez pas accès à cette page.", 403);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(
        Request $request,
        Step $step,
        EntityManagerInterface $entityManager,
        ActionRepository $actionRepository,
        RoadmapManagement $roadmapManagement
    ): Response {
        $id = $step->getId();
        $form = $this->createForm(StepType::class, $step);
        $actionsStart = $step->getActions();
        $arrayStartActions = [];
        foreach ($actionsStart as $actionStart) {
            $arrayStartActions[] = $actionStart->getId();
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actionsSubmited = $step->getActions();
            $arrayEndActions = [];
            foreach ($actionsSubmited as $actionSubmited) {
                $arrayEndActions[] = $actionSubmited->getId();
            }
            $actions = array_diff($arrayEndActions, $arrayStartActions);
            if (!(count($actions) == 0)) {
                foreach ($actions as $action) {
                    $actionSelect = $actionRepository->find($action);
                    if ($actionSelect) {
                        $roadmapManagement->updateStep($step, $actionSelect);
                    }
                }
            }
            $entityManager->flush();

            return $this->redirectToRoute('step_show', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('step/edit.html.twig', [
            'step' => $step,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Step $step, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $step->getId(), (string)$request->request->get('_token'))) {
            $entityManager->remove($step);
            $entityManager->flush();
        }

        return $this->redirectToRoute('step_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\ActionCheck;
use App\Form\IsActionCompleteType;
use App\Form\ActionType;
use App\Repository\ActionRepository;
use App\Service\CheckGestion;
use App\Service\CheckValidity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/action", name="action_")
 * @IsGranted("ROLE_USER")
 */
class ActionController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(ActionRepository $actionRepository): Response
    {
        return $this->render('action/index.html.twig', [
            'actions' => $actionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $action = new Action();
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($action);
            $entityManager->flush();

            return $this->redirectToRoute('action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('action/new.html.twig', [
            'action' => $action,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/{id}", name="show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Action $action): Response
    {
        return $this->render('action/show.html.twig', [
            'action' => $action,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Action $action, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('action/edit.html.twig', [
            'action' => $action,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Action $action, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $action->getId(), (string)$request->request->get('_token'))) {
            $entityManager->remove($action);
            $entityManager->flush();
        }

        return $this->redirectToRoute('action_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/user/{id}", name="showUser", methods={"GET", "POST"})
     */
    public function showUser(
        ActionCheck $actionCheck,
        Request $request,
        EntityManagerInterface $entityManager,
        CheckGestion $checkGestion
    ): Response {
        $stepCheck = $actionCheck->getStepCheck();
        if (!is_null($stepCheck)) {
            $roadmapCheck = $stepCheck->getRoadmapCheck();

            if (!is_null($roadmapCheck)) {
                $userCheck = $roadmapCheck->getUser();
                $user = $this->getUser();

                if ($userCheck === $user) {
                    $action = $actionCheck->getAction();

                    $form = $this->createForm(IsActionCompleteType::class, $actionCheck);
                    $form->handleRequest($request);

                    if ($form->isSubmitted() && $form->isValid()) {
                        if ($form['isComplete']) {
                            $actionCheck->setIsComplete(true);
                        } else {
                            $actionCheck->setIsComplete(false);
                        }
                        $entityManager->flush();
                        $checkGestion->checkAction($actionCheck);

                        if ($actionCheck->getStepCheck()) {
                            $stepCheck = $actionCheck->getStepCheck();
                            $checkStepId = $stepCheck->getId();

                            return $this->redirectToRoute('step_userShow', ['id' => $checkStepId]);
                        }
                    }
                    return $this->render('action/showUser.html.twig', [
                        'actionCheck' => $actionCheck,
                        'action' => $action,
                        'form' => $form->createView()
                    ]);
                }
            }
        }
        return new Response("Vous n'avez pas accès à cette page.", 403);
    }
}

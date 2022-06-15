<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Service\ControlUpload;
use App\Form\RessourceType;
use App\Repository\RessourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormError;

/**
 * @Route("/ressource", name="ressource")
 * @IsGranted("ROLE_USER")
 */
class RessourceController extends AbstractController
{
    /**
     * @Route("/", name="_index", methods={"GET"})
     */
    public function index(RessourceRepository $ressourceRepository): Response
    {
        return $this->render('ressource/index.html.twig', [
            'ressources' => $ressourceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager, ControlUpload $controlUpload): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $extension = "";

            if (null !== $ressource->getImageFile()) {
                $extension = $controlUpload->extensionValidity($ressource);
            }
            $authorizedTypes = ['image', 'video', 'pdf'];
            if (in_array($extension, $authorizedTypes) || $extension === "") {
                $ressource->setType($extension);
                $entityManager->persist($ressource);
                $entityManager->flush();
                return $this->redirectToRoute('ressource_index', [], Response::HTTP_SEE_OTHER);
            } else {
                if ($extension) {
                    $form->addError(new FormError($extension));
                }
            }
        }

        return $this->renderForm('ressource/new.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="_show", methods={"GET"})
     */
    public function show(Ressource $ressource): Response
    {
        return $this->render('ressource/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(
        Request $request,
        Ressource $ressource,
        EntityManagerInterface $entityManager,
        ControlUpload $controlUpload
    ): Response {

        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $extension = "";
            $authorizedTypes = ['image', 'video', 'pdf'];

            if (null !== $ressource->getImageFile()) {
                $extension = $controlUpload->extensionValidity($ressource);
            }

            if (in_array($extension, $authorizedTypes) || $extension === "") {
                $ressource->setType($extension);
                $entityManager->persist($ressource);
                $entityManager->flush();
                return $this->redirectToRoute('ressource_index', [], Response::HTTP_SEE_OTHER);
            } else {
                if ($extension) {
                    $form->addError(new FormError($extension));
                }
            }
        }

        return $this->renderForm('ressource/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Ressource $ressource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ressource->getId(), (string)$request->request->get('_token'))) {
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ressource_index', [], Response::HTTP_SEE_OTHER);
    }
}

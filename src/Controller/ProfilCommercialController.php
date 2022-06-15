<?php

namespace App\Controller;

use App\Entity\ProfilCommercial;
use App\Entity\Profil;
use App\Form\ProfilCommercialType;
use App\Repository\ProfilComRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/profil/commercial")
 */
class ProfilCommercialController extends AbstractController
{
    /**
     * @Route("/", name="profil_commercial_index", methods={"GET"})
     */
    public function index(ProfilComRepository $profilComRepository): Response
    {
        return $this->render('profil_commercial/index.html.twig', [
            'profil_commercials' => $profilComRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{profil}", name="profil_commercial_new", methods={"GET", "POST"})
     * @ParamConverter("profil", class="App\Entity\Profil", options={"mapping": {"profil": "id"}})
     */
    public function new(Profil $profil, Request $request, EntityManagerInterface $entityManager): Response
    {
        $profilCommercial = new ProfilCommercial();
        $form = $this->createForm(ProfilCommercialType::class, $profilCommercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilCommercial->setProfil($profil);
            $entityManager->persist($profilCommercial);
            $entityManager->flush();

            return $this->redirectToRoute(
                'profil_marketing_new',
                ['profil' => $profil->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('profil_commercial/new.html.twig', [
            'profil_commercial' => $profilCommercial,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="profil_commercial_show", methods={"GET"})
     */
    public function show(Profil $profil): Response
    {
        $profilCommercial = $profil->getProfilCommercial();
        $form = $this->createForm(ProfilCommercialType::class, $profilCommercial);

        return $this->render('profil_commercial/show.html.twig', [
            'profil' => $profil,
            'profil_commercial' => $profilCommercial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="profil_commercial_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        ProfilCommercial $profilCommercial,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(ProfilCommercialType::class, $profilCommercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'profil_commercial_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('profil_commercial/edit.html.twig', [
            'profil_commercial' => $profilCommercial,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="profil_commercial_delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        ProfilCommercial $profilCommercial,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $profilCommercial->getId(), (string)$request->request->get('_token'))) {
            $entityManager->remove($profilCommercial);
            $entityManager->flush();
        }

        return $this->redirectToRoute(
            'profil_commercial_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}

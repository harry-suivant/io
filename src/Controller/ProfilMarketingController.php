<?php

namespace App\Controller;

use App\Entity\ProfilMarketing;
use App\Entity\Profil;
use App\Form\ProfilMarketingType;
use App\Repository\ProfilMarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/profil/marketing")
 */
class ProfilMarketingController extends AbstractController
{
    /**
     * @Route("/", name="profil_marketing_index", methods={"GET"})
     */
    public function index(ProfilMarRepository $profilMarRepository): Response
    {
        return $this->render('profil_marketing/index.html.twig', [
            'profil_marketings' => $profilMarRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{profil}", name="profil_marketing_new", methods={"GET", "POST"})
     * @ParamConverter("profil", class="App\Entity\Profil", options={"mapping": {"profil": "id"}})
     */
    public function new(
        Request $request,
        Profil $profil,
        EntityManagerInterface $entityManager
    ): Response {
        $profilMarketing = new ProfilMarketing();
        $form = $this->createForm(ProfilMarketingType::class, $profilMarketing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilMarketing->setProfil($profil);
            $entityManager->persist($profilMarketing);
            $entityManager->flush();

            //return $this->redirectToRoute('profil_marketing_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute(
                'profil_index_customer',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('profil_marketing/new.html.twig', [
            'profil_marketing' => $profilMarketing,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="profil_marketing_show", methods={"GET"})
     */
    public function show(Profil $profil): Response
    {
        $profilMarketing = $profil->getProfilMarketing();
        $form = $this->createForm(ProfilMarketingType::class, $profilMarketing);

        return $this->render('profil_marketing/show.html.twig', [
            'profil' => $profil,
            'profil_marketing' => $profilMarketing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="profil_marketing_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        ProfilMarketing $profilMarketing,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(ProfilMarketingType::class, $profilMarketing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'profil_marketing_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('profil_marketing/edit.html.twig', [
            'profil_marketing' => $profilMarketing,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="profil_marketing_delete", methods={"POST"})
     */
    public function delete(
        Request $request,
        ProfilMarketing $profilMarketing,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $profilMarketing->getId(), (string)$request->request->get('_token'))) {
            $entityManager->remove($profilMarketing);
            $entityManager->flush();
        }

        return $this->redirectToRoute(
            'profil_marketing_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}

<?php

namespace App\Controller;

use App\Entity\Credits;
use App\Form\CreditsType;
use App\Repository\CreditsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/credits')]
final class CreditsController extends AbstractController
{
    #[Route(name: 'app_credits_index', methods: ['GET'])]
    public function index(CreditsRepository $creditsRepository): Response
    {
        return $this->render('credits/index.html.twig', [
            'credits' => $creditsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_credits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        $credit = new Credits();
        $form = $this->createForm(CreditsType::class, $credit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($credit);
            $entityManager->flush();

            return $this->redirectToRoute('app_credits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('credits/new.html.twig', [
            'credit' => $credit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_credits_show', methods: ['GET'])]
    public function show(Credits $credit): Response
    {
        return $this->render('credits/show.html.twig', [
            'credit' => $credit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_credits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Credits $credit, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        $form = $this->createForm(CreditsType::class, $credit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_credits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('credits/edit.html.twig', [
            'credit' => $credit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_credits_delete', methods: ['POST'])]
    public function delete(Request $request, Credits $credit, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$credit->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($credit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_credits_index', [], Response::HTTP_SEE_OTHER);
    }
}

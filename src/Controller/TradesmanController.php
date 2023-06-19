<?php

namespace App\Controller;

use App\Entity\Tradesman;
use App\Form\TradesmanType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tradesman')]
class TradesmanController extends AbstractController
{
    #[Route('/', name: 'app_tradesman_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tradesmen = $entityManager
            ->getRepository(Tradesman::class)
            ->findAll();

        return $this->render('tradesman/index.html.twig', [
            'tradesmen' => $tradesmen,
        ]);
    }

    #[Route('/new', name: 'app_tradesman_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tradesman = new Tradesman();
        $form = $this->createForm(TradesmanType::class, $tradesman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tradesman);
            $entityManager->flush();

            return $this->redirectToRoute('app_tradesman_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tradesman/new.html.twig', [
            'tradesman' => $tradesman,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tradesman_show', methods: ['GET'])]
    public function show(Tradesman $tradesman): Response
    {
        return $this->render('tradesman/show.html.twig', [
            'tradesman' => $tradesman,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tradesman_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tradesman $tradesman, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TradesmanType::class, $tradesman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tradesman_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tradesman/edit.html.twig', [
            'tradesman' => $tradesman,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tradesman_delete', methods: ['POST'])]
    public function delete(Request $request, Tradesman $tradesman, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tradesman->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tradesman);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tradesman_index', [], Response::HTTP_SEE_OTHER);
    }
}

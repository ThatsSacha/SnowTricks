<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Service\TrickService;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/trick')]
class TrickController extends AbstractController
{
    private $service;

    public function __construct(TrickService $service)
    {
        $this->service = $service;
    }

    #[Route('/is-authenticated/{id}/edit', name: 'trick_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, Trick $trick): Response
    {
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trickEdited = $this->service->edit($trick);

            if ($trickEdited instanceof Trick) {
                return $this->redirectToRoute('trick_show', ['slug' => $trickEdited->getSlug()]);
            } else {
                $this->addFlash($trickEdited['type'], $trickEdited['message']);
            }
        }
        
        return $this->renderForm('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('', name: 'trick_index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('trick/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }

    #[Route('/is-authenticated/new', name: 'trick_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trickCreated = $this->service->new($trick, $this->getUser());
            
            if ($trickCreated instanceof Trick) {
                return $this->redirectToRoute('trick_show', ['slug' => $trickCreated->getSlug()]);
            } else {
                $this->addFlash($trickCreated['type'], $trickCreated['message']);
            }
        }

        return $this->renderForm('trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'trick_show', methods: ['GET'])]
    public function show(Trick $trick): Response
    {
        return $this->render('trick/show.html.twig', [
            'trick' => $trick
        ]);
    }

    #[Route('/{slug}/{numberComments}', name: 'trick_show_comments', methods: ['GET'])]
    public function showWithComments(Trick $trick, int $numberComments): Response
    {
        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'numberComments' => $numberComments
        ]);
    }

    #[Route('/is-authenticated/{id}', name: 'trick_delete', methods: ['POST'])]
    public function delete(Request $request, Trick $trick, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trick_index', [], Response::HTTP_SEE_OTHER);
    }
}

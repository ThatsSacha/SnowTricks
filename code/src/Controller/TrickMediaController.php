<?php

namespace App\Controller;

use App\Entity\TrickMedia;
use App\Form\TrickMedia1Type;
use App\Repository\TrickMediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/trick/media')]
class TrickMediaController extends AbstractController
{

    #[Route('/{id}', name: 'trick_media_delete', methods: ['GET'])]
    public function delete(Request $request, TrickMedia $trickMedia, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trickMedia->getId(), $request->query->get('_token'))) {
            $entityManager->remove($trickMedia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trick_edit', ['id' => $trickMedia->getTrick()->getId()], Response::HTTP_SEE_OTHER);
    }
}

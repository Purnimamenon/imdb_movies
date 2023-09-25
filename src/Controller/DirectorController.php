<?php

namespace App\Controller;

use App\Entity\Director;
use App\Form\DirectorType;
use App\Repository\DirectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirectorController extends AbstractController
{
    #[Route('/director', name: 'director_index', methods: ['GET'])]
    public function index(DirectorRepository $directorRepository): Response
    {
        $directors = $directorRepository->findAll();

        return $this->render('director/index.html.twig', [
            'directors' => $directors,
        ]);
    }

    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $director = new Director();

        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($director);
            $entityManager->flush();

            return $this->redirectToRoute('director_index');
        }

        return $this->render('director/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/director/edit/{id}', name: 'director_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Director $director, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('director_index');
        }

        return $this->render('director/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/director/delete/{id}', name: 'director_delete', methods: ['GET', 'DELETE'])]
    public function delete(Request $request, Director $director, EntityManagerInterface $entityManager): Response
    {
        if (!$director) {
            throw $this->createNotFoundException('Category not found');
        }

        // Delete the category
        $entityManager->remove($director);
        $entityManager->flush();
        
        return $this->redirectToRoute('director_index');
    }

}

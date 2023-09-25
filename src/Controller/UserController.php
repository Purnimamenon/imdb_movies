<?php

namespace App\Controller;

use App\Entity\Imdbmovies;
use App\Entity\Category;
use App\Repository\ImdbmoviesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


   
    public function userdashboard(Request $request , ImdbmoviesRepository $imdbmoviesRepository): Response{
     
     $movies = $imdbmoviesRepository->findAll();
     $uid = $request->attributes->get('userId');
    //  print_r($uid);
    //  die;
     $categoryNames = [];
     foreach ($movies as $movie) {
     
         
         $categoryId = $movie->getCategoryId();
     
         $category = $this->entityManager->getRepository(Category::class)->findOneBy(['id' => $categoryId]);
         
         $categoryName = $category ? $category->getCategoryname() : '';
         // echo "sdasd";
         // print_r($categoryName);
         // die;
         $categoryNames[$movie->getmovie_Id()] = $categoryName;
     }

     return $this->render('user/user_dashboard.html.twig', [
            'movies' => $movies,
            'categoryNames' => $categoryNames,
            'userId' => $uid
        ]);
 
    }
}

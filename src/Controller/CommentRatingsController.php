<?php

namespace App\Controller;

use App\Entity\Commentreview;
use App\Entity\User;
use App\Entity\Imdbmovies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentreviewRepository;
use App\Repository\UserRepository;
use App\Repository\ImdbmoviesRepository;



class CommentRatingsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


  #[Route('/view_comments_reviews', name: 'app_comment_ratings')]
  public function viewCommentsReviews(Request $request)
  {
    $user = $this->entityManager->getRepository(User::class)->findAll();

    $movies = $this->entityManager->getRepository(Imdbmovies::class)->findAll();

    $commentReviews = $this->entityManager->getRepository(Commentreview::class)->findAll();
    // print_r($commentReviews);
    // die;
    $movieNames = [];
    
        foreach ($commentReviews as $comment) {
        
            
            $movieId = $comment->getMovieId();
        
            $moviename = $this->entityManager->getRepository(Imdbmovies::class)->findOneBy(['movie_Id' => $movieId]);
            // print_r($moviename);
            // die;
            $movieName = $moviename ? $moviename->getMovieName() : '';
            // echo "sdasd";
            // print_r($movieName);
            // die;
            $movieNames[$comment->getMovieId()] = $movieName;
        }


     $userNames = [];

     foreach ($commentReviews as $comment) {
        
            
        $userId = $comment->getUserId();
    
        $username = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $userId]);
        // print_r($moviename);
        // die;
        $UserName = $username ? $username->getUsername() : '';
        // echo "sdasd";
        // print_r($movieName);
        // die;
        $userNames[$comment->getUserId()] = $UserName;
    }
           
    return $this->render('comment_ratings/index.html.twig', [
        'commentReviews' => $commentReviews,
        'movieNames' => $movieNames,
        'userNames' => $userNames
    ]);
  }
}

<?php

namespace App\Controller;

use App\Entity\Imdbmovies;
use App\Entity\Category;
use App\Entity\Director;
use App\Entity\Commentreview;
use App\Form\ImdbMovieType;
use App\Repository\ImdbmoviesRepository;
use App\Repository\CategoryRepository;
use App\Repository\DirectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/movies', name: 'app_movie_index')]
    public function index(CategoryRepository $categoryRepository,DirectorRepository $director): Response
    {
        $movies = $this->entityManager->getRepository(Imdbmovies::class)->findAll();
        // var_dump($movies);
        // die;

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

        $directorNames = [];
        foreach ($movies as $movie) {
        
            
            $directorId = $movie->getDirectorId();
        
            $director = $this->entityManager->getRepository(Director::class)->findOneBy(['id' => $directorId]);
            
            $directorName = $director ? $director->getName() : '';
            // echo "sdasd";
            // print_r($directorName);
            // die;
            $directorNames[$movie->getmovie_Id()] = $directorName;
        }
        
        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
            'categoryNames' => $categoryNames,
            'directorNames' => $directorNames
        ]);
    }

    #[Route('/movies/create', name: 'app_movie_create')]
    public function create(Request $request, EntityManagerInterface $entityManager, CategoryController $categoryController): Response
    {
        $movie = new Imdbmovies();

        $form = $this->createForm(ImdbMovieType::class, $movie);
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        // $category = $categoryController->show($form->get('category')->getData());

        // // Set the Category entity on the Movie entity.
        // if ($category instanceof App\Entity\Category) {
        //     // Set the Category entity on the Movie entity.
        //     $movie->setCategory($category);
        // } else {
        //     // Set the Category entity on the Movie entity to null.
        //     $movie->setCategory(null);
        // }
        
        // $imageFile = $form->get('movie_image')->getData();
    
        //     if ($imageFile) {
        //         $imageName = uniqid().'.'.$imageFile->guessExtension();
        //         $imageFile->move(
        //             $this->getParameter('movie_images_directory'), // Use the parameter for the image directory
        //             $imageName
        //         );
        //         $movie->setMovieImage($imageName);
        //     }

            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('app_movie_index');
        }

        return $this->render('movie/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/movies/{id}', name: 'app_movie_show')]
    public function show(int $id): Response
    {
    $movie = $this->entityManager->getRepository(Imdbmovies::class)->find($id);
            
    $categoryId = $movie->getCategoryId();

    $category = $this->entityManager->getRepository(Category::class)->findOneBy(['id' => $categoryId]);
    
    $categoryName = $category ? $category->getCategoryname() : '';

    $categoryNames[$movie->getmovie_Id()] = $categoryName;


    $directorId = $movie->getDirectorId();

    $director = $this->entityManager->getRepository(Director::class)->findOneBy(['id' => $directorId]);
    
    $directorName = $director ? $director->getName() : '';

    $directorNames[$movie->getmovie_Id()] = $directorName;
        
  
    if (!$movie) {
        throw $this->createNotFoundException('Movie not found.');
    }

    return $this->render('movie/show.html.twig', [
        'movie' => $movie,
        'categoryNames' => $categoryNames,
        'directorNames' => $directorNames

    ]);
}


#[Route('/movies/{id}/edit', name: 'app_movie_edit')]
public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
{
    $movie = $this->entityManager->getRepository(Imdbmovies::class)->find($id);

    if (!$movie) {
        throw $this->createNotFoundException('Movie not found.');
    }

    $form = $this->createForm(ImdbMovieType::class, $movie);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('app_movie_index', ['id' => $movie->getmovie_Id()]);
    }

    return $this->render('movie/edit.html.twig', [
        'form' => $form->createView(),
    ]);
}


#[Route('/movies/{id}/delete', name: 'app_movie_delete')]
public function delete(int $id, EntityManagerInterface $entityManager): Response
{
    $movie = $this->entityManager->getRepository(Imdbmovies::class)->find($id);

    if (!$movie) {
        throw $this->createNotFoundException('Movie not found.');
    }

    $entityManager->remove($movie);
    $entityManager->flush();

    return $this->redirectToRoute('app_movie_index');
}


 public function addCommentReview(Request $request, $movieId)
 {
    
    // Retrieve the selected movie using the $movieId parameter
    $movie = $this->entityManager->getRepository(Imdbmovies::class)->find($movieId);
    $movies = $this->entityManager->getRepository(Imdbmovies::class)->findAll();

    foreach ($movies as $movie) {
     
         
        $categoryId = $movie->getCategoryId();
    
        $category = $this->entityManager->getRepository(Category::class)->findOneBy(['id' => $categoryId]);
        
        $categoryName = $category ? $category->getCategoryname() : '';
        // echo "sdasd";
        // print_r($categoryName);
        // die;
        $categoryNames[$movie->getmovie_Id()] = $categoryName;
      }

    if (!$movie) {
        throw $this->createNotFoundException('The movie with id ' . $movieId . ' does not exist.');
    }

    // Handle the form submission
    $comment = $request->request->get('comment');
    $rating = $request->request->get('review');
    $user_id = $request->request->get('user_id');

    // print_r($comment);
    // print_r($rating);
    // print_r($user_id);

    // die;
    // Create a new CommentReview entity
    $commentReview = new Commentreview();
    $commentReview->setComments($comment);
    $commentReview->setRatings($rating);
    $commentReview->setMovieId($movieId);
    $commentReview->setUserId($user_id);

        // print_r($commentReview);
        // die;
    // Persist the comment and review to the database
    $this->entityManager->persist($commentReview);
    $this->entityManager->flush();

    // Redirect to a success page or return a response as needed
    // For example, you can redirect back to the movie details page
    return $this->redirectToRoute('user_dashboard', ['userId' => $user_id]);
}


}

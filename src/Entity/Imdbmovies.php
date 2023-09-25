<?php

namespace App\Entity;

use App\Entity\Category;
use App\Repository\ImdbmoviesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImdbmoviesRepository::class)]
#[ORM\Table(name: '`imdb_movies`')]

class Imdbmovies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $movie_Id = null;

    #[ORM\Column(nullable: true)]
    private ?int $category_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $director_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $movie_name = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $release_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $movie_image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $movie_details = null;

    private ?Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }
    
    public function getmovie_Id(): ?int
    {
        return $this->movie_Id;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }


    public function getDirectorId(): ?int
    {
        return $this->director_id;
    }

    public function setDirectorId(?int $director_id): static
    {
        $this->director_id = $director_id;

        return $this;
    }

    public function getMovieName(): ?string
    {
        return $this->movie_name;
    }

    public function setMovieName(?string $movie_name): static
    {
        $this->movie_name = $movie_name;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(?\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getMovieImage(): ?string
    {
        return $this->movie_image;
    }

    public function setMovieImage(?string $movie_image): static
    {
        $this->movie_image = $movie_image;

        return $this;
    }

    public function getMovieDetails(): ?string
    {
        return $this->movie_details;
    }

    public function setMovieDetails(?string $movie_details): static
    {
        $this->movie_details = $movie_details;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

}

<?php

namespace App\Entity;

use App\Entity\Category;
use App\Repository\MovieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\Table(name: '`movies`')]

class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $movieName = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $releaseDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $movieImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $movieDetails = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovieName(): ?string
    {
        return $this->movieName;
    }

    public function setMoviename(?string $movieName): static
    {
        $this->movieName = $movieName;

        return $this;
    }

     /**
     * Get the category of the movie.
     *
     * @return Category|null
     */
    public function getCategory(): ?Category
    {

    return $this->category;

    }

    public function __toString(): string
    {

    return $this->category ? $this->category->getName() : '';

    }
    
    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getMovieImage(): ?string
    {
        return $this->movieImage;
    }

    public function setMovieImage(?string $movieImage): static
    {
        $this->movieImage = $movieImage;

        return $this;
    }

    public function getMovieDetails(): ?string
    {
        return $this->movieDetails;
    }

    public function setMovieDetails(?string $movieDetails): static
    {
        $this->movieDetails = $movieDetails;

        return $this;
    }
}

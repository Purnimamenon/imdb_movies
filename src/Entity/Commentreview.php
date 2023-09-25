<?php

namespace App\Entity;

use App\Repository\CommentreviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentreviewRepository::class)]
class Commentreview
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 550, nullable: true)]
    private ?string $comments = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ratings = null;

    #[ORM\Column(nullable: true)]
    private ?int $movie_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    public function getRatings(): ?string
    {
        return $this->ratings;
    }

    public function setRatings(?string $ratings): static
    {
        $this->ratings = $ratings;

        return $this;
    }

    public function getMovieId(): ?int
    {
        return $this->movie_id;
    }

    public function setMovieId(?int $movie_id): static
    {
        $this->movie_id = $movie_id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}

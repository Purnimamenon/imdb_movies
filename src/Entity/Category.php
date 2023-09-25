<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: '`category`')]

class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $categoryname = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $categorydescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryname(): ?string
    {
        return $this->categoryname;
    }

    public function setCategoryname(?string $categoryname): static
    {
        $this->categoryname = $categoryname;

        return $this;
    }

    public function getCategorydescription(): ?string
    {
        return $this->categorydescription;
    }

    public function setCategorydescription(?string $categorydescription): static
    {
        $this->categorydescription = $categorydescription;

        return $this;
    }
}

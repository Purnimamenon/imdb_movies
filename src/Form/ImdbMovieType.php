<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Director;
use App\Entity\Imdbmovies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImdbMovieType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        $directors = $this->entityManager->getRepository(Director::class)->findAll();


        
        $categoryChoices = ['-Select-' => ''];
        $directorChoices = ['-Select-' => ''];



        foreach ($categories as $category) {

            $categoryChoices[$category->getCategoryname()] = $category->getId();
        }

        foreach ($directors as $director) {

            $directorChoices[$director->getName()] = $director->getId();
        }

        $builder
            ->add('category_id', ChoiceType::class, [
                'choices' => $categoryChoices,
                'label' => 'Movie Category',
                'required' => false,
            ])

            ->add('director_id', ChoiceType::class, [
                'choices' => $directorChoices,
                'label' => 'Directors',
                'required' => false,
            ])

            ->add('movie_name', TextType::class, [
                'label' => 'Movie Name',
            ])
            ->add('release_date', DateTimeType::class, [
                'label' => 'Release Date',
            ])
            ->add('movie_image', FileType::class, [
                'label' => 'Movie Image',
                'mapped' => false,
            ])
            ->add('movie_details', TextareaType::class, [
                'label' => 'Movie Details',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Imdbmovies::class,
        ]);
    }
}

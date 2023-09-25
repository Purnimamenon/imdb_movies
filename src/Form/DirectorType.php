<?php

namespace App\Form;

use App\Entity\Director;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Name',
                'attr' => ['placeholder' => 'Director Name'],
            ])
            ->add('age',TextType::class, [
                'label' => 'Age',
                'attr' => ['placeholder' => 'Director Age'],
            ])
            ->add('experience',TextType::class, [
                'label' => 'Experience',
                'attr' => ['placeholder' => 'Experience in yrs..'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Director::class,
        ]);
    }
}

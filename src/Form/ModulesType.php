<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Programme;
use App\Entity\Modules;
use FFI\CData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomModule')
       
            ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'nomCategorie'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modules::class,
         
        ]);
    }
}

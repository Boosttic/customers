<?php

namespace App\Form;

use App\Entity\Sale;
use App\Entity\Machine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\MachineType;

class SaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option): void
    {
        $builder
            ->add('machines', CollectionType::class, ['entry_type' =>MachineType::class, 'allow_add' => true, 'allow_delete' => true, 'label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sale::class,
        ]);
    }
}

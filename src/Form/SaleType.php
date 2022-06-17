<?php

namespace App\Form;

use App\Entity\Sale;
use App\Entity\Customer;
use App\Entity\Machine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\ApplicationType;
use App\Form\CustomerformType;

class SaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('applications', CollectionType::class, ['entry_type' => ApplicationType::class, 'allow_add' => true, 'allow_delete' => true])
            ->add('customer', EntityType::class, ['class' =>Customer::class, 'multiple'=>true, 'expanded'=>true])
            ->add('machines', EntityType::class, ['class' =>Machine::class, 'multiple'=>true, 'expanded'=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sale::class,
        ]);
    }
}

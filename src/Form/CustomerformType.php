<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\ContactType;

class CustomerformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom'])
            ->add('city', TextType::class, ['label'=>'Ville'])
            ->add('country', TextType::class, ['label'=>'Pays'])
            ->add('address', TextType::class, ['label'=>'Adresse'])
            ->add('contacts', CollectionType::class, ['entry_type' => ContactType::class, 'allow_add' => true, 'allow_delete' => true, 'label'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}

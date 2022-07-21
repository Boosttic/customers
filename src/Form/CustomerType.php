<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('juridicalName', TextType::class, [
                'label' => 'customer.juridicalName'
            ])
            ->add('tradeName', TextType::class, [
                'label' => 'customer.tradeName'
            ])
            ->add('phone', TextType::class, [
                'label' => 'customer.phone'
            ])
            ->add('email', TextType::class, [
                'label' => 'customer.email'
            ])
            ->add('siret', TextType::class, [
                'label' => 'customer.siret'
            ])
            ->add('postalAddress', AddressType::class, [
                'label' => false
            ])
            ->add('billingAddress', AddressType::class, [
                'label' => false
            ])
            ->add('haveBillingAddress', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'customer.haveBillingAddress'
            ])
            ->add('contacts', CollectionType::class, [

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}

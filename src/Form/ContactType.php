<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, ['label'=>'Email'])
            ->add('is_main', null, ['label'=>'Contact Principale ?'])
            ->add('tel', null, ['label'=>'Téléphone (falcultatif)'])
            ->add('firstname', TextType::class, ['label'=>'Prénom'])
            ->add('lastname', TextType::class, ['label'=>'Nom de famille'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

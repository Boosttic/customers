<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Label;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'contact.firstname'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'contact.lastname'
            ])
            ->add('email', EmailType::class, [
                'label' => 'contact.email',
                'required' => false,
            ])
            ->add('tel', TelType::class, [
                'label' => 'contact.tel',
                'required' => false,
            ])
            ->add('label', EntityType::class, [
                'class' => Label::class,
                'choice_label' => function ($label) {
                    return $label->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

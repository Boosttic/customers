<?php

namespace App\Form;

use App\Entity\ProviderOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\RamType;
use App\Form\StockageType;
 
class ProviderOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('proc')
            ->add('debit')
            ->add('is_server')
            ->add('rams', CollectionType::class, ['entry_type' => RamType::class, 'allow_add' => true, 'allow_delete' => true])
            ->add('stockages', CollectionType::class, ['entry_type' => StockageType::class, 'allow_add' => true, 'allow_delete' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProviderOffer::class,
        ]);
    }
}

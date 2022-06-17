<?php

namespace App\Form;

use App\Entity\Application;
use App\Entity\Product;
use App\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\ProductType;
use App\Form\AccountType;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $appAccount = new Account();
        $appAccount->setType(0);
        $bddAccount = new Account;
        $bddAccount->setType(1);

        $builder
            ->add('domainName')
            ->add('port')
            ->add('product', EntityType::class, ['class' =>Product::class, 'expanded'=>true])
            ->add('accounts', CollectionType::class, ['entry_type' => AccountType::class, 'entry_options' => ['label' => false]])
            ->get('accounts')
            ->setData([$appAccount, $bddAccount]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}

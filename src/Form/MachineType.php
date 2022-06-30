<?php

namespace App\Form;

use App\Entity\Machine;
use App\Entity\Application;
use App\Entity\Account;
use App\Entity\ProviderOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\AccountType;
use App\Form\ApplicationType;

class MachineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $accountUI = new Account();
        $accountUI->setType(3);
        $accountSSH = new Account;
        $accountSSH->setType(2);

        $builder
            ->add('ip')
            ->add('providerOffer', EntityType::class, ['class'=>ProviderOffer::class, 'label'=>'Caractéristique'])
            ->add('applications', CollectionType::class, ['entry_type' => ApplicationType::class, 'allow_add' => true, 'allow_delete' => true, 'label'=>false])
            ->add('accounts', CollectionType::class, ['entry_type' => AccountType::class, 'entry_options' => ['label' => false]])
            ->get('accounts')
            ->setData([$accountUI, $accountSSH]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Machine::class,
        ]);
    }
}

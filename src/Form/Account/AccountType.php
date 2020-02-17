<?php

namespace App\Form\Account;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * 
 */
class AccountType extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $optios)
	{
		$builder
			->add('last_name', TextType::class)
            ->add('first_name', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class)
         ;
	}
}
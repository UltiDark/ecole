<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactClasse extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail', EmailType::class, [
                'invalid_message' => 'Veuillez entrer votre adresse mail',
            ])
            ->add('objet', TextType::class, [
				'invalid_message' => 'Veuillez entrer l\'objet du mail',
			])
            ->add('corpsMail', TextareaType::class, [
				'invalid_message' => 'Veuillez entrer le niveau'
			])
			->add('submit', SubmitType::class, [
				'label' => 'Envoyer'
			]);
	}
}
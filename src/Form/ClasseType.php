<?php

namespace App\Form\Type;

use App\Entity\Prof;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ClasseType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
				'invalid_message' => 'Veuillez entrer le nom de la classe',
			])
            ->add('niveau', IntegerType::class, [
				'invalid_message' => 'Veuillez entrer le niveau'
			])
            ->add('id_prof', EntityType::class, [
				'class' => Prof::class,
				'choice_label' => 'nom',
				'label' => 'Prof Principal'
			])
			->add('submit', SubmitType::class, [
				'label' => 'Envoyer'
			]);
	}
}
<?php

namespace App\Form\Type;

use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ProfType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
				'invalid_message' => 'Veuillez entrer un nom',
			])
            ->add('prenom', TextType::class, [
				'invalid_message' => 'Veuillez entrer un prenom'
			])
            ->add('id_matiere', EntityType::class, [
				'class' => Matiere::class,
				'choice_label' => 'nom',
				'label' => 'Matière'
			])
			->add('date_de_naissance', DateType::class, [
				'widget' => 'choice',
				'years' => range(date('Y'), date('Y')-100),
				'label' => 'Date de Naissance',
				'required' => false
			])
			->add('submit', SubmitType::class, [
				'label' => 'Envoyer'
			]);
	}
}
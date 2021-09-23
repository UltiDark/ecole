<?php

namespace App\Form\Type;

use App\Entity\Eleve;
use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NoteType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('id_matiere', EntityType::class, [
				'class' => Matiere::class,
				'choice_label' => 'nom',
				'label' => 'Matière'
			])
            ->add('note', IntegerType::class, [
				'invalid_message' => 'Veuillez entrer une note',
				'attr' => array('min' => 0, 'max' => 20)
			])
			/*->add('id_eleve', EntityType::class, [
				'class' => Eleve::class,
				'choice_label' => 'nom',
			])*/
            ->add('coefficient', IntegerType::class, [
				'invalid_message' => 'Veuillez entrer un coefficient'
			])
			->add('date', DateType::class, [
				'widget' => 'choice',
			])
			->add('submit', SubmitType::class, [
				'label' => 'Envoyer'
			]);
	}
}
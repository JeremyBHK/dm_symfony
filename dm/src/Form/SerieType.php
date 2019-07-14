<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Serie;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('categorie_id')
            ->add('annee_debut')
            ->add('annee_fin')
            ->add('img', FileType::class, [
                'mapped'=>false, // Ca permet de ne pas associer cet input avec un champ de la BDD
				'required'=>false // Permet de sauvegarder l'utilisateur sans photo de profil
            ])
            ->add('nb_saisons')
			->add('save', SubmitType::class, ['label' => 'Ajouter'])
        ;
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Serie::class,
		]);
	}
}
?>
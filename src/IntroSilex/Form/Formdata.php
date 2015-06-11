<?php

namespace IntroSilex\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
// use Delineas\Validator\ExpirationDate;
// use Delineas\Validator\AmountOther;
// use Delineas\Validator\ContactTypeFields;

class Formdata extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

			$builder
				->add('name','text', array(
		    	'label' => 'Nombre',
		    	'required'  => false,
		    ))
		    ->add('surname','text', array(
		    	'label' => 'Apellidos',
		    	'required'  => false,
		    ))
		    ->add('credit_card', 'text', array(
		    	'label' => 'Número de tarjeta',
		    	'required' => true,
		    	'max_length' => 16,
		    	'constraints' => array(
			    	new Assert\Length(array(
			    		'min' => 15,
			    		'max' => 16,
			    		'minMessage' => 'Por favor, introduzca un número de tarjeta válido.',
			    		'maxMessage' => 'Por favor, introduzca un número de tarjeta válido.',
			    		'exactMessage' => 'Por favor, introduzca un número de tarjeta válido.',
			    	)),
			    	new Assert\NotBlank(),
			    	)
		    ))		    
		    ->add('province','text', array(
		    	'label' => 'Nombre de la empresa',
		    	'required'  => false,
		    ))
		    ;		        
		            
	  }

    public function getName()
    {
        return 'formdata';
    }


}
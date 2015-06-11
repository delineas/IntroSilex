<?php

namespace IntroSilex\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints as Assert;
use IntroSilex\Form\Formdata;


class FormdataController implements ControllerProviderInterface
{

	public function connect( Application $app )
	{
		$formdataController = $app['controllers_factory'];
		$formdataController->match("/", array( $this, 'formdataForm' ) )->bind( 'formdata_form' );
		return $formdataController;
	}

	public function formdataForm( Application $app, Request $request )
	{

		$form = $app['form.factory']->create(new Formdata());

    if ($request->isMethod('POST')) {
        $form->submit($request);
        if ($form->isValid()) {
        	$data = $form->getData();
        	$this->saveFormdata($app, $data);
					// $this->sendMail($app, $data);
					return new RedirectResponse($app['url_generator']->generate('homepage'));
        }
    }		
    $form->add('submit', 'submit', array('label'=>'Enviar'));

		return $app['twig']->render('form.html.twig', array(
			'form' => $form->createView()
		));

	}

	public static function saveFormdata(Application $app, $data) {
		$result = $app['db']->insert('formdata', $data);
	}	

}

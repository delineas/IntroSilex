<?php

namespace IntroSilex\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use IntroSilex\Controller\Formdata;


class ApiController implements ControllerProviderInterface
{

  private $_app;

  public function __construct($app)
  {
      $this->_app = $app;
  }

	public function connect( Application $app )
	{
		$apiController = $app['controllers_factory'];
		$apiController->get("/index.json", array( $this, 'indexAction' ) );
		$apiController->post("/new.json", array( $this, 'newAction' ) );
		return $apiController;
	}

	public function indexAction(Application $app)
	{
		return $app->json($this->findAll());
	}

	public function newAction(Application $app, Request $request)
	{
		$new = array(
        'name' => $request->request->get('name'),
        'surname'  => $request->request->get('surname'),
        'province'  => $request->request->get('province'),
        'credit_card'  => $request->request->get('credit_card'),
    );
    $app['monolog']->addInfo(serialize($request->request));
    FormdataController::saveFormdata($app,$new);
		return $app->json($new,201);
	}

	private function findAll() 
	{
		return $this->_app['db']->fetchAll("SELECT * FROM formdata");
	}

}

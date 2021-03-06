<?php
namespace Greenhex;
use Greenhex\Controllers;

class Routes
{
	public static function setup($app)
	{
		// Home
		$app->get('/', 'Greenhex\Controllers\PageController:home')->name('home');
		$app->get('/feed', 'Greenhex\Controllers\PageController:feed');
		$app->get('/test', 'Greenhex\Controllers\PageController:test');
		$app->get('/user/:user', 'Greenhex\Controllers\UserController:view');

		$app->get('/login', 'Greenhex\Controllers\AuthenticationController:login')->name('login');
		$app->get('/logout', 'Greenhex\Controllers\AuthenticationController:logout')->name('logout');
		$app->get('/signup', 'Greenhex\Controllers\SignupController:signup')->name('signup');

		$app->post('/login', 'Greenhex\Controllers\AuthenticationController:process');
		$app->post('/signup', 'Greenhex\Controllers\SignupController:process');

		$app->group('/account', function() use ($app)
		{
			$app->get('/', 'Greenhex\Controllers\AccountController:index');
			$app->get('/activation/:code', 'Greenhex\Controllers\AccountController:activation');
		});

		// Not found
		$app->notFound(function() use ($app)
		{
			$data = [];
			$data['meta_title'] = $app->config->get('greenhex.title');
			$data['meta_description'] = $app->config->get('greenhex.description');
			$data['meta_keywords'] = $app->config->get('greenhex.keywords');
			$data['title'] = 'Not found';

			$app->render('errors/notfound.twig', $data);
		});
	}
}

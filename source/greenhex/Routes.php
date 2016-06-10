<?php
namespace Greenhex;
use Greenhex\Controllers;

class Routes
{
	public static function setup($app)
	{
		// Home
		$app->get('/', 'Greenhex\Controllers\PageController:home')->name('home');
	}
}

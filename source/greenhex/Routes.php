<?php
namespace Greenhex;

class Routes
{
	public static function setup($app)
	{
		// Home
		$app->get('/', function()
		{
			echo 'Hello!';
		})->name('home');
	}
}

<?php
namespace Greenhex;
use Greenhex\Routes;
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

/**
* Greenhex
* 
* @author     MadnessFreak <hello@bitwappy.co>
* @copyright  2016 MadnessFreak
* @package    Bitwappy
*/
class Greenhex
{
	protected static $app;

	public static function getApp()
	{
		return static::$app;
	}

	public static function run()
	{
		// preload and init
		Greenhex::preload();
		Greenhex::init();

		// run app
		Greenhex::$app->run();
	}

	private static function init()
	{
		// slim setup
		Greenhex::$app = $app = new Slim
		([
			'templates.path' => '../templates',
		]);

		// view setup
		$app->view(new Twig());
		$app->view->parserOptions = 
		[
			'charset' => 'utf-8',
			'cache' => realpath('../templates/cache'),
			'auto_reload' => true,
			'strict_variables' => false,
			'autoescape' => true
		];

		$app->view->parserExtensions = 
		[
			new TwigExtension()
		];

		// routes setup
		Routes::setup($app);
	}

	private static function preload()
	{
		require '../vendor/autoload.php';
	}
}

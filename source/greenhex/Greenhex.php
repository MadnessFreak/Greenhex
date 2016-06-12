<?php
namespace Greenhex;
use Greenhex\Routes;
use Greenhex\Utiltiy;
use Medoo;
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Twig_SimpleFunction;

/**
* Greenhex
* 
* @author     MadnessFreak <hello@greenhex.net>
* @copyright  2016 MadnessFreak
* @package    Greenhex
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

		// debug
		//Greenhex::schema();

		// run app
		Greenhex::$app->run();
	}

	private static function init()
	{
		// config setup
		$config = new Config;
		$config->load('../config.inc.php');

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
			'autoescape' => false
		];

		$app->view->parserExtensions = 
		[
			new TwigExtension()
		];

		$function = new Twig_SimpleFunction("tweet", function ($text)
		{
			return Utility::tweet($text);
		});
		$app->view->getInstance()->addFunction($function);

		// database setup
		$database = new Medoo
		([
			'database_type' => 'mysql',
			'database_name' => $config->get('database.name'),
			'server' => $config->get('database.host'),
			'username' => $config->get('database.user'),
			'password' => $config->get('database.passwd'),
			'charset' => $config->get('database.charset'),
			'prefix' => $config->get('database.prefix')
		]);

		// slim container setup
		$app->container->set('config', function() use($config)
		{
			return $config;
		});
		$app->container->set('db', function() use ($database)
		{
			return $database;
		});

		// routes setup
		Routes::setup($app);
	}

	private static function preload()
	{
		require '../vendor/autoload.php';
	}

	private static function schema()
	{
		$passwd = 'greenhex';
		$token = sha1(mktime());
		$hash = sha1($password . $token);

		Greenhex::$app->db->insert('user',
		[
			'name' => 'MadnessFreak',
			'email' => 'hello@greenhex.net',
			'passwd' => $hash,
			'token' => $token,
		]);
	}
}

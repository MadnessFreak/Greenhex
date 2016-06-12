<?php
namespace Greenhex\Controllers;
use Greenhex\Greenhex;

abstract class Controller
{
	/**
	 * @var	Slim
	 */
	protected $app;
	/**
	 * @var	Database
	 */
	protected $db;
	/**
	 * @var	Config
	 */
	protected $config;
	/**
	 * @var	array	Optional template data
	 */
	protected $data;

	/**
	 * Initializes a new instance of the Greenhex\Controllers\Controller
	 */
	public function __construct()
	{
		$this->app = Greenhex::getApp();
		$this->db = $this->app->db;
		$this->config = $this->app->config;

		$this->data = [];
		$this->data['meta_title'] = $this->config->get('greenhex.title');
		$this->data['meta_description'] = $this->config->get('greenhex.description');
		$this->data['meta_keywords'] = $this->config->get('greenhex.keywords');
	}

	/**
	 * Returns the value at the specified index
	 *
	 * @param	string	name
	 */
	public function __get($name)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}
		return null;
	}

	/**
	 * Sets a value to the specified index
	 *
	 * @param	string	name
	 * @param	mixed	value
	 */
	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}

	/**
	 * Sets the response content type
	 *
	 * @param	string	contentType
	 */
	public function contentType($contentType)
	{
		$this->response()->header('Content-Type', $contentType);
	}

	/**
	 * Redirects to the specified path
	 *
	 * @param	string	$path
	 */
	public function redirect($path)
	{
		$this->app->redirect($path);
	}

	/**
	 * Slim request object
	 *
	 * @return	\Slim\Http\Request
	 */
	public function request()
	{
		return $this->app->request();
	}

	/**
	 * Slim response object
	 *
	 * @return	\Slim\Http\Response
	 */
	public function response()
	{
		return $this->app->response();
	}

	/**
	 * Renders the specified template
	 *
	 * @param	string	$template
	 */
	public function display($template)
	{
		$this->app->render($template, $this->data);
	}
}

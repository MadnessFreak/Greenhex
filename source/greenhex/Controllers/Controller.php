<?php
namespace Greenhex\Controllers;
use Greenhex\Greenhex;

class Controller
{
	protected $app;
	protected $db;
	protected $config;
	protected $data;

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

	public function __get($name)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}
		return null;
	}

	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}

	public function display($template)
	{
		$this->app->render($template, $this->data);
	}
}

<?php
namespace Greenhex;

class Config
{
	protected $data;

	public function __construct()
	{
		$this->data = [];
	}

	public function load($file)
	{
		$this->data = require($file);
	}

	public function get($key, $default = null)
	{
		$segments = explode('.', $key);
		$data = $this->data;
		
		foreach ($segments as $segment)
		{
			if (isset($data[$segment]))
			{
				$data = $data[$segment];
			}
			else
			{
				$data = $default;
				break;
			}
		}
		return $data;
	}

	public function exists($key)
	{
		return $this->get($key) != null;
	}
}

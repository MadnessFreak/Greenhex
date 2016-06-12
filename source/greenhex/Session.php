<?php
namespace Greenhex;

class Session
{
	public static function has($key)
	{
		return isset($_SESSION[$key]);
	}
	
	public static function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function erase($key)
	{
		unset($_SESSION[$key]);
	}

	public static function destroy()
	{
		session_destroy();
	}
}

<?php
namespace Greenhex;
use Greenhex\Session;
use Greenhex\Greenhex;

class Security
{
	public static function auth($user)
	{
		Session::set(Greenhex::getApp()->config->get('session.user-auth'), $user->id);
		Session::set(Greenhex::getApp()->config->get('session.user'),
		[
			'id' => $user->id,
			'name' => $user->name,
			'email' => $user->email,
			'user_type' => $user->user_type,
			'created_at' => $user->created_at
		]);
	}

	public static function makeToken()
	{
		return sha1(microtime() . uniqid(mt_rand(), true));
	}

	public static function makeBigToken()
	{
		return hash('sha256', Security::makeToken());
	}

	public static function makePassword($token, $password)
	{
		$hash = sha1($password . $token);

		return $hash;
	}

	public static function checkUserPass($user, $password)
	{
		return (bool)($user->password == sha1($password . $user->token));
	}
}
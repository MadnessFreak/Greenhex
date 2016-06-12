<?php
namespace Greenhex\Models\Factory;
use Greenhex\Models\User;

class UserFactory
{
	public static function create($data = [], $insert = false)
	{
		$user = new User;

		if (!is_array($data))
		{
			$data = 
			[
				$user->getKeyName() => $data
			];
		}

		if (!empty($data))
		{
			$user->fill($data);
		}

		if ($insert)
		{
			$temp = $user->insert();
			print_r($temp); // TODO: DEBUG
		}

		return $user;
	}

	public static function get($id)
	{
		return UserFactory::create($id)->get();
	}

	public static function find($search)
	{
		return UserFactory::create()->find($search);
	}

	public static function delete($id)
	{
		return UserFactory::create($id)->delete();
	}
}

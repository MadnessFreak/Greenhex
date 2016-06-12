<?php
namespace Greenhex\Controllers;
use Greenhex\Models\User;
use Greenhex\Models\Factory\UserFactory;

class UserController extends Controller
{
	public function view($user)
	{
		$user = UserFactory::get($user);

		if ($user != null)
		{
			print_r($user);
		}
		else
		{
			echo "User not found";
		}
	}
}

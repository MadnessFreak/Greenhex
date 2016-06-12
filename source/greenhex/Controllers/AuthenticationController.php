<?php
namespace Greenhex\Controllers;
use Greenhex\Models\User;
use Greenhex\Models\Factory\UserFactory;
use Greenhex\Security;
use Greenhex\Session;
use Respect\Validation\Validator;

class AuthenticationController extends Controller
{
	public function login()
	{
		$this->title = 'Log In';
		$this->display('login.twig');
	}

	public function process()
	{
		$identifier = $this->request()->post('email');
		$password = $this->request()->post('password');

		if (Validator::stringType()->notEmpty()->length(3, 255)->validate($identifier) &&
			Validator::stringType()->notEmpty()->length(3, 255)->validate($password))
		{
			$user = UserFactory::find($identifier);

			if ($user != null)
			{
				if (Security::checkUserPass($user, $password))
				{
					Security::auth($user);
					$this->redirect($this->app->urlFor('home'));
				}
				else
				{
					$this->app->flashNow('error', 'Invalid password');
					$this->fail('password', 'Please fill in all fields');
				}
			}
			else
			{
				$this->app->flashNow('error', 'Invalid identifier');
				$this->fail('email', 'Please fill in all fields');
				$this->fail('password', 'Please fill in all fields');
				$this->data['request']['params']['email'] = null;
			}
		}
		else
		{
			$this->app->flashNow('error', 'Please fill in all fields');
			$this->fail('email', 'Please fill in all fields');
			$this->fail('password', 'Please fill in all fields');
		}

		$this->login();
	}
}

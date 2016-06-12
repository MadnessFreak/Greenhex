<?php
namespace Greenhex\Controllers;
use Greenhex\Models\User;
use Greenhex\Models\Factory\UserFactory;
use Greenhex\Security;
use Greenhex\Session;
use Respect\Validation\Validator;

class SignupController extends Controller
{
	public function signup()
	{
		$this->title = 'Sign Up';
		$this->display('signup.twig');
	}

	public function process()
	{
		$name = $this->request()->post('name');
		$email = $this->request()->post('email');
		$email2 = $this->request()->post('email_confirm');
		$password = $this->request()->post('password');

		if (!Validator::stringType()->notEmpty()->length(3, 255)->validate($name))
		{
			$this->fail('name', 'Invalid name');
		}
		if (!Validator::email()->validate($email) ||
			!Validator::email()->validate($email2))
		{
			$this->fail('email', 'Email is not valid');
		}
		if ($email != $email2)
		{
			$this->fail('email', 'Email\'s does not match');
		}
		if (!Validator::stringType()->notEmpty()->length(3, 255)->validate($password))
		{
			$this->fail('password', 'Invalid password');
		}

		if ($this->valid())
		{
			$token = Security::makeToken();
			$password = Security::makePassword($token, $password);

			UserFactory::create
			(
				[
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'token' => $token,
					'tmp_key' => Security::makeBigToken()
				],
				true
			);

			$this->app->flash('success', 'You have been signed up.');
			die();
		}

		$this->signup();
	}
}
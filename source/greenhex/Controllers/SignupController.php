<?php
namespace Greenhex\Controllers;
use Greenhex\Models\User;
use Greenhex\Models\Factory\UserFactory;
use Greenhex\Mailer;
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
			$activation_code = Security::makeToken();
			$activation_link = 'http://' . $_SERVER['SERVER_NAME'] . $this->app->urlFor('home') . 'account/activation/' . $activation_code;

			UserFactory::create
			(
				[
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'token' => $token,
					'activation_code' => $activation_code
				],
				true
			);

			$website = $this->config->get('greenhex.title');
			$receiver = $email;
			$subject = "Activate Your Account on {$this->config->get('greenhex.title')}";
			$message = "Dear {$name},<br><br>

thank you for registering on our website: {$website}. It is required to open the link below in order to verify your email address.<br><br>

Please open the link below in your browser:<br>
<a href=\"{$activation_link}\">{$activation_link}</a><br><br>

Once prompted provide the details as shown below:<br><br>
Your name:			{$name}<br>
Activation Code:	{$activation_code}<br><br>

If you cannot open the link or have troubles following the instructions, please contact the administrator.<br>
You can safely ignore this email if you did not register with the website: {$website}.";
			$this->mailer->send($receiver, $subject, $message);

			$this->app->flash('success', "Thank you for registering, {$name}.<br>An email was sent to “{$email}” containing a one-time link to verify your account and ultimately completing your registration.");
		}

		$this->signup();
	}
}
<?php
namespace Greenhex\Controllers;
use Greenhex\Models\User;
use Greenhex\Models\Factory\UserFactory;

class AccountController extends Controller
{
	public function index()
	{

	}

	public function activation($code)
	{
		$user = UserFactory::by('activation_code', $code);

		if ($user != null)
		{
			if (!$user->active && $user->activation_code == $code)
			{
				$user->active = true;
				$user->activation_code = null;
				$this->activation_valid = true;
				$user->update();
			}
		}

		if (!isset($this->activation_valid) || $this->activation_valid != true)
		{
			$this->app->response->setStatus(410); // HTTP_GONE
		}

		$this->display('pages/account/activation.twig');
	}
}

<?php
namespace Greenhex\Controllers;
use Greenhex\Controllers\Controller;
use Greenhex\Greenhex;

class PageController extends Controller
{
	public function home()
	{
		$this->title = 'Home';
		$this->display('pages/home.twig');
	}
}

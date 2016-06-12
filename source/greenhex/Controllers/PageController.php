<?php
namespace Greenhex\Controllers;
use Greenhex\Controllers\Controller;
use Greenhex\Greenhex;
use Greenhex\Models\User;
use Greenhex\Models\Factory\UserFactory;
use PDO;

class PageController extends Controller
{
	public function home()
	{
		$this->title = 'Home';
		$this->display('pages/home.twig');
	}

	public function feed()
	{
		$this->title = 'Feed';

		$this->feed = $this->db->query
		('
			SELECT	p.*,
					u.idname AS author_idname,
					u.name AS author_name
			FROM	ghex_post p
			JOIN	ghex_user u ON (p.author_id = u.id)
			LIMIT	15
		')->fetchAll(PDO::FETCH_ASSOC);

		$this->debug = print_r($this->feed, true);

		$this->display('pages/feed.twig');
	}

	public function test()
	{
		/*$data = UserFactory::create([
			'name' => 'Max Mustermann',
			'email' => 'max.musermann@example.net'
		], false);*/
		$data = UserFactory::get(1);
		$data->name = 'MadnessFreak';
		$data->email = 'hello@greenhex.net';
		$data->update();

		echo "Hello {$data->name}!";
	}
}

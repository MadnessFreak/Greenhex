<?php

return [
	'greenhex' => [
		'title' => 'Greenhex',
		'description' => 'Greenhex is a free to use and open source short messaging platform.',
		'keywords' => 'greenhex, green, hex, share, sharing'
	],
	'view' => [
		'templates' => '../templates',
		'cache' => '../templates/cache'
	],
	'session' => [
		'user' => 'user',
		'user-auth' => 'user_auth'
	],
	'database' => [
		'host' => 'localhost',
		'port' => 3306,
		'name' => 'greenhex',
		'user' => 'root',
		'passwd' => '',
		'charset' => 'utf-8',
		'prefix' => 'ghex_'
	]
];

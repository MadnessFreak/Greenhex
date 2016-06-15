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
	],
	'mailer' => [
		'host' => 'mailtrap.io',
		'port' => 2525,
		'user' => 'd36aef43ad40de',
		'passwd' => '1d8cc39df82420',
		'sender' => 'test@mailtrap.io',
		'sender-name' => 'Greenhex Support',
		'smtp-auth' => true,
		'smtp-secure' => 'tls',
		'use-html' => true
	]
];

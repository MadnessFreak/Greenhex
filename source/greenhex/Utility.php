<?php
namespace Greenhex;

class Utility
{
	public static function tweet($text)
	{
		$url = Greenhex::getApp()->urlFor('home');

		$text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1">$1</a>', $text); // links
		$text = preg_replace('/@(\w+)/', '<a href="' . $url . 'user/$1">@$1</a>', $text); // users
		$text = preg_replace('/#(\w+)/', ' <a href="' . $url . 'tag/$1">#$1</a>', $text); // tags

		return $text;
	}
}

<?php
namespace App;

trait Selectable
{
	public static function getSelectList($value = 'name', $key = 'id'){
		return static::latest()/*->owned()*/->pluck($value, $key);
	}
}
<?php 

class SiteWidget_Facebook extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Facebook',
		'titre' 		=> 'Facebook',
		'description'	=> 'Affiche le widget Fan',
		'position'		=> 'aside',
		'class'			=> 'bFull',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	);
	
	public static $decorators = array(
		'id'	=> 'facebook',
		'class'	=> 'zFull',
		'titre'	=> 'Facebook',
	);
	
	public static $params = array(
		'connections' => 16,
	);
	
	public static function form()
	{
		
	}
	
	public static function widget()
	{
		echo self::render();
	}
	
	public static function render()
	{
		self::$decorators = self::$decorators + parent::$decorators;
		
		return sprintf(self::$decorators['before'], self::$decorators['id'], self::$decorators['class'], self::$decorators['attrs'])
	    . sprintf(self::$decorators['titreBefore'], self::$decorators['titreClass'], self::$decorators['titreAttrs'])
		. self::$decorators['titre']
	    . self::$decorators['titreAfter']
		
		. self::$decorators['after'];	
		
	}
}

<?php 

class SiteWidget_RevueVideo extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'RevueVideo',
		'titre' 		=> 'Revue de Vidéos',
		'description'	=> 'Affiche des vidéos dailymotion',
		'position'		=> 'colLeft',
		'class'			=> 'bHalf',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id'		=> 'videos',
		'class'		=> 'bHalf',
		'titre'		=> 'Revue de vidéo',
		'titreClass'=> 'roundtitle',
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
		self::$decorators 	= self::$decorators + parent::$decorators;

		return sprintf(self::$decorators['before'], self::$decorators['id'], self::$decorators['class'], self::$decorators['attrs'])
	    . sprintf(self::$decorators['titreBefore'], self::$decorators['titreClass'], self::$decorators['titreAttrs'])
		. self::$decorators['titre']
	    . self::$decorators['titreAfter']

		. self::$decorators['after'];
	}
}

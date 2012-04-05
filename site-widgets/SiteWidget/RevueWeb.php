<?php 

class SiteWidget_RevueWeb extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'RevueWeb',
		'titre' 		=> 'Revue de Web',
		'description'	=> 'Afficher les dernières google actualites',
		'position'		=> 'colLeft',
		'class'			=> 'bHalf',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id'			=> 'revuedeweb',
		'class'			=> 'bHalf',
		'titre'			=> 'Revue de web',
		'titreClass'	=> 'roundtitle',
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

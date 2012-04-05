<?php 

class SiteWidget_Tag extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Tag',
		'titre' 		=> 'Mots clés',
		'description'	=> 'Affiche les mots clés',
		'position'		=> 'colLeft',
		'class'			=> 'bHalf',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id'	=> 'tagcloud',
		'class'	=> 'bHalf',
		'titre'	=> 'Mots clés',
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
		self::$decorators = self::$decorators + parent::$decorators;
		
		return sprintf(self::$decorators['before'], self::$decorators['id'], self::$decorators['class'], self::$decorators['attrs'])
	    . sprintf(self::$decorators['titreBefore'], self::$decorators['titreClass'], self::$decorators['titreAttrs'])
		. self::$decorators['titre']
	    . self::$decorators['titreAfter']
	 	. self::$decorators['after'];
	}
}

<?php 

class SiteWidget_Sondage extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Sondage',
		'titre' 		=> 'Votre Opinion',
		'description'	=> 'Afficher un sondage',
		'position'		=> 'aside',
		'class'			=> 'bFull',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id'			=> 'sondage',
		'class'			=> 'zFull',
		'titre'			=> 'Votre opinion',
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
	    . self::$decorators['titre'] . self::$decorators['titreAfter']
	    .self::$decorators['after'];
	}
}

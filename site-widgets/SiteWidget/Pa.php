<?php 

class SiteWidget_Pa extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Pa',
		'titre' 		=> 'Pa Mon Hebdo et Zeclic',
		'description'	=> 'Afficher les dernières PA Immo/Auto/Zeclic',
		'position'		=> 'aside',
		'class'			=> 'bFull',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id' 	=> 'pa',
		'class'	=> 'tabbed_area zFull',
		'titre'	=> 'Petites Annonces',
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
		global $petitesAnnoncesWidget;
	
		self::$decorators = self::$decorators + parent::$decorators;
		
		return sprintf(self::$decorators['before'], self::$decorators['id'], self::$decorators['class'], self::$decorators['attrs'])
	    . sprintf(self::$decorators['titreBefore'], self::$decorators['titreClass'], self::$decorators['titreAttrs'])
		. self::$decorators['titre']
	    . self::$decorators['titreAfter']
		.self::$decorators['after'];
	}
}

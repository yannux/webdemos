<?php 

class SiteWidget_Blogzone extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Blogzone',
		'titre' 		=> 'Blogzone',
		'description'	=> 'Affiche les blogs du coin',
		'position'		=> 'colLeft',
		'class'			=> 'bHalf',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id'			=> 'blogzone',
		'class'			=> 'bHalf univOrange',
		'titre'			=> 'Blog Zone',
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
		
		if ('' != ($content = 'Blog Zone')) {
	    	return sprintf(self::$decorators['before'], self::$decorators['id'], self::$decorators['class'], self::$decorators['attrs'])
	    	. sprintf(self::$decorators['titreBefore'], self::$decorators['titreClass'], self::$decorators['titreAttrs'])
			. self::$decorators['titre']
	    	. self::$decorators['titreAfter']
	        . $content
	        . self::$decorators['after'];
		}
		
		return '';
	}
}

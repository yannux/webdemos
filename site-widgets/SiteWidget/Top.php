<?php 

class SiteWidget_Top extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Top',
		'titre' 		=> '+ Lus | + Commentés',
		'description'	=> 'Boite à onglets avec les + lus / + commentés ',
		'position'		=> 'colLeft',
		'class'			=> 'bHalf',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	);
	
	public static $decorators = array(
		'id'			=> 'top',
		'class'			=> 'tabbed_area bHalf',
		'titre'			=> 'Les plus...',
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
		
		$return =  sprintf(self::$decorators['before'], self::$decorators['id'], self::$decorators['class'], self::$decorators['attrs'])
	    . sprintf(self::$decorators['titreBefore'], self::$decorators['titreClass'], self::$decorators['titreAttrs'])
		. self::$decorators['titre']
	    . self::$decorators['titreAfter'];
		
	
	    $return .= self::$decorators['after'];
		
		return $return;
	}
}

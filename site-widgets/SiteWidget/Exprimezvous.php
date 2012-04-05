<?php 

class SiteWidget_Exprimezvous extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Exprimezvous',
		'titre' 		=> 'Exprimez Vous',
		'description'	=> 'Formulaire exprimez vous pour les internautes',
		'position'		=> 'aside',
		'class'			=> 'bFull',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id' 	=> 'uneavous',
		'class'	=> 'zFull univOrange',
		'titre'	=> 'Exprimez-vous !<a href="/wp-content/static/uneamoi-ensavoirplus.html?KeepThis=true&amp;TB_iframe=true&amp;height=480&amp;width=640" style="position:absolute; top:0;right:10px;font-size:11px;color:#fff;" class="thickbox"><small>En savoir +</small></a>',
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
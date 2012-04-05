<?php

class SiteWidget_Abstract
{
	public static $conf;
	
	public static $decorators = array(
		'before'	=> '<div id="Widget-%s" class="%s"%s>',
		'after'		=> '</div>',
		'id'		=> '',
		'class'		=> '',
		'attrs'		=> '',		
	    'titreBefore'	=> '<h2 class="%s" %s>',
		'titreAfter'	=> '</h2>',
		'titreClass'	=> '',
		'titreAttrs'	=> '',
	);
	
	public static function form(){}
	
	public static function widget(){}
	
	public static function render(){} 
}

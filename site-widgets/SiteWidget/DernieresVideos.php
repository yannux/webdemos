<?php

class SiteWidget_DernieresVideos extends SiteWidget_Abstract
{
	
	public static $conf = array(
		'id'			=> 'DernieresVideos',
		'titre' 		=> 'Dernières Vidéos',
		'description'	=> 'Affiche les 5 dernières vidéos',
		'position'		=> 'colLeft',
		'class'			=> 'bHalf',
		'max'			=> 1,
		'utilise'		=> 0,
		'configurable'	=> 0,
	); 
	
	public static $decorators = array(
		'id'	=> 'DerniereVideos',
		'class'	=> 'bHalf',
		'titre'	=> 'Dernières vidéos',
		'titreClass'	=> 'roundtitle',
	);
	
	public static $params = array(
		'qtt' => array('label' => 'Nombre de vidéos à afficher', 'value' => 5),
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
		
	}
}

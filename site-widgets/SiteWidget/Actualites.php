<?php 

class SiteWidget_Actualites extends SiteWidget_Abstract
{
	public static $conf = array(
		'id'			=> 'Actualites',
		'titre' 		=> 'Actualités',
		'description'	=> 'Afficher les dernières actualites',
		'position'		=> 'colLeft',
		'class'			=> 'bFull',
		'max'			=> 0,
		'utilise'		=> 0,
		'configurable'	=> 1,
	); 
	
	public static $decorators = array(
		'id'	=> '',
		'class'	=> 'bFull',
		'titre'	=> 'Actualités',		
	);
	
	public static $params = array(
		'qtt' => array('label' => "Nombre d'actualités à afficher", 'value' => 5, 'size'=>'2'),
	);
		
	public static function form($params)
	{
		$return = '';
		foreach(self::$params as $paramKey => $paramData) {
			$value = (isset($params[$paramKey]) ? $params[$paramKey] : $paramData['value']); 
			$return .= '<label>' . $paramData['label']
			. '<input type="text" name="params_'.self::$conf['id'].'_'.$paramKey.'" value="'.$value.'" size="'.$paramData['size'].'">'
			. '</label>';
		}
		return  $return;
	}
	
	public static function widget($params = array())
	{
		if (!empty($params)) {
			foreach($params as $key => $value) {
				self::$params[$key]['value'] = $value;
			}
		}
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
			
		return $return;	}
}

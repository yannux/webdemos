<?php
class SiteWidget
{
	const KEY_OPTION_AREAS_CONTENT  = 'site_widget_areas_content';
	const KEY_OPTION_WIDGET_CONF 	= 'site_widget_widget_conf';
	
	public $widgets = array(
		'Actualites' 	=> array(),
		'Annuaire'	 	=> array(),
		'Blogzone'		=> array(),
		'Exprimezvous'	=> array(),
		'Facebook'		=> array(),
		'Infolocale'	=> array(),
		'Journal'		=> array(),
		'Pa'			=> array(),
		'RevueVideo'	=> array(),
		'RevueWeb'		=> array(),
		'Sondage'		=> array(),
		'Tag'			=> array(),
		'Top'			=> array(),
		'DernieresVideos'	=> array(),
	);

	public $default_areas	= array ( 
		'colLeft' => array ( 
			'active' => array ( 
				0 => array ( 'id' => 'Actualites', 'params' => array( 'qtt' => '10' ) ), 
				1 => array ( 'id' => 'RevueWeb'), 
				2 => array ( 'id' => 'Top' ), 
				3 => array ( 'id' => 'RevueVideo' ),
			), 
			'inactive' => array ( 
				4 => array ( 'id' => 'Tag' ),
				5 => array ( 'id' => 'Infolocale' ), 
				6 => array ( 'id' =>'Blogzone' ), 
				7 => array ( 'id' => 'Annuaire' ),
				8 => array ( 'id' => 'DernieresVideos' ),
			), 
		), 
		'aside' => array ( 
			'active' => array ( 
				0 => array ( 'id' => 'Journal' ), 
				1 => array ( 'id' => 'Exprimezvous'), 
				2 => array ( 'id' => 'Facebook' ), 
			), 
			'inactive' => array (
				3 => array ( 'id' => 'Sondage' ), 
				4 => array ( 'id' => 'Pa' ), 
			), 
		), 
	);

	public $areas	= array(
		'colLeft' 	=> array('active' => array(), 'inactive' => array()),
		'aside'		=> array('active' => array(), 'inactive' => array()),
	);
	
	public $conf_errors = array();
	
	private $_conf_existe = false;
	
	private $_init_done	= false;
	
	public function __construct()
	{
		include(__DIR__ . '/SiteWidget/Abstract.php');
	}
	
	public function initConfig($backend = false)
	{
		// On récupre la configuration en DB et 
		$conf_in_db = unserialize($_COOKIE['site-widget-demo']);
		if (is_array($conf_in_db)) {
			$this->_conf_existe = true;
			foreach($this->areas as $areaName => $areaContent) {
				if (!isset($conf_in_db[$areaName])) {
					continue;
				}
				$this->areas[$areaName] = $conf_in_db[$areaName];
			}
		}
		else {
			$this->areas = $this->default_areas;
		}

		foreach($this->areas as $areaName => $areaContents) {
			foreach($areaContents as $etat => $widgetsIn) {
				if ($backend === false && $etat == 'inactive') {
					continue;
				}
				foreach($widgetsIn as $position => $widgetInfo) {
					$class = 'SiteWidget_'.$widgetInfo['id'];
					if (!class_exists($class)) {
						include(__DIR__ . '/SiteWidget/' . $widgetInfo['id'] . '.php');
					}
				}
			}
		}
	
		$this->_init_done = true;		
		return;
	}
	
	public function admin_form_extra_fields()
	{
		echo '<input type="hidden" name="extra_conf_existe" value="'.(int)$this->_conf_existe.'" />';
	}
	
	public function admin_widget_in_area($area = '')
	{
		foreach ($this->areas[$area] as $etat => $widgets) {
			foreach($widgets as $ordre => $widgetParams) {
				$widgetKey = $widgetParams['id'];
				$class = 'SiteWidget_'.$widgetKey;
				
				echo '<div id="'.$widgetKey.'" class="'.$class::$conf['class'].' '.$etat.' portlet" rel="'.$class::$conf['position'].'">';
				
				echo '<div class="portlet-header">'.$class::$conf['titre'];
				if ($class::$conf['configurable']) {
					echo '<a rel="params-'.$widgetKey.'" class="ui-icon ui-icon-wrench" title="Configurer le widget" href="/wp-admin/admin-ajax.php?action=site-widget_wiget-conf&amp;widgetKey='.$widgetKey.'">Configurer</a>';
				}
				echo '</div>';
				
				echo '<div class="portlet-content">'	
				. '<div><label><input type="checkbox" '.($etat === 'active' ? 'checked="checked"': '').' name="active_'.$widgetKey.'" value="1">Cocher pour activer </label></div><br />'
				. '<small>' . $class::$conf['description'] . '</small>'
				.'</div>';
				
				if ($class::$conf['configurable']) {
					echo '<div id="params-'.$widgetKey.'" style="display:none">'
					. $class::form($widgetParams['params'])
					.'</div>';
				}

				echo '</div>';
			}
			
		}
	}
	public function admin_ajax_widget_form()
	{
		$widgetKey = $_GET['widgetKey'];
		var_dump($widgetKey);
	}
	
	public function admin_ajax_save($postData)
	{
		global $wpdb;
		
		// Enregistre les widget en fonction de l'area et position
		foreach($_POST['areas'] as $areaName => $widgets) {
			if (!isset($this->areas[$areaName])) {
				continue;
			}

			foreach($widgets as $ordre => $widgetKey) {
				$etat = ((isset($_POST['active'][$widgetKey]) && (int)$_POST['active'][$widgetKey] === 1) ? 'active' : 'inactive');
				$this->areas[$areaName][$etat][$ordre] = array(
					'id'		=> $widgetKey,
					'params'	=>  (isset($_POST['params'][$widgetKey]) ? $_POST['params'][$widgetKey] : ''),
				);	
			}
		}
		
		// Save in cookie for demo
		setcookie('site-widget-demo', serialize($this->areas));
			
	}
	
	public function widget_in_area($area)
	{
		if (false === $this->_init_done) $this->initConfig();
		
		$display_bHalf = 0;
		
		foreach($this->areas[$area]['active'] as $ordre => $widget) {

			$widgetKey = $widget['id'];
			$class = 'SiteWidget_'.$widgetKey;
						
			if ($class::$conf['class'] == 'bHalf') {
				$display_bHalf++;
				
				if ($display_bHalf%2 === 1) {
					$class::$decorators['class'] = $class::$decorators['class']  . ' bHalf_left ';	
				}
				$class::$decorators['class'] = $class::$decorators['class']  . ' ' . $display_bHalf;
			}
			
			
			$class::widget($widget['params']);
		}
	}
}

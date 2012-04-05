<?php 

include(__DIR__ . '/SiteWidget.php');

switch ($_POST['action']) {
	case 'save-site-widget':
		$siteWidget = new SiteWidget();
		$siteWidget->admin_ajax_save($_POST);
		$response = json_encode(array());
    	header( "Content-Type: application/json" );
		die;
		break;	
	default:
		die;
		break;
}

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
header('Content-Type: text/html; charset=utf-8');
?>
<html>
	<head>
		<title>Site Widget Demo</title>
	</head>
	<style>
	#colLeft {
    float: left;
    width: 700px;
}

#colLeft .bFull {
    overflow: hidden;
    padding: 10px;
    width: 660px;
    border:1px solid #000;
}
#colLeft .bHalf {
    float: left;
    overflow: hidden;
    padding: 10px;
    width: 320px;
    border:1px solid #000;
}
#colLeft .bHalf_left{clear:left}

#colLeft .bThird1 {
    float: left;
    margin: 10px 5px;
    width: 216.5px;
}
#colLeft .bThird2 {
    float: left;
    margin: 10px 5px;
    width: 442px;
}
#aside {
    float: left;
    width: 300px;
}
#aside .zFull {
    margin: 10px;
    overflow: hidden;
    width: 280px;
}
#aside .bFull {
    overflow: hidden;
    padding: 10px;
    width: 260px;
}
#aside .bHalf {
    float: left;
    overflow: hidden;
    padding: 10px;
    width: 120px;
}
	</style>
	<body>
		<?php 
		include(__DIR__ . '/SiteWidget.php');
		$siteWidget = new SiteWidget();
		?>
		<div id="colLeft">
		<?php echo $siteWidget->widget_in_area('colLeft');?>	
		</div>
		<div id="aside">
		<?php echo $siteWidget->widget_in_area('aside');?>
		</div>
	</body>
</html>
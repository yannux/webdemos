<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!-- Only use sortable and dialog -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" media="all" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/flick/jquery-ui.css"></style>
<style>
body{font-size:0.9em}
.column {float: left; padding-bottom: 100px; }
#aside {width: 200px;}
#colLeft {width: 450px;}
.portlet {float: left; margin: 0 1em 1em 0; height:120px}
#colLeft .bHalf { width: 186px; float: left; }  
#colLeft .bFull { width:386px;}
#aside .bFull, #aside .zFull { width:180px;}
.portlet-header { margin: 0.3em; padding-bottom: 4px; padding-left: 0.2em; }
.portlet-header .ui-icon { float: right; }
.portlet-content { padding: 0.4em; }
.ui-sortable-placeholder {height:120px; border: 2px dotted black; visibility: visible !important; height: 50px !important;}
.ui-sortable-placeholder * { visibility: hidden; }
</style>
	<script>
	var ajaxurl = 'ajax.php';
	(function($) {
		$(function() {
			$(".column").sortable({
				cursor: 'crosshair',
				start: function(e, ui){
			    	ui.placeholder.height(ui.item.height());
			    	ui.placeholder.html('Glissez moi ici');
			    }
			});
			/*.bind( "sortreceive", function(event, ui) {
			    console.log("[" + this.id + "] received [" + ui.item.html() + "] from [" + ui.sender.attr("id") + "]");
			
			    if (ui.item.attr('rel') !== undefined &&  ui.item.attr('rel') !== this.id)
			    {
			     $(ui.sender).sortable('cancel');
			     //ui.item.effect("highlight", {}, 3000);
			     console.log('interdit');
			    }
			});*/
			$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
				.find(".portlet-header")
					.addClass("ui-widget-header ui-corner-all")
					.end()
				.find(".portlet-content");
			
			$(".column").disableSelection();
		
			$('#doaction_save').click(function(e){
				e.preventDefault();
				var oExtra = {};
				var oActive = {};
				var oParams = {};
				
				$('#form_site_widget input[type=hidden][name^=extra_]').each(function() {
        			oExtra[this.name.replace(new RegExp('extra_', 'g'), '')] = $(this).val();
    			});
    			$('#form_site_widget input[type=checkbox][name^=active_]').each(function() {
    				if ($(this).is(':checked')) {
        				oActive[this.name.replace(new RegExp('active_', 'g'), '')] = 1;
        			}
    			});
    			$('#form_site_widget input[name^=params_]').each(function() {
    				var param_Elm = this.name.split('_');
					  if(oParams[param_Elm[1]] == undefined) {
					    oParams[param_Elm[1]] = {};
					  }
					  oParams[param_Elm[1]][param_Elm[2]] = this.value;
    			});
				var data = {
					'action': 'save-site-widget',
					'areas': {
						'colLeft': $('#colLeft').sortable('toArray'),
						'aside' : $('#aside').sortable('toArray')
					},
					'extra': oExtra,
					'active': oActive,
					'params': oParams,
				};
				$.ajax({
                	type: "POST",
                	url: ajaxurl,
                	data: data

            	});;
				return false;
			});
			
			$( ".column div.portlet-header" ).click(function( event ) {
				event.preventDefault();
				var $item = $( this ),
					$target = $( event.target );

				if ( $target.is( "a.ui-icon-wrench" ) ) {
					var confId = '#' + $target.attr('rel');

					$(confId).dialog({
						autoOpen: true,
						height: 300,
						width: 350,
						modal: true,
						draggable: false,
						closeOnEscape: false,
						title: 'Configuration ' + $item.clone().children().remove().end().text(),
						buttons: {
							"Valider": function() {
								$(this).dialog( "close" );
							}
						},
						close: function() {
							var idElm = $(this).attr('id').split('-');
							var $dValues = $('input[name^=params_]'); 
							$('#' + idElm[1]).append('<div id="' + idElm.join('-') + '" style="display:none">'+$(this).html()+'</div>');
							$dValues.each(function(){
								$('#' + idElm[1] + ' input[name='+$(this).attr('name')+']').attr('value', $(this).attr('value'));
							});	
						}
					});
				}
					
				return false;
			});
			
		});
	})(jQuery);
	</script>
</head>
<body>
<div id="site-widget">
	<h2>Admin</h2>
<?php 
include(__DIR__ . '/SiteWidget.php');
$siteWidget = new SiteWidget();
$siteWidget->initConfig(true); // $backend = true
?>
	<form id="form_site_widget" action="" method="post">
	<div class="tablenav">
		<input class="button-primary" type="submit" name="doaction_save" id="doaction_save"  value="Enregistrer"/>
		<?php echo $siteWidget->admin_form_extra_fields(); ?>
	</div>
	<br class="clear" />
	<div id="colLeft" class="column">
	<?php $siteWidget->admin_widget_in_area('colLeft');?>	
	</div>
	
	<div id="aside" class="column">
	<?php $siteWidget->admin_widget_in_area('aside');?>	
	</div>	
 	</form>
</div>
</body>
</html>
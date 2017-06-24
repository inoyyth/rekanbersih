<!DOCTYPE html>
<?php include "fn_lib/lib_function.php"; ?>
<?php 
if ($this->session->userdata('logged_in_admin')){
    $session_data=$this->session->userdata('logged_in_admin');
    $first_name=$session_data['first_name_admin'];
    $last_name=$session_data['last_name_admin'];
}else{
    $first_name="";
    $last_name="";
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INOY CMS V.0.1</title>

    <!-- BootstraUrp core CSS -->
    <link href="<?=base_url();?>assets/themes/panel/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?=base_url();?>assets/themes/panel/css/tabx.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/multiselect/bootstrap-select.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/themes/panel/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/themes/panel/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/themes/base/jquery.ui.all.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/demos/demos.css">
    <!-- Page Specific CSS -->
    <style>
  .pagination{
    margin-top: -10px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 10px;
}

.pagination a{
    margin: 0 5px 0 0;
    padding: 3px 6px;
    background: #B3B4BD;
    border-color: yellow;
    color: #fff !important;
}

.pagination a.number{
    border: 1px solid #ddd;
}

.pagination a.current{
    background: #4D6F94;
    border-color: yellow;
    color: #fff !important;
}

.pagination a.curren.hover{
    text-decoration: underline;
}
.combo_search{
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
   width: 100%;
   padding: 5px;
  
   line-height: 1;
   height: 34px;
   -webkit-appearance: none;
}
#loadingxx{
	padding:20px;
	position: fixed;
	top: 30%;
	left: 43%;
	margin-top: -120px;
	margin-left: -220px;
        z-index: 999;
}
#bgx{
    background :rgba(0,0,0,0.4);
    width: 100%;
    height: 100%;
    z-index: 999;
    position: fixed;
}
</style>
  </head>

  <body>
      <div id="bgx" style="display: none;">
      <div id="loadingxx" style="position: fixed;margin: 0 auto;"><img src="<?=base_url();?>assets/themes/loading.gif"></div>
      </div>
    <div id="wrapper">
          <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url();?>">Admin V.0.1</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="<?=base_url();?>panel"><i class="fa fa-dashboard"></i> DASHBOARD</a></li>
            
            <li><a href="<?=base_url();?>menu"><i class="fa fa-bar-chart-o"></i> MENU</a></li>
            
            <li><a href="<?=base_url();?>file_manager" target="_blank"><i class="fa fa-bar-chart-o"></i> FILE MANAGER</a></li>
            
            <li><a href="<?=base_url();?>slider"><i class="fa fa-bar-chart-o"></i> HOME SLIDER</a></li>
            
            <!--<li><a href="<?=base_url();?>bannerfix"><i class="fa fa-bar-chart-o"></i> PAGE BANNER</a></li>-->
            
            <li><a href="<?=base_url();?>contact"><i class="fa fa-bar-chart-o"></i> CONTACT</a></li>
            
            <li><a href="<?=base_url();?>newsletter"><i class="fa fa-bar-chart-o"></i> NEWSLETTER</a></li>
            
            <li><a href="<?=base_url();?>faq"><i class="fa fa-bar-chart-o"></i> FAQ</a></li>
			
			<li><a href="<?=base_url();?>customer_comment"><i class="fa fa-bar-chart-o"></i> CUSTOMER COMMENT</a></li>
			
			<li><a href="<?=base_url();?>customer_inquiry"><i class="fa fa-bar-chart-o"></i> CUSTOMER INQUIRY</a></li>
			
			<li><a href="<?=base_url();?>sales_order"><i class="fa fa-bar-chart-o"></i> SALES ORDER</a></li>
            
			<li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> PRODUCT <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?=base_url();?>category_management">CATEGORY PRODUCT</a></li>
					<li><a href="<?=base_url();?>product">PRODUCT</a></li>
				</ul>
            </li>
			
            <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> ARTICLES <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url();?>article_category">CATEGORIES</a></li>
                        <li><a href="<?=base_url();?>article_subcategory">SUB CATEGORIES</a></li>
                        <li><a href="<?=base_url();?>article">ARTICLES</a></li>
                    </ul>
            </li>
            
            <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> SETTING <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url();?>user_management">ADMINISTRATOR</a></li>
                        <li><a href="<?=base_url();?>email_setting">EMAIL SETTING</a></li>
                        <li><a href="<?=base_url();?>backup_db">DATABASE BACKUP</a></li>
                    </ul>
            </li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">
           <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge total_pesan"></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url();?>private_message">View Inbox <span class="badge total_pesan"></span></a></li>
                  <div id="private_message" style="margin-left: 10px;"></div>
              </ul>
            </li>
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $first_name." ".$last_name;?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
<!--                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>-->
                <li><a href="<?=base_url();?>login/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        <!--<div class="row">
          <div class="col-lg-12">
            <h1>Dashboard <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to SB Admin by <a class="alert-link" href="http://startbootstrap.com">Start Bootstrap</a>! Feel free to use this template for your admin needs! We are using a few different plugins to handle the dynamic tables and charts, so make sure you check out the necessary documentation links provided.
            </div>
          </div>
        </div>--><!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo $this->load->view($view);?>
            </div>
        </div>
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->
	
	<!-- modal filetree -->
	<div class="modal fade" id="filetree-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">File Directory</h4>
		  </div>
		  <div class="modal-body">
			<div id='filetree-content'>
				
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" id="filetree-save">Save changes</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>

    <!-- JavaScript -->
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/jquery-1.10.2.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.button.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.resizable.js"></script>
        
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.dialog.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.menu.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.accordion.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.tabs.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.tooltip.js"></script>
        
        
        
	<style>
	.custom-combobox {
		//position: relative;
		//display: inline-block;
                font-size: 15px;
                width: 100%;
	}
	.custom-combobox-toggle {
		//position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
		/* support: IE7 */
		*height: 10em;
		*top: 0.1em;
                width: 30px;
                background-color: red;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 0.3em;
	}
	</style>
	<script>
            (function( $ ) {
	$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right" )
					.mousedown(function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.click(function() {
						input.focus();

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.data( "ui-autocomplete" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );
        $(function() {
		$( ".comboboxxx" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
		});
	});
	$(function() {
                $( ".accordion" ).accordion();
                $( ".datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
                        dateFormat: "yy-mm-dd"
		});
                $( ".tabs" ).tabs();
                //$( "#combobox2" ).combobox();
                $('#dialog').dialog();
                
                $( ".dialog_image" ).dialog({
			autoOpen: false,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( ".opener_image" ).click(function() {
			$( ".dialog_image" ).dialog( "open" );
                        var isi = $("#gb1").val();
                        $("#isi").text(isi);
		});
                $( ".close_image" ).click(function() {
			$( ".dialog_image" ).dialog( "close" );
		});
	})
           
	</script>
        <!-- <script type="text/javascript">
            $(document).ready(function(){
                var seconds = 15000; // time in milliseconds
                var reload = function() {
                    $("#private_message").text('');
                    $.ajax({
                      type:'post',
                       url: '<?=base_url();?>panel/cek_message',
                       dataType: 'json',
                       cache: false,
                       success: function(data, status) {
                           var jum_pesan = data.length;
                           $(".total_pesan").text(jum_pesan);
                           $.each(data, function(i,item){
			         $("#private_message").append("<li class='divider'></li>\n\
                                                               <li class='message-preview'>\n\
                                                                    <a href='<?=base_url();?>private_message/"+item.id+"'>\n\
                                                                    <span class='name'>"+item.name+":</span>\n\
                                                                    <span class='message'>"+item.product_name+"</span>\n\
                                                                    <span class='message'>"+item.question+"</span>\n\
                                                                    <span class='time'><i class='fa fa-clock-o'></i> "+item.datetime+"</span></a>\n\
                                                               </li>");
			    });
                           setTimeout(function() {
                              reload();
                           }, seconds);
                       }
                    });
                };
                reload();
            });
            </script> -->

    <!-- Page Specific Plugins -->
    <script src="<?=base_url();?>assets/multiselect/bootstrap-select.js"></script>
    <script src="<?=base_url();?>assets/themes/panel/js/bootstrap.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?=base_url();?>assets/themes/panel/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="<?=base_url();?>assets/themes/panel/js/tablesorter/tables.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?=base_url();?>assets/themes/panel/data-tables/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?=base_url();?>assets/themes/panel/data-tables/js/ZeroClipboard.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?=base_url();?>assets/themes/panel/data-tables/js/TableTools.js"></script>
		
  </body>
</html>

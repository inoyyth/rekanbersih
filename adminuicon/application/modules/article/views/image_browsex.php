<html>
<head>
	<title>Techlister.com - Folder tree with PHP and jQuery</title>
	<link rel="stylesheet" href="<?=base_url();?>assets/folder_tree/css/filetree.css" type="text/css" >
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	
<script type="text/javascript" >
$(document).ready( function() {
	$("#filetree-save").click(function (){
		setFiletree();
	});
	
	$( '#container' ).html( '<ul class="filetree start"><li class="wait">' + 'Generating Tree...' + '<li></ul>' );
	
	getfilelist( $('#container') , 'files' );
	
	function getfilelist( cont, root ) {
	
		$( cont ).addClass( 'wait' );
			
		$.post( '<?php echo base_url();?>assets/elfinder-2.1.24/Foldertree.php', { dir: root }, function( data ) {
	
			$( cont ).find( '.start' ).html( '' );
			$( cont ).removeClass( 'wait' ).append( data );
			if( 'Sample' == root ) 
				$( cont ).find('UL:hidden').show();
			else 
				$( cont ).find('UL:hidden').slideDown({ duration: 500, easing: null });
			
		});
	}
	
	$( '#container' ).on('click', 'LI A', function() {
		var entry = $(this).parent();
		
		if( entry.hasClass('folder') ) {
			if( entry.hasClass('collapsed') ) {
						
				entry.find('UL').remove();
				getfilelist( entry, escape( $(this).attr('rel') ));
				entry.removeClass('collapsed').addClass('expanded');
				$( '#link_text' ).val( $(this).attr( 'rel' ));
			}
			else {
				
				entry.find('UL').slideUp({ duration: 500, easing: null });
				entry.removeClass('expanded').addClass('collapsed');
			}
		} else {
			$( '#selected_file' ).text($(this).attr( 'rel' ));
			$( '#isi' ).val( $(this).attr( 'rel' ));
			$("#filetree-image").attr('src','<?=base_url();?>assets/elfinder-2.1.24/'+$(this).attr( 'rel' ));
			//setModel($(this).attr( 'rel' ));
		}
	return false;
	});
});

function setFiletree(){
	var id = $( '#selected_file' ).text();
	$("#thumbnail").val(id);
	$("#blah1").attr('src','<?=base_url();?>assets/elfinder-2.1.24/'+id);
	$('#filetree-modal').modal('hide');
   }
</script>

</head>
<body>
<div id="container"> </div>
<div id="selected_file"></div>
<div style="margin-left: 26px;">
	<img src="" id="filetree-image" height="100px" width="130px" style="border: solid;">
</div>
</body>
</html>
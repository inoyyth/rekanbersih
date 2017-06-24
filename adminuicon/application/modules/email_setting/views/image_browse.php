<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">setTimeout("window.close();", 15000);</script>
<script language="javascript">
   function setModel(id){
     window.opener.document.forms[0].thumbnail.value = id;
     window.opener.document.forms[0].blah1.src = "<?=base_url();?>assets/elfinder/"+id;
     window.self.close();
     setTimeout("window.close();", 15000);
     bersih();
   }
  </script>
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Techlister.com - Folder tree with PHP and jQuery</title>
	<link rel="stylesheet" href="<?=base_url();?>assets/folder_tree/css/filetree.css" type="text/css" >
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	
<script type="text/javascript" >
$(document).ready( function() {

	$( '#container' ).html( '<ul class="filetree start"><li class="wait">' + 'Generating Tree...' + '<li></ul>' );
	
	getfilelist( $('#container') , 'files' );
	
	function getfilelist( cont, root ) {
	
		$( cont ).addClass( 'wait' );
			
		$.post( '<?=base_url();?>assets/elfinder/Foldertree.php', { dir: root }, function( data ) {
	
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
			$( '#selected_file' ).text( "File:  " + $(this).attr( 'rel' ));
                        $( '#isi' ).val( $(this).attr( 'rel' ));
                        setModel($(this).attr( 'rel' ));
		}
	return false;
	});
	
        $("#upload_submit").click(function(){
           if($("#link_text").val()==""){
               alert("Please Select Folder for upload");
            }
            else if($("#link_text").val()==""){
               alert("File is Required");
            }
            else{
                $("#upload_foto").submit();
            }
        });
});
</script>

</head>
<body>
<div id="container"> </div>
<div id="selected_file"></div>
<form method="post" id="upload_foto" action="<?=base_url();?>article/upload_foto" enctype="multipart/form-data" >
    <fieldset>
        <input type="hidden" id="link_text" name="link_text" required>
            <input type="file" name="image" required> <input id="upload_submit" type="button" value="upload">
    </fieldset>
</form>
</body>
</html>
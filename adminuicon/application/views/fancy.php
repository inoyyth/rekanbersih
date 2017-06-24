<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>
   !window.jQuery && document.write('<script src="<?=base_url();?>assets/fancybox/jquery-1.4.3.min.js"><\/script>');
</script>
<script type="text/javascript" src="<?=base_url();?>assets/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/fancybox/style.css" />
<script>
    $(document).ready(function() {
    $("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});
    });
</script>


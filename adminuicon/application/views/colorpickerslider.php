<!--<link href="<?=base_url();?>/assets/colorpickersliders/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">-->
<link href="<?=base_url();?>/assets/colorpickersliders/libraries/prettify/prettify.css" rel="stylesheet" type="text/css" media="all">
<link href="<?=base_url();?>/assets/colorpickersliders/demo.css" rel="stylesheet" type="text/css" media="all">
<link href="<?=base_url();?>/assets/colorpickersliders/jquery-colorpickersliders/jquery.colorpickersliders.css" rel="stylesheet" type="text/css" media="all">

<script src="<?=base_url();?>/assets/colorpickersliders/libraries/jquery-1.9.0.min.js"></script>
<script src="<?=base_url();?>/assets/colorpickersliders/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>/assets/colorpickersliders/libraries/prettify/prettify.js"></script>
<script src="<?=base_url();?>/assets/colorpickersliders/libraries/tinycolor.js"></script>
<script src="<?=base_url();?>/assets/colorpickersliders/jquery-colorpickersliders/jquery.colorpickersliders.js"></script>


<?php
if(!empty($color_data)) {
    foreach($color_data as $x) {
    ?>
    <script type="text/javascript">
        $("span.<?php echo $x['span_class']; ?>").ColorPickerSliders({
            flat: true,
            invalidcolorsopacity: 1,
            previewontriggerelement: false,
            connectedinput: '.<?php echo $x['span_class_input']; ?>',
            swatches: false,
            color : '<?php echo !empty($x['color']) ? $x['color'] : 'rgb(222, 255, 163)'; ?>',
            order: {
            opacity: 0,
            rgb: 1,
            preview: 2
            },labels: {
            rgbred: 'Red',
            rgbgreen: 'Green',
            rgbblue: 'Blue'
        }
        });
    </script>
    <?php
    }
} else {
?>



    <script>
        $("span.full-demo").ColorPickerSliders({
            flat: true,
            invalidcolorsopacity: 1,
            previewontriggerelement: false,
            connectedinput: '.full-demo-input',
            swatches: false,
            order: {
            opacity: 0,
            rgb: 1,
            preview: 2
            },labels: {
            rgbred: 'Red',
            rgbgreen: 'Green',
            rgbblue: 'Blue'
        }
        });
    </script>
<?php
}
?>
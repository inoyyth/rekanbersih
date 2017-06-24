<ol class="breadcrumb">
    <li></i> Discount System</li>
    <li class="active"></i> Add Main Discount</li>
</ol>
<form method="post" action="<?=base_url();?>discount/add_proses_main_discount" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>discount/index_main_discount');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Main Discount </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Discount Name</label>
                    <input type="text" class="form-control" name="discount_name"  required/>
                </div>
<!--                <div class="form-group">
                    <label>From Date</label>
                    <input class="form-control" name="from_date" type="text" size="15" id="from" required/>
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input class="form-control" name="to_date" type="text" size="15" id="to" required/>
                </div>-->
                <div class="form-group">
                    <label>Minimum Value</label>
                    <input type="text" class="form-control rupiah" value="0" name="minimum_value"/>
                </div>
                <div class="form-group">
                    <label>Discount System</label>
                    <select class="form-control" required name="parameter_discount" id="discount_system">
                        <option value="">Set Discount System</option>
                        <option value="MD">Manual Discount</option>
                        <option value="BG">Buy Get</option>
                    </select>
                </div>
                <div class="form-group" id="discount_manual" style="display: none;">
                    <label>Value Of Discount</label>
                    <input type="text" class="form-control rupiah" name="discount_value_manual"/>
                    <input type="checkbox" name="percentase_manual" value="1"/> Persentase 
                    <input type="checkbox" name="kelipatan_manual" value="1"/> Kelipatan
                </div>
                
                <div class="form-group col-lg-6 discount_getbuy" style="display: none;">
                    <input type="button" id="add_list_discount" value="+"> 
                    <label>List of Discount</label>
                    <select name="get_buy[]" class="form-control">
                        <?php
                            foreach($list_discount as $list_discountx){
                        ?>
                        <option value="<?=$list_discountx->id;?>"><?=$list_discountx->list_discount_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 discount_getbuy" style="display: none;">
                    <label>Value Of Discount</label>
                    <input type="text" name="value_getbuy[]" class="form-control rupiah"/>
                    <input type="checkbox" name="percentase_getbuy[]" value="1"/> Persentase
                </div>
                
                <div id="show_list_discount"></div>
                
                <div class="form-group col-lg-12">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                        <option value="">Status</option>
                        <option value="Y">Active</option>
                        <option value="N">Not Active</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('multitextbox');?>
<script type="text/javascript" src="<?=base_url();?>tinymce/tinymce.min.js"/></script>
<script type="text/javascript" src="<?=base_url();?>tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   //content_css: "<?=base_url();?>tinymce/css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
}); 
</script>
<script type="text/javascript">
    var $j = jQuery.noConflict();
$j(document).ready(function() { 
    $j("#app_product").tokenInput("<?=base_url();?>discount/listproduct", {
        theme: "facebook",
        preventDuplicates: true
    });
    $j("#exc_product").tokenInput("<?=base_url();?>coupon/listproduct", {
        theme: "facebook",
        preventDuplicates: true
    });
    $j("#app_category").tokenInput("<?=base_url();?>coupon/listcategory", {
        theme: "facebook",
        preventDuplicates: true
    });
    $j("#exc_category").tokenInput("<?=base_url();?>coupon/listcategory", {
        theme: "facebook",
        preventDuplicates: true
    });
    $j("#app_brand").tokenInput("<?=base_url();?>coupon/listbrand", {
        theme: "facebook",
        preventDuplicates: true
    });
    $j("#exc_brand").tokenInput("<?=base_url();?>coupon/listbrand", {
        theme: "facebook",
        preventDuplicates: true
    });
});
</script>

<script>
    $(document).ready(function(){
        var ix=0;
        $("#app_category").keypress(function (){
           alert('tes');
        });
        $("#discount_system").change(function (){
           var isi = $(this).val();
           if(isi==="MD"){
                $("#discount_manual").show();
                $(".discount_getbuy").hide();
           }
           if(isi==="BG"){
                $("#discount_manual").hide();
                $(".discount_getbuy").show();
           }
        });
        
        $("#add_list_discount").click(function(){
            var n = ix++;
            var att_php = "<?php  foreach($list_discount as $list_discountx){
                        echo "<option value='$list_discountx->id'>$list_discountx->list_discount_name</option>";
                         }
                        ?>";
            var repeat_discount ="<div id='rem_div"+n+"'><div class='form-group col-lg-6 discount_getbuy'>\n\
                    <input type='button' onclick='rem_list("+n+")' value='-'>\n\
                    <label>List of Discount</label>\n\
                    <select name='get_buy[]' class='form-control'>"+att_php+"</select>\n\
                </div>\n\
                <div class='form-group col-lg-6 discount_getbuy'>\n\
                    <label>Value Of Discount</label>\n\
                    <input type='text' name='value_getbuy[]' class='form-control rupiah' required/>\n\
                    <input type='checkbox' name='percentase_getbuy[]' value='1'/> Persentase\n\
                </div></div>";
            $("#show_list_discount").append(repeat_discount);
        });
    });
    function rem_list(id){
        $("#rem_div"+id).remove();
    }
</script>
<script>
$(function() {
$( "#from" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
dateFormat: "yy-mm-dd",
//numberOfMonths: 3,
onClose: function( selectedDate ) {
$( "#to" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#to" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
dateFormat: "yy-mm-dd",
//numberOfMonths: 3,
onClose: function( selectedDate ) {
$( "#from" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
</script>
<ol class="breadcrumb">
    <li></i> Discount System</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?=base_url();?>discount/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>discount');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Discount </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Main Discount</label>
                    <select name="main_discount" id="main_discount" class="form-control">
                        <option value="">- select main discount -</option>
                        <?php foreach($list_discount as $list_discountx){
                            if($detail_discount->main_discount_id==$list_discountx->id){
                                $cek="selected";
                            }else{
                                $cek="";
                            }
                        ?>
                        <option value="<?=$list_discountx->id;?>" <?=$cek;?>><?=$list_discountx->discount_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Discount System</label>
                    <input type="text" class="form-control disc_list" id="discount_system" readonly/>
                </div>
                <div class="form-group">
                    <label>Minimum Value</label>
                    <input type="text" class="form-control disc_list" id="minimum_value" readonly/>
                </div>
                <div class="form-group">
                    <label>Discount Name</label> <input type="hidden" name="id" value="<?=$detail_discount->id;?>"/>
                    <input type="text" class="form-control" name="discount_name" value="<?=$detail_discount->discount_name;?>" required/>
                </div>
                <div class="form-group">
                    <label>Apply for Brand</label>
                    <input type="text" class="form-control" name="app_brand" id="app_brand"  />
                </div>
                <!--<div class="form-group col-lg-6">
                    <label>Exclude for Brand</label>
                    <input type="text" class="form-control" name="exc_brand" id="exc_brand"  />
                </div>-->
                <div class="form-group">
                    <label>Apply for Category</label>
                    <input type="text" class="form-control" name="app_category" id="app_category"  />
                </div>
                <!--<div class="form-group col-lg-6">
                    <label>Exclude for Category</label>
                    <input type="text" class="form-control" name="exc_category" id="exc_category"  />
                </div>-->
                <div class="form-group">
                    <label>Apply for product</label>
                    <input type="text" class="form-control" name="app_product" id="app_product"  />
                </div>
                <!--<div class="form-group col-lg-6">
                    <label>Exclude Product</label>
                    <input type="text" class="form-control" name="exc_product" id="exc_product" />
                </div>-->
                <div class="form-group">
                    <label>From Date</label>
                    <input class="form-control" name="from_date" type="text" size="15" id="from" value="<?=$detail_discount->from_date;?>" required/>
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input class="form-control" name="to_date" type="text" size="15" id="to" value="<?=$detail_discount->to_date;?>" required/>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                        <?php
                            if($detail_discount->status=="Y"){
                                $y="selected";
                            }else{
                                $y="";
                            }
                            if($detail_discount->status=="N"){
                                $n="selected";
                            }else{
                                $n="";
                            }
                        ?>
                        <option value="">Set Status</option>
                        <option value="Y" <?=$y;?>>Active</option>
                        <option value="N" <?=$n;?>>Not Active</option>
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
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                      if($detail_discount->apply_discount_product != ""){
                      $dc=explode(",", $detail_discount->apply_discount_product);
                       foreach($dc as $cd){
                           $dt=$this->db->query("select a.id as id,b.sku as name from product_general a left join product_detail b on a.id=b.product_general_id where a.id='$cd'")->row();
                           echo '{id: '.$dt->id.', name: "'.$dt->name.'"},';
                       }
                      }else{
                          
                      }
                    ?>
                ]
    });
    $j("#exc_product").tokenInput("<?=base_url();?>coupon/listproduct", {
        theme: "facebook",
        preventDuplicates: true
    });
    $j("#app_category").tokenInput("<?=base_url();?>coupon/listcategory", {
        theme: "facebook",
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                        if($detail_discount->category_product_discount!=""){
                        $dc=explode(",", $detail_discount->category_product_discount);
                            foreach($dc as $cd){
                                $dt=$this->db->query("select id,product_category_name as name from product_category where id='$cd'")->row();
                                echo '{id: '.$dt->id.', name: "'.$dt->name.'"},';
                            }
                        }else{
                            
                        }
                    ?>
                ]
    });
    $j("#exc_category").tokenInput("<?=base_url();?>coupon/listcategory", {
        theme: "facebook",
        preventDuplicates: true
    });
    $j("#app_brand").tokenInput("<?=base_url();?>coupon/listbrand", {
        theme: "facebook",
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                        if($detail_discount->brand_id!=""){
                        $dc=explode(",", $detail_discount->brand_id);
                            foreach($dc as $cd){
                                $dt=$this->db->query("select id,brand_name as name from brand where id='$cd'")->row();
                                echo '{id: '.$dt->id.', name: "'.$dt->name.'"},';
                            }
                        }else{
                            
                        }
                    ?>
                ]
    });
    $j("#exc_brand").tokenInput("<?=base_url();?>coupon/listbrand", {
        theme: "facebook",
        preventDuplicates: true
    });
});
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
<script>
    $(document).ready(function(){
        var idx= "<?=$detail_discount->main_discount_id;?>";
        if(idx===""){
            $("#discount_system").val('');
            $("#minimum_value").val('');
        }else{
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>discount/cek_main_discount",
            data: "id=" + idx,
            beforeSend: function () {
                $("#loading_gif").show();
            },
            success: function (dt) {
                hasil=dt.split("|");
                console.log(hasil);
                var ax = hasil[1].split("|");
                if(ax == "BG"){
                    $("#discount_system").val("Buy Get System");
                }else{
                    $("#discount_system").val("Manual System");
                }
                $("#minimum_value").val(hasil[0].split("|"));
            }
        });
        }
        $("#main_discount").change(function(){
        var id = $(this).val();
        if(id===""){
            $("#discount_system").val('');
            $("#minimum_value").val('');
        }else{
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>discount/cek_main_discount",
            data: "id=" + id,
            beforeSend: function () {
                $("#loading_gif").show();
            },
            success: function (dt) {
                hasil=dt.split("|");
                console.log(hasil);
                var ax = hasil[1].split("|");
                //alert(ax);
                if(ax == "BG"){
                    $("#discount_system").val("Buy Get System");
                }else{
                    $("#discount_system").val("Manual System");
                }
                $("#minimum_value").val(hasil[0].split("|"));
            }
        });
        }
    });
    });
</script>
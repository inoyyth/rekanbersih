<ol class="breadcrumb">
    <li></i> Coupon System</li>
    <li></i> Coupon System</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?=base_url();?>coupon/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>coupon');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Coupon </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Coupon Name</label>  <input type="hidden" name="id" value="<?=$list_detail->id;?>">  <input type="hidden" name="posisi" value="<?=$posisi;?>">
                    <input type="text" class="form-control" name="coupon_name" value="<?=$list_detail->coupon_name;?>" required/>
                </div>
                <div class="form-group">
                    <label>Coupon Code</label>
                    <input type="text" class="form-control" name="coupon_code" value="<?=$list_detail->coupon_code;?>" required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?=$list_detail->description;?></textarea>
                </div>
                <div class="form-group">
                    <label>Coupon Type</label>
                    <select name="coupon_type" class="combobox">
                        <?php
                        foreach($list_type as $type){
                            if($type->id == $list_detail->coupon_type){
                                $cek="selected";
                            }else{
                                $cek="";
                            }
                            echo"<option value='$type->id' $cek>$type->coupon_type</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="amount" value="<?=$list_detail->amount;?>" required/>
                </div>
                <div class="form-group col-lg-6">
                    <label>Minimum Sub Total Cart</label>
                    <input type="text" class="form-control" name="sub_total_cart" value="<?=$list_detail->minimum_sub_total;?>" required/>
                </div>
                <div class="form-group col-lg-12">
                    <label>Usage Limit Type</label>
                    <div class="form-group">
                        <?php
                            if($list_detail->usage_limit_type=="1"){
                                $satu="checked";
                                $dua="";
                            }
                            if($list_detail->usage_limit_type=="2"){
                                $satu="";
                                $dua="checked";
                            }
                        ?>
                        <input type="radio" name="limit_per_coupon" value="1" <?=$satu;?> required> lImit Per Coupon
                        <input type="radio" name="limit_per_coupon" value="2" <?=$dua;?> required> lImit Per Users
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label>Usage Limit Value</label>
                    <input type="text" class="form-control" name="limit_per_tot" value="<?=$list_detail->usage_limit_total;?>" required/>
                </div>
                <div class="form-group">
                     <?php
                    if($list_detail->other_coupon=="1"){
                        $satu="checked";
                    }else{
                        $satu="";
                    }
                    if($list_detail->sale_item=="1"){
                        $dua="checked";
                    }else{
                        $dua="";
                    }
                     if($list_detail->member_only=="1"){
                        $tiga="checked";
                    }else{
                        $tiga="";
                    }
                    ?>
                    <label>&nbsp;</label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="other_coupon"  value="1" <?=$satu;?>> Cannot be used with other coupon
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" name="sale_item" value="1" <?=$dua;?>> Not apply for sale items
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" name="member_only" value="1" <?=$tiga;?>> Member only
                    </label>
                </div>
                <div class="form-group col-lg-6">
                    <label>Apply for Categorys</label>
                    <input type="text" class="form-control" name="app_category" id="app_category"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Exclude for Categorys</label>
                    <input type="text" class="form-control" name="exc_category" id="exc_category"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Apply for Brands</label>
                    <input type="text" class="form-control" name="app_brand" id="app_brand"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Exclude Brands</label>
                    <input type="text" class="form-control" name="exc_brand" id="exc_brand"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Apply for Products</label>
                    <input type="text" class="form-control" name="app_product" id="app_product"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Exclude Products</label>
                    <input type="text" class="form-control" name="exc_product" id="exc_product"  />
                </div>
                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="text" class="form-control datepicker" name="expiry_date" value="<?=$list_detail->expiry_date;?>"  required/>
                </div>
                 <div class="form-group">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" name="status" required>
                        <?php
                            if($list_detail->status == "Y"){
                                $a="selected";
                            }else{
                                $a="";
                            }
                            
                            if($list_detail->status == "N"){
                                $b="selected";
                            }else{
                                $b="";
                            }
                        ?>
                        <option value="Y" <?=$a;?>/>Active</option>
                        <option value="N" <?=$b;?>/>Not Active</option>
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
    $j("#app_product").tokenInput("<?=base_url();?>coupon/listproduct", {
        theme: "facebook",
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                      if($list_detail->app_product!=""){
                      $dc=explode(",", $list_detail->app_product);
                       foreach($dc as $cd){
                           $dt=$this->db->query("select id,product_name as name from product_general where id='$cd'")->row();
                           echo '{id: '.$dt->id.', name: "'.$dt->name.'"},';
                       }
                      }else{
                          
                      }
                    ?>
                ]
    });
    $j("#exc_product").tokenInput("<?=base_url();?>coupon/listproduct", {
        theme: "facebook",
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                        if($list_detail->exc_product!=""){
                            $dc=explode(",", $list_detail->exc_product);
                            foreach($dc as $cd){
                               $dt=$this->db->query("select id,product_name as name from product_general where id='$cd'")->row();
                               echo '{id: '.$dt->id.', name: "'.$dt->name.'"},';
                            }
                        }else{
                            
                        }
                    ?>
                ]
    });
    $j("#app_category").tokenInput("<?=base_url();?>coupon/listcategory", {
        theme: "facebook",
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                        if($list_detail->app_category!=""){
                        $dc=explode(",", $list_detail->app_category);
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
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                        if($list_detail->exc_category!=""){
                        $dc=explode(",", $list_detail->exc_category);
                            foreach($dc as $cd){
                                $dt=$this->db->query("select id,product_category_name as name from product_category where id='$cd'")->row();
                                echo '{id: '.$dt->id.', name: "'.$dt->name.'"},';
                            }
                        }else{
                            
                        }
                    ?>
                ]
    });
    $j("#app_brand").tokenInput("<?=base_url();?>coupon/listbrand", {
        theme: "facebook",
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                        if($list_detail->app_brand!=""){
                        $dc=explode(",", $list_detail->app_brand);
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
        preventDuplicates: true,
        prePopulate: [
                     <?php 
                        if($list_detail->exc_brand!=""){
                        $dc=explode(",", $list_detail->exc_brand);
                            foreach($dc as $cd){
                                $dt=$this->db->query("select id,brand_name as name from brand where id='$cd'")->row();
                                echo '{id: '.$dt->id.', name: "'.$dt->name.'"},';
                            }
                        }else{
                            
                        }
                    ?>
                ]
    });
});
</script>
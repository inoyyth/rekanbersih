<ol class="breadcrumb">
    <li></i> Coupon System</li>
    <li></i> Coupon System</li>
    <li class="active"></i> Add</li>
</ol>
<form method="post" action="<?=base_url();?>coupon/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>coupon');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Coupon </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Coupon Name</label>
                    <input type="text" class="form-control" name="coupon_name"  required/>
                </div>
                <div class="form-group">
                    <label>Coupon Code</label>
                    <input type="text" class="form-control" name="coupon_code"  required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Coupon Type</label>
                    <select name="coupon_type" class="combobox">
                        <?php
                        foreach($list_type as $type){
                            echo"<option value='$type->id'>$type->coupon_type</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="amount"  required/>
                </div>
                <div class="form-group col-lg-6">
                    <label>Minimum Sub Total Cart</label>
                    <input type="text" class="form-control" name="sub_total_cart"  required/>
                </div>
                <div class="form-group col-lg-12">
                    <label>Usage Limit Type</label>
                    <div class="form-group">
                        <input type="radio" name="limit_per_coupon" value="1" required> lImit Per Coupon
                        <input type="radio" name="limit_per_coupon" value="2" required> lImit Per Users
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <label>Usage Limit Value</label>
                    <input type="text" class="form-control" name="limit_per_user" required/>
                </div>
                <div class="form-group" col-lg-6>
                    <label>&nbsp;</label>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="other_coupon" value="1"> Cannot be used with other coupon
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" name="sale_item" value="1"> Not apply for sale items
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" name="member_only" value="1"> Member only
                    </label>
                </div>
                <div class="form-group col-lg-6">
                    <label>Apply for Category</label>
                    <input type="text" class="form-control" name="app_category" id="app_category"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Exclude for Category</label>
                    <input type="text" class="form-control" name="exc_category" id="exc_category"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Apply for Brand</label>
                    <input type="text" class="form-control" name="app_brand" id="app_brand"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Exclude for Brand</label>
                    <input type="text" class="form-control" name="exc_brand" id="exc_brand"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Apply for product</label>
                    <input type="text" class="form-control" name="app_product" id="app_product"  />
                </div>
                <div class="form-group col-lg-6">
                    <label>Exclude Product</label>
                    <input type="text" class="form-control" name="exc_product" id="exc_product" />
                </div>
                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="text" class="form-control datepicker" name="expiry_date"  required/>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                        <option value="">Set Status</option>
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
    $j("#app_product").tokenInput("<?=base_url();?>coupon/listproduct", {
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
        $("#app_category").keypress(function (){
           alert('tes');
        });
    });
</script>
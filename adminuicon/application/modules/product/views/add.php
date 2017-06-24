<form method="post" action="<?=base_url();?>product/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>product');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add Product </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>Category</label>
            <select class="combo_search" id="category" style="width: 100%;font-size: 15px;" required name="product_category">
                <option value="">--select category--</option>
                <?php
                    foreach($product_category as $category){ ?>
						<option value="<?php echo $category['id'];?>"><?php echo $category['product_category_name'];?></option>
                 <?php } ?>
            </select>
        </div>
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name"  required/>
                </div>
				<div class="form-group">
                    <label>Product Price</label>
                    <input type="text" class="form-control" name="product_price"  required/>
                </div>
				<div class="form-group">
                    <label>Length Area</label>
                    <input type="text" class="form-control" name="length_area"  required/>
                </div>
				<div class="form-group">
                    <label>Length Unit</label>
                    <select class="form-control" name="length_unit"  required/>
						<?php 
							$unit = ['m','m2','m3'];
							foreach($unit as $v){
						?>
						<option value="<?php echo $v;?>"><?php echo $v;?></option>
						<?php } ?>
					</select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="editor1" name="product_description"></textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="text" class="form-control" id="thumbnail" name="thumbnail" onclick="TampilModel('<?=base_url();?>product/image_browse');" required readonly/>
                    <div style="margin-top: 10px;">
                        <img src="" id="blah1" height="100px" width="130px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Hot Product</label>
                    <input type="checkbox" value="1" name="hot_product">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" style="width: 100%;font-size: 10px;" required name="status">
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
<?php $this->load->view('ckeditor');?>
<script type="text/javascript">
function TampilModel(file){
	$('#filetree-modal').modal('show');
	$('#filetree-content').load(file);
}
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1',
    {
        filebrowserBrowseUrl: '<?php echo base_url();?>assets/elfinder-2.1.24/elfinder.html',
        filebrowserUploadUrl: '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
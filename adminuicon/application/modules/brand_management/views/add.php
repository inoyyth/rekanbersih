<ol class="breadcrumb">
    <li> Category Mgt.</li>
    <li> Brands</li>
    <li class="active"> Add<li>
</ol>
<form method="post" action="<?=base_url();?>brand_management/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>brand_management');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Brands </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Brand Name</label>
                    <input class="form-control" name="brand_name">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" style="width: 100%;font-size: 15px;" name="category[]" multiple required>
                        <?php 
                        foreach($category as $categoryx){
                        ?>
                        <option value="<?=$categoryx->id;?>"/> <?=$categoryx->product_category_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Brand Description</label>
                    <textarea class="form-control" name="brand_description"></textarea>
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="text" class="form-control" id="thumbnail" name="thumbnail" onclick="TampilModel('<?=base_url();?>brand_management/image_browse');" id="thumbnail" required readonly/>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" name="status">
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
<?php $this->load->view('tinyfck');?>
<script type="text/javascript">
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
}
</script>

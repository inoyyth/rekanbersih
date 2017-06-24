<ol class="breadcrumb">
    <li> Category Mgt.</li>
    <li> Category</li>
    <li class="active"> Update<li>
</ol>
<form method="post" action="<?=base_url();?>category_management/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>category_management/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Category </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>ID</label>
					<input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                    <input class="form-control" type="text" name="id" value="<?=$list->id;?>" readonly/>
                </div>
                <div class="form-group">
                    <label>Category Name</label>
                    <input class="form-control" name="product_category_name" value="<?=$list->product_category_name;?>"/>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" style="width: 100%;font-size: 10px;" required name="product_category_status">
                        <option value="">Set Status</option>
                        <option value="Y" <?php echo ($list->product_category_status=="Y"?"selected":"");?>>Active</option>
                        <option value="N" <?php echo ($list->product_category_status=="N"?"selected":"");?>>Not Active</option>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
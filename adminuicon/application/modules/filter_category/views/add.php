<ol class="breadcrumb">
    <li> Category Mgt.</li>
    <li> Filter Category</li>
    <li class="active"> Add<li>
</ol>
<form method="post" action="<?=base_url();?>filter_category/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>filter_category');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Filter Category </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Category Name</label>
                    <select name="category" class="combobox" style="width: 100%;font-size: 10px;">
                        <option value="">Set Status</option>
                        <?php foreach($category as $categoryx){?>
                            <option value="<?=$categoryx->id;?>"><?=$categoryx->product_category_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Filter Name</label>
                    <input type="text" name="filtername" class="form-control">
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
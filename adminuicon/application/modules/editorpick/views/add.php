<ol class="breadcrumb">
    <li></i> Editorpick</li>
    <li class="active"></i> Add</li>
</ol>
<form method="post" action="<?=base_url();?>editorpick/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>editorpick');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Editorpick</h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Theme Name</label>
                    <input type="text" class="form-control" name="theme_name"  required/>
                </div>
                <div class="form-group">
                    <label>Theme Description</label>
                    <textarea name="theme_description" style="width: 90%;"></textarea>
                </div>
                <div class="form-group">
                    <label>Theme Image</label>
                    <input type="file" name="image" onchange="readURL1(this);"  required/>
                    <div style="margin-top: 10px;">
                        <img src="#" id="blah1" height="100px" width="100px" style="border: solid;">
                    </div>
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
<?php $this->load->view('tinyfck');?>
<script type="text/javascript">
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
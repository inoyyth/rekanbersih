<form method="post" action="<?= base_url(); ?>bannerfix/add_proses" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>bannerfix');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Add Banner </h3>
        </div>
        <div class="panel-body" id="panelx">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="banner_title" class="form-control" required />
            </div>
            
            <div class="form-group">
                <label>Link Title</label>
                <input type="text" name="banner_link" class="form-control" required />
            </div>
            
            <div class="form-group">
                <label>URL</label>
                <input type="text" name="banner_url" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="text" class="form-control" id="thumbnail" name="banner_image" onclick="TampilModel('<?=base_url();?>bannerfix/image_browse');" id="thumbnail" required readonly/>
                <div style="margin-top: 10px;">
                    <img src="" id="bimage1" height="200px" width="230px" style="border: solid;">
                </div>
            </div>
            
            <div class="form-group">
                <label>Target Page</label>
                <select class="combobox" style="width: 100%;font-size: 10px;" required name="banner_target">
                    <option value="1">On Page</option>
                    <option value="0">New Page</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Status</label>
                <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
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
<script type="text/javascript" src="<?=base_url();?>tinymce/tinymce.min.js"/></script>
<?php $this->load->view('tinyfck');?>
<script>
    function TampilModel(file){
        window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
    }
</script>
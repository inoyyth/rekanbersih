<form method="post" action="<?=base_url();?>faq/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>faq');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add FAQ </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>Questions</label>
            <textarea class="form-control" id="editor1" name="question"></textarea>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="editor2" name="answered"></textarea>
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
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('ckeditor');?>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1',
    {
        filebrowserBrowseUrl: '<?php echo base_url();?>assets/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
    CKEDITOR.replace( 'editor2',
    {
        filebrowserBrowseUrl: '<?php echo base_url();?>assets/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
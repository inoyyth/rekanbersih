<ol class="breadcrumb">
    <li></i> Email Setting</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?=base_url();?>email_setting/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Contact  </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Image</label>
                    <input type="text" class="form-control" id="thumbnail" name="image" value="<?=$detail->logo;?>" onclick="TampilModel('<?=base_url();?>contact/image_browse');" required readonly/>
                    <div style="margin-top: 10px;">
                        <img src="" id="blah1" height="150px" width="300px" style="border: solid;">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Header</label>
                    <textarea name="header" id="editor1" rows="10" cols="80"><?=$detail->header;?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Footer</label>
                    <textarea name="footer" id="editor2" rows="10" cols="80"><?=$detail->footer;?></textarea>
                </div>
                
            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('ckeditor');?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#blah1").attr("src",'<?=base_url();?>assets/elfinder/<?=$detail->logo;?>');
        $("#urlmaps").focusout(function(){   
            var val = $(this).val();
            $("#gmaps").attr("src",val);
        })
    });
    function TampilModel(file){
        window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
    }
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
</script>
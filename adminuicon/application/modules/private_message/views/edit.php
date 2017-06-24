<form method="post" action="<?=base_url();?>private_message/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>article/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Private Message </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
            <input class="form-control" type="text" name="id" value="<?=$data->id;?>" readonly/>
        </div>
        <div class="form-group">
            <label>Question</label>
            <textarea class="form-control" name="question" id="editor_1"><?=$data->question;?></textarea>
        </div>
        <div class="form-group">
            <label>Answered</label>
            <textarea class="form-control" name="answered" id="editor_2"><?=$data->answered;?></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="combobox" style="width: 100%;font-size: 10px;" name="status" required>
                <?php
                    if($data->status == "Y"){
                        $a="selected";
                    }else{
                        $a="";
                    }

                    if($data->status == "N"){
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
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('combo2');?>
<?php $this->load->view('ckeditor');?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor_1' );
    CKEDITOR.replace( 'editor_2' );
</script>
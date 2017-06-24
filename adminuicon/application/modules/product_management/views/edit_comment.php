<?php error_reporting(0);?>
<form method="post" action="<?=base_url();?>product_management/update_comment" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>product_management/comment_search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Update Merk </h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label>Customer Name</label>
                <input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                <input type="hidden" name="id" value="<?=$detail->id;?>"/>
                <input type="text" class="form-control" value="<?php echo $detail->name;?>" readonly/>
            </div>
            <div class="form-group">
                <label>Comment</label>
                <textarea name="comment" class="form-control"><?=$detail->comment;?></textarea>
            </div>
            <div class="form-group">
                <label>Reply</label>
                <textarea name="comment_reply" class="form-control"><?=$detail->comment_reply;?></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="combobox">
                    <?php
                        if($detail->status=="Y"){
                            $y="selected";
                            $n="";
                        }else{
                            $y="";
                            $n="selected";
                        }
                    ?>
                    <option value="Y" <?=$y;?>>Active</option>
                    <option value="N" <?=$n;?>>Not Active</option>
                </select>
            </div>
        </div>
    </div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('multitextbox');?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
}
</script>
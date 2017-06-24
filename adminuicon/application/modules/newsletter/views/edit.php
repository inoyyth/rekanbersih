<form method="post" action="<?=base_url();?>newsletter/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>newsletter/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Newsletter </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
            <input class="form-control" type="text" name="id" value="<?=$list_detail->id;?>" readonly/>
        </div>
        <div class="form-group">
            <label>Title (Subject)</label>
            <input type="text" class="form-control" name="title" value="<?=$list_detail->news_title;?>" required/>
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea name="message" style="width: 90%;"><?=$list_detail->news_description;?></textarea>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('combo2');?>
<?php $this->load->view('tinyfck');?>
<script type="text/javascript">
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
}
</script>
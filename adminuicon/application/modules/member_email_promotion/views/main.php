<ol class="breadcrumb">
    <li class="active"></i> Member Email Promotion</li>
</ol>
<form method="post" action="<?=base_url();?>member_email_promotion/update_email_member_promotion" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>');" class="btn btn-danger" value="Close" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Member Email Promotion </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Email Value</label>
                    <textarea name="isi_email" style="width: 90%;"><?=$detail->email_value;?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('tinyfck');?>
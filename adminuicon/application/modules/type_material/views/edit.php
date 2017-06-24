<ol class="breadcrumb">
    <li> Category Mgt.</li>
    <li> Materail</li>
    <li class="active"> Update<li>
</ol>
<form method="post" action="<?=base_url();?>type_material/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>type_material/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Merk </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                    <input class="form-control" type="text" name="id" value="<?=$list->id_type_material;?>" readonly/>
                </div>
                <div class="form-group">
                    <label>Merk Name</label>
                    <input class="form-control" name="type_material_name" value="<?=$list->type_material;?>">
                </div>
                <div class="form-group">
                    <label>Abbreviation</label>
                    <input class="form-control" name="abbreviation" value="<?=$list->abbreviation;?>">
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('tinyfck');?>
<script type="text/javascript">
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
}
</script>
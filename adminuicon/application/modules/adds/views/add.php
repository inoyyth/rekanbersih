<form method="post" action="<?= base_url(); ?>adds/add_proses" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>adds');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Add Adds </h3>
        </div>
        <div class="panel-body" id="panelx">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="adds_name" required/>
            </div>
            <div class="form-group">
                <label>URL</label>
                <input type="text" class="form-control" name="adds_url" required/>
            </div>
            <div class="form-group">
                <label> Link Open</label>
                <select name="adds_open" class="form-control">
                    <option value="1">Self Page</option>
                    <option value="0">Open Page</option>
                </select>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="text" class="form-control" id="thumbnail" name="adds_image" onclick="TampilModel('<?=base_url();?>adds/image_browse');" id="thumbnail" required readonly/>
            </div>
            <div class="form-group">
                <label>Menu : </label>
                <span>
                    <br/>
                    <?php foreach($menu as $menux) {?>
                    <input type="checkbox" name="menu[]" value="<?=$menux->id;?>"> <?=$menux->menu_name;?>
                        <br/>
                    <?php
                    }
                    ?>
                    
                </span>
            </div>
        </div>
    </div>
</div>
</div>
</form>

<?php $this->load->view('combobox_autocomplete'); ?>
<script>
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
}
</script>
<form method="post" action="<?=base_url();?>locator_management/update_city_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.history.back();" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update City </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>City</label><input type="hidden" name="id" value="<?=$detail->id;?>"/>
                    <input type="text" class="form-control" name="city" value="<?=$detail->city;?>" required/>
                </div>
                <div class="form-group">
                    <label>Set Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                        <?php
                            if($detail->status=="Y"){
                                $y="selected";
                            }else{
                                $y="";
                            }
                            if($detail->status=="N"){
                                $n="selected";
                            }else{
                                $n="";
                            }
                        ?>
                        <option value="">Set Status</option>
                        <option value="Y" <?=$y;?>>Active</option>
                        <option value="N" <?=$n;?>>Not Active</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
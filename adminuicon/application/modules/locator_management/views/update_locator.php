<form method="post" action="<?=base_url();?>locator_management/update_locator_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.history.back();" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Store Location </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
            <div class="form-group">
                <label>Chose City</label><input type="hidden" name="id" value="<?=$list_locator->id;?>"/>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="city">
                        <option value="">choose city</option>
                        <?php
                            foreach($list_city as $city){
                            if($city->id == $list_locator->id_city){
                                $loc="selected";
                            }else{
                                $loc="";
                            }
                        ?>
                                <option value="<?=$city->id;?>"<?=$loc;?>><?=$city->city;?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address"><?=$list_locator->address;?></textarea>
                </div>
                <div class="form-group">
                    <label>Url Maps</label>
                    <input type="text" name="map" class="form-control" value="<?=$list_locator->map;?>"/>
                </div>
<!--                <div class="form-group">
                    <label>Maps Preview</label>
                    <iframe src="https://mapsengine.google.com/map/embed?mid=zpftrfr6DoQM.khuRl99ugjBA" width="200" height="200"></iframe>
                </div>-->
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" onchange="readURL1(this);" /><input type="hidden" name="image_hidden" value="<?=$list_locator->image;?>"/>
                    <div style="margin-top: 10px;">
                        <img src="<?=base_url();?>assets/foto/<?=$list_locator->image;?>" id="blah1" height="100px" width="100px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Set Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                         <?php
                            if($list_locator->status=="Y"){
                                $y="selected";
                            }else{
                                $y="";
                            }
                            if($list_locator->status=="N"){
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
<script type="text/javascript">
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
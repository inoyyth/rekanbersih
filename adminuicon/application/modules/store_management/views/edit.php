<ol class="breadcrumb">
    <li></i> Locator Mgt.</li>
    <li></i> Store</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?=base_url();?>store_management/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>store_management/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Store  </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                    <input class="form-control" type="text" name="id" value="<?=$list_detail->id;?>" readonly/>
                </div>
                <div class="form-group">
                <label>Chose City</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="city">
                        <option value="">choose city</option>
                        <?php
                            foreach($list_city as $city){
                                if($city->id==$list_detail->id_city){
                                    $select="selected";
                                }else{
                                    $select="";
                                }
                        ?>
                        <option value="<?=$city->id;?>" <?=$select;?>><?=$city->city;?></option>
                            <?php } ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Locator Name</label>
                    <input type="text" name="locator_name" value="<?=$list_detail->locator_name;?>" class="form-control" required/>
                </div>
                
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address"><?=$list_detail->address;?></textarea>
                </div>
                <div class="form-group">
                    <label>Url Maps</label>
                    <input type="text" name="map" class="form-control" value="<?=$list_detail->map;?>" required/>
                </div>
                
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="text" name="tel" class="form-control" value="<?=$list_detail->telepon;?>" required/>
                </div>
                
<!--                <div class="form-group">
                    <label>Maps Preview</label>
                    <iframe src="https://mapsengine.google.com/map/embed?mid=zpftrfr6DoQM.khuRl99ugjBA" width="200" height="200"></iframe>
                </div>-->
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" onchange="readURL1(this);"/>
                    <div style="margin-top: 10px;">
                        <input type="hidden" name="image_hidden" value="<?=$list_detail->image;?>"/>
                        <img src="../../../../userfiles/Image/store_management/<?=$list_detail->image;?>" id="blah1" height="100px" width="100px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" name="status" required>
                        <?php
                            if($list_detail->status == "Y"){
                                $a="selected";
                            }else{
                                $a="";
                            }
                            
                            if($list_detail->status == "N"){
                                $b="selected";
                            }else{
                                $b="";
                            }
                        ?>
                        <option value="Y" <?=$a;?>/>Active</option>
                        <option value="N" <?=$b;?>/>Not Active</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Logo</label>
                    <div class="col-lg-12" style="background:#f8f8f8;border:1px solid #ccc;">
                        <?php
                        $current_logo = explode(',', trim($list_detail->logo));
                        
                        foreach($list_logo as $logo_data) {
                            ?>
                                <div style="border-bottom: 1px solid #ddd;padding:10px 5px;">
                                    <?php
                                    $set = Array(
                                        'name' => 'logo[]'
                                    );
                                    
                                    if(in_array($logo_data->id, $current_logo)) {
                                        $set['checked'] = "checked";
                                    } else {
                                        $set['checked'] = null;
                                    }
                                    
                                    
                                    echo form_checkbox($set, $logo_data->id).'&nbsp;&nbsp;&nbsp;';
                                    echo $logo_data->logo_title;
                                    echo '&nbsp;&nbsp;&nbsp;<img src="../../../../userfiles/Image/logo/'.$logo_data->logo_image.'" width="50px" height="30px"/>';
                                    echo '<br/>';
                                    ?>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('tinyfck');?>
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
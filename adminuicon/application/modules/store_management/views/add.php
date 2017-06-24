<ol class="breadcrumb">
    <li></i> Locator Mgt.</li>
    <li></i> Store</li>
    <li class="active"></i> Add</li>
</ol>
<form method="post" action="<?=base_url();?>store_management/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>store_management');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Store  </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
            <div class="form-group">
                    <label>Chose City</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="city">
                        <option value="">choose city</option>
                        <?php
                            foreach($list_city as $city){?>
                        <option value="<?=$city->id;?>"><?=$city->city;?></option>
                            <?php } ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Locator Name</label>
                    <input type="text" name="locator_name" class="form-control" required/>
                </div>
                
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address"></textarea>
                </div>
                <div class="form-group">
                    <label>Url Maps</label>
                    <input type="text" name="map" class="form-control" required/>
                </div>
<!--                <div class="form-group">
                    <label>Maps Preview</label>
                    <iframe src="https://mapsengine.google.com/map/embed?mid=zpftrfr6DoQM.khuRl99ugjBA" width="200" height="200"></iframe>
                </div>-->
                <div class="form-group">
                    <label>Telephone</label>
                    <input type="text" name="tel" class="form-control" required/>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" onchange="readURL1(this);"  required/>
                    <div style="margin-top: 10px;">
                        <img src="#" id="blah1" height="100px" width="100px" style="border: solid;">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Set Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                        <option value="">Set Status</option>
                        <option value="Y">Active</option>
                        <option value="N">Not Active</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Logo</label>
                    <div class="col-lg-12" style="background:#f8f8f8;border:1px solid #ccc;">
                        <?php
                        foreach($list_logo as $logo_data) {
                            ?>
                                <div style="border-bottom: 1px solid #ddd;padding:10px 5px;">
                                    <?php
                                    echo form_checkbox(Array(
                                        'name' => 'logo[]'
                                    ), $logo_data->id).'&nbsp;&nbsp;&nbsp;';
                                    echo $logo_data->logo_title;
                                    echo '&nbsp;&nbsp;&nbsp;<img src="../../userfiles/Image/logo/'.$logo_data->logo_image.'" width="50px" height="30px"/>';
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
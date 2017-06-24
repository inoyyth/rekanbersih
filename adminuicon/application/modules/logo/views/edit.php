<ol class="breadcrumb">
    <li></i> Logo Management</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?=base_url();?>logo/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>logo/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Logo </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                    <input class="form-control" type="text" name="id" value="<?=$list_detail->id;?>" readonly/>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" value="<?=$list_detail->logo_title;?>" name="title"  required/>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" onchange="readURL1(this);"/>
                    <div style="margin-top: 10px;">
                        <img src="<?=base_url();?>assets/UserFiles/Image/logo/<?=$list_detail->logo_image;?>" id="blah1" height="100px" width="100px" style="border: solid;">
                        <input type="hidden" name="image_hidden"  value="<?=$list_detail->logo_image;?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description"><?=$list_detail->logo_description;?></textarea>
                </div>
                <div class="form-group">
                    <label>Set Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                        <?php
                            if($list_detail->status=="Y"){
                                $y="selected";
                            }else{
                                $y="";
                            }
                            if($list_detail->status=="N"){
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
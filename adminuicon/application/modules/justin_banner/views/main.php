<ol class="breadcrumb">
    <li></i> Justin Banner</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?=base_url();?>justin_banner/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>justin_banner');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Justin Banner  </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Banner Right</label>
                    <input type="file" name="image1" onchange="readURL1(this);"/>
                    <div style="margin-top: 10px;">
                        <input type="hidden" name="image_hidden1" value="<?=$list->banner_right;?>"/>
                        <img src="../userfiles/Image/justin_banner/<?=$list->banner_right;?>" id="blah1" height="100px" width="100px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Banner Right Url</label>
                    <input type="text" class="form-control" name="right_url" value="<?=$list->banner_right_url;?>"/>
                </div>
                <div class="form-group">
                    <label>Banner Left</label>
                    <input type="file" name="image2" onchange="readURL2(this);"/>
                    <div style="margin-top: 10px;">
                        <input type="hidden" name="image_hidden2" value="<?=$list->banner_left;?>"/>
                        <img src="../userfiles/Image/justin_banner/<?=$list->banner_left;?>" id="blah2" height="100px" width="100px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Banner Left Url</label>
                    <input type="text" class="form-control" name="left_url" value="<?=$list->banner_left_url;?>"/>
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
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah2')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
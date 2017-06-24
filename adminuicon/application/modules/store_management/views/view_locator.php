<style>
    .address{
        border: 1px solid #cccccc;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        padding: 10px;
        background-color: #eeeeee;
    }
</style>
<ol class="breadcrumb">
    <li></i> Locator Mgt.</li>
    <li></i> Store</li>
    <li class="active"></i> View</li>
</ol>
<form method="post" action="<?=base_url();?>locator_management/update_locator_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>store_management/search/<?=$posisi;?>');" class="btn btn-danger" value="Back" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> View Store Location </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
            <div class="form-group">
                <label>City</label><input type="hidden" name="id" value="<?=$list_locator->id;?>"/>
                <input type="text" name="map" class="form-control" value="<?=$list_locator->city;?>" disabled/>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <div class="address"><?=$list_locator->address;?></div>
                </div>
                <div class="form-group">
                    <label>Url Maps</label>
                    <input type="text" name="map" class="form-control" disabled value="<?=$list_locator->map;?>" required/>
                    <iframe src="<?=$list_locator->map;?>" width="100%" height="250" style="margin-top: 1%;" ></iframe>
                </div>
<!--                <div class="form-group">
                    <label>Maps Preview</label>
                    <iframe src="https://mapsengine.google.com/map/embed?mid=zpftrfr6DoQM.khuRl99ugjBA" width="200" height="200"></iframe>
                </div>-->
                <div class="form-group">
                    <label>Image</label>
                    <div style="margin-top: 10px;">
                        <img src="<?=base_url();?>assets/foto/<?=$list_locator->image;?>" id="blah1" height="300px" width="100%" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="text" class="form-control" disabled value="<?=status($list_locator->status);?>"/>
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
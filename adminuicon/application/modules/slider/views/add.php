<ol class="breadcrumb">
    <li></i> Slider</li>
    <li class="active"></i> Add</li>
</ol>
<form method="post" action="<?= base_url(); ?>slider/add_proses" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>slider');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Add New Slider </h3>
        </div>
        <div class="panel-body" id="panelx">
            <div class="row" style="font-size: 12px;">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title"  required/>
                    </div>
                    <div class="form-group">
                        <label>Image (sugest size 1920 x 717)</label>
                        <input type="text" class="form-control" id="thumbnail" name="image" onclick="TampilModel('<?= base_url(); ?>slider/image_browse');" required readonly/>
                        <div style="margin-top: 10px;">
                            <img src="" id="blah1" height="180px" width="350px" style="border: solid;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" name="image_url" class="form-control" required="true">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="slider_description" class="form-control" required="true"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Window Target</label>
                        <select class="combobox" style="width: 100%;font-size: 10px;" required name="slider_target">
                            <option value="blank">Blank</option>
                            <option value="parent">Parent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                            <option value="">Set Status</option>
                            <option value="Y">Active</option>
                            <option value="N">Not Active</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $this->load->view('combobox_autocomplete'); ?>
<script type="text/javascript">
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                        .attr('src', e.target.result)
                        .width(350)
                        .height(180);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function validate(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    function TampilModel(file) {
        $('#filetree-modal').modal('show');
        $('#filetree-content').load(file);
    }
</script>
<?php $this->load->view('colorpickerslider'); ?>
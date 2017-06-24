<ol class="breadcrumb">
    <li></i> Slider</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?= base_url(); ?>slider/update_proses" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>slider');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Update Slider </h3>
        </div>
        <div class="panel-body" id="panelx">
            <div class="row" style="font-size: 12px;">
                <div class="form-group">
                    <label>Title</label>    <input type="hidden"  value="<?= $list_detail->id; ?>" name="id">
                    <input type="text" class="form-control" name="title" value="<?= $list_detail->title; ?>"  required/>
                </div>
                <div class="form-group">
                    <label>Image (sugest size 1920 x 717)</label>
                    <input type="text" class="form-control" name="image" onclick="TampilModel('<?= base_url(); ?>slider/image_browse');" id="thumbnail" value="<?= $list_detail->image_slider; ?>" required readonly/>
                    <div style="margin-top: 10px;">
                        <img src="<?= base_url(); ?>assets/elFinder-2.1.24/<?= $list_detail->image_slider; ?>" id="blah1" height="180px" width="350px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="image_url" class="form-control" required="true" value="<?php echo $list_detail->image_url; ?>">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="slider_description" class="form-control" required="true"><?php echo $list_detail->slider_description; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Window Target</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="slider_target">
                        <option value="blank" <?php echo ($list_detail->slider_target == "blank" ? "selected" : ""); ?>>Blank</option>
                        <option value="parent" <?php echo ($list_detail->slider_target == "parent" ? "selected" : ""); ?>>Parent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" name="status" required>
                        <?php
                        if ($list_detail->status == "Y") {
                            $a = "selected";
                        } else {
                            $a = "";
                        }

                        if ($list_detail->status == "N") {
                            $b = "selected";
                        } else {
                            $b = "";
                        }
                        ?>
                        <option value="Y" <?= $a; ?>/>Active</option>
                        <option value="N" <?= $b; ?>/>Not Active</option>
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
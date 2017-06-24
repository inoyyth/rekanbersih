<ol class="breadcrumb">
    <li></i> Contact</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?= base_url(); ?>contact/update_proses" enctype="multipart/form-data" >
    <div style="margin-bottom: 5px;text-align: right;">
        <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>');" class="btn btn-danger" value="Cancel" />
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"> Update Contact  </h3>
        </div>
        <div class="panel-body" id="panelx">
            <div class="row" style="font-size: 12px;">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="company" class="form-control" value="<?= $detail->company; ?>" required/>
                    </div>

                    <div class="form-group">
                        <label>Owner Name</label>
                        <input type="text" name="owner" class="form-control" value="<?= $detail->owner; ?>" required/>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address"><?= $detail->address; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="text" name="telephone" class="form-control" value="<?= $detail->telephone; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?= $detail->email; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label>Office Hour</label>
                        <textarea class="form-control" name="office_hour"><?= $detail->office_hour; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Url Maps</label>
                        <input id="urlmaps" type="text" name="map" class="form-control" value="<?= $detail->map; ?>" required/>
                        <p>Only insert src from maps</p>
                    </div>
                    <div class="form-group">
                        <iframe id="gmaps" src="" width="500" height="200"></iframe>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="text" class="form-control" id="thumbnail" name="image" value="<?= $detail->image; ?>" onclick="TampilModel('<?= base_url(); ?>contact/image_browse');" required readonly/>
                        <div style="margin-top: 10px;">
                            <img src="" id="blah1" height="150px" width="300px" style="border: solid;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?= $detail->description; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $this->load->view('combobox_autocomplete'); ?>
<?php $this->load->view('tinyfck'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#gmaps").attr("src", '<?= $detail->map; ?>');
        $("#blah1").attr("src", '<?= base_url(); ?>assets/elfinder-2.1.24/<?= $detail->image; ?>');
        $("#urlmaps").focusout(function () {
            var val = $(this).val();
            $("#gmaps").attr("src", val);
        })
    });
            function TampilModel(file) {
                $('#filetree-modal').modal('show');
                $('#filetree-content').load(file);
            }
</script>
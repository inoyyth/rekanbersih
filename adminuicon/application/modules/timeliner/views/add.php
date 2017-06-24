<ol class="breadcrumb">
    <li></i> Timeliner</li>
    <li class="active"></i> Add</li>
</ol>
<form method="post" action="<?=base_url();?>timeliner/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>timeliner/search');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Timeliner </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
<!--                <div class="form-group">
                    <label>Start</label>
                    <input type="text" class="form-control datepicker" name="start"  required/>
                </div>
                <div class="form-group">
                    <label>End</label>
                    <input type="text" class="form-control datepicker" name="end"  required/>
                </div>-->
                <div class="form-group">
                    <label>Year</label>
                    <select name="year" class="combobox" required>
                        <option value="" selected></option>
                        <?php
                        $year=date("Y")+1;
                        for($i=1990;$i<=$year;$i++){
                            echo"<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title"  required/>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content"></textarea>
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
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('tinyfck');?>
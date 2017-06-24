<ol class="breadcrumb">
    <li> Category Mgt.</li>
    <li> Attributes</li>
    <li class="active"> Add<li>
</ol>
<form method="post" action="<?=base_url();?>attribute_management/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>attribute_management');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Attributes </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Attributes Name</label>
                    <input class="form-control" name="attributes_name">
                </div>
                <div class="form-group">
                    <label>Attributes Description</label>
                    <textarea class="form-control" name="attributes_description"></textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="child" onclick="tampil(this);"> <label>Attributes Child</label>
                    <div id="tampil_row">
                        <input type="button" id="add" class="btn btn-sm" value="+ add"><br>
                        <p><input type="text" required name="val[]" id="inputsatu"/></p>
                    </div>
                </div>
                <div class="form-group">
                    <label>Set Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" name="active">
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
$(function(){
    var i = 1;
    $("#tampil_row").hide();
    
    $("#add").click(function(){
        var x = i++;
        var inputan="<p><input type='text' class='inputan2' required name='val[]' id='inp"+x+"'> <input type='button' class='btn btn-sm inputan2' value='Remove' id='but"+x+"' onclick='hapus("+x+");'/></p>";
        $("#tampil_row").append(inputan);
    });
    
});
    function tampil(check){
        if(check.checked){
            //alert('checked');
            $("#tampil_row").show();
            $("#inputsatu").val('');
            $(".inputan2").remove();
        }else{
            //alert('notchecked');
             $("#tampil_row").hide();
        }
    }
    
    function hapus(id){
        $("#inp"+id).remove();
        $("#but"+id).remove();
    }
</script>
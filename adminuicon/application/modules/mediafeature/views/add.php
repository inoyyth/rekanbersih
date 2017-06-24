<ol class="breadcrumb">
    <li></i> Media Feature</li>
    <li class="active"></i> Add</li>
</ol>
<form method="post" action="<?=base_url();?>mediafeature/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>mediafeature/search');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Mediafeature </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title"  required/>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="category">
                        <option value="">Set Category</option>
                        <?php foreach($category as $categoryx){ ?>
                        <option value="<?=$categoryx->id;?>"><?=$categoryx->category_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Media URL</label>
                    <input type="text" class="form-control" name="media_url"  required/>
                </div>
                <div class="form-group">
                    <label>Image Thumbnail</label>
                    <input type="file" multiple  name="image" onchange="readURL1(this);"  required/>
                    <div style="margin-top: 10px;">
                        <img src="#" id="blah1f" height="100px" width="100px" style="border: solid;">
                    </div>
                </div>
                <div class="page-header">
                    <p><i class="fa fa-info-circle"></i>&nbsp;<label>Image Library</label><span><input type="button" id="add" class="btn btn-sm pull-right" value="+ add"></span></p><div class="clearfix"></div>
                </div>
                <div class="container-fluid">
                    <div id="tampil_row" class="form-group pull-left"></div><br/>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group" style="padding-top: 10px;">
                    <label>Media Weblink</label>
                    <input type="text" class="form-control" name="media_weblink"  required/>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control datepicker" name="date"  required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="media_description"></textarea>
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
<script type="text/javascript">
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1f')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL1x(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1x')
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
    
    $("#add").click(function(){
        var x = i++;
        var inputan = "<div class='col-lg-3' style='padding-bottom:10px;'><input type='file' multiple  onchange='readURLxx(this,"+x+");' required name='userfile[]' id='inp"+x+"'/><br/><img src='#' id='blah"+x+"' height='100px' width='100px' style='border: solid;'> <input type='button' class='btn btn-sm inputan2' value='Remove' id='but"+x+"' onclick='hapus("+x+");'/></div>";
        //var inputan="<p><input type='text' class='inputan2' required name='val[]' id='inp"+x+"'> <input type='button' class='btn btn-sm inputan2' value='Remove' id='but"+x+"' onclick='hapus("+x+");'/></p>";
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
        $("#blah"+id).remove();
    }
    function readURLxx(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#blah"+id)
                .attr('src', e.target.result)
                .width(100)
                .height(100);
        };

        reader.readAsDataURL(input.files[0]);
    }
    }
</script>
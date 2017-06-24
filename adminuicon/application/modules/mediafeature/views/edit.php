<ol class="breadcrumb">
    <li></i> Media Feature</li>
    <li class="active"></i> Update</li>
</ol>
<form method="post" action="<?=base_url();?>mediafeature/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>mediafeature/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Mediafeature </h3>
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
                    <input type="text" class="form-control" value="<?=$list_detail->media_title;?>" name="title"  required/>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="category">
                        <option value="">Set Category</option>
                        <?php 
                        foreach($category as $categoryx){ 
                        if($list_detail->media_category==$categoryx->id){
                            $cek="selected";
                        }else{
                            $cek="";
                        }
                        ?>
                        <option value="<?=$categoryx->id;?>" <?=$cek;?>><?=$categoryx->category_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Media URL</label>
                    <input type="text" class="form-control" value="<?=$list_detail->media_url;?>" name="media_url"  required/>
                </div>
                <div class="form-group">
                    <label>Image Thumbnail</label>
                    <input type="file" name="image" onchange="readURL1(this);"/>
                    <div style="margin-top: 10px;">
                        <img src="../../../../userfiles/Image/media_feature/<?=$list_detail->media_image;?>" id="blahf" height="100px" width="100px" style="border: solid;">
                        <input type="hidden" name="image_hidden"  value="<?=$list_detail->media_image;?>"/>
                    </div>
                </div>
                <div class="form_group">
                    <label>Image Library</label>
                </div>
                <div class="form_group">
                    <div id="tampil_row">
                        <input type="button" id="add" class="btn btn-sm" value="+ add" style="margin:20px;">
                        <?php foreach($image_lib as $imglib){?>
                        <div id="tempe<?=$imglib->id;?>">
<!--                            <input type="file" required multiple name="userfile[]" id="inputsatu" onchange="readURL1xc(this,<?=$imglib->id;?>);"/>
                            <input type="hidden" name="image_hidden"  value="<?=$imglib->mediafeatureimage_image;?>"/>-->
                            <img src="../../../../userfiles/Image/media_feature/<?=$imglib->mediafeatureimage_image;?>" id="blahc<?=$imglib->id;?>" height="100px" width="100px" style="border: solid;"><input type='button' class='btn btn-sm inputan2' value='Remove' onclick='hapustempe(<?=$imglib->id;?>);'/>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Media Weblink</label>
                    <input type="text" class="form-control" name="media_weblink"  value="<?=$list_detail->media_weblink;?>"  required/>
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control datepicker" name="date"  value="<?=$list_detail->date;?>"  required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="media_description"><?=$list_detail->media_description;?></textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
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
                $('#blahf')
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
    function readURL1xc(input,id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blahc'+id)
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function hapustempe(id){
        $.ajax({
                type:"POST",
                url:"<?=base_url();?>mediafeature/delete_image",
                data:"id="+id,
                beforeSend: function() {
                    $("#loading_gif").show();
                },
                success: function(dt){
                    console.log(dt);
                    $("#tempe"+id).hide();
                },
                beforeSend: function() {
                    $("#loading_gif").hide();
                },
            });
    }
</script>
<script>
$(function(){
    var i = 1;
    
    $("#add").click(function(){
        var x = i++;
        var inputan = "<input type='file' multiple  onchange='readURLxx(this,"+x+");' required name='userfile[]' id='inp"+x+"'/><img src='#' id='blah"+x+"' height='100px' width='100px' style='border: solid;'> <input type='button' class='btn btn-sm inputan2' value='Remove' id='but"+x+"' onclick='hapus("+x+");'/>";
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
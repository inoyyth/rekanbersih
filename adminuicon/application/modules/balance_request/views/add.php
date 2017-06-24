<form method="post" action="<?=base_url();?>article/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>article');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add Article </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>Category</label>
            <select class="combo_search" id="category" style="width: 100%;font-size: 15px;" required name="category">
                <option value="">--select category--</option>
                <?php
                    foreach($list_category as $category){
                        echo"<option value='$category->id'>$category->article_category_name</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Subategory</label>
            <select class="combo_search" style="width: 100%;font-size: 15px;" id="subcategory" required name="subcategory">
                <option value="">--select subcategory--</option>
            </select>
        </div>
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Article Name</label>
                    <input type="text" class="form-control" name="article"  required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="text" class="form-control" id="thumbnail" name="thumbnail" onclick="TampilModel('<?=base_url();?>article/image_browse');" required readonly/>
                    <div style="margin-top: 10px;">
                        <img src="" id="blah1" height="100px" width="130px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" style="width: 100%;font-size: 10px;" required name="status">
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
<?php $this->load->view('multitextbox');?>
<?php $this->load->view('tinyfck');?>
<script type="text/javascript">
    $(document).ready(function(){
        var app='<select class="combobox" style="width: 100%;font-size: 10px;" required name="subcategory" id="subcategory"></select>';
    $("#category").change(function(){
//        $("#subcategory").remove();
//        $("#app").append("<select name='subcategory' class='combobox' id='subcategory'></select>");
//        $("#subcategory" ).combobox();
         var id = $("#category").val();
         $.ajax({
             type:'post',
             url:"<?=base_url();?>article/get_subcategory",
             data: "id="+id,
             success: function(data){
                 $("#subcategory").html(data);
             }
         });
      }); 
});
function TampilModel(file){
window.open(file,'_blank','toolbar=no,scrollbars=yes,statusbar=yes,height=485,width=520').focus();
}
</script>
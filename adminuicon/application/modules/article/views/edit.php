<form method="post" action="<?=base_url();?>article/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>article/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Article </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <div class="form-group">
                    <label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                    <input class="form-control" type="text" name="id" value="<?=$list_detail->id;?>" readonly/>
                </div>
            <label>Category</label>
            <select class="combo_search" style="width: 100%;font-size: 15px;" id="category" required name="category">
                <option value="">--select category--</option>
                <?php
                    foreach($list_category as $cat){
                        if($list_detail->id_category==$cat->id){
                            $cek="selected";
                        }else{
                            $cek="";
                        }
                ?>
                <option value="<?=$cat->id;?>" <?=$cek;?>><?=$cat->article_category_name;?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Subategory</label>
            <select class="combo_search" style="width: 100%;font-size: 15px;" id="subcategory" required name="subcategory">
                <?php
                    $list_subcategory=$this->db->query("select * from article_subcategory where id_category='$list_detail->id_category'")->result();
                    foreach($list_subcategory as $subcat){
                        if($list_detail->id_subcategory==$subcat->id){
                            $cek2="selected";
                        }else{
                            $cek2="";
                        }
                ?>
                <option value="<?=$subcat->id;?>" <?=$cek2;?>><?=$subcat->article_subcategory_name;?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Article Name</label>
                    <input type="text" class="form-control" name="article" value="<?=$list_detail->article_name;?>"  required/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="editor1" name="description"><?=$list_detail->article_description;?></textarea>
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="text" class="form-control" id="thumbnail" name="thumbnail" onclick="TampilModel('<?=base_url();?>article/image_browse');" value="<?=$list_detail->article_image;?>" required readonly/>
                    <div style="margin-top: 10px;">
                        <img src="<?=base_url();?>assets/elFinder-2.1.24/<?=$list_detail->article_image;?>" id="blah1" height="100px" width="130px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Index Article</label>
                    <input type="checkbox" value="1" name="index_article" <?php echo ($list_detail->index_article=="1"?"checked":"");?>>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" name="status" required>
                        <?php
                            if($list_detail->status == "Y"){
                                $a="selected";
                            }else{
                                $a="";
                            }
                            
                            if($list_detail->status == "N"){
                                $b="selected";
                            }else{
                                $b="";
                            }
                        ?>
                        <option value="Y" <?=$a;?>/>Active</option>
                        <option value="N" <?=$b;?>/>Not Active</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('combobox_autocomplete');?>
<?php $this->load->view('combo2');?>
<?php $this->load->view('ckeditor');?>
<script type="text/javascript">
    $(document).ready(function(){
		$("#category").change(function(){
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
	$('#filetree-modal').modal('show');
	$('#filetree-content').load(file);
}
</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1',
    {
        filebrowserBrowseUrl: '<?php echo base_url();?>assets/elFinder-2.1.24/elfinder.html',
        filebrowserUploadUrl: '<?php echo base_url();?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });
</script>
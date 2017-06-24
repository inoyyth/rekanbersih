<form method="post" action="<?=base_url();?>customer_comment/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>customer_comment/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Article Category </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>ID</label><input type="hidden" name="posisi" value="<?=$posisi;?>"/>
                    <input class="form-control" type="text" name="id" value="<?=$list_detail->id;?>" readonly/>
                </div>
                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" value="<?=$list_detail->customer_name;?>" required/>
                </div>
				<div class="form-group">
                    <label>Customer Job</label>
                    <input type="text" class="form-control" name="customer_job" value="<?=$list_detail->customer_job;?>" required/>
                </div>
				<div class="form-group">
                    <label>Customer Title</label>
                    <select class="form-control" name="customer_title" required/>
						<option value="1" <?php echo ($list_detail->customer_title==1?"selected":"");?>>Mr.</option>
						<option value="2" <?php echo ($list_detail->customer_title==2?"selected":"");?>>Mrs.</option>
					</select>
                </div>
				<div class="form-group">
                    <label>Customer Office</label>
                    <input type="text" class="form-control" name="customer_office" value="<?=$list_detail->customer_office;?>" required/>
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control" name="customer_comment"> <?=$list_detail->customer_comment;?></textarea>
                </div>
                <div class="form-group">
                    <label>Set Status</label>
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
<script type="text/javascript" src="<?=base_url();?>tinymce/tinymce.min.js"/></script>
<script type="text/javascript" src="<?=base_url();?>tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   //content_css: "<?=base_url();?>tinymce/css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
}); 
</script>
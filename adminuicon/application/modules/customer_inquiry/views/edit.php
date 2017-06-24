<form method="post" action="<?=base_url();?>customer_inquiry/update_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>customer_inquiry/search/<?=$posisi;?>');" class="btn btn-danger" value="Cancel" />
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
                    <label>Name</label>
                    <input type="text" class="form-control" name="inquiry_name" value="<?=$list_detail->inquiry_name;?>" readonly="true"/>
                </div>
				<div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="inquiry_email" value="<?=$list_detail->inquiry_email;?>" readonly="true"/>
                </div>
				<div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="inquiry_phone" value="<?=$list_detail->inquiry_phone;?>" readonly="true"/>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="inquiry_address" readonly="true"> <?=$list_detail->inquiry_address;?></textarea>
                </div>
				<div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="inquiry_message" readonly="true"> <?=$list_detail->inquiry_message;?></textarea>
                </div>
                <div class="form-group">
                    <label>Set Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" name="status" required>
                        <option value="1" <?=($list_detail->status == 1 ? "selected" : "");?>/>Waiting</option>
                        <option value="2" <?=($list_detail->status == 2 ? "selected" : "");?>/>Follow Up</option>
						<option value="3" <?=($list_detail->status == 3 ? "selected" : "");?>/>Done</option>
                    </select>
                </div>
				<div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" required="true"> <?=$list_detail->description;?></textarea>
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
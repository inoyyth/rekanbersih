<form method="post" action="<?=base_url();?>locator_management/add_locator_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.history.back();" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add New Store Location </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
            <div class="form-group">
                    <label>Chose City</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="city">
                        <option value="">choose city</option>
                        <?php
                            foreach($list_city as $city){?>
                        <option value="<?=$city->id;?>"><?=$city->city;?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address"></textarea>
                </div>
                <div class="form-group">
                    <label>Url Maps</label>
                    <input type="text" name="map" class="form-control" required/>
                </div>
<!--                <div class="form-group">
                    <label>Maps Preview</label>
                    <iframe src="https://mapsengine.google.com/map/embed?mid=zpftrfr6DoQM.khuRl99ugjBA" width="200" height="200"></iframe>
                </div>-->
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" onchange="readURL1(this);"  required/>
                    <div style="margin-top: 10px;">
                        <img src="#" id="blah1" height="100px" width="100px" style="border: solid;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Set Status</label>
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
<script type="text/javascript">
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
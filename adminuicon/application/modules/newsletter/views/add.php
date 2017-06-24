<form method="post" action="<?=base_url();?>newsletter/add_proses" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>newsletter');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Add Newsletter </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="form-group">
            <label>Title (Subject)</label>
            <input type="text" class="form-control" name="title"  required/>
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea name="message" style="width: 90%;"></textarea>
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
             url:"<?=base_url();?>newsletter/get_subcategory",
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
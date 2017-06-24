<ol class="breadcrumb">
    <li></i> Discount System</li>
    <li class="active"></i> Update Main Discount</li>
</ol>
<form method="post" action="<?=base_url();?>discount/update_proses_main_discount" enctype="multipart/form-data" >
<div style="margin-bottom: 5px;text-align: right;">
    <input type="submit" class="btn btn-primary" value="Save" /> <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>discount/index_main_discount');" class="btn btn-danger" value="Cancel" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Update Main Discount </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Discount Name</label> <input type="hidden" name="id" value="<?=$detail_discount->id;?>"/>
                    <input type="text" class="form-control" name="discount_name" value="<?=$detail_discount->discount_name;?>" required/>
                </div>
<!--                <div class="form-group">
                    <label>From Date</label>
                    <input class="form-control" name="from_date" type="text" size="15" id="from" value="<?=$detail_discount->from_date;?>" required/>
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input class="form-control" name="to_date" type="text" size="15" id="to" value="<?=$detail_discount->to_date;?>" required/>
                </div>-->
                <div class="form-group">
                    <label>Minimum Value</label>
                    <input type="text" class="form-control rupiah" value="<?=formatrp($detail_discount->minimum_value);?>" name="minimum_value"/>
                </div>
                <div class="form-group">
                    <label>Discount System</label>
                    <select class="form-control" required name="parameter_discount" id="discount_system">
                        <?php
                            if($detail_discount->parameter_discount=="MD"){
                                $md="selected";
                            }else{
                                $md="";
                            }
                            if($detail_discount->parameter_discount=="BG"){
                                $bg="selected";
                            }else{
                                $bg="";
                            }
                        ?>
                        <option value="">Set Discount System</option>
                        <option value="MD" <?=$md;?>>Manual Discount</option>
                        <option value="BG" <?=$bg;?>>Buy Get</option>
                    </select>
                </div>
                <?php if($detail_discount->parameter_discount=="MD"){?>
                <div class="form-group" id="discount_manual" style="display: none;">
                    <label>Value of Discount</label>
                    <input type="text" class="form-control rupiah" name="discount_value_manual" value="<?=  formatrp($value_discount->value_discount_manual);?>"/>
                    <input type="checkbox" name="percentase_manual" value="1" <?php echo ($value_discount->percentase=="1" ? "checked" : "");?>/> Persentase 
                    <input type="checkbox" name="kelipatan_manual" value="1" <?php echo ($value_discount->kelipatan=="1" ? "checked" : "");?>/> Kelipatan
                </div>
                
                <input type="button" id="add_list_discount" class="discount_getbuy" value=" + Add Discount " style="display: none;">
                <div class="form-group col-lg-6 discount_getbuy" style="display: none;">
                    <label>List of Discount</label>
                    <select name="get_buy[]" class="form-control">
                        <?php
                            foreach($list_discount as $list_discountx){
                        ?>
                        <option value="<?=$list_discountx->id;?>"><?=$list_discountx->list_discount_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 discount_getbuy" style="display: none;">
                    <label>Value Of Discount</label>
                    <input type="text" name="value_getbuy[]" class="form-control rupiah"/>
                    <input type="checkbox" name="percentase_getbuy[]" value="1"/> Persentase
                </div>
                <div id="show_list_discount"></div>
                <?php }else{ ?>
                <div class="form-group" id="discount_manual" style="display: none;">
                    <label>List Of Discount</label>
                    <input type="text" class="form-control rupiah" name="discount_value_manual"/>
                    <input type="checkbox" name="percentase_manual" value="1"/> Persentase
                </div>
                
                <input type="button" id="add_list_discount" value=" + Add Discount "><br><br>
                <?php foreach($value_discount as $value_discountx){ ?>
                <div class="form-group col-lg-6 discount_getbuy  remove_list_buy<?=$value_discountx->id;?>" style="display: none;">
                    <input type="button" value=" - " onclick="remove_list_buy('<?=$value_discountx->id;?>');">
                    <label>List of Discount</label>
                    <select name="get_buy[]" class="form-control">
                        <?php
                            foreach($list_discount as $list_discountx){
                                if($list_discountx->id == $value_discountx->list_discount_id){
                                    $cek="selected";
                                }else{
                                    $cek="";
                                }
                        ?>
                        <option value="<?=$list_discountx->id;?>" <?=$cek;?>><?=$list_discountx->list_discount_name;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 discount_getbuy  remove_list_buy<?=$value_discountx->id;?>" style="display: none;">
                    <label>Value Of Discount</label>
                    <input type="text" name="value_getbuy[]" class="form-control rupiah" value="<?=$value_discountx->value_discount_buy_get;?>"/>
                    <input type="checkbox" name="percentase_getbuy[]" value="1" <?php echo ($value_discountx->percentase=="1" ? "checked" : "");?>/> Persentase
                </div>
                <?php } ?>
                <div id="show_list_discount"></div>
                <?php } ?>
                <div class="form-group col-lg-12">
                    <label>Status</label>
                    <select class="combobox" style="width: 100%;font-size: 10px;" required name="status">
                        <?php
                            if($detail_discount->status=="Y"){
                                $y="selected";
                            }else{
                                $y="";
                            }
                            if($detail_discount->status=="N"){
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
<?php $this->load->view('multitextbox');?>
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

<script>
    $(document).ready(function(){
        var ix=0;
        if($("#discount_system").val()=="MD"){
            $("#discount_manual").show();
            $(".discount_getbuy").hide();
        }else{
            $("#discount_manual").hide();
            $(".discount_getbuy").show();
        }
        $("#app_category").keypress(function (){
           //alert('tes');
        });
        $("#discount_system").change(function (){
           var isi = $(this).val();
           if(isi==="MD"){
                $("#discount_manual").show();
                $(".discount_getbuy").hide();
           }
           if(isi==="BG"){
                $("#discount_manual").hide();
                $(".discount_getbuy").show();
           }
        });
        
        $("#add_list_discount").click(function(){
            var n = ix++;
            var att_php = "<?php  foreach($list_discount as $list_discountx){
                        echo "<option value='$list_discountx->id'>$list_discountx->list_discount_name</option>";
                         }
                        ?>";
            var repeat_discount ="<div id='rem_div"+n+"'><div class='form-group col-lg-6 discount_getbuy'>\n\
                    <input type='button' onclick='rem_list("+n+")' value='-'>\n\
                    <label>List of Discount</label>\n\
                    <select name='get_buy[]' class='form-control'>"+att_php+"</select>\n\
                </div>\n\
                <div class='form-group col-lg-6 discount_getbuy'>\n\
                    <label>Value Of Discount</label>\n\
                    <input type='text' name='value_getbuy[]' class='form-control rupiah'/>\n\
                    <input type='checkbox' name='percentase_getbuy[]' value='1'/> Persentase\n\
                </div></div>";
            $("#show_list_discount").append(repeat_discount);
        });
    });
    function rem_list(id){
        $("#rem_div"+id).remove();
    }
    function remove_list_buy(id){
        $(".remove_list_buy"+id).remove();
    }
</script>
<script>
$(function() {
$( "#from" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
dateFormat: "yy-mm-dd",
//numberOfMonths: 3,
onClose: function( selectedDate ) {
$( "#to" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#to" ).datepicker({
defaultDate: "+1w",
changeMonth: true,
dateFormat: "yy-mm-dd",
//numberOfMonths: 3,
onClose: function( selectedDate ) {
$( "#from" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
</script>
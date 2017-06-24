<ol class="breadcrumb">
    <li> Report</li>
    <li class="active"></i> Sales Report</li>
</ol>
<div class="row container">
    <form method="post" action="<?=base_url();?>sales_report/search" id="form2"/>
    <div class="col-lg-4">
        <i style="margin-top: -15px;font-size: 13px;">From </i><input style="font-size: 13px;margin-bottom: 4px;padding:7px;" name="from_sr" type="text" size="10" id="from" />

        <i style="margin-top: -15px;font-size: 13px;">To </i><input style="font-size: 13px;margin-top: -20px;padding:7px;" name="to_sr" type="text" size="10" id="to" />
    </div>
        <div class="col-lg-3">
        <select name="type_sr[]" id="pref-brand" class="form-control pref-brand selectpicker" title="Type" multiple data-selected-text-format="count" >
            <?php foreach($category as $categoryx){ ?>
            <option value="<?=$categoryx->id;?>"><?=$categoryx->product_category_name;?></option>
            <?php } ?>
        </select>
        </div>
        <div class="col-lg-3">
        <select name="brand_sr[]" id="pref-brand" class="form-control pref-brand selectpicker" title="Brand" multiple data-selected-text-format="count">
            <?php foreach($brand as $brandx){ ?>
            <option value="<?=$brandx->id;?>"><?=$brandx->brand_name;?></option>
            <?php } ?>
        </select>
        </div>
    <div class="col-lg-2">
        <input type="submit" value="Go!" style="font-size: 19px;" class="btn btn-default btn-xs">
    </div>
    <div class="clearfix"></div>
</div>
<br/>
<div class="row">
    <div class="container">
        <div class="col-lg-8">TOTAL SALES</div><div class="col-lg-4">Rp. <?=  formatrp($total_harga->harga);?></div>
        <div class="col-lg-8">TOTAL ITEM SALES</div><div class="col-lg-4"><?=$jumlah_barang->harga;?> item</div>
        <div class="col-lg-8">Bank Transfers</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">BCA Kredit Card</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">BCA KlikPay</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">BCA 6 Month Installement</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">BCA 12 Mont Installement</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">Mandiri KlikPay</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">Mandiri Credit Card Full Payment</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">Mandiri 6 Month Installement</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">Mandiri 12 Month Installement</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">BNI 6 Month Installement</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">BNI 12 Month Installement</div><div class="col-lg-4"> - </div>
        <div class="col-lg-8">Other Visa/MasterCard Credit Card</div><div class="col-lg-4"> - </div>
    </div>
</div>
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function (){
        $('.selectpicker').selectpicker();
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>article/add");
        });
    });
        function updatex(id,cust){
        window.location.replace("<?php echo base_url(); ?>order/update/"+id+"/"+cust+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
         function deletex(id){
               if(confirm('Delete this record?')){
               window.location.replace("<?php echo base_url(); ?>article/delete/"+id+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
                }else{

                }
            }
        function coba(tables){
            //alert("valuenya "+id+" fieldnya "+tables);
            document.getElementById(tables).submit();
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
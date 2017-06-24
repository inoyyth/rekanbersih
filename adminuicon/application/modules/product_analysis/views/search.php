<ol class="breadcrumb">
    <li> Report</li>
    <li class="active"></i> Product Analysis</li>
</ol>
<div class="container">
    <form method="post" action="<?=base_url();?>product_analysis/search" id="form2"/>
    <div class="col-lg-4">
        <i style="margin-top: -15px;font-size: 13px;">From </i><input style="font-size: 13px;margin-bottom: 4px;padding:7px;" name="from_sr" type="text" size="10" id="from" value="<?=$from_sr;?>"/>

        <i style="margin-top: -15px;font-size: 13px;">To </i><input style="font-size: 13px;margin-top: -20px;padding:7px;" name="to_sr" type="text" size="10" id="to" value="<?=$to_sr;?>"/>
    </div> 
    <div class="col-lg-3">
        <select name="type_sr[]" id="pref-brand" class="form-control pref-brand selectpicker" title="Type" multiple data-selected-text-format="count">
        <?php
        $accsql= mysql_query("select * from product_category where product_category_status='Y'");
        while ($datac=  mysql_fetch_array($accsql)){
            if(in_array($datac['id'] , $type_sr)){
                $cek="selected";
            }else{
                $cek="";
            }
        ?>
        <option value="<?=$datac['id'];?>"<?=$cek;?>><?=$datac['product_category_name'];?></option>
        <?php } ?>
        </select>
        </div>
    <div class="col-lg-3">
        <select name="brand_sr[]" id="pref-brand" class="form-control pref-brand selectpicker" title="Brand" multiple data-selected-text-format="count">
            <?php
            $brandsql=mysql_query("select * from brand where status='Y' order by id limit 13");
            while($datab= mysql_fetch_array($brandsql)){
                if(in_array($datab['id'] , $brand_sr)){
                    $cek="selected";
                }else{
                    $cek="";
                }
            ?>
            <option value="<?=$datab['id'];?>" <?=$cek;?>><?=$datab['brand_name'];?></option>
            <?php } ?>
        </select>
        </div>
    <div class="col-lg-2">
        <input type="submit" value="Go!" style="font-size: 19px;" class="btn btn-default btn-xs"> 
    </div>
    <div class="clearfix"></div>
</div>
<br/>
<div class="panel panel-default">
    <div class="panel-heading">Customer Orders</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                    <select style="float: right;width: 50px;margin-top: -10px;" name="page_sr" onchange="coba('form2');"/>
                        <?php 
                        if($page_sr=="10"){
                            $pg10="selected";
                        }else{
                            $pg10="";
                        }
                        if($page_sr=="25"){
                            $pg25="selected";
                        }else{
                            $pg25="";
                        }
                        if($page_sr=="50"){
                            $pg50="selected";
                        }else{
                            $pg50="";
                        }
                        if($page_sr=="100"){
                            $pg100="selected";
                        }else{
                            $pg100="";
                        }
                        ?>
                        <option value="10" <?=$pg10;?>>10</option>
                        <option value="25" <?=$pg25;?>>25</option>
                        <option value="50" <?=$pg50;?>>50</option>
                        <option value="100" <?=$pg100;?>>100</option>
                    </select>
                </form>
            </div>
            <i>
                Total Data: <?=$total_data;?>
            </i>
            <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Product Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Total Quantity Purchased <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Total (IDR) <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($data)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($data as $data){
                          $id_cat=$data->id;
                          $no++;
                    ?>
                         <tr>
                            <td style="text-align: center;"><?php echo $data->product_name; ?></td>
                            <td style="text-align: center;"><?=$data->jum_barang;?></td>
                            <td style="text-align: right;"><?=$data->harga;?></td>
                        </tr>
                      <?php }} ?>
                    </tbody>
<!--                    <tfoot>
                        <tr>
                            <form method="post" action="<?=base_url();?>customers_report/search" id="form1"/>
                                <td><input name="id_sr" value="<?=$id_sr;?>" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" value="<?=$name_sr;?>" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="date_sr" value="<?=$date_sr;?>" class="form-control datepicker" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td style="text-align: center;padding-top: 1.5%;">
                                    <button id="update" onclick="indexx();" type="button" class="btn btn-info btn-xs"><i class="fa fa-arrow-circle-left"> Clear Filter</button></i></button>
                                </td>
                            </form>
                        </tr>
                    </tfoot>-->
                </table>
                <div class="pagination"><?=$halaman;?></div>
            </div>
        </div>
    </div>
<!--end attribute form-->
<?php $this->load->view('combobox_autocomplete');?>
<script type="text/javascript">
    $(document).ready(function (){
        $("#new").click(function(){
           window.location.replace("<?php echo base_url(); ?>article/add");
        });
    });
        function updatex(id,cust){
        window.location.replace("<?php echo base_url(); ?>order/update/"+id+"/"+cust+"/<?=($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;?>");
        }
        function indexx(){
        window.location.replace("<?php echo base_url(); ?>customers_report");
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
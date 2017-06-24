<ol class="breadcrumb">
    <li> Report</li>
    <li class="active"></i> Order</li>
</ol>
<div>
    <form method="post" action="<?=base_url();?>order/search" id="form0"/>
        <i style="margin-top: -15px;margin-left: 1%;font-size: 10px;">From </i><input style="font-size: 10px;margin-bottom: 4px" name="from_sr" type="text" size="15" id="from" value="<?=$from_sr;?>" required/>

        <i style="margin-top: -15px;margin-left: 1%;font-size: 10px;">To </i><input style="font-size: 10px;margin-top: -20px" name="to_sr" type="text" size="15" id="to" value="<?=$to_sr;?>" required/>

        <input type="submit" value="Go!" style="font-size: 11px;" class="btn btn-default btn-xs">
    </form>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Report Order</div>
        <div class="panel-body">
            <div style="margin-bottom: 5px;">
                <form method="post" action="<?=base_url();?>order/search" id="form2"/>
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
                           <th style="text-align: center;">Order ID <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Invoice ID <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Customer Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Order Date <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;width: 10%;">Total(IDR) <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Payment Method <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Order Status <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Action <i class="fa fa-sort"></i></th>
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
                          $order_number=$data->number_order;
                           $sq=mysql_query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$order_number'");
                           $disctemp=mysql_fetch_array(mysql_query("select distinct(discount) as total from transaksi_oke where number_order='$order_number'"));
                           if(mysql_num_rows($sq) > 1){
                           $datax=  mysql_fetch_array($sq);
                            if($datax['coupon_type']==1){
                                $amount=$datax['amount'];
                                $total= ($data->jum - $amount) - $disctemp['total'];
                            }
                            if($datax['coupon_type']==2){
                                $amount= ($data->jum * $datax['amount']) / 100;
                                $total= ($data->jum - $amount) - $disctemp['total'];
                            }
                           }else{
                               $total=$data->jum - $disctemp['total'];
                           }
                    ?>
                        <tr>
                            <td style="text-align: center;width: 10%;"><?php echo $data->number_order; ?></td>
                            <td style="text-align: center;"><?php echo $data->number_invoice; ?></td>
                            <td><?php echo $data->firstname_custdetail." ".$data->lastname_custdetail; ?></td>
                            <td style="text-align: center;"><?php echo tgl_indo(date("Y-m-d",strtotime($data->sys_create_date))); ?></td>
                            <td style="text-align: right;"><?php echo formatrp($total); ?></td>
                            <td style="text-align: center;"><?php echo $data->payment_method; ?></td>
                            <td><?php echo $data->status_order; ?></td>
                            <td style="text-align: center;width: 8%;">
                                <button id="update" onclick="updatex('<?=$data->number_order;?>','<?=$data->cust_id;?>');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-edit"> Edit</button></i></button> 
<!--                                <button id="delete" onclick="deletex('<?=$data->number_invoice;?>');" type="button" class="btn btn-danger btn-xs"><i class="fa fa-retweet"> Delete</i></button>-->
                            </td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <form method="post" action="<?=base_url();?>order/search" id="form1"/>
                                <td><input name="id_sr" value="<?=$id_sr;?>" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="invoice_sr" value="<?=$invoice_sr;?>" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="name_sr" value="<?=$name_sr;?>" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="date_sr" value="<?=$date_sr;?>" class="form-control datepicker" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td></td>
                                <td><input name="payment_sr" value="<?=$payment_sr;?>" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td><input name="status_sr" value="<?=$status_sr;?>" class="form-control" style="width: 100%;" type="text" onkeyup="javascript:if(event.keyCode == 13){coba('form1');}else{return false;};"/></td>
                                <td style="text-align: center;padding-top: 1.5%;">
                                    <button id="update" onclick="indexx();" type="button" class="btn btn-info btn-xs"><i class="fa fa-arrow-circle-left"> Clear Filter</button></i></button>
                                </td>
                            </form>
                        </tr>
                    </tfoot>
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
        window.location.replace("<?php echo base_url(); ?>order");
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
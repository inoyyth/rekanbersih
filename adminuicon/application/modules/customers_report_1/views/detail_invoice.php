<ol class="breadcrumb">
    <li></i> Report</li>
    <li class="active"></i> Invoice Oreders</li>
</ol>
<div style="margin-bottom: 5px;text-align: right;">
   <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>customers_report');" class="btn btn-danger btn-sm" value="Back" />
</div>
<?php 
    $lokasi=  substr($cust->city_custdetail, -2);
    $provinsi=  mysql_fetch_array(mysql_query("SELECT * from inf_lokasi where lokasi_propinsi = '$lokasi' and lokasi_kabupatenkota='0'"));
    if(substr($cust->city_custdetail, 2) < 10 ){
        $kotax=  substr($cust->city_custdetail,0, 2);
    }else{
        $kotax=  substr($cust->city_custdetail,0, 2);
    }
    $kota=  mysql_fetch_array(mysql_query("SELECT * from inf_lokasi where lokasi_propinsi = '$lokasi' and lokasi_kabupatenkota='$kotax'"));
?>
<div class="row">
     <div class="col-lg-6">
        <h2>Customer Detail</h2>
        <h5>ID: <?=$cust->id;?></h5>
        <h5>Name: <?=$cust->firstname_custdetail." ".$cust->lastname_custdetail;?></h5>
        <h5>Email: <?=$cust->email_custdetail;?></h5>
        <h5>Address: <?=$cust->address_custdetail;?></h5>
        <h5>City: <?=$kota['lokasi_nama'];?></h5>
        <h5>Province: <?=$provinsi['lokasi_nama'];?></h5>
        <h5>ZIP: <?=$cust->zip;?></h5>
        <h5>Phone: <?=$cust->telephone_custdetail;?></h5>
        <h5>Mobile: <?=$cust->mobile_custdetail;?></h5>
    </div>
</div>  
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Customer Order </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
             <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Number Order <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Quantity <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Sub Total <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($invoice)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($invoice as $data){
                        $id_cat=$data->id;
                        $no++;
                        if($data->special_price == "0"){
                            $harga=$data->normal_price;
                        }else{
                            $harga=$data->special_price;
                        }
                        $order_number=$data->number_order;
                           $sq=mysql_query("select a.*,b.* from voucher_oke a INNER JOIN coupon b on a.id_voucher=b.id where a.number_order ='$order_number'");
                           $datax=  mysql_fetch_array($sq);
                            if($datax['coupon_type']==1){
                                $amount=$datax['amount'];
                                $total= $data->jum - $amount;
                            }
                            if($datax['coupon_type']==2){
                                $amount= ($data->jum * $datax['amount']) / 100;
                                $total= $data->jum - $amount;
                            }
                            ?>
                        <tr>
                            <td style="text-align: center;width: 30%;"><a href="<?=base_url();?>customers_report/detail_order/<?php echo $data->number_order; ?>"><?php echo $data->number_order; ?></a></td>
                            <td style="text-align: center;"><?php echo $data->jumx; ?></td>
                            <td style="text-align: right;"><?=  formatrp($total);?></td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
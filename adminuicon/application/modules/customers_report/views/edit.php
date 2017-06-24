<ol class="breadcrumb">
    <li></i> Report</li>
    <li class="active"></i> Order</li>
</ol>
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
                            <th style="text-align: center;">SKU <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Product Name <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Quantity <i class="fa fa-sort"></i></th>
                            <th style="text-align: center;">Sub Total <i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      if(count($detail)<1){
                          echo"<td colspan='10' align='center'>Data Not Found</td>";
                      }else{
                      $no=0;
                      foreach($detail as $data){
                        $id_cat=$data->id;
                        $no++;
                        if($data->special_price == "0"){
                            $harga=$data->normal_price;
                        }else{
                            $harga=$data->special_price;
                        }
                        $tot="";
                        $xc="";
                        $xy='';
                        $status="";
                        $no_order='';
                        $jmx = $harga * $data->qty;
                        $status .= $data->status_order;
                        $no_order=$data->number_order;
                    ?>
                        <tr>
                            <td style="text-align: center;width: 10%;"><?php echo $data->sku; ?></td>
                            <td style="text-align: center;"><?php echo $data->product_name; ?></td>
                            <td style="text-align: center;"><?php echo $data->qty; ?></td>
                            <td style="text-align: right;"><?=  formatrp($harga * $data->qty);?></td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: center;">Total</td>
                            <td style="text-align: center;"><?=$jum_brg->jum;?></td>
                            <td style="text-align: right;"><?=  formatrp($jum_hrg->jum);?></td>
                        </tr>
                    </tfoot>
                </table>
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
                        <h2>Delivery</h2>
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
                    <div class="col-lg-6">
                        <h2>Customer Detail</h2>
                        <h2>Billing</h2>
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
                    <h2>Status Order : <?=$status;?></h2>
                    <form method="post" action="<?=base_url();?>order/update_proses" />
                    <div>Update Status: 
                        <select name="status">
                            <option value="order">Order</option>
                            <option value="shipped">Shipped</option>
                            <option value="pending">Pending</option>
                            <option value="waiting">Waiting</option>
                        </select>
                        <input type="hidden" name="order_number" value="<?=$no_order;?>">
                        <input type="submit" name="submit" value="Update"/>
                    </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
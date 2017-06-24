<ol class="breadcrumb">
    <li></i> Report</li>
    <li class="active"></i> Update Return Product</li>
</ol>
<div style="margin-bottom: 5px;text-align: right;">
   <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>return_request');" class="btn btn-danger btn-sm" value="Back" />
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"> Customer Order </h3>
    </div>
    <div class="panel-body" id="panelx">
        <div class="row" style="font-size: 12px;">
            <!-- Detail pelanggan -->
            <div class="container">
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
                        <h4>Delivery</h4>
                        <span>ID: <?=$cust->id;?></span><br/>
                        <span>Name: <?=$cust->firstname_custdetail." ".$cust->lastname_custdetail;?></span><br/>
                        <span>Email: <?=$cust->email_custdetail;?></span><br/>
                        <span>Address: <?=$cust->address_custdetail;?></span><br/>
                        <span>City: <?=$kota['lokasi_nama'];?></span><br/>
                        <span>Province: <?=$provinsi['lokasi_nama'];?></span><br/>
                        <span>ZIP: <?=$cust->zip;?></span>><br/>
                        <span>Phone: <?=$cust->telephone_custdetail;?></span><br/>
                        <span>Mobile: <?=$cust->mobile_custdetail;?></span><br/>
                    </div>
                    <div class="col-lg-6">
                        <h4>Billing</h4>
                        <span>ID: <?=$cust->id;?></span><br/>
                        <span>Name: <?=$cust->firstname_custdetail." ".$cust->lastname_custdetail;?></span><br/>
                        <span>Email: <?=$cust->email_custdetail;?></span><br/>
                        <span>Address: <?=$cust->address_custdetail;?></span><br/>
                        <span>City: <?=$kota['lokasi_nama'];?></span><br/>
                        <span>Province: <?=$provinsi['lokasi_nama'];?></span><br/>
                        <span>ZIP: <?=$cust->zip;?></span>><br/>
                        <span>Phone: <?=$cust->telephone_custdetail;?></span><br/>
                        <span>Mobile: <?=$cust->mobile_custdetail;?></span><br/>
                    </div>
            </div>
                <div style="padding-bottom: 50px;"></div>
            <!-- Tabel Order -->
            <div class="row">
                
                <div class="col-lg-10 table-responsive" style="font-size: 12px;">
                    <div class="text-left"><h4>Item order</h4></div>
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr>
                            <th class="col-lg-2 header" style="text-align: center;">SKU <i class="fa fa-sort"></i></th>
                            <th class="col-lg-4 header" style="text-align: center;">Product Name <i class="fa fa-sort"></i></th>
                            <th class="col-lg-2 header" style="text-align: center;">Price <i class="fa fa-sort"></i></th>
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
                        $tgl="";
                        $reason="";
                        $action="";
                        $desc="";
                        $status='';
                        $order_number="";
                        if($data->reason=="1"){
                              $reason .="Received Wrong Product";
                          }
                          if($data->reason=="2"){
                              $reason .="Not Satisfied With the Product";
                          }
                          if($data->reason=="3"){
                              $reason .="Wrong Product Ordered";
                          }
                          if($data->reason=="4"){
                              $reason .="There is Problem With the Product";
                          }
                        $tgl .= $data->sys_create_date;
                        //$reason .= $data->reason;
                        $action .= $data->action;
                        $desc .= $data->description;
                        $status .= $data->status;
                        $order_number .= $data->order_number;
                    ?>
                        <tr>
                            <td style="text-align: center;width: 10%;"><?php echo $data->sku; ?></td>
                            <td style="text-align: center;"><?php echo $data->product_name; ?></td>
                            <td style="text-align: right;"><?=formatrp($harga);?></td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                </table>
                
                    
                </div> 
            </div>
            <!-- Status Order -->
            <div>
                    <h4>Order Number : <?=$order_number;?></h4>
                    <h4>Time Return Sign : <?=$tgl;?></h4>
                    <h4>Reason Return : <?=$reason;?></h4>
                    <h4>Action Return : <?=$action;?></h4>
                    <h4>Description Return : <?=$desc;?></h4>
                    <form method="post" action="<?=base_url();?>return_request/update_proses" />
                    <div>Update Status: 
                        <select name="status">
                            <?php
                                if($status=="pending"){
                                    $pending="selected";
                                }else{
                                    $pending="";
                                }
                                if($status=="oke"){
                                    $oke="selected";
                                }else{
                                    $oke="";
                                }
                            ?>
                            <option value="pending" <?=$pending;?>>Pending</option>
                            <option value="oke" <?=$oke;?>>Oke</option>
                        </select>
                        <input type="hidden" name="order_number" value="<?=$order_number;?>">
                        <input type="submit" name="submit" value="Update"/>
                    </div>
                    </form>
            </div>
                 
            </div>
        </div>
    </div>
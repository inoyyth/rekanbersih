<ol class="breadcrumb">
    <li></i> Report</li>
    <li class="active"></i> Order</li>
</ol>
<div class="panel panel-success">
    <div class="panel-heading">
            <span class="panel-title"><h4>Customer order</h4></span>
            <div class="pull-right" style="margin-top: -35px;"><input type="button" onclick="window.location.replace('<?php echo base_url(); ?>order');" class="btn btn-danger btn-sm" value="Back" /></div>
    </div>
    <div class="clearfix"></div>
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
                        <span>ZIP: <?=$cust->zip;?></span><br/>
                        <span>Phone: <?=$cust->telephone_custdetail;?></span><br/>
                        <span>Mobile: <?=$cust->mobile_custdetail;?></span><br/>
                    </div>
                    <div class="col-lg-6">
                        <h4>Billing</h4>
                        <span>Name: <?=$billing->firstname_custbilling." ".$billing->lastname_custbilling;?></span><br/>
                        <span>Email: <?=$billing->email_custbilling;?></span><br/>
                        <span>Address: <?=$billing->address_custbilling;?></span><br/>
                        <span>City: <?=$kota['lokasi_nama'];?></span><br/>
                        <span>Province: <?=$provinsi['lokasi_nama'];?></span><br/>
                        <span>ZIP: <?=$billing->zip;?></span><br/>
                        <span>Phone: <?=$billing->telephone_custbilling;?></span><br/>
                        <span>Mobile: <?=$billing->mobile_custbilling;?></span><br/>
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
                            <th class="col-lg-2 header" style="text-align: center;">Quantity <i class="fa fa-sort"></i></th>
                            <th class="col-lg-2 header" style="text-align: center;">Sub Total <i class="fa fa-sort"></i></th>
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
                        if($data->special_price < 1){
                            $harga=$data->normal_price;
                        }else{
                            $harga=$data->special_price;
                        }
                        $tot="";
                        $xc="";
                        $xy='';
                        $status="";
                        $no_order='';
                        $tgl='';
                        $jmx = $harga * $data->qty;
                        $status .= $data->status_order;
                        $tgl .= $data->sys_create_date;
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
                            <?php
                            $amount="";
                            $total="";
                            if(isset($disc->coupon_type) != ""){
                                if($disc->coupon_type==1){
                                    $amount=$disc->amount;
                                    $total= $jum_hrg->jum - $amount;
                                }
                                if($disc->coupon_type==2){
                                    $amount= ($jum_hrg->jum * $disc->amount) / 100;
                                    $total= $jum_hrg->jum - $amount;
                                }
                                $coupon_code=$disc->coupon_code;
                            }else{
                                $total=$jum_hrg->jum;
                                $coupon_code='';
                                $amount=0;
                            }
                                ?>
                            <td colspan="2" style="text-align: center;">Discount</td>
                            <td style="text-align: center;"><?=$coupon_code;?></td>
                            <td style="text-align: right;"><?=formatrp($amount+$disc_tempx->total);?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">Total</td>
                            <td style="text-align: center;"><?=$jum_brg->jum;?></td>
                            <td style="text-align: right;"><?=  formatrp($total-$disc_tempx->total);?></td>
                        </tr>
                    </tfoot>
                </table>

                </div> 
            </div>
            <!-- Status Order -->
            <div>
                    <form method="post" action="<?=base_url();?>order/update_proses" />
                    <span>Time Order : <?=$tgl;?><br/>Status Order : <?=$status;?></span>
                    <div>Update Status: 
                        <select name="status" id="statuss">
                            <?php
                            if($status=="waiting for payment"){
                                $waiting="selected";
                            }else{
                                $waiting="";
                            }
                            if($status=="payment confirmed"){
                                $payconfirm="selected";
                            }else{
                                $payconfirm="";
                            }
                            if($status=="payment verified"){
                                $verified="selected";
                            }else{
                                $verified="";
                            }
                            if($status=="shipped"){
                                $shipped="selected";
                            }else{
                                $shipped="";
                            }
                            if($status=="cancel"){
                                $cancel="selected";
                            }else{
                                $cancel="";
                            }
                            ?>
                            <option value="waiting for payment" <?=$waiting;?>>Waiting For Payment</option>
                            <option value="payment confirmed" <?=$payconfirm;?>>Payment Confirmed</option>
                            <option value="payment verified" <?=$verified;?>>Payment Verified</option>
                            <option value="shipped" <?=$shipped;?>>Shipped</option>
                            <option value="cancel" <?=$cancel;?>>Cancel</option>
                        </select>
                        <input type="hidden" name="order_number" value="<?=$no_order;?>">
                        <input type="hidden" name="email" value="<?=$cust->email_custdetail;?>">
                        <input type="submit" name="submit" value="Update"/>
                    </div>
                    <div id="rw" style="display: none;">
                        Airway Bill : <textarea name="rwbill"></textarea>
                    </div>
                    </form>
            </div>
                 
            </div>
        </div>
    </div>
    <?php $this->load->view('tinyfck');?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#statuss").change(function(){
               if($(this).val()==="shipped"){
                   $("#rw").show();
               }else{
                   $("#rw").hide();
               }
            });
        })
    </script>
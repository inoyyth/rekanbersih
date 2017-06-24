<ol class="breadcrumb">
    <li></i> Report</li>
    <li class="active"></i> Order</li>
</ol>
<div style="margin-bottom: 5px;text-align: right;">
   <input type="button" onclick="window.location.replace('<?php echo base_url(); ?>custormers_report/');" class="btn btn-danger btn-sm" value="Back" />
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
                            <?php
                            $amount="";
                            $total="";
                                if($disc->coupon_type==1){
                                    $amount=$disc->amount;
                                    $total= $jum_hrg->jum - $amount;
                                }
                                if($disc->coupon_type==2){
                                    $amount= ($jum_hrg->jum * $disc->amount) / 100;
                                    $total= $jum_hrg->jum - $amount;
                                }
                                ?>
                            <td colspan="2" style="text-align: center;">Discount</td>
                            <td style="text-align: center;">Code " <?=$disc->coupon_code;?></td>
                            <td style="text-align: right;"><?=formatrp($amount);?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">Total</td>
                            <td style="text-align: center;"><?=$jum_brg->jum;?></td>
                            <td style="text-align: right;"><?=  formatrp($total);?></td>
                        </tr>
                    </tfoot>
                </table>    
            </div>
        </div>
    </div>
</div>
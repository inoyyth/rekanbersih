<?php
function formatrp($angka){

    $rupiah=number_format($angka,0,',','.'); // membentuk tanda pemisah seperti (.)

    return $rupiah;

}
?>
<div>
    <h2>Your Order is Delivered</h2> 
</div>

<div>
    <p style="font-size: 16px;">Status order <b>#<?=$so->so_number;?></b> is Delivered</p> 
</div>

<div>
   Thank you for ordering from Toko Filter Air online store. 
   Please see order details below. 
</div>

<div style="text-align: center;">
    <center>
         <h3>Order Detail</h3> 
    <table border="1px">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Product Qty</th>
                <th>Product Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($so_finish_product as $so_finish_product_data){?>
            <tr>
                <td><?=$so_finish_product_data->product_code;?></td>
                <td><?=$so_finish_product_data->product_name;?></td>
                <td style="text-align: center;"><?=$so_finish_product_data->qty;?></td>
                <td style="text-align: center;"><?=formatrp($so_finish_product_data->unit_price);?></td>
                <td style="text-align: center;"><?=formatrp($so_finish_product_data->total_price);?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Sub Total :</td>
                <td style="text-align: right;"><?=formatrp($so->sub_total);?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">From Wallet :</td>
                <td style="text-align: right;"><?=formatrp($so->cut_price);?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Expedition :</td>
                <td style="text-align: right;"><?=formatrp($shipping->expedition_price);?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Expedition :</td>
                <td style="text-align: right;"><?=formatrp($so->total_price);?></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left;">Expedition Name: <?=$shipping->expedition_name;?></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left;">Expedition Service:  <?=$shipping->expedition_service;?></td>
            </tr>
        </tfoot>
    </table>
    </center>
</div>

<div>
    Tracking your order <a href="<?=$url_base;?>tracking_order/detail/<?=$so->so_number;?>">here</a> <br>
    <b>You can cek expedition status with Resi Number : <?=$so->tracking_order;?></b>
</div>

<div style="font-weight: bolder;color: red;font-size: 15px;margin-top: 20px;">
Please transfer to the account below
<br>
BANK CENTRAL ASIA (BCA) <br>
Account No.458 222 8xx <br>
PT Desalite International
</div>
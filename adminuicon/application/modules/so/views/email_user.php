<?php
function formatrp($angka){

    $rupiah=number_format($angka,0,',','.'); // membentuk tanda pemisah seperti (.)

    return $rupiah;

}
?>
<div>
    <img src="<?=$url_base."assets/elfinder".$email_setting->logo;?>">
</div>
<div style="margin-top: 10px;">
    <?php echo $email_setting->header;?>
</div>
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
<div>
    <center>
    <h3 style="text-align: center;">Customer Information</h3> 
    <table width="100%" style="text-align: left;">
        <tr>
            <td style="width: 25px;">Name</td>
            <td>: <?=$user->name;?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>: <?=$user->adress;?></td>
        </tr>
        <tr>
            <td>Province</td>
            <td>: <?=$user->provinsi;?></td>
        </tr>
        <tr>
            <td>City</td>
            <td>: <?=$user->kabupaten;?></td>
        </tr>
        <tr>
            <td>Zip</td>
            <td>: <?=$user->zip;?></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>: <?=$user->contact;?></td>
        </tr>
        <tr>
            <td>Telephone</td>
            <td>: <?=$user->tlp;?></td>
        </tr>
        <tr>
            <td>Handphone</td>
            <td>: <?=$user->handphone;?></td>
        </tr>
        <tr>
            <td>Fax</td>
            <td>: <?=$user->fax;?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: <?=$user->email;?></td>
        </tr>
    </table>
</div>
<div>
    <center>
    <h3 style="text-align: center;">Shipping Information</h3> 
    <table width="100%" style="text-align: left;">
        <tr>
            <td>Address</td>
            <td>: <?=$shipping->address;?></td>
        </tr>
        <tr>
            <td>Province</td>
            <td>: <?=$shipping->provinsi;?></td>
        </tr>
        <tr>
            <td>City</td>
            <td>: <?=$shipping->kabupaten;?></td>
        </tr>
        <tr>
            <td>Zip</td>
            <td>: <?=$shipping->zip;?></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>: <?=$shipping->contact;?></td>
        </tr>
        <tr>
            <td>Telephone</td>
            <td>: <?=$shipping->telp;?></td>
        </tr>
        <tr>
            <td>Handphone</td>
            <td>: <?=$shipping->handphone;?></td>
        </tr>
        <tr>
            <td>Fax</td>
            <td>: <?=$shipping->fax;?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: <?=$shipping->email;?></td>
        </tr>
    </table>
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
    <b>You can cek expedition status with Resi Number : <font color='red'><?=$so->tracking_order;?></font></b>
</div>
<div style="margin-top: 10px;">
    <?php echo $email_setting->footer;?>
</div>
<!--<div style="font-weight: bolder;color: red;font-size: 15px;margin-top: 20px;">
Please transfer to the account below
<br>
BANK CENTRAL ASIA (BCA) <br>
Account No.458 222 8xx <br>
PT Desalite International
</div>-->
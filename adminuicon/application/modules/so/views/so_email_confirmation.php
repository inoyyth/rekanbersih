<!DOCTYPE html>
<html lang="en">
<head>
  <title>tokofilterair.com | email konfirmasi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div style="text-align: center;text-decoration: underline;">
    <h4>Toko Filter Request Confirmation #<?=$so->so_number;?></h4>
</div>
<div>
    <center>
    <h3 style="text-align: center;">Informasi Customer</h3> 
    <table width="100%" style="text-align: left;">
        <tr>
            <td style="width: 25px;">Nama</td>
            <td>: <?=$customer->name;?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?=$customer->adress;?></td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>: <?=$customer->provinsi;?></td>
        </tr>
        <tr>
            <td>Kota</td>
            <td>: <?=$customer->kabupaten;?></td>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td>: <?=$customer->zip;?></td>
        </tr>
        <tr>
            <td>Kontak</td>
            <td>: <?=$customer->contact;?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: <?=$customer->tlp;?></td>
        </tr>
        <tr>
            <td>Handphone</td>
            <td>: <?=$customer->handphone;?></td>
        </tr>
        <tr>
            <td>Fax</td>
            <td>: <?=$customer->fax;?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: <?=$customer->email;?></td>
        </tr>
    </table>
</div>
<div>
    <center>
    <h3 style="text-align: center;">Informasi Alamat Pengiriman</h3> 
    <table width="100%" style="text-align: left;">
        <tr>
            <td>Alamat</td>
            <td>: <?=$shipping->address;?></td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>: <?=$shipping->provinsi;?></td>
        </tr>
        <tr>
            <td>Kota</td>
            <td>: <?=$shipping->kabupaten;?></td>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td>: <?=$shipping->zip;?></td>
        </tr>
        <tr>
            <td>Kontak</td>
            <td>: <?=$shipping->contact;?></td>
        </tr>
        <tr>
            <td>Telepon</td>
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
<?php
function formatrp($angka){

    $rupiah=number_format($angka,0,',','.'); // membentuk tanda pemisah seperti (.)

    return $rupiah;

}
if($so->total_price==$pre_so->total_price){
?> 
<div style="text-align: center;">
    <center>
         <h3>Order Detail</h3> 
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>Kode Product</th>
                <th>Nama Product</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($so_finish_product as $so_finish_product_data){?>
            <tr>
                <td><?=$so_finish_product_data->product_code;?></td>
                <td><?=$so_finish_product_data->product_name;?></td>
                <td style="text-align: center;"><?=$so_finish_product_data->qty;?></td>
                <td style="text-align: center;"><?=formatrp($so_finish_product_data->unit_price);?></td>
                <td style="text-align: right;"><?=formatrp($so_finish_product_data->total_price);?></td>
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
                <td colspan="4" style="text-align: right;">Total :</td>
                <td style="text-align: right;"><?=formatrp($so->total_price);?></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left;">Expedition Name: <?=$shipping->expedition_name;?></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: left;">Expedition Services:  <?=$shipping->expedition_service;?></td>
            </tr>
        </tfoot>
    </table>
    </center>
</div>
<div style="padding-top: 10px;">
    <?php echo $email_information;?>
</div>
<div style="text-align: center;font-weight: bolder;padding-top: 10px;text-decoration: underline;">
    <h3>Silahkan Pilih Salah Satu Tombol Yang Ada Dibawah Ini Untuk Lanjut Ke Proses Berikutnya.</h3>
</div>
<div style="text-align: center;font-weight: bolder;padding-top: 10px;">
    <a href="<?php echo str_replace("adminuicon/","",$url_base);?>so/update_status/<?=$id_so_encode;?>/1"><button class="btn btn-primary">SETUJU</button></a> | 
    <a href="<?php echo str_replace("adminuicon/","",$url_base);?>so/update_status/<?=$id_so_encode;?>/3"><button class="btn btn-danger">BATAL</button></a> 
</div>

<?php }else{ ?>


<div style="text-align: center;">
    <center>
         <h3>Order Detail</h3> 
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>Kode Product</th>
                <th>Nama Product</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pre_so_finish_product as $pre_so_finish_product_data){?>
            <tr>
                <td><?=$pre_so_finish_product_data->product_code;?></td>
                <td><?=$pre_so_finish_product_data->product_name;?></td>
                <td style="text-align: center;"><?=$pre_so_finish_product_data->qty;?></td>
                <td style="text-align: center;"><?=formatrp($pre_so_finish_product_data->unit_price);?></td>
                <td style="text-align: right;"><?=formatrp($pre_so_finish_product_data->total_price);?></td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Sub Total :</td>
                <td style="text-align: right;"><?=formatrp($pre_so->sub_total);?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">From Wallet :</td>
                <td style="text-align: right;"><?=formatrp($pre_so->cut_price);?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Expedition :</td>
                <td style="text-align: right;"><?=formatrp($shipping->expedition_price);?></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Total :</td>
                <td style="text-align: right;"><?=formatrp($pre_so->total_price);?></td>
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
<div style="text-align: center;">
    <center>
         <h3>Permintaan Yang Dapat Dipenuhi</h3> 
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th>Kode Product</th>
                <th>Nama Product</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($so_finish_product as $so_finish_product_data){?>
            <tr>
                <td><?=$so_finish_product_data->product_code;?></td>
                <td><?=$so_finish_product_data->product_name;?></td>
                <td style="text-align: center;"><?=$so_finish_product_data->qty;?></td>
                <td style="text-align: center;"><?=formatrp($so_finish_product_data->unit_price);?></td>
                <td style="text-align: right;"><?=formatrp($so_finish_product_data->total_price);?></td>
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
                <td colspan="4" style="text-align: right;">Total :</td>
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
<div style="padding-top: 10px;font-weight: bolder;">
    <?php echo $email_information;?>
</div>
<div style="text-align: center;font-weight: bolder;padding-top: 10px;text-decoration: underline;">
    <h3>Silahkan Pilih Salah Satu Tombol Yang Ada Dibawah Ini Untuk Lanjut Ke Proses Berikutnya.</h3>
</div>
<div style="text-align: center;font-weight: bolder;padding-top: 10px;">
    <a href="<?php echo str_replace("adminuicon/","",$url_base);?>so/update_status/<?=$id_so_encode;?>/1"><button class="btn btn-primary">SETUJU</button></a> | 
    <a href="<?php echo str_replace("adminuicon/","",$url_base);?>so/update_status/<?=$id_so_encode;?>/2"><button class="btn btn-default">TUNGGU STOK TERSEDIA</button></a></a> | 
    <a href="<?php echo str_replace("adminuicon/","",$url_base);?>so/update_status/<?=$id_so_encode;?>/3"><button class="btn btn-danger">BATAL</button></a>
</div>
<?php } ?>
</body>
</html>

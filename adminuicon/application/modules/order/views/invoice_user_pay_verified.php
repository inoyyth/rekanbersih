<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Your order #<?=$number_order;?> is now Payment Verified.</title>
		<style type="text/css">
			h1,h2,h3,h4,h5 {
				color:#3a3a3a;
			}
			a {
				color:#e20025;
				text-decoration:none
			}
		</style>
	</head>
	<body style="width:100%;background-color:#f6f6f6;font-size:13px;color:#656565;font-family: Arial, Helvetica, sans-serif">
		<table align="center" bgcolor="#fff" width="600px" cellpadding="10" cellspacing="0" border="0" style="margin:auto">
			<tr>
				<td style="height:auto;border-bottom:1px solid #eaeaea">
					<img  style="padding:10px 5px;float:left" src="<?=base_url();?>userfiles/Image/emails/logo-urbanicon-store.png" >
				</td>
			</tr>
			<tr>
				<td style="padding:0px 10px"><h2>Your Order is now Payment Verified.</h2></td>
			</tr>
			<tr>
				<td>
					<p style="font-size:16px">Status order <span style="color:#e20025"><strong>#<?=$number_order;?></strong> (<?=$email;?>)</span> is now Payment Verified</p>
					<p><?=$billing->firstname_custdetail;?> <?=$billing->lastname_custdetail;?>,<br/><br/>Thank you for ordering from Urban Icon online store. Please see order details below. You can see this order by <a href="http://urbanicon.co.id/register" target="_blank"><strong>Logging in into your account</a></p>
                                        <p>Please email <font color="red">urbanicon@time.co.id</font> if you have any questions regarding the order</p>
				</td>
			</tr>
			<tr>
				<td>
					<h3 style="line-height: 0px;">Order Details</h3>
				</td>
			</tr>
			<tr>
				<table align="center" bgcolor="#fff" width="600px" cellpadding="5" cellspacing="0" border="0" style="margin:auto;padding:0 10px">
                                    <?php
                                    foreach($order as $orderx){?>
                                    <tr style="height:20px">
                                        <td style="width:25%;text-align:left">
                                                <?=$orderx->product_name;?>
                                        </td>
                                        <td style="width:25%;text-align:left">
                                                <?=$orderx->sku;?>
                                        </td>
                                        <td style="width:25%;text-align:center">
                                                <?=$orderx->qty;?>
                                        </td>
                                        <td style="width:25%;text-align:right">
                                                IDR <?=($orderx->special_price=="0" ? $orderx->normal_price * $orderx->qty : $orderx->special_price * $orderx->qty);?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                        <tr>
                                            <td colspan="3" style="text-align:right;border-top:1px solid #eaeaea"><strong>Discount</strong></td>
                                            <td style="text-align:right;border-top:1px solid #eaeaea"><strong>
                                             <?php
                                                if($disc_hit > 0){
                                                $discx="";
                                                if($disc->coupon_type=="2"){
                                                    $discx = ((($totx->jum * $disc->amount) /100) + $disc_tempx->total);
                                                    echo $discx;
                                                }elseif($disc->coupon_type=="1"){
                                                    $discx = (($totx->jum - $disc->amount) + $disc_tempx->total);
                                                    echo $discx;
                                                }else{
                                                    $discx = $disc_tempx->total + 0;
                                                    echo $discx;
                                                }
                                                }else{
                                                    echo $disc_tempx->total + 0;
                                                }
                                            ?>
                                            </strong></td>
					</tr>
					<tr>
                                            <td colspan="3" style="text-align:right;border-top:1px solid #eaeaea"><strong>TOTAL IDR</strong></td>
                                            <td style="text-align:right;border-top:1px solid #eaeaea"><strong>
                                                <?php if($disc_hit > 0){
                                                echo $totx->jum - $discx;}else{ echo $totx->jum - $disc_tempx->total;}?></strong></td>
					</tr>
				</table>
				<table align="center" bgcolor="#fff" width="600px" cellpadding="5" cellspacing="0" border="0" style="margin:auto;padding:0 10px">
					<tr>
						<td style="width:50%;vertical-align:top">
							<h3 style="line-height: 0px;">Billing Details</h3>
                                                        <?php
                                                        $province=$billing->province_custbilling;
                                                        $city=$billing->city_custbilling;
                                                        $provinsi=$this->db->query("SELECT * from inf_lokasi where lokasi_propinsi = '$province' and lokasi_kabupatenkota='0'")->row();
                                                        $kota=$this->db->query("SELECT * from inf_lokasi where lokasi_propinsi = '$province' and lokasi_kabupatenkota='$city' and lokasi_kecamatan='0'")->row();
                                                        ?>
							<p>
                                                        <?=$billing->firstname_custbilling;?> <?=$billing->lastname_custbilling;?>
                                                            <br/><?=$billing->address_custbilling;?>
                                                            <br/><?=$kota->lokasi_nama;?> <?=$provinsi->lokasi_nama;?>
                                                            <br/><?=$billing->zip;?>
                                                            <br/><?=$billing->telephone_custbilling;?>
                                                            <br/>
							</p>
						</td>
						<td style="width:50%;vertical-align:top">
                                                    <?php 
                                                        $lokasi=  substr($billing->city_custdetail, -2);
                                                        $provinsix=  mysql_fetch_array(mysql_query("SELECT * from inf_lokasi where lokasi_propinsi = '$lokasi' and lokasi_kabupatenkota='0'"));
                                                        if(substr($billing->city_custdetail, 2) < 10 ){
                                                            $kotax=  substr($billing->city_custdetail,0, 2);
                                                        }else{
                                                            $kotax=  substr($billing->city_custdetail,0, 2);
                                                        }
                                                        $kota=  mysql_fetch_array(mysql_query("SELECT * from inf_lokasi where lokasi_propinsi = '$lokasi' and lokasi_kabupatenkota='$kotax'"));
                                                    ?>
							<h3 style="line-height: 0px;">Shipping Details</h3>
							<p>
                                                        <?=$billing->firstname_custdetail;?> <?=$billing->lastname_custdetail;?>
                                                            <br/><?=$billing->address_custdetail;?>
                                                            <br/><?=$kota['lokasi_nama'];?> <?=$provinsix['lokasi_nama'];?>
                                                            <br/><?=$billing->zip_ship;?>
                                                            <br/><?=$billing->telephone_custdetail;?>
                                                        </p>
						</td>
					</tr>
                                        <tr>
                                            <td colspan="2">
                                                <h3>Tracking Number</h3>
                                                <?=$rwbill;?>
                                                <p><a href="http://jne.co.id" target="_blank"><font color='red'>Track Your Order</font></a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                You should receive your order in 1-3 business days.<br>
                                                We hope you will love the item you ordered!
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>If you find difficulties for payment confirmation please let us know.<br>
                                                If you have transferred and somehow experienced error (order gets cancelled), please ignore the email and contact us immediately.</td>
					</tr>
				</table>
				<table align="center" bgcolor="#fff" width="600px" cellpadding="0" cellspacing="0" border="0" style="margin:auto;padding:20px 10px;border-top:1px solid #eaeaea">
					<tr>
						<td>
							<a href="http://instagram.com/urbaniconstore" target="_blank" style="text-decoration: none;">
					<img src="<?=base_url();?>userfiles/Image/emails/36px_instagram.png" alt="Instagram" >
							</a>
							<a href="https://www.facebook.com/urbaniconstore" target="_blank" style="text-decoration: none;">
					<img src="<?=base_url();?>userfiles/Image/emails/36px_facebook.png" alt="Facebook" >
							</a><a href="https://plus.google.com/+UrbaniconCoId01/about" target="_blank" style="text-decoration: none;">
					<img src="<?=base_url();?>userfiles/Image/emailsages/36px_google.png" alt="Google+" >
							</a>	
							<a href="https://twitter.com/UrbanIconStore" target="_blank" style="text-decoration: none;">
					<img src="<?=base_url();?>userfiles/Image/emails/36px_twitter.png" alt="Twitter" >
							</a>
							<a href="http://www.pinterest.com/urbaniconstore/urban-icon-store/" target="_blank" style="text-decoration: none;">
					<img src="<?=base_url();?>userfiles/Image/emails/36px_pinterest.png" alt="Pinterest" >
							</a>
						</td>
						<td style="text-align:right;font-size:14px">urbanicon@time.co.id<br/>+62.21.2927.2708 ext.4212 (Mon-Fri 9 AM - 6 PM)</td>
					</tr>
				</table>
			</tr>
		</table>
	</body>
</html>
<?php
$data="";
foreach($disc as $disx){
    $data .=$disx->apply_discount_productx;
}
//echo $data;
$st=  substr($data,0,-1);
echo $st;
//$sql=mysql_query("select * from product_general where id in ($st)");
//while($dt=mysql_fetch_array($sql)){
//    echo $dt['product_name'].",";
//}
//echo gmdate("Y-m-d", time()+60*60*7);
//echo $user->user_id;
?>

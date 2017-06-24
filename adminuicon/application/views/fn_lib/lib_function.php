<?php
function status($status){
    if($status=="Y"){
        $hasil="Active";
    }else{
        $hasil="Not Active";
    }
    return $hasil;
}

function tgl_indo($tgl){
    $tg=  substr($tgl,8,2);
    $bln=  substr($tgl,5,2);
    $th=  substr($tgl,0,4);
  
    switch($bln){
		case "01":
		$bl="Jan";
		break;
		case "02":
		$bl="Feb";
		break;
		case "03":
		$bl="Mar";
		break;
		case "04":
		$bl="Apr";
		break;
		case "05":
		$bl="Mei";
		break;
		case "06":
		$bl="Jun";
		break;
		case "07":
		$bl="Jul";
		break;
		case "08":
		$bl="Aug";
		break;
		case "09":
		$bl="Sep";
		break;
		case "10":
		$bl="Oct";
		break;
		case "11":
		$bl="Nov";
		break;
		case "12":
		$bl="Dec";
		break;
	}
        
        return $tg."/".$bl."/".$th;
}

function wordlimitx($text){
    
        $word=substr($text,0,30).".....";
    
    return $word;
}

function wordlimitx2($text,$panjang){
    
        $word=substr($text,0,$panjang).".....";
    
    return $word;
}

function formatrp($angka){

    $rupiah=number_format($angka,0,',','.'); // membentuk tanda pemisah seperti (.)

    return $rupiah;

}
function countBC($table,$where,$field){
    $ct=mysql_query("select count(*)as jum from $table where $where='$field'");
    $data=mysql_fetch_array($ct);
    return $data['jum'];
}
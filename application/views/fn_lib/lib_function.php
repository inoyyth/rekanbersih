<?php
function status($status){
    if($status=="Y"){
        $hasil="Active";
    }else{
        $hasil="Not Active";
    }
    return $hasil;
}

function target_page($page){
    if($page=="1"){
        $link="_self";
    }else{
        $link="_blank";
    }
    
    return $link;
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

function wordlimitx($text,$batasan){
    
        $words = explode(" ",$text);
    return implode(" ",array_splice($words,0,$batasan))." .......";
}

function formatrp($angka){

    $rupiah=number_format($angka,0,',','.'); // membentuk tanda pemisah seperti (.)

    return $rupiah;

}

function menu_open($menu){
    if($menu=="1"){
        $hasil="_blank";
    }else{
        $hasil="_self";
    }
    return $hasil;
}
function url($url) {
     $url = preg_replace('~[^\pL0-9_]+~u', '-', $url);
     $url = trim($url, "-");
     $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
     $url = strtolower($url);
     $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
     return $url;
    }
function url_return($url){
    return strtoupper(str_replace("-"," ",$url));
}

function remove_image($content){
    $content = preg_replace("/<img[^>]+\>/i", "", $content); 
    echo $content;
}
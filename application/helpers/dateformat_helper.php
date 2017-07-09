<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('date_thai')) {
    function date_thai($strDate,$long=false,$format="d m y")
    {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strMonthCut = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthLong = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if($long){
            $strMonthThai=$strMonthLong[$strMonth];
        }else{
            $strMonthThai=$strMonthCut[$strMonth];
        }
        $format = str_replace("d", $strDay, $format);
        $format = str_replace("m", $strMonthThai, $format);
        $format = str_replace("y", $strYear, $format);
        return $format;
    }
}
if (!function_exists('date_time_thai')) {
    function date_time_thai($strDateTime,$long=false)
    {
        $strYear = date("Y",strtotime($strDateTime))+543;
        $strMonth= date("n",strtotime($strDateTime));
        $strDay= date("j",strtotime($strDateTime));
        $strHour= date("H",strtotime($strDateTime));
        $strMinute= date("i",strtotime($strDateTime));
        $strMonthCut = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthLong = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if($long){
            $strMonthThai=$strMonthLong[$strMonth];
        }else{
            $strMonthThai=$strMonthCut[$strMonth];
        }
        return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    }
}

if (!function_exists('date_eng')) {
    function date_eng($strDateTime)
    {
        if(empty($strDateTime)){
            return '0000-00-00';
        }else{
            $dateTemp = explode('/',$strDateTime);
            return  ($dateTemp[2]-543).'-'.$dateTemp[1].'-'.$dateTemp[0];
        }
    }
}
if (!function_exists('date_thai_num')) {
    function date_thai_num($strDateTime)
    {
        if(empty($strDateTime)){
            return '00/00/0000';
        }else{
            $dateTemp = explode('-',$strDateTime);
            return  $dateTemp[2].'/'.$dateTemp[1].'/'.($dateTemp[0]+543);
        }
    }
}
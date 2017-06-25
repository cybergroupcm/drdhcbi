<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('date_thai')) {
    function date_thai($strDate,$long=false)
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
        return "$strDay $strMonthThai $strYear";
    }
}
if (!function_exists('date_thai')) {
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
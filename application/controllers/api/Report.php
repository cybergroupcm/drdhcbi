<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Report extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data/Report_type_model');
        $this->load->helper('file','url','api');
    }
    private $strMonthCut = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    private $strMonthLong = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

    public function report_statistic_by_type_get()
    {
        $year = $this->get('year');
        if($year == ''){
            $year = date('Y');
        }
        $sql = "SELECT
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year,
                    SUM(report_statistic_by_type.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_type
                WHERE report_statistic_by_type.complain_year = '".$year."'
                GROUP BY
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        $sum_all = 0;
        foreach ($query->result() as $row)
        {
            $result_data[$row->complain_type_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        if (!empty($result_data)) {
            $this->response($result_data, REST_Controller::HTTP_OK);
        } else {
            $this->response($year, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function month_report_get()
    {
        $year = $this->get('year');
        if($year == ''){
            $year = date('Y');
        }
        $result_data = array();
        foreach ($this->strMonthCut AS $key=>$val){
            if($val != '') {
                $result_data[$key.$year] = $val.' '.($year+543);
            }
        }
        if (!empty($result_data)) {
            $this->response($result_data, REST_Controller::HTTP_OK);
        } else {
            $this->response($year, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function report_all_complaint_get()
    {
        $sql = "SELECT
                    complain_type_id,
                    channel_id,
                    count(keyin_id) as sum_complain
                FROM
                    dt_keyin
                GROUP BY
                    complain_type_id,
                    channel_id";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row)
        {
            if($row->complain_type_id!='' && $row->channel_id!='') {
                $result_data[$row->complain_type_id][$row->channel_id] = $row->sum_complain;
                $result_data[$row->complain_type_id]['sum_all'] = 0;
            }
        }
        if (!empty($result_data)) {
            $this->response($result_data, REST_Controller::HTTP_OK);
        } else {
            $this->response($id, REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
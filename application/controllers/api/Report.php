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
        $where_type_id = "";
        $where_part = "";
        $where_province = "";
        $where_district = "";
        $where_subdistrict = "";
        $year = $this->get('year');
        $complain_type_id = $this->get('complain_type_id');
        $partid = $this->get('partid');
        $province_id = $this->get('province_id');
        $district_id = $this->get('district_id');
        $address_id = $this->get('address_id');
        if($year == ''){
            $year = date('Y');
        }

        if($complain_type_id != ''){
            $where_type_id = " AND report_statistic_by_type.complain_type_id = '".$complain_type_id."'";
        }
        if($partid != ''){
            $where_part = " AND report_statistic_by_type.partid = '".$partid."'";
        }
        if($province_id != ''){
            $where_province = " AND report_statistic_by_type.province_id = '".$province_id."'";
        }
        if($district_id != ''){
            $where_district = " AND report_statistic_by_type.district_id = '".$district_id."'";
        }
        if($address_id != ''){
            $where_subdistrict = " AND report_statistic_by_type.subdistrict_id = '".$address_id."'";
        }

        $sql = "SELECT
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year,
                    SUM(report_statistic_by_type.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_type
                WHERE report_statistic_by_type.complain_year = '".$year."'
                ".$where_type_id.$where_part.$where_province.$where_district.$where_subdistrict."
                GROUP BY
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row)
        {
            $result_data[$row->complain_type_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
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

    public function report_statistic_by_type_max_get()
    {
        $year = $this->get('year');
        if($year == ''){
            $year = date('Y');
        }
        $sql = "SELECT
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year,
                    SUM(report_statistic_by_type.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_type
                WHERE report_statistic_by_type.complain_year = '".$year."'
                GROUP BY
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year
                    ORDER BY sum_complain DESC
								LIMIT 0,6";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row)
        {
            $result_data[$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function list_year_get()
    {
        $sql = "SELECT
                    report_statistic_by_type.complain_year
                FROM
                    report_statistic_by_type
                GROUP BY
                    report_statistic_by_type.complain_year
                ORDER BY report_statistic_by_type.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row)
        {
            $result_data[$row->complain_year] = $row->complain_year+543;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_statistic_by_status_get()
    {
        $where_type_id = "";
        $where_part = "";
        $where_province = "";
        $where_district = "";
        $where_subdistrict = "";
        $year = $this->get('year');
        $current_status_id = $this->get('current_status_id');
        $partid = $this->get('partid');
        $province_id = $this->get('province_id');
        $district_id = $this->get('district_id');
        $address_id = $this->get('address_id');
        if($year == ''){
            $year = date('Y');
        }

        if($current_status_id != ''){
            $where_type_id = " AND report_statistic_by_status.current_status_id = '".$current_status_id."'";
        }
        if($partid != ''){
            $where_part = " AND report_statistic_by_status.partid = '".$partid."'";
        }
        if($province_id != ''){
            $where_province = " AND report_statistic_by_status.province_id = '".$province_id."'";
        }
        if($district_id != ''){
            $where_district = " AND report_statistic_by_status.district_id = '".$district_id."'";
        }
        if($address_id != ''){
            $where_subdistrict = " AND report_statistic_by_status.subdistrict_id = '".$address_id."'";
        }

        $sql = "SELECT
                    report_statistic_by_status.current_status_id,
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year,
                    SUM(report_statistic_by_status.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_status
                WHERE report_statistic_by_status.complain_year = '".$year."'
                ".$where_type_id.$where_part.$where_province.$where_district.$where_subdistrict."
                GROUP BY
                    report_statistic_by_status.current_status_id,
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row)
        {
            $result_data[$row->current_status_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_statistic_by_status_max_get()
    {
        $year = $this->get('year');
        if($year == ''){
            $year = date('Y');
        }
        $sql = "SELECT
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year,
                    SUM(report_statistic_by_status.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_status
                WHERE report_statistic_by_status.complain_year = '".$year."'
                GROUP BY
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year
                    ORDER BY sum_complain DESC
								LIMIT 0,6";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row)
        {
            $result_data[$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }
}
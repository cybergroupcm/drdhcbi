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

    public function report_statistic_by_type_get()
    {
        $id = $this->get('id');
        $sql = "SELECT
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year,
                    SUM(report_statistic_by_type.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_type
                GROUP BY
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        $sum_all = 0;
        foreach ($query->result() as $row)
        {
            $sum_all += $row->sum_complain;
            $result_data[$row->complain_type_id][$row->complain_month.$row->complain_year] = $row->sum_complain;
            $result_data[$row->complain_type_id]['sum_all'] = $sum_all;
        }
        if (!empty($result_data)) {
            $this->response($result_data, REST_Controller::HTTP_OK);
        } else {
            $this->response($id, REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function year_report_type_get()
    {
        $id = $this->get('id');
        $sql = "SELECT
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year
                FROM
                    report_statistic_by_type
                GROUP BY
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year
                ORDER BY
                    report_statistic_by_type.complain_year,
                    report_statistic_by_type.complain_month";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row)
        {
            $result_data[$row->complain_month.$row->complain_year] = $row->complain_year.'-'.$row->complain_month;
        }
        if (!empty($result_data)) {
            $this->response($result_data, REST_Controller::HTTP_OK);
        } else {
            $this->response($id, REST_Controller::HTTP_NOT_FOUND);
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
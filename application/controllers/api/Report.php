<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Report extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data/Report_type_model');
        $this->load->helper('file', 'url', 'api');
    }

    private $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    private $strMonthLong = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

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
        if ($year == '') {
            $year = date('Y');
        }

        if ($complain_type_id != '') {
            $where_type_id = " AND report_statistic_by_type.complain_type_id = '" . $complain_type_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_statistic_by_type.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_statistic_by_type.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_statistic_by_type.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_statistic_by_type.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year,
                    SUM(report_statistic_by_type.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_type
                WHERE report_statistic_by_type.complain_year = '" . $year . "'
                " . $where_type_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            $result_data[$row->complain_type_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function month_report_get()
    {
        $year = $this->get('year');
        if ($year == '') {
            $year = date('Y');
        }
        $result_data = array();
        foreach ($this->strMonthCut AS $key => $val) {
            if ($val != '') {
                $result_data[$key . $year] = $val . ' ' . ($year + 543);
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
        $where_date = "";
        $where_type_id = "";
        $where_channel_id = "";
        $where_part = "";
        $where_province = "";
        $where_district = "";
        $where_subdistrict = "";
        $date_start = $this->get('complaint_date_start');
        $date_end = $this->get('complaint_date_end');
        $complain_type_id = $this->get('complain_type_id');
        $channel_id = $this->get('channel_id');
        $partid = $this->get('partid');
        $province_id = $this->get('province_id');
        $district_id = $this->get('district_id');
        $address_id = $this->get('address_id');

        if ($date_start != '' && $date_end != '') {
            $where_date = " AND report_all_complaint.complain_date BETWEEN '" . $date_start . "' AND '" . $date_end . "' ";
        } else if ($date_start != '' && $date_end == '') {
            $where_date = " AND report_all_complaint.complain_date >= '" . $date_start . "' ";
        } else if ($date_start == '' && $date_end != '') {
            $where_date = " AND report_all_complaint.complain_date <= '" . $date_end . "' ";
        }

        if ($complain_type_id != '') {
            $where_type_id = " AND report_all_complaint.complain_type_id = '" . $complain_type_id . "'";
        }
        if ($channel_id != '') {
            $where_channel_id = " AND report_all_complaint.channel_id = '" . $channel_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_all_complaint.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_all_complaint.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_all_complaint.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_all_complaint.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    complain_type_id,
                    channel_id,
                    sum(sum_complain) as sum_complain
                FROM
                    report_all_complaint
                WHERE 1=1 " . $where_date . $where_type_id . $where_channel_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    complain_type_id,
                    channel_id";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            if ($row->complain_type_id != '' && $row->channel_id != '') {
                $result_data[$row->complain_type_id][$row->channel_id] = $row->sum_complain;
                $result_data[$row->complain_type_id]['sum_all'] = 0;
            }
        }
        if (!empty($result_data)) {
            $this->response($result_data, REST_Controller::HTTP_OK);
        } else {
            $this->response('', REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function report_statistic_by_type_max_get()
    {
        $year = $this->get('year');
        if ($year == '') {
            $year = date('Y');
        }
        $sql = "SELECT
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year,
                    SUM(report_statistic_by_type.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_type
                WHERE report_statistic_by_type.complain_year = '" . $year . "'
                GROUP BY
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year
                    ORDER BY sum_complain DESC
								LIMIT 0,6";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
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
        foreach ($query->result() as $row) {
            $result_data[$row->complain_year] = $row->complain_year + 543;
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
        if ($year == '') {
            $year = date('Y');
        }

        if ($current_status_id != '') {
            $where_type_id = " AND report_statistic_by_status.current_status_id = '" . $current_status_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_statistic_by_status.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_statistic_by_status.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_statistic_by_status.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_statistic_by_status.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    report_statistic_by_status.current_status_id,
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year,
                    SUM(report_statistic_by_status.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_status
                WHERE report_statistic_by_status.complain_year = '" . $year . "'
                " . $where_type_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    report_statistic_by_status.current_status_id,
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            $result_data[$row->current_status_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_statistic_by_status_max_get()
    {
        $year = $this->get('year');
        if ($year == '') {
            $year = date('Y');
        }
        $sql = "SELECT
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year,
                    SUM(report_statistic_by_status.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_status
                WHERE report_statistic_by_status.complain_year = '" . $year . "'
                GROUP BY
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year
                    ORDER BY sum_complain DESC
								LIMIT 0,6";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            $result_data[$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_by_type_get()
    {
        $where_type_id = "";
        $where_part = "";
        $where_province = "";
        $where_district = "";
        $where_subdistrict = "";
        $year = $this->get('year');
        $subject_id = $this->get('subject_id');
        $partid = $this->get('partid');
        $province_id = $this->get('province_id');
        $district_id = $this->get('district_id');
        $address_id = $this->get('address_id');
        if ($year == '') {
            $year = date('Y');
        }

        if ($subject_id != '') {
            $where_type_id = " AND report_statistic_by_subject.subject_id = '" . $subject_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_statistic_by_subject.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_statistic_by_subject.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_statistic_by_subject.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_statistic_by_subject.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    report_statistic_by_subject.subject_id,
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year,
                    SUM(report_statistic_by_subject.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_subject
                WHERE report_statistic_by_subject.complain_year = '" . $year . "'
                " . $where_type_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    report_statistic_by_subject.subject_id,
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            $result_data[$row->subject_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_by_type_max_get()
    {
        $year = $this->get('year');
        if ($year == '') {
            $year = date('Y');
        }
        $sql = "SELECT
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year,
                    SUM(report_statistic_by_subject.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_subject
                WHERE report_statistic_by_subject.complain_year = '" . $year . "'
                GROUP BY
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year
                    ORDER BY sum_complain DESC
								LIMIT 0,6";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            $result_data[$row->complain_month . $row->complain_year] = $row->sum_complain;
        }
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_all_complaint_max_get()
    {
        $where_date = "";
        $where_type_id = "";
        $where_channel_id = "";
        $where_part = "";
        $where_province = "";
        $where_district = "";
        $where_subdistrict = "";
        $date_start = $this->get('complaint_date_start');
        $date_end = $this->get('complaint_date_end');
        $complain_type_id = $this->get('complain_type_id');
        $channel_id = $this->get('channel_id');
        $partid = $this->get('partid');
        $province_id = $this->get('province_id');
        $district_id = $this->get('district_id');
        $address_id = $this->get('address_id');

        if ($date_start != '' && $date_end != '') {
            $where_date = " AND report_all_complaint.complain_date BETWEEN '" . $date_start . "' AND '" . $date_end . "' ";
        } else if ($date_start != '' && $date_end == '') {
            $where_date = " AND report_all_complaint.complain_date >= '" . $date_start . "' ";
        } else if ($date_start == '' && $date_end != '') {
            $where_date = " AND report_all_complaint.complain_date <= '" . $date_end . "' ";
        }

        if ($complain_type_id != '') {
            $where_type_id = " AND report_all_complaint.complain_type_id = '" . $complain_type_id . "'";
        }
        if ($channel_id != '') {
            $where_channel_id = " AND report_all_complaint.channel_id = '" . $channel_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_all_complaint.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_all_complaint.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_all_complaint.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_all_complaint.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    ms_channel.channel_id,
                    ms_channel.channel_name,
                        SUM(
                            report_all_complaint.sum_complain
                        ) AS sum_complain
                FROM
                    ms_channel
                LEFT JOIN report_all_complaint ON report_all_complaint.channel_id = ms_channel.channel_id
                WHERE 1=1 " . $where_channel_id . "
                GROUP BY
                    ms_channel.channel_id
                ORDER BY
                    sum_complain DESC,ms_channel.channel_id ASC
                LIMIT 0,10";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            $result_data[$row->channel_id] = $row->channel_id;
        }
        if (!empty($result_data)) {
            $this->response($result_data, REST_Controller::HTTP_OK);
        } else {
            $this->response('', REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function report_result_progress_get()
    {
        $this->load->model('master/Complain_type_model');
        $this->load->model('data/Report_result_all_model');
        $result = null;
        $type = $this->get('type');
        $year = $this->get('year');
        $month = $this->get('month');
        $statusGroups = [
            '0' => ['1', '2'],
            '1' => ['3', '4', '5', '6']
        ];
        $monthOrders = [10, 11, 12, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $complainTypes = $this->Complain_type_model
            ->as_dropdown('complain_type_name')
            ->where(['parent_id' => '0', 'status_active' => '1'])
            ->get_all();
        if (!is_null($type)) {
            if ($type == 1) {
                $result['column1'] = 'เรื่องร้องเรียนงบประมาณ พ.ศ.' . date_thai($year . '-01-01', true, 'y');
                $run = 2;
                if ($complainTypes) {
                    $sum = 0;
                    foreach ($complainTypes as $index => $complainType) {
                        $sum += $result["column{$run}"] = $this->Report_result_all_model->progressByType($index, $year, $month);
                        $run++;
                    }
                    $result['column8'] = $sum;
                    $run++;
                }
                $sum1 = 0;
                foreach ($statusGroups as $index => $statusGroup) {
                    $sum1 += $result["column{$run}"] = $this->Report_result_all_model->progressByStatus($statusGroup, $year, $month);
                    $run++;
                }
                $result['column11'] = $sum1;
            } else {
                if ((int)$month > 9) {
                    $year++;
                }
                foreach ($monthOrders as $key => $monthOrder) {
                    $result[$key]['column1'] = date_thai($year . "-" . sprintf("%02s", $monthOrder) . '-01', true, 'm');
                    $run = 2;
                    if ($complainTypes) {
                        $sum = 0;
                        foreach ($complainTypes as $index => $complainType) {
                            $sum += $result[$key]["column{$run}"] = $this->Report_result_all_model->progressByType($index, $year, $monthOrder);
                            $run++;
                        }
                        $result[$key]['column8'] = $sum;
                        $run++;
                    }
                    $sum1 = 0;
                    foreach ($statusGroups as $index => $statusGroup) {
                        $sum1 += $result[$key]["column{$run}"] = $this->Report_result_all_model->progressByStatus($statusGroup, $year, $monthOrder);
                        $run++;
                    }
                    $result[$key]['column11'] = $sum1;
                    if (sprintf("%02s", $month) == sprintf("%02s", $monthOrder)) {
                        break;
                    }
                }

            }
        }


        if ($result) {
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No report data were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function report_all_complaint_app_get()
    {
        $where_date = "";
        $where_type_id = "";
        $where_channel_id = "";
        $where_part = "";
        $where_province = "";
        $where_district = "";
        $where_subdistrict = "";
        $date_start = $this->get('complaint_date_start');
        $date_end = $this->get('complaint_date_end');
        $complain_type_id = $this->get('complain_type_id');
        $channel_id = $this->get('channel_id');
        $partid = $this->get('partid');
        $province_id = $this->get('province_id');
        $district_id = $this->get('district_id');
        $address_id = $this->get('address_id');

        if ($date_start != '' && $date_end != '') {
            $where_date = " AND report_all_complaint.complain_date BETWEEN '" . $date_start . "' AND '" . $date_end . "' ";
        } else if ($date_start != '' && $date_end == '') {
            $where_date = " AND report_all_complaint.complain_date >= '" . $date_start . "' ";
        } else if ($date_start == '' && $date_end != '') {
            $where_date = " AND report_all_complaint.complain_date <= '" . $date_end . "' ";
        }

        if ($complain_type_id != '') {
            $where_type_id = " AND report_all_complaint.complain_type_id = '" . $complain_type_id . "'";
        }
        if ($channel_id != '') {
            $where_channel_id = " AND report_all_complaint.channel_id = '" . $channel_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_all_complaint.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_all_complaint.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_all_complaint.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_all_complaint.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    report_all_complaint.channel_id,
                    sum(report_all_complaint.sum_complain) as sum_complain,
                    ms_channel.channel_name
                FROM
                    report_all_complaint
                LEFT JOIN ms_channel ON report_all_complaint.channel_id=ms_channel.channel_id
                WHERE 1=1 AND report_all_complaint.channel_id <> '' " . $where_date . $where_type_id . $where_channel_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    report_all_complaint.channel_id
                LIMIT 10";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() AS $key => $row) {
            $result_data['labels'][] = $row->channel_name;
            $result_data['datasets'][0]['data'][] = $row->sum_complain;
        }
        $result_data['datasets'][0]['label'] = "ช่องทางการร้องทุกข์";

        if (!empty($result_data)) {
            $this->response(array( 'report' => $result_data), REST_Controller::HTTP_OK);
        } else {
            $this->response('', REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function report_by_type_app_get()
    {
        $where_type_id = "";
        $where_part = "";
        $where_province = "";
        $where_district = "";
        $where_subdistrict = "";
        $year = $this->get('year');
        $subject_id = $this->get('subject_id');
        $partid = $this->get('partid');
        $province_id = $this->get('province_id');
        $district_id = $this->get('district_id');
        $address_id = $this->get('address_id');
        if ($year == '') {
            $year = date('Y');
        }

        if ($subject_id != '') {
            $where_type_id = " AND report_statistic_by_subject.subject_id = '" . $subject_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_statistic_by_subject.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_statistic_by_subject.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_statistic_by_subject.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_statistic_by_subject.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    report_statistic_by_subject.subject_id,
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year,
                    SUM(report_statistic_by_subject.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_subject
                WHERE report_statistic_by_subject.complain_year = '" . $year . "'
                " . $where_type_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    report_statistic_by_subject.subject_id,
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year";
        $query = $this->db->query($sql);
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->subject_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
            //$result[$row->subject_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }

        $sql_max = "SELECT
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year,
                    SUM(report_statistic_by_subject.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_subject
                WHERE report_statistic_by_subject.subject_id <> '' AND report_statistic_by_subject.complain_year = '" . $year . "'
                GROUP BY
                    report_statistic_by_subject.complain_month,
                    report_statistic_by_subject.complain_year
                    ORDER BY sum_complain DESC
								LIMIT 0,6";
        $query_max = $this->db->query($sql_max);
        $result_data_max = array();
        foreach ($query_max->result() as $row_max) {
            $result_data_max[$row_max->complain_month . $row_max->complain_year] = $row_max->sum_complain;
        }

        $sql_subject = "SELECT
                            ms_subject.subject_id,
                            ms_subject.subject_name
                        FROM ms_subject";
        $query_subject = $this->db->query($sql_subject);
        $result_subject = array();
        foreach ($query_subject->result() as $row_subject) {
            $result_subject[$row_subject->subject_id]['subject_id'] = $row_subject->subject_id;
            $result_subject[$row_subject->subject_id]['subject_name'] = $row_subject->subject_name;
        }

        $month_report = array();
        foreach ($this->strMonthCut AS $key => $val) {
            if ($val != '') {
                $month_report[$key . $year] = $val . ' ' . ($year + 543);
            }
        }

        $result_data = array();
        $i = 0;
        foreach ($month_report AS $key2 => $month) {
            if ($result_data_max[$key2]) {
                $result_data[$i]['name'] = $month;
                $result_data[$i]['mmyyyy'] = $key2;
                foreach ($result_subject AS $key_subject => $subject) {
                    $result_data[$i]['content'][$subject['subject_id']]['subject_id'] = $subject['subject_id'];
                    $result_data[$i]['content'][$subject['subject_id']]['subject_name'] = $subject['subject_name'];
                    $result_data[$i]['content'][$subject['subject_id']]['subject_sum'] = ($result[$subject['subject_id']][$key2] != '') ? $result[$subject['subject_id']][$key2] : '0';
                }
            }
            $i++;
        }

        $result_data['statement']['sql'] = $sql;
        $result_data['statement']['sql_max'] = $sql_max;
        $result_data['statement']['sql_subject'] = $sql_subject;

        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_statistic_by_type_app_get()
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
        if ($year == '') {
            $year = date('Y');
        }

        if ($complain_type_id != '') {
            $where_type_id = " AND report_statistic_by_type.complain_type_id = '" . $complain_type_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_statistic_by_type.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_statistic_by_type.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_statistic_by_type.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_statistic_by_type.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    report_statistic_by_type.complain_type_id,
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year,
                    SUM(report_statistic_by_type.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_type
                WHERE report_statistic_by_type.complain_year = '" . $year . "'
                " . $where_type_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    report_statistic_by_type.complain_month,
                    report_statistic_by_type.complain_year";
        $query = $this->db->query($sql);
        $result_data = array();
        foreach ($query->result() as $row) {
            $result[$row->complain_month . $row->complain_year] = $row->sum_complain;
        }

        $month_report = array();
        foreach ($this->strMonthCut AS $key => $val) {
            if ($val != '') {
                $month_report[$key . $year] = $val . ' ' . ($year + 543);
            }
        }

        $arr_data = array();
        foreach ($month_report as $key => $val){
            $arr_data['data'][] = (int)$result[$key];
            $arr_datasets['labels'][] = $val;
        }
        $arr_data['label'] = "เรื่อง";
        $arr_datasets['datasets'] = array($arr_data);

        $arr_type = array();
        foreach ($month_report AS $key => $val) {
            $arr_type[$key]['name'] = $val;
            $arr_type[$key]['value'] = ($result[$key] != '') ? $result[$key] : '0';
        }

        $result_data = array('report' => $arr_datasets);
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function report_statistic_by_status_app_get()
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
        if ($year == '') {
            $year = date('Y');
        }

        if ($current_status_id != '') {
            $where_type_id = " AND report_statistic_by_status.current_status_id = '" . $current_status_id . "'";
        }
        if ($partid != '') {
            $where_part = " AND report_statistic_by_status.partid = '" . $partid . "'";
        }
        if ($province_id != '') {
            $where_province = " AND report_statistic_by_status.province_id = '" . $province_id . "'";
        }
        if ($district_id != '') {
            $where_district = " AND report_statistic_by_status.district_id = '" . $district_id . "'";
        }
        if ($address_id != '') {
            $where_subdistrict = " AND report_statistic_by_status.subdistrict_id = '" . $address_id . "'";
        }

        $sql = "SELECT
                    report_statistic_by_status.current_status_id,
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year,
                    SUM(report_statistic_by_status.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_status
                WHERE report_statistic_by_status.complain_year = '" . $year . "'
                " . $where_type_id . $where_part . $where_province . $where_district . $where_subdistrict . "
                GROUP BY
                    report_statistic_by_status.current_status_id,
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year";
        $query = $this->db->query($sql);
        $result = array();
        foreach ($query->result() as $row) {
            //$result[$row->complain_month . $row->complain_year][$row->current_status_id] = $row->sum_complain;
            $result[$row->current_status_id][$row->complain_month . $row->complain_year] = $row->sum_complain;
        }

        $sql_max = "SELECT
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year,
                    SUM(report_statistic_by_status.sum_complain) AS sum_complain
                FROM
                    report_statistic_by_status
                WHERE report_statistic_by_status.complain_year = '" . $year . "'
                GROUP BY
                    report_statistic_by_status.complain_month,
                    report_statistic_by_status.complain_year
                    ORDER BY sum_complain DESC
								LIMIT 0,6";
        $query_max = $this->db->query($sql_max);
        $result_data_max = array();
        //$result = array();
        foreach ($query_max->result() as $row_max) {
            $result_data_max[$row_max->complain_month . $row_max->complain_year] = $row_max->sum_complain;
            //$result[$row_max->complain_month . $row_max->complain_year] = $row_max->sum_complain;
        }

        $sql_status = "SELECT
                        ms_current_status.current_status_id,
                        ms_current_status.current_status_name
                    FROM ms_current_status";
        $query_status = $this->db->query($sql_status);
        $result_status = array();
        foreach ($query_status->result() as $row_status) {
            $result_status[$row_status->current_status_id]['current_status_id'] = $row_status->current_status_id;
            $result_status[$row_status->current_status_id]['current_status_name'] = $row_status->current_status_name;
        }

        $month_report = array();
        foreach ($this->strMonthCut AS $key => $val) {
            if ($val != '') {
                $month_report[$key . $year] = $val . ' ' . ($year + 543);
            }
        }

        $result_data = array();
        $i = 0;
        foreach ($month_report AS $key2 => $month) {
            //if ($result_data_max[$key2]) {
                //$arr_data['data'][] = (int)$key2;
//                $arr_datasets['labels'][] = $month;

                //$result_data[$key2]['name'] = $month;
                //$result_data[$key2]['value'] = $key2;
                foreach ($result_status AS $key_subject => $subject) {
                    //$arr_data['data'][$i] = (int)$result[$subject['current_status_id']][$key2];
                    //$arr_data['data'][] = (int)$result[$key];
//                    $arr_data['data'][] = (int)$result[$subject['current_status_id']][$key2];
//                    $arr_data['label'] = $subject['current_status_name'];

                    //$result_data[$key2]['content'][$subject['current_status_id']]['current_status_id'] = $subject['current_status_id'];
                    //$result_data[$key2]['content'][$subject['current_status_id']]['current_status_name'] = $subject['current_status_name'];
                    //$result_data[$key2]['content'][$subject['current_status_id']]['subject_sum'] = ($result[$subject['current_status_id']][$key2] != '') ? $result[$subject['current_status_id']][$key2] : '0';
                    //$result_data[$key2][$subject['current_status_id']] = ($result[$subject['current_status_id']][$key2] != '') ? $result[$subject['current_status_id']][$key2] : '0';
                }
//                $arr_datasets['datasets'] = array($arr_data);
                //$arr_data['label'][] = $subject['current_status_name'];
            ///}
            $i++;
        }
        //$this->response($result_data, REST_Controller::HTTP_OK);

///

        foreach ($month_report as $key => $val){
//            if ($result_data_max[$key]) {
//                foreach ($result_status AS $key_subject => $subject) {
//                    $arr_data['data'][] = (int)$result[$key][$subject['current_status_id']];
//                }
                $arr_datasets['labels'][] = $val;
//            }
        }
        $index = 0;
        foreach ($result_status AS $key_subject => $subject) {
            $arr_data = array();
            foreach ($month_report as $key => $val){
                $arr_data['data'][] = (int)$result[$subject['current_status_id']][$key];
            }
            $arr_data['label'] = $subject['current_status_name'];
            $arr_datasets['datasets'][$index++] = $arr_data;
        }
        //$arr_datasets['datasets'][] = array($arr_data);




//        $arr_data['label'] = "เรื่อง";
//        $arr_datasets['datasets'] = array($arr_data);

//        $arr_type = array();
//        foreach ($month_report AS $key => $val) {
//            $arr_type[$key]['name'] = $val;
//            $arr_type[$key]['value'] = ($result[$key] != '') ? $result[$key] : '0';
//        }
        $result_data = array('report' => $arr_datasets);
        $this->response($result_data, REST_Controller::HTTP_OK);
        //$this->response($result_data, REST_Controller::HTTP_OK);

        //$this->response(array('old' => $result_data, 'new' => $result_status, 'max' => $result_data_maxม , 'result' => $result ), REST_Controller::HTTP_OK);
    }

    public function report_test_app_get()
    {


        $yyyy = date('Y');
        $m = date('m');
        $result_data = array();
        for ($i = 1; $i <= (int)$m; $i++) {
            //$result_data[$i] = date("Ym",mktime(0,0,0,$i,1,$yyyy));

            $this->db->select('complain_month, complain_year, report_statistic_by_subject.subject_id, ms_subject.subject_name');
            $this->db->select_sum('sum_complain');
            $this->db->from('report_statistic_by_subject');
            $this->db->join('ms_subject', 'report_statistic_by_subject.subject_id = ms_subject.subject_id');
            $this->db->where(array('complain_year' => $yyyy, 'complain_month' => $i));
            $this->db->group_by(array('report_statistic_by_subject.subject_id', 'complain_month', 'complain_year'));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $key => $rows) {
                    $result_data[$i][] = $rows;
                }
            }else{
                $result_data[$i] = array();
            }

        }

        $datasets = array();
        $labels =array();
        for ($i = 1; $i <= (int)$m; $i++) {
            for($k=0; $k <= 2; $k++) {
                $datasets[$k]['data'][] = (int)$result_data[$i][$k]['sum_complain'];
                $datasets[$k]['label'] = ( $result_data[$i][$k]['subject_name'] ) ? $result_data[$i][$k]['subject_name'] : $datasets[$k]['label'] ;
            }

            $labels[] = $this->strMonthLong[$i];
        }

        $this->response(array('datasets' => $datasets, 'lables'=> $labels), REST_Controller::HTTP_OK);
    }


}
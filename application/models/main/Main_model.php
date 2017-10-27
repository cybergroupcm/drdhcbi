<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_sum_status($user_id='')
    {
      $where = "";
      if( $user_id != '' ){
            $where = " WHERE report_statistic_by_status.create_user_id = '".$user_id."' ";
      }
      $sql = "  SELECT SUM(report_statistic_by_status.sum_complain) AS sum_complain,
                      report_statistic_by_status.current_status_id
                FROM report_statistic_by_status
                ".$where."
                GROUP BY report_statistic_by_status.current_status_id
                ORDER BY report_statistic_by_status.current_status_id ASC ";
      $query = $this->db->query($sql);
      $sum_all = 0;
      $result[1] = 0;
      $result[2] = 0;
      $result[3] = 0;
      $result[4] = 0;
      foreach ($query->result() as $row)
      {
        $result[$row->current_status_id] = $row->sum_complain;
        $sum_all += $row->sum_complain;
      }
      $result['sum_all'] =  $sum_all;
      return $result;
    }

    public function get_sum_status_without_ccaa($user_id='')
    {

        $where = "";
        $where_user = "";
        if( $user_id != '' ) {
            $where = " AND dt_keyin.create_user_id = '" . $user_id . "' ";
            $sql = "SELECT
                  `au_users`.company,
                  `au_users_groups`.group_id
                FROM `au_users` INNER JOIN `au_users_groups` ON `au_users`.id = `au_users_groups`.user_id
                WHERE `au_users`.id = '".$user_id."'
                ";
            $query = $this->db->query($sql);
            $data_group = $query->result_array();
            if(!empty($data_group)){
                $where_user = " OR (`dt_keyin`.send_org_id = '".$data_group[0]['company']."')";
            }
        }
        $sql = "SELECT
                    IF(`dt_keyin`.`current_status_id`>=4,4,`dt_keyin`.`current_status_id`) AS `current_status_id`,
                    count( `dt_keyin`.`keyin_id` ) AS `sum_complain` 
                FROM `dt_keyin`
                WHERE 1=1 ".$where." ".$where_user."
                GROUP BY IF(`dt_keyin`.`current_status_id`>=4,4,`dt_keyin`.`current_status_id`)";
        $query = $this->db->query($sql);
        $sum_all = 0;
        $result[1] = 0;
        $result[2] = 0;
        $result[3] = 0;
        $result[4] = 0;
        foreach ($query->result() as $row)
        {
            $result[$row->current_status_id] = $row->sum_complain;
            $sum_all += $row->sum_complain;
        }
        $result['sum_all'] =  $sum_all;
        return $result;
    }

    public function get_sum_dashboard($user_id='')
    {
        $where = "";
        if( $user_id != '' ){
            $where = " WHERE report_statistic_by_status.create_user_id = '".$user_id."' ";
        }
        $sql = "  SELECT SUM(report_statistic_by_status.sum_complain) AS sum_complain,
                      report_statistic_by_status.current_status_id
                FROM report_statistic_by_status
                ".$where."
                GROUP BY report_statistic_by_status.current_status_id
                ORDER BY report_statistic_by_status.current_status_id ASC ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_current_status()
    {
      $sql = "SELECT current_status_id, current_status_name FROM ms_current_status ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function get_data_status($status_id){
        $to_day = date('Y-m-d');
        //$to_day = '2017-10-10';
        $sql = "SELECT
                dt_keyin.keyin_id,
                dt_keyin.complain_no,
                dt_keyin.complain_name,
                dt_keyin.latitude,
                dt_keyin.longitude,
                ms_complain_type.parent_id AS complain_type_id
                FROM dt_keyin
                JOIN ms_complain_type
                ON dt_keyin.complain_type_id = ms_complain_type.complain_type_id
                WHERE ms_complain_type.parent_id != 0
                AND current_status_id='".$status_id."'
                AND complain_date LIKE('".$to_day."%')
                ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function get_complain_type_list(){
        $sql = "SELECT complain_type_name, icon_pin FROM ms_complain_type WHERE parent_id=0 AND status_active=1 ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_complain_type_icon($complain_type_id=''){
        $sql = "SELECT icon_pin,parent_id FROM ms_complain_type WHERE complain_type_id='".$complain_type_id."' ";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row)
        {
          if($row->parent_id > 0){
              return $this->get_complain_type_icon($row->parent_id);
          }else{
              return $row->icon_pin;
          }
        }
    }

    public function get_area($area_id='')
    {
      if($area_id != ''){
          $where_area = "AND ms_ccaa.ccDigi='".$area_id."'";
      }else{
          $where_area = "";
      }
      $sql_area = " SELECT ms_ccaa.ccDigi AS area_id,ms_ccaa.ccName AS area_name, ms_ccaa.g_point, ms_ccaa.g_shape, ms_ccaa.ccType
                  FROM ms_ccaa
                  WHERE ms_ccaa.ccDigi LIKE('20%')
                  ".$where_area."
                  AND ms_ccaa.ccType='Aumpur'
                  ORDER BY ms_ccaa.ccDigi ASC ";
      $query_area = $this->db->query($sql_area);
      $result = $query_area->result();

      return $result;
    }


    public function get_sum_area()
    {
      $sql = " SELECT report_all_complaint.district_id,
                	SUM(report_all_complaint.sum_complain) AS sum_complain
                FROM report_all_complaint
                GROUP BY report_all_complaint.district_id
                ORDER BY report_all_complaint.district_id ASC ";
      $query = $this->db->query($sql);
      $sum_all = 0;
      foreach ($query->result() as $row)
      {
        $result[$row->district_id] = $row->sum_complain;
        $sum_all += $row->sum_complain;
      }
      $result['sum_all'] =  $sum_all;
      return $result;
    }

    public function get_sum_type($user_id='')
    {
        $to_day = date('Y-m-d');
        //$to_day = '2017-09-27';
        $where = "";
        if( $user_id != '' ){
            $where = "  WHERE report_all_complaint.create_user_id = '".$user_id."'
                        AND report_all_complaint.complain_date LIKE('".$to_day."%') ";
        }else{
            $where = "  WHERE report_all_complaint.complain_date LIKE('".$to_day."%') ";
        }
      $sql = " SELECT report_all_complaint.complain_type_id,
              	ms_complain_type.complain_type_name,
              	ms_complain_type.parent_id,
              	SUM(report_all_complaint.sum_complain) AS sum_complain
              FROM report_all_complaint INNER JOIN ms_complain_type ON report_all_complaint.complain_type_id = ms_complain_type.complain_type_id
              ".$where."
              GROUP BY report_all_complaint.complain_type_id
              ORDER BY sum_complain DESC";
              //LIMIT 5 ";
      $query = $this->db->query($sql);
      $sum_all = 0;
      $result = array();
    $sql_main = "SELECT complain_type_id,complain_type_name,color FROM ms_complain_type WHERE parent_id = '0' ORDER BY complain_type_id ASC";
    $query_main = $this->db->query($sql_main);
    foreach ($query_main->result() as $row_main)
    {
        foreach ($query->result() as $row)
        {
            if(($row_main->complain_type_id == $row->parent_id) || ($row_main->complain_type_id == $row->complain_type_id)) {
                $result[$row_main->complain_type_id]['sum_complain'] += $row->sum_complain;
                $sum_all += $row->sum_complain;
            }
        }
        $result[$row_main->complain_type_id]['complain_type_name'] = $row_main->complain_type_name;
        $result[$row_main->complain_type_id]['color'] = $row_main->color;

    }

      if( empty($result) ){
          $result[1]['complain_type_name'] = 'ไม่มีข้อมูล';
          $result[1]['sum_complain'] = 0;
          $result[1]['color'] = '#CCCCCC';
      }else {
          foreach ($result as $key => $value) {
              $result[$key]['sum_complain'] = ($value['sum_complain'] * 100) / $sum_all;
          }
      }
      return $result;
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_sum_status()
    {
      $sql = "  SELECT SUM(report_statistic_by_status.sum_complain) AS sum_complain,
                      report_statistic_by_status.current_status_id
                FROM report_statistic_by_status
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

    public function get_sum_type()
    {
      $sql = " SELECT report_all_complaint.complain_type_id,
              	ms_complain_type.complain_type_name,
              	SUM(report_all_complaint.sum_complain) AS sum_complain
              FROM report_all_complaint INNER JOIN ms_complain_type ON report_all_complaint.complain_type_id = ms_complain_type.complain_type_id
              GROUP BY report_all_complaint.complain_type_id
              ORDER BY report_all_complaint.complain_type_id ASC ";
      $query = $this->db->query($sql);
      $sum_all = 0;
      $color = array('#8181F7','#81BEF7','#0431B4','#0489B1','#04B4AE','#088A68');
      foreach ($query->result() as $row)
      {
        $result[$row->complain_type_id]['complain_type_name'] = $row->complain_type_name;
        $result[$row->complain_type_id]['sum_complain'] = $row->sum_complain;
        $result[$row->complain_type_id]['color'] = $color[$sum_all];
        $sum_all++;
      }
      return $result;
    }
}

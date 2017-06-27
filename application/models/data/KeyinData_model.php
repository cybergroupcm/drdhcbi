<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeyinData_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'dt_keyin';
        $this->primary_key = 'keyin_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';
    }

    public function get_dashboard_data()
    {
        $arr_data = [
            'arr_data' => [
                '0' => [
                    'req_id' => '0001',
                    'req_title' => 'เรื่องร้องทุกข์1',
                    'req_name' => 'นายก',
                    'req_date' => '2017-06-01',
                ],
                '1' => [
                    'req_id' => '0002',
                    'req_title' => 'เรื่องร้องทุกข์2',
                    'req_name' => 'นายข',
                    'req_date' => '2017-06-02',
                ],
                '2' => [
                    'req_id' => '0003',
                    'req_title' => 'เรื่องร้องทุกข์3',
                    'req_name' => 'นายค',
                    'req_date' => '2017-06-03',
                ],
            ],
            'data_filter' => [
                '0' => 'แจ้งเบาะแสการทำผิด',
                '1' => 'ยานพาหนะ',
                '2' => 'เรื่องทั่วไป'
            ],
            'data_received' => [
                'req_id' => '0001',
                'req_title' => 'เรื่องร้องทุกข์1',
                'req_name' => 'นายก',
                'send_date' => '2017-06-05'
            ],
            'data_department' => [
                '0' => 'ทดสอบ1',
                '1' => 'ทดสอบ2',
                '2' => 'ทดสอบ3'
            ]
        ];
        return $arr_data;
    }

    public function get_complaint_type()
    {
        $this->db->select('complain_type_id,complain_type_name');
        $query = $this->db->get('ms_complain_type');
        foreach ($query->result_array() as $row)
        {
            $result[$row['complain_type_id']] = $row['complain_type_name'];
        }
        return $result;
    }

    public function get_accused_type()
    {
        $this->db->select('accused_type_id,accused_type');
        $query = $this->db->get('ms_accused_type');
        foreach ($query->result_array() as $row)
        {
            $result[$row['accused_type_id']] = $row['accused_type'];
        }
        return $result;
    }
    public function get_channel()
    {
        $this->db->select('channel_id,channel_name');
        $query = $this->db->get('ms_channel');
        foreach ($query->result_array() as $row)
        {
            $result[$row['channel_id']] = $row['channel_name'];
        }
        return $result;
    }

}
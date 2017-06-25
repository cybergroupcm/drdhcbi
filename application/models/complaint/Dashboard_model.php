<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function get_data()
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

}
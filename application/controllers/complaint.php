<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Complaint extends CI_Controller {

	public function key_in()
	{
            //$this->load->model('Template_libraries', 'libraries');
            $arr_data['complaint_type'] = array(
                '0'=>'แจ้งเบาะแสการทำผิด',
                '1'=>'ปัญหาความเดือดร้อน',
                '2'=>'ยานพาหนะ',
                '3'=>'ธนาคตาร/สถาบันการเงิน/เงินทุนหลักทรัพย์',
                '4'=>'เรื่องทั่วไป',
                '5'=>'ขอความช่วยเหลือ'
                );
            $arr_data['complainant'] = array(
                '0'=>'หน่วยงานถายใน',
                '1'=>'หน่วยงานภายนอก',
                '2'=>'บุคคล/นิติบุคคล'
                );
            $this->libraries->template('complaint/key_in',$arr_data);
	}

    public function dashboard()
    {
        $arr_data=array(
            'arr_data' => array(
                '0'=>array(
                    'req_id'=>'0001',
                    'req_title'=>'เรื่องร้องทุกข์1',
                    'req_name'=>'นายก',
                    'req_date'=>'2017-06-01',
                ),
                '1'=>array(
                    'req_id'=>'0002',
                    'req_title'=>'เรื่องร้องทุกข์2',
                    'req_name'=>'นายข',
                    'req_date'=>'2017-06-02',
                ),
                '2'=>array(
                    'req_id'=>'0003',
                    'req_title'=>'เรื่องร้องทุกข์3',
                    'req_name'=>'นายค',
                    'req_date'=>'2017-06-03',
                ),
            ),
            'data_filter' => array(
                '0'=>'แจ้งเบาะแสการทำผิด',
                '1'=>'ยานพาหนะ',
                '2'=>'เรื่องทั่วไป'
            ),
            'data_received' => array(
                'req_id'=>'0001',
                'req_title'=>'เรื่องร้องทุกข์1',
                'req_name'=>'นายก',
                'send_date'=>'2017-06-05'
            ),
            'data_department' => array(
                '0'=>'ทดสอบ1',
                '1'=>'ทดสอบ2',
                '2'=>'ทดสอบ3'
            )
        );
        $this->libraries->template('complaint/dashboard',$arr_data);
    }
}
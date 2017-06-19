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
}

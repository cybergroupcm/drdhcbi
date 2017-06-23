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

        //start แบ่งหน้า
        $this->load->library('pagination');
        $config['base_url'] = base_url().'complaint/dashboard/page';
        $config['total_rows'] = 200; // Count total rows in the query
        $config['full_tag_open'] = '<div class="container text-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['page_query_string'] = TRUE;
        $config['prev_link'] = '&lt; <';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '> &gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $this->pagination->initialize($config);
        $arr_data['pagination'] = $this->pagination->create_links();
        //end แบ่งหน้า

        $this->libraries->template('complaint/dashboard',$arr_data);
    }

    public function getDataReceived($req_id)
    {
        //echo $req_id;
        $arr_data=array(
            'data_received' => array(
                '0001'=>array(
                    'req_id'=>'0001',
                    'req_title'=>'เรื่องร้องทุกข์1',
                    'req_name'=>'นายก',
                    'send_date'=>'2017-06-01',
                ),
                '0002'=>array(
                    'req_id'=>'0002',
                    'req_title'=>'เรื่องร้องทุกข์2',
                    'req_name'=>'นายข',
                    'send_date'=>'2017-06-02',
                ),
                '0003'=>array(
                    'req_id'=>'0003',
                    'req_title'=>'เรื่องร้องทุกข์3',
                    'req_name'=>'นายค',
                    'send_date'=>'2017-06-03',
                )
            )
        );
        $result = $arr_data['data_received'][$req_id];
        echo json_encode($result);
        exit;
    }

    public function view_detail($req_id)
    {
        $arr_data=array(
            'arr_data' => array(
                '0'=>array(
                    'req_status'=>'อยู่ระหว่างตรวจสอบ',
                    'req_title'=>'เรื่องร้องทุกข์1',
                    'req_name'=>'นายก',
                    'req_date'=>'2017-06-01',
                    'req_money'=>'2000',
                ),
                '1'=>array(
                    'req_status'=>'อยู่ระหว่างตรวจสอบ',
                    'req_title'=>'เรื่องร้องทุกข์2',
                    'req_name'=>'นายข',
                    'req_date'=>'2017-06-02',
                    'req_money'=>'2000',
                ),
                '2'=>array(
                    'req_status'=>'รอเจ้าหน้าที่รับเรื่องร้องทุกข์',
                    'req_title'=>'เรื่องร้องทุกข์3',
                    'req_name'=>'นายค',
                    'req_date'=>'2017-06-03',
                    'req_money'=>'2000',
                ),
            ),
            'data_detail' => array(
                'req_id' => $req_id
            )
        );
        $this->libraries->template('complaint/view_detail',$arr_data);
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Complaint extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        //$this->load->helper('cookie');
        //$this->load->helper('api');
        $this->load->helper('form');
        $this->load->model('complaint_model');
        $this->load->helper('dateformat');
    }

    public function key_in()
    {
        $url = "http://localhost/drdhcbi/api/complaint/complaint_type";
        $arr_data['complaint_type'] = api_call_get($url);
        $url = "http://localhost/drdhcbi/api/complaint/accused_type";
        $arr_data['complainant'] = api_call_get($url);
        $url = "http://localhost/drdhcbi/api/complaint/channel";
        $arr_data['channel'] = api_call_get($url);
        $this->libraries->template('complaint/key_in', $arr_data);
    }

    public function dashboard()
    {

        /*$cookie = array(
            'name' => 'token',
            'value' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwiaWF0IjoxNDk4MzI0OTA0LCJleHAiOjE0OTg0MTE0MDR9.68uPmgihXhR862kxXYU_blfVzxyJGC4O77gTgHaDtJI',
            'expire' => '86500',
        );*/
        //$this->input->set_cookie($cookie);
        $url = "http://localhost/drdhcbi/api/complaint/dashboard";

        $arr_data = api_call_get($url);
        /*echo '<pre>';
        print_r($arr_data);
        echo '</pre>';*/

        //start แบ่งหน้า
        $this->load->library('pagination');
        $config['base_url'] = base_url().'complaint/dashboard/page';
        $config['total_rows'] = 200; // Count total rows in the query
        $config['full_tag_open'] = '<div class="container text - center"><ul class="pagination">';
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

        $this->libraries->template('complaint/dashboard', $arr_data);
    }

    public function getDataReceived($req_id)
    {
        //echo $req_id;
        $arr_data = array(
            'data_received' => array(
                '0001' => array(
                    'complain_no' => '0001',
                    'complain_name' => 'เรื่องร้องทุกข์1',
                    'recipient' => 'นายก',
                    'doc_receive_date' => '2017-06-01',
                ),
                '0002' => array(
                    'complain_no' => '0002',
                    'complain_name' => 'เรื่องร้องทุกข์2',
                    'recipient' => 'นายข',
                    'doc_receive_date' => '2017-06-02',
                ),
                '0003' => array(
                    'complain_no' => '0003',
                    'complain_name' => 'เรื่องร้องทุกข์3',
                    'recipient' => 'นายค',
                    'doc_receive_date' => '2017-06-03',
                )
            )
        );
        $result = $arr_data['data_received'][$req_id];
        echo json_encode($result);
        exit;
    }

    public function view_detail($req_id)
    {
        $arr_data = array(
            'arr_data' => array(
                '0' => array(
                    'req_status' => 'อยู่ระหว่างตรวจสอบ',
                    'req_title' => 'เรื่องร้องทุกข์1',
                    'req_name' => 'นายก',
                    'req_date' => '2017-06-01',
                    'req_money' => '2000',
                ),
                '1' => array(
                    'req_status' => 'อยู่ระหว่างตรวจสอบ',
                    'req_title' => 'เรื่องร้องทุกข์2',
                    'req_name' => 'นายข',
                    'req_date' => '2017-06-02',
                    'req_money' => '2000',
                ),
                '2' => array(
                    'req_status' => 'รอเจ้าหน้าที่รับเรื่องร้องทุกข์',
                    'req_title' => 'เรื่องร้องทุกข์3',
                    'req_name' => 'นายค',
                    'req_date' => '2017-06-03',
                    'req_money' => '2000',
                ),
            ),
            'data_detail' => array(
                'req_id' => $req_id
            )
        );
        $this->libraries->template('complaint/view_detail', $arr_data);
    }
}
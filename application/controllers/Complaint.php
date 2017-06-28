<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Complaint extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        //$this->load->helper('cookie');
        //$this->load->helper('api');
        $this->load->helper('form');
        $this->load->helper('form_additional');
        //$this->load->model('complaint_model');
        $this->load->helper('dateformat');

    }

    public function key_in()
    {
        /*$cookie = array(
            'name' => 'token',
            'value' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwiaWF0IjoxNDk4NTcyNTc2LCJleHAiOjE0OTg2NTkwNzZ9.7GCfaZSKdXMO9GTmTHQb-ow2glgMktSVH1C-mwwTB6Y',
            'expire' => '86500',
        );
        $this->input->set_cookie($cookie);*/


        $url = "http://localhost/drdhcbi/api/setting/complain_type";
        $arr_data['complain_type'] = list_options(api_call_get($url),'complain_type_id','complain_type_name','กรุณาเลือก');

        $url = "http://localhost/drdhcbi/api/setting/accused_type";
        $arr_data['accused_type'] = list_options(api_call_get($url),'accused_type_id','accused_type');

        $url = "http://localhost/drdhcbi/api/setting/channel";
        $arr_data['channel'] = list_options(api_call_get($url),'channel_id','channel_name','กรุณาเลือก');

        $url = "http://localhost/drdhcbi/api/setting/subject";
        $arr_data['subject'] = list_options(api_call_get($url),'subject_id','subject_name','กรุณาเลือก');

        $url = "http://localhost/drdhcbi/api/setting/wish";
        $arr_data['wish'] = list_options(api_call_get($url),'wish_id','wish_name');
        /*echo '<pre>';
        print_r($arr_data);
        echo '<pre>';*/
        //die();
        $this->libraries->template('complaint/key_in', $arr_data);
    }

    public function dashboard()
    {

        $cookie = array(
            'name' => 'token',
            'value' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwiaWF0IjoxNDk4NjYyNzI5LCJleHAiOjE0OTg3NDkyMjl9.mCXvz70nSJJ0qOQFoPGK2I8dhnF4ExcZUaorUfDdKBw',
            'expire' => '86500',
        );
        $this->input->set_cookie($cookie);
        $url = "http://localhost/drdhcbi/api/complaint/dashboard";

        $arr_data = api_call_get($url);
//        echo '<pre>';
//        print_r($arr_data);
//        echo '</pre>';

        //start แบ่งหน้า
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'complaint/dashboard/page';
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

    public function getDataReceived($id)
    {
        $url = "http://localhost/drdhcbi/api/complaint/key_in/".$id;
        $arr_data['data_received'] = api_call_get($url);
        //echo '<pre>'; print_r($arr_data); echo '</pre>';
        $result = $arr_data['data_received'];
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
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

    public function key_in($id='')
    {
        /*$cookie = array(
            'name' => 'token',
            'value' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwiaWF0IjoxNDk4NTcyNTc2LCJleHAiOjE0OTg2NTkwNzZ9.7GCfaZSKdXMO9GTmTHQb-ow2glgMktSVH1C-mwwTB6Y',
            'expire' => '86500',
        );
        $this->input->set_cookie($cookie);*/


        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type'] = api_call_get($url);

        $url = base_url("api/dropdown/accused_type_lists");
        $arr_data['accused_type'] = api_call_get($url);

        $url = base_url("api/dropdown/channel_lists");
        $arr_data['channel'] = api_call_get($url);

        $url = base_url("api/dropdown/subject_lists");
        $arr_data['subject'] = api_call_get($url);

        $url = base_url("api/dropdown/wish_lists");
        $arr_data['wish'] = api_call_get($url);

        $url = base_url("api/dropdown/title_name_lists");
        $arr_data['title_name'] = api_call_get($url);
        
        if($id!=''){
            $url = base_url("api/complaint/key_in/".$id);
            $arr_data['key_in_data'] = api_call_get($url);
        }
        
        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);
        
        if(@$arr_data['key_in_data']['province_id']!=''){
            $ccaa_code = substr(@$arr_data['key_in_data']['province_id'], 0, 3);
        }else{
            $ccaa_code = '200';
        }
        $url = base_url("api/dropdown/ccaa_lists/Aumpur/".$ccaa_code);
        $arr_data['district_list'] = api_call_get($url);
        
        if(@$arr_data['key_in_data']['district_id']!=''){
            $ccaa_code = substr(@$arr_data['key_in_data']['district_id'], 0, 4);
            $url = base_url("api/dropdown/ccaa_lists/Tamboon/".$ccaa_code);
            $arr_data['subdistrict_list'] = api_call_get($url);
        }
        
        $this->libraries->template('complaint/key_in', $arr_data);
    }

    public function dashboard($page=1)
    {

        /*$cookie = array(
            'name' => 'token',
            'value' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwiaWF0IjoxNDk4NzQ5MzY1LCJleHAiOjE0OTg4MzU4NjV9.MOrBK-wwE3aHnhpcpZt9iW7fkdIwsNERP_cEadfIlKw',
            'expire' => '86500',
        );
        $this->input->set_cookie($cookie);*/
        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['data_filter'] = api_call_get($url);
        $url = base_url('/api/complaint/total_row');
        $total_row = api_call_get($url);
        $url = base_url('/api/complaint/dashboard/page/'.$page);
        $arr_data['data'] = api_call_get($url);
        $arr_data['start_row'] = (($page-1)*15)+1;

        $url = base_url("api/dropdown/send_org_parent_lists");
        $arr_data['send_org_parent'] = api_call_get($url);

        $url = base_url("api/dropdown/send_org_lists");
        $arr_data['send_org'] = api_call_get($url);

        //start แบ่งหน้า
        //$this->load->library('pagination');
        $config['base_url'] = base_url() . 'complaint/dashboard';
        $config['uri_segment'] = 3;
        $config['total_rows'] = $total_row; // Count total rows in the query
        $config['full_tag_open'] = '<div class="container text - center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $config['per_page'] = 15;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
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

//    public function received($id)
//    {
//        $arr_data = array(
//            'data_keyin' => array(
//                'keyin_id'=>$id
//            )
//        );
//        //$this->libraries->template('complaint/received',$arr_data);
//        $this->load->view('complaint/received',$arr_data);
//    }

    public function getDataReceived($id)
    {
        $url = base_url("api/complaint/key_in/".$id);
        $arr_data['data_received'] = api_call_get($url);
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

    public function getDataSend($id)
    {
        $url = base_url("api/complaint/key_in/".$id);
        $arr_data['data_send'] = api_call_get($url);
        $result = $arr_data['data_send'];
        echo json_encode($result);
        exit;
    }
    
    public function get_district_list($type,$id,$default='')
    {
        $url = base_url("api/dropdown/ccaa_lists/".$type."/".$id);
        $arr_data['type'] = $type;
        $arr_data['district_list'] = api_call_get($url);
        $this->load->view('complaint/get_district_list', $arr_data);
    }
}
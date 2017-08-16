<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Complaint extends CI_Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
        parent::__construct();

        /* Load :: Common */
        $this->load->helper(array('form'));
        $this->load->library(array('my_mpdf','accused_type','complain_type','send_org'));
        if ( ! $this->ion_auth->logged_in() || !$this->api_auth->logged_in())
        {
            redirect('alert', 'refresh');
        }
    }

    public function key_in($step = 'key_in_step1', $id = '')
    {
        $arr_data['step'] = str_replace('key_in_step', '', $step);

        $url = base_url("api/dropdown/channel_lists");
        $arr_data['channel'] = api_call_get($url);

        $url = base_url("api/dropdown/subject_lists");
        $arr_data['subject'] = api_call_get($url);

        $url = base_url("api/dropdown/wish_lists");
        $arr_data['wish'] = api_call_get($url);

        $url = base_url("api/dropdown/title_name_lists");
        $arr_data['title_name'] = api_call_get($url);

        //กำหนดการแสดงผลหน้าบันทึกข้อมูล
        $url = base_url("api/authen/token_info");
        $user_data_id = api_call_get($url);
        $url = base_url("api/complaint/user_groups/user_id/" . $user_data_id['userid']);
        $user_modes_groups = api_call_get($url);
        if(isset($user_modes_groups)){
            $members_keyin = false;
            // 2 = group member
            if(in_array(2,$user_modes_groups)){
              $members_keyin = true;
            }else{
              $members_keyin = false;
            }
            $arr_data['members_keyin'] = $members_keyin;
        }

        $arr_data['key_in_data'] = [];
        if ($id != '') {
            $url = base_url("api/complaint/key_in/" . $id);
            $arr_data['key_in_data'] = api_call_get($url);
            $arr_data['id'] = $id;

            $url = base_url("api/dropdown/accused_type_lists/0");
            $arr_data['accused_type'][] = api_call_get($url);
            if($arr_data['key_in_data']['accused_type_id']!='') {
                $arr_data['get_accused_type'] = $this->accused_type->sort_accused($arr_data['key_in_data']['accused_type_id']);
                foreach ($arr_data['get_accused_type'] as $key => $value) {
                    $url = base_url("api/dropdown/accused_type_lists/" . $value);
                    $accused_type = api_call_get($url);
                    if (!array_key_exists('message', $accused_type)) {
                        $arr_data['accused_type'][] = $accused_type;
                    }
                }
            }

            $url = base_url("api/dropdown/complain_type_lists//parent_id/0");
            $arr_data['complain_type'][] = api_call_get($url);
            if($arr_data['key_in_data']['accused_type_id']!='') {
                $arr_data['get_complain_type'] = $this->complain_type->sort_complain_type($arr_data['key_in_data']['complain_type_id']);
                foreach ($arr_data['get_complain_type'] as $key => $value) {
                    $url = base_url("api/dropdown/complain_type_lists//parent_id/" . $value);
                    $complain_type = api_call_get($url);
                    if (!array_key_exists('message', $complain_type)) {
                        $arr_data['complain_type'][] = $complain_type;
                    }
                }
            }

            if($members_keyin == true && $arr_data['key_in_data']['channel_id'] == ''){
              $arr_data['key_in_data']['channel_id'] = '2';
            }
            if($members_keyin == true && $arr_data['key_in_data']['subject_id'] == ''){
              $arr_data['key_in_data']['subject_id'] = '1';
            }

            $url = base_url("api/complaint/user_detail/idcard/".$arr_data['key_in_data']['id_card']);
            $arr_data['user_detail'] = api_call_get($url);
            //echo"<pre>";print_r($arr_data['user_detail'] );echo"</pre>";exit;
        }else{
            if($members_keyin == true){
              $arr_data['key_in_data']['recipient'] = '-';
            }else{
              $arr_data['key_in_data']['recipient'] = '';
            }
            $url = base_url("api/dropdown/accused_type_lists/0");
            $arr_data['accused_type'][] = api_call_get($url);

            $url = base_url("api/dropdown/complain_type_lists/0");
            $arr_data['complain_type'][] = api_call_get($url);
        }

        $url = base_url("api/dropdown/accused_type_lists");
        $arr_data['accused_type_all'] = api_call_get($url);

        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type_all'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        if (@$arr_data['key_in_data']['address_id'] != '') {
            $ccaa_code = substr(@$arr_data['key_in_data']['address_id'], 0, 3);
        }
        else {
            $ccaa_code = '200';
        }
        $url = base_url("api/dropdown/ccaa_lists/Aumpur/" . $ccaa_code);
        $arr_data['district_list'] = api_call_get($url);

        if (@$arr_data['key_in_data']['address_id'] != '') {
            $ccaa_code = substr(@$arr_data['key_in_data']['address_id'], 0, 4);
            $url = base_url("api/dropdown/ccaa_lists/Tamboon/" . $ccaa_code);
            $arr_data['subdistrict_list'] = api_call_get($url);
        }

        $url = base_url("api/dropdown/ccaa_lists");
        $arr_data['ccaa_all'] = api_call_get($url);

        $this->libraries->template('complaint/' . $step, $arr_data);
    }

    public function dashboard()
    {
        $queryFilter = '';
        $filter = $this->input->get();
        $filtered = array_filter($filter, function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $arr_data['txtDetail'] = '';
        $isFirst = true;
        $hasStartDate = false;
        if (count($filtered) > 0) {
            $arr_data['txtDetail'] = 'ค้นหา:';
            foreach ($filtered as $index => $item) {
                if(!$isFirst  && !$hasStartDate){
                    $arr_data['txtDetail'] .= ' และ ';
                }
                switch ($index){
                    case 'complain_no':
                        $arr_data['txtDetail'] .= " เลขที่เรื่องร้องทุกข์ {$item}";
                        break;
                    case 'petitioner':
                        $arr_data['txtDetail'] .= " ชื่อผู้ร้องทุกข์ {$item}";
                        break;
                    case 'complaint_detail':
                        $arr_data['txtDetail'] .= " เรื่องร้องทุกข์ {$item}";
                        break;
                    case 'current_status':
                        $url = base_url("api/dropdown/current_status_lists");
                        $current_status = api_call_get($url);
                        $arr_data['txtDetail'] = "สถานะ {$current_status[$item]}";
                        break;
                    case 'complaint_date_start':
                        $dateText = date_thai(date_eng($item));
                        $arr_data['txtDetail'] .= " ตั้งแต่วันที่ {$dateText}";
                        $hasStartDate = true;
                        break;
                    case 'complaint_date_end':
                        $dateText = date_thai(date_eng($item));
                        $arr_data['txtDetail'] .= " ถึงวันที่ {$dateText}";
                        break;
                }
                if ($index == 'complaint_date_start' || $index == 'complaint_date_end') {
                    $item = date_eng($item);
                }
                $item = urlencode($item);
                $queryFilter .= "/{$index}/{$item}";
                $isFirst = false;
            }
        }

        //$filter = $this->input->get('filter');

//        if(!is_null($filter)){
//            $queryFilter = "?".http_build_query(['filter'=>$filter]);
//            $config['suffix'] = '?' . http_build_query(['filter'=>$filter]);
//            $config['first_url'] = base_url() . 'complaint/dashboard'.'?'. http_build_query(['filter'=>$filter]);
//        }
//        if(!is_null($current_status)){
//            $queryFilter = "?".http_build_query(['filter'=>$filter]);
//        }

//        $search = $this->input->get('search');
//        $queryFilter = null;
//        if(!is_null($filter)){
//            $querySearch = http_build_query(['search'=>$filter]);
//        }
        $url = base_url("api/authen/token_info");
        $user_data_id = api_call_get($url);

        $url = base_url("api/complaint/user_mode_permission/user_id/" . $user_data_id['userid']);
        $user_modes_groups = api_call_get($url);

        $arr_data['action_mode'] = array(
            'edit' => 0,    //แก้ไข
            'delete' => 0,  //ลบ
            'receive' => 0, //รับเรื่อง
            'send' => 0,    //ส่งเรื่อง
            'finish' => 0   //บันทึกผลการดำเนินการ
        );

        if (!empty($user_modes_groups[2])) {
            foreach ($user_modes_groups[2] as $key => $value) {
                if ($value == 15) {
                    $arr_data['action_mode']['edit'] = 1;
                }
                if ($value == 16) {
                    $arr_data['action_mode']['delete'] = 1;
                }
                if ($value == 17) {
                    $arr_data['action_mode']['receive'] = 1;
                }
                if ($value == 18) {
                    $arr_data['action_mode']['send'] = 1;
                }
                if ($value == 20) {
                    $arr_data['action_mode']['finish'] = 1;
                }
            }
        }

        $overall = 0; // สถานะการมองเห็นทั้งหมด 0 มองเห้นเฉพาะที่ตนเองสร้าง , 1 มองเห็นทั้งหมด

        if (!empty($user_modes_groups[3])) {
            foreach ($user_modes_groups[3] as $key => $value) {
                if ($value == 19) {
                    $overall = 1;
                }
            }
        }
        //@start เช็คให้ข้อมูลกลุ่มผู้ใช้งานเพื่อ แสดงรายการที่ยกเลิก
        $id=$arr_data['token']['userid'];
        $url = base_url()."api/user/user/".$id;
        $arr_data_user = api_call_get($url);
        $arr_group = array();
        foreach($arr_data_user['currentGroups'] AS $key=>$val){
            $arr_group[$key] = $val['id'];
        }

        if(in_array('1',$arr_group)){
            $check_no_status  = "";
        }else{
            $check_no_status  = "/no_status/5";
        }

        //@end เช็คให้ข้อมูลกลุ่มผู้ใช้งานเพื่อ แสดงรายการที่ยกเลิก

//        $url = base_url("api/dropdown/complain_type_lists");
//        $arr_data['data_filter'] = api_call_get($url);
        /*$url = base_url('/api/complaint/total_row/overall/'.$overall.'/user_id/'.$user_data_id['userid']);
        $total_row = api_call_get($url);
        $arr_data['total_row'] = $total_row;*/
//        $url = base_url('/api/complaint/dashboard/overall/'.$overall.'/user_id/'.$user_data_id['userid'].'/page/'.$page);
        $url = base_url('/api/complaint/dashboard_last_month/overall/' . $overall . '/user_id/' . $user_data_id['userid'] . $queryFilter.$check_no_status);
        $arr_data['data'] = api_call_get($url);
        if (isset($arr_data['data']['status'])) {
            $arr_data['data'] = [];
//            $arr_data['total_row'] = 0;
        }
//        $arr_data['start_row'] = (($page-1)*15)+1;
        $arr_data['start_row'] = 1;

        $url = base_url("api/dropdown/send_org_parent_lists/0");
        $arr_data['send_org_parent'] = api_call_get($url);

        $url = base_url("api/dropdown/send_org_lists");
        $arr_data['send_org'] = api_call_get($url);

        $url = base_url("api/dropdown/channel_lists");
        $arr_data['channel'] = api_call_get($url);

        $url = base_url("api/dropdown/subject_lists");
        $arr_data['subject'] = api_call_get($url);

        $url = base_url("api/dropdown/complain_type_lists//parent_id/0");
        $arr_data['complain_type'][] = api_call_get($url);

        if($arr_data['txtDetail']==''){
            $date = new DateTime('now');
            $date->modify('last day of this month');
            $firstDate =  date_thai(date("Y-m-1"));
            $lastDate =  date_thai($date->format('Y-m-d'));
            $arr_data['txtDetail'] = "ข้อมูล วันที่ {$firstDate} ถึง วันที่ {$lastDate}";
        }

        //start แบ่งหน้า
        //$this->load->library('pagination');
        /*$config['base_url'] = base_url() . 'complaint/dashboard';
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
        $arr_data['pagination'] = $this->pagination->create_links();*/
        //end แบ่งหน้า

        $this->libraries->template('complaint/dashboard', $arr_data);
    }

    public function getDataReceived($id)
    {
        $url = base_url("api/complaint/key_in/" . $id);
        $arr_data['data_received'] = api_call_get($url);
        $result = $arr_data['data_received'];
        echo json_encode($result);
        exit;
    }

    public function view_detail($id)
    {
        $url = base_url("api/complaint/key_in/" . $id);
        $arr_data['key_in_data'] = api_call_get($url);

        $arr_data['get_accused_type'] = $this->accused_type->sort_accused($arr_data['key_in_data']['accused_type_id']);
        $arr_data['get_complain_type'] = $this->complain_type->sort_complain_type($arr_data['key_in_data']['complain_type_id']);

        $url = base_url("api/complaint/user_detail/idcard/".$arr_data['key_in_data']['id_card']);
        $arr_data['user_detail'] = api_call_get($url);
        $url = base_url("api/complaint/user_detail/id/".$arr_data['key_in_data']['create_user_id']);
        $arr_data['create_user_detail'] = api_call_get($url);
        $url = base_url("api/complaint/user_detail/id/".$arr_data['key_in_data']['update_user_id']);
        $arr_data['update_user_detail'] = api_call_get($url);
        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);
        $url = base_url("api/dropdown/ccaa_lists/Aumpur/");
        $arr_data['district_list'] = api_call_get($url);
        $url = base_url("api/dropdown/ccaa_lists/Tamboon/");
        $arr_data['subdistrict_list'] = api_call_get($url);
        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type'] = api_call_get($url);
        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);
        $url = base_url("api/complaint/result/".$id);
        $arr_data['result'] = api_call_get($url);
        $url = base_url("api/dropdown/accused_type_lists");
        $arr_data['accused_type_all'] = api_call_get($url);
        //echo"<pre>";print_r($arr_data['result']);echo"</pre>";
        $this->libraries->template('complaint/view_detail', $arr_data);
    }

    public function getDataSend($id)
    {
        $url = base_url("api/complaint/key_in/" . $id);
        $arr_data['data_send'] = api_call_get($url);
        $result = $arr_data['data_send'];
        echo json_encode($result);
        exit;
    }

    public function get_district_list($type, $id, $default = '')
    {
        $url = base_url("api/dropdown/ccaa_lists/" . $type . "/" . $id);
        $arr_data['type'] = $type;
        $arr_data['district_list'] = api_call_get($url);
        $this->load->view('complaint/get_district_list', $arr_data);
    }

    public function getDataResult($id)
    {
        $url = base_url("api/complaint/result/" . $id);
        $arr_data['data_result'] = api_call_get($url);
        $result = $arr_data['data_result'];
        echo json_encode($result);
    }

    public function pdf_detail($id)
    {
        //load the view and saved it into $html variable
        $url = base_url("api/complaint/key_in/" . $id);
        $arr_data['key_in_data'] = api_call_get($url);

        $arr_data['get_accused_type'] = $this->accused_type->sort_accused($arr_data['key_in_data']['accused_type_id']);
        $arr_data['get_complain_type'] = $this->complain_type->sort_complain_type($arr_data['key_in_data']['complain_type_id']);

        $url = base_url("api/complaint/user_detail/idcard/".$arr_data['key_in_data']['id_card']);
        $arr_data['user_detail'] = api_call_get($url);
        $url = base_url("api/complaint/user_detail/id/".$arr_data['key_in_data']['create_user_id']);
        $arr_data['create_user_detail'] = api_call_get($url);
        $url = base_url("api/complaint/user_detail/id/".$arr_data['key_in_data']['update_user_id']);
        $arr_data['update_user_detail'] = api_call_get($url);
        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);
        $url = base_url("api/dropdown/ccaa_lists/Aumpur/");
        $arr_data['district_list'] = api_call_get($url);
        $url = base_url("api/dropdown/ccaa_lists/Tamboon/");
        $arr_data['subdistrict_list'] = api_call_get($url);
        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type'] = api_call_get($url);
        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);
        $url = base_url("api/complaint/result/".$id);
        $arr_data['result'] = api_call_get($url);
        $url = base_url("api/dropdown/accused_type_lists");
        $arr_data['accused_type_all'] = api_call_get($url);
        $html = $this->load->view('complaint/pdf_detail', $arr_data, true);
        // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/

        $this->my_mpdf->SetDisplayMode('fullpage');
        $this->my_mpdf->list_indent_first_level = 0;
        //$stylesheet = file_get_contents(APPPATH.'third_party/mpdf/css/mpdfstyletables.css');
        //$this->mpdf->WriteHTML($stylesheet, 1);
        $this->my_mpdf->WriteHTML($html, 2);
        $this->my_mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }

    public function get_accused_child($id,$count_acc)
    {
        $url = base_url("api/dropdown/accused_type_lists/".$id);
        $arr_data['accused_type_lists'] = api_call_get($url);
        $arr_data['count_acc'] = $count_acc;
        $this->load->view('complaint/get_accused_child', $arr_data);
    }
    public function get_complain_type_child($id,$count_type)
    {
        $url = base_url("api/dropdown/complain_type_lists//parent_id/".$id);
        $arr_data['complain_type_lists'] = api_call_get($url);
        $arr_data['count_type'] = $count_type;
        $this->load->view('complaint/get_complain_type_child', $arr_data);
    }
    public function get_send_org_child($id,$count_type)
    {
        $url = base_url("api/dropdown/send_org_parent_lists/".$id);
        $arr_data['lists'] = api_call_get($url);
        $arr_data['count_type'] = $count_type;
        $this->load->view('complaint/get_send_org_child', $arr_data);
    }

    public function get_send_org($id)
    {
        $url = base_url("api/dropdown/send_org_parent_lists/0");
        $arr_data['send_org'][] = api_call_get($url);
        if($id!='') {
            $arr_data['get_send_org'] = $this->send_org->sort_send_org($id);
            foreach ($arr_data['get_send_org'] as $key => $value) {
                $url = base_url("api/dropdown/send_org_parent_lists/" . $value);
                $send_org = api_call_get($url);
                if (!array_key_exists('message', $send_org)) {
                    $arr_data['send_org'][] = $send_org;
                }
            }
        }
        $this->load->view('complaint/get_send_org', $arr_data);
    }

    public function key_in_step5_pdf($id)
    {
        $url = base_url("api/dropdown/channel_lists");
        $arr_data['channel'] = api_call_get($url);

        $url = base_url("api/dropdown/subject_lists");
        $arr_data['subject'] = api_call_get($url);

        $url = base_url("api/dropdown/wish_lists");
        $arr_data['wish'] = api_call_get($url);

        $url = base_url("api/dropdown/title_name_lists");
        $arr_data['title_name'] = api_call_get($url);

        $arr_data['key_in_data'] = [];

        $url = base_url("api/complaint/key_in/" . $id);
        $arr_data['key_in_data'] = api_call_get($url);
        $arr_data['id'] = $id;

        $url = base_url("api/dropdown/accused_type_lists/0");
        $arr_data['accused_type'][] = api_call_get($url);
        if($arr_data['key_in_data']['accused_type_id']!='') {
            $arr_data['get_accused_type'] = $this->accused_type->sort_accused($arr_data['key_in_data']['accused_type_id']);
            foreach ($arr_data['get_accused_type'] as $key => $value) {
                $url = base_url("api/dropdown/accused_type_lists/" . $value);
                $accused_type = api_call_get($url);
                if (!array_key_exists('message', $accused_type)) {
                    $arr_data['accused_type'][] = $accused_type;
                }
            }
        }

        $url = base_url("api/dropdown/complain_type_lists//parent_id/0");
        $arr_data['complain_type'][] = api_call_get($url);
        if($arr_data['key_in_data']['accused_type_id']!='') {
            $arr_data['get_complain_type'] = $this->complain_type->sort_complain_type($arr_data['key_in_data']['complain_type_id']);
            foreach ($arr_data['get_complain_type'] as $key => $value) {
                $url = base_url("api/dropdown/complain_type_lists//parent_id/" . $value);
                $complain_type = api_call_get($url);
                if (!array_key_exists('message', $complain_type)) {
                    $arr_data['complain_type'][] = $complain_type;
                }
            }
        }

        $url = base_url("api/complaint/user_detail/idcard/".$arr_data['key_in_data']['id_card']);
        $arr_data['user_detail'] = api_call_get($url);
        //echo"<pre>";print_r($arr_data['user_detail'] );echo"</pre>";exit;

        $url = base_url("api/dropdown/accused_type_lists");
        $arr_data['accused_type_all'] = api_call_get($url);

        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type_all'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists");
        $arr_data['ccaa_all'] = api_call_get($url);

        $html = $this->load->view('complaint/key_in_step5_pdf', $arr_data, true);
        // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/

        $this->my_mpdf->SetDisplayMode('fullpage');
        $this->my_mpdf->list_indent_first_level = 0;
        //$stylesheet = file_get_contents(APPPATH.'third_party/mpdf/css/mpdfstyletables.css');
        //$this->mpdf->WriteHTML($stylesheet, 1);
        $this->my_mpdf->WriteHTML($html, 2);
        $this->my_mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }
}

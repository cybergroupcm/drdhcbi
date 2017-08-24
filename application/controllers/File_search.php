<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class File_search extends CI_Controller
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

    public function dashboard()
    {
        $url = base_url("api/dropdown/send_org_parent_lists/0");
        $arr_data['send_org_parent'] = api_call_get($url);

        $url = base_url("api/dropdown/send_org_lists");
        $arr_data['send_org'] = api_call_get($url);

        $url = base_url("api/dropdown/channel_lists");
        $arr_data['channel'] = api_call_get($url);

        $url = base_url("api/dropdown/subject_lists");
        $arr_data['subject'] = api_call_get($url);

        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);

        $url = base_url("api/dropdown/complain_type_lists//parent_id/0");
        $arr_data['complain_type'][] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

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
                    case 'complain_type_id':
                        $url = base_url("api/dropdown/complain_type_lists");
                        $complain_type = api_call_get($url);
                        $arr_data['txtDetail'] .= " ประเภทเรื่องร้องทุกข์ {$complain_type[$item]}";
                        break;
                    case 'channel_id':
                        $arr_data['txtDetail'] .= " ช่องทางร้องทุกข์ {$arr_data['channel'][$item]}";
                        break;
                    case 'subject_id':
                        $arr_data['txtDetail'] .= " ลักษณะเรื่องร้องทุกข์ {$arr_data['subject'][$item]}";
                        break;
                    case 'current_status':
                        $arr_data['txtDetail'] = "สถานะ {$arr_data['current_status'][$item]}";
                        break;
                    case 'province_id':
                        $url = base_url("api/dropdown/ccaa_lists/Changwat/{$item}");
                        $province = api_call_get($url);
                        $arr_data['txtDetail'] .= "พื้นที่ จังหวัด{$province[$item]}";
                        break;
                    case 'district_id':
                        $url = base_url("api/dropdown/ccaa_lists/Aumpur/{$item}");
                        $district = api_call_get($url);
                        $arr_data['txtDetail'] = rtrim($arr_data['txtDetail'], ' และ ');
                        $arr_data['txtDetail'] .= " อำเภอ{$district[$item]}";
                        break;
                    case 'address_id':
                        $url = base_url("api/dropdown/ccaa_lists/Tamboon/{$item}");
                        $address = api_call_get($url);
                        $arr_data['txtDetail'] = rtrim($arr_data['txtDetail'], ' และ ');
                        $arr_data['txtDetail'] .= " ตำบล{$address[$item]}";
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
                    case 'time_start':
                        $dateText = $item;
                        $arr_data['txtDetail'] .= " ช่วงเวลา {$dateText}";
                        break;
                    case 'time_end':
                        $dateText = $item;
                        $arr_data['txtDetail'] .= " ถึงเวลา {$dateText}";
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

        $url = base_url('/api/complaint/dashboard_last_month/overall/' . $overall . '/user_id/' . $user_data_id['userid'] . $queryFilter.$check_no_status);
        $arr_data['data'] = api_call_get($url);
        if (isset($arr_data['data']['status'])) {
            $arr_data['data'] = [];
        }
        foreach($arr_data['data'] as $key => $value){
                $arr_data['data'][$key]['complain_type'] = $this->complain_type->sort_complain_type($value['complain_type_id']);
        }

        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type_all'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists");
        $arr_data['ccaa_all'] = api_call_get($url);

        $arr_data['start_row'] = 1;


        if($arr_data['txtDetail']==''){
            $date = new DateTime('now');
            $date->modify('last day of this month');
            $firstDate =  date_thai(date("Y-m-1"));
            $lastDate =  date_thai($date->format('Y-m-d'));
            $arr_data['txtDetail'] = "ข้อมูล วันที่ {$firstDate} ถึง วันที่ {$lastDate}";
        }

        $this->libraries->template('file_search/dashboard', $arr_data);
    }
    function show_file($keyin_id){
        $url = base_url("api/complaint/key_in/" . $keyin_id);
        $arr_data['key_in_data'] = api_call_get($url);
        $this->load->view('file_search/show_file', $arr_data);
    }
}

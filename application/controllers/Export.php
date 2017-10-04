<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Bangkok');
        parent::__construct();

        /* Load :: Common */
        $this->load->helper(array('form'));
        $this->load->library(array('accused_type','complain_type','send_org'));
        $this->load->model('master/Ccaa_model');
        if ( ! $this->ion_auth->logged_in() || !$this->api_auth->logged_in())
        {
            redirect('alert', 'refresh');
        }
    }

    public function xml(){
        $this->load->library('MY_Xml_writer');
        // Initiate class
        $xml = new MY_Xml_writer;
        $xml->setRootName('data');
        $xml->initiate();

        // Start branch 1
//        $xml->startBranch('cars');

        // Set branch 1-1 and its nodes
        $xml->startBranch('complaint', array('no' => '1')); // start branch 1-1
        $xml->addNode('idcard', 'รหัสประจำตัวประชาชน');
        $xml->addNode('name', 'ชื่อ - นามสกุล');
        $xml->addNode('gender', 'เพศ');
        $xml->addNode('birthdate', 'วันเกิด');
        $xml->addNode('religion', 'ศาสนา');
        $xml->addNode('nationality', 'สัญชาติ');
        $xml->addNode('origin', 'เชื้อชาติ');
        $xml->addNode('home_addr', 'บ้านเลขที่ (ภูมิลำเนา)');
        $xml->addNode('home_province', 'จังหวัด (ภูมิลำเนา)');
        $xml->addNode('home_district', 'อำเภอ (ภูมิลำเนา)');
        $xml->addNode('home_subdistrict', 'ตำบล (ภูมิลำเนา)');
        $xml->addNode('home_country', 'ประเทศ (ภูมิลำเนา)');
        $xml->addNode('present_addr', 'บ้านเลขที่ (ปัจจุบัน)');
        $xml->addNode('present_province', 'จังหวัด (ปัจจุบัน)');
        $xml->addNode('present_district', 'อำเภอ (ปัจจุบัน)');
        $xml->addNode('present_subdistrict', 'ตำบล (ปัจจุบัน)');
        $xml->addNode('present_country', 'ประเทศ (ปัจจุบัน)');


        $xml->startBranch('relations', array('type' => 'ผู้เกี่ยวข้อง')); // start branch
        $xml->startBranch('relation', array('no' => '1')); // start branch
        $xml->addNode('name', 'ชื่อ - นามสกุล');
        $xml->addNode('phone', 'เบอร์โทรศัพท์');
        $xml->addNode('addr', 'ที่อยู่');
        $xml->endBranch();
        $xml->endBranch();

        $xml->addNode('found_addr', 'สถานที่พบตัว');

        $xml->startBranch('dwells'); // start branch
        $xml->startBranch('dwell', array('no' => '1')); // start branch
        $xml->addNode('ORGNAME', 'หน่วยงานให้ความช่วยเหลือ');
        $xml->addNode('STAY_DATE', 'วันที่ให้ตัวช่วยเหลือ');
        $xml->addNode('STAY_TYPE', 'สภาพปัญหา/สาเหตุการรับเข้า');
        $xml->addNode('STAY_USER', 'ชื่อผู้รับเข้า');
        $xml->addNode('RESIGN_DATE', 'วันที่จำหน่าย');
        $xml->addNode('RESIGN_TYPE', 'สาเหตุการจำหน่าย');
        $xml->addNode('RESIGN_USER', 'ชื่อผู้จำหน่าย');
        $xml->endBranch();
        $xml->endBranch();
        $xml->startBranch('activities', array('type' => 'กิจกรรม')); // start branch
        $xml->startBranch('activity', array('no' => '1')); // start branch
        $xml->addNode('program', 'โปรแกรม/กิจกรรมการให้ความช่วยเหลือ');
        $xml->addNode('org', 'หน่วยงานให้ความช่วยเหลือ');
        $xml->addNode('date', 'วันที่ให้ความช่วยเหลือ');
        $xml->endBranch();
        $xml->endBranch();


        $xml->endBranch();

        // Set branch 1-1 and its nodes
//        $xml->startBranch('car', array('country' => 'usa')); // start branch 1-1
//        $xml->addNode('make', 'Ford');
//        $xml->addNode('model', 'T-Ford', array(), true);
//        $xml->endBranch();

        // Set branch 1-2 and its nodes
//        $xml->startBranch('car', array('country' => 'Japan')); // start branch
//        $xml->addNode('make', 'Toyota');
//        $xml->addNode('model', 'Corolla', array(), true);
//        $xml->endBranch();

        // End branch 1
//        $xml->endBranch();

        // Start branch 2
//        $xml->startBranch('bikes'); // start branch

        // Set branch 2-1  and its nodes
//        $xml->startBranch('bike', array('country' => 'usa')); // start branch
//        $xml->addNode('make', 'Harley-Davidson');
//        $xml->addNode('model', 'Soft tail', array(), true);
//        $xml->endBranch();

        // End branch 2
//        $xml->endBranch();

        // Print the XML to screen
        $xml->getXml(true);
    }

    public function complaint($id){
        if($id){
            $url = base_url("api/complaint/export_xml/id/" . $id);
            $export_data[0] = api_call_get($url);
        }else{
            $url = base_url("api/complaint/export_xml/");
            $export_data = api_call_get($url);
        }
        /*echo '<pre>';
        print_r($export_data);
        echo '</pre>';*/

        $this->load->library('MY_Xml_writer');
        // Initiate class
        $xml = new MY_Xml_writer;
        $xml->setRootName('data');
        $xml->initiate();

        // Start branch 1
//        $xml->startBranch('cars');
        foreach ($export_data as $key => $value) {
            if(!is_null($value['address_id'])){
                $province = $this->Ccaa_model->as_array()->get(substr($value['address_id'],0,2).'000000');
                $district = $this->Ccaa_model->as_array()->get(substr($value['address_id'],0,4).'0000');
                $subdistrict = $this->Ccaa_model->as_array()->get(substr($value['address_id']));
            }
            // Set branch 1-1 and its nodes
            $xml->startBranch('complaint', array('no' => $key)); // start branch 1-1
            $xml->addNode('no', $value['complain_no']);
            $xml->addNode('date', $value['complain_date']);
            $xml->addNode('name', $value['complaint_name']);
            $xml->addNode('detail', $value['complaint_detail']);
            $xml->addNode('channel', $value['channel'][0]['channel_name']);
            $xml->addNode('scene_date', $value['scene_date']);
            $xml->addNode('place_scene', $value['place_scene']);
            $xml->addNode('accused_name', $value['accused_name']);

            $xml->startBranch('location'); // start branch
            $xml->addNode('province', $province['ccName']);
            $xml->addNode('district', $district['ccName']);
            $xml->addNode('subdistrict', $subdistrict['ccName']);
            $xml->addNode('latitude', $value['latitude']);
            $xml->addNode('longitude', $value['longitude']);
            $xml->endBranch();



            $xml->startBranch('complainer'); // start branch
            if($value['user_complain_type_id']=='2'){
                $xml->addNode('idcard', $value['id_card']);
                $xml->addNode('name', "{$value['title_name'][0]['prename']}{$value['first_name']}   {$value['last_name']}");
                $xml->addNode('phone_number', $value['phone_number']);
            }else{
                $xml->addNode('idcard','');
                $xml->addNode('name', 'ไม่ประสงค์ออกนาม');
                $xml->addNode('phone_number', '');
            }
            $xml->endBranch();
            $xml->endBranch();

        }

        // Print the XML to screen
        $xml->getXml(true);
    }

}

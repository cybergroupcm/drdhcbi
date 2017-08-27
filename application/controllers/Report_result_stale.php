<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_result_stale extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper(array('form'));
        $this->load->library('my_mpdf');
        if ( ! $this->ion_auth->logged_in() || !$this->api_auth->logged_in())
        {
            redirect('alert', 'refresh');
        }
    }
    
    public function view()
    {
        //echo 'AA';
        //exit;
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$_GET['year'];
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status".$param;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status_max/".$_GET['year'];
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['main_data'] = array(
            '1'=>'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.2558  และสามารถแก้ไขปัญหาจนได้ข้อยุติ  ในปีงบประมาณ พ.ศ.2559',
            '2'=>'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.2559 และสามารถแก้ไขปัญหาจนได้ข้อยุติในปีงบประมาณ พ.ศ.2560'
        );
        $arr_data['sub_data'] = array(
            '1'=>array(
                '1'=>'เรื่องเข้าทั้งหมดปี ๕๘',
                '2'=>'ดำเนินการจนได้ข้อยุติปี ๕๘-๕๙',
                '3'=>'เรื่องค้างทั้งหมดปีงบ ๕๘-๕๙',
                '4'=>'เรื่องยุติในเดือนนี้',
                '5'=>'คงเหลือ'
            ),
            '2'=>array(
                '1'=>'เรื่องเข้าทั้งหมดปี ๕๙',
                '2'=>'ดำเนินการจนได้ข้อยุติปี ๕๙',
                '3'=>'เรื่องค้างทั้งหมดปีงบ ๕๙',
                '4'=>'เรื่องยุติในเดือนนี้',
                '5'=>'คงเหลือ'
            ));
        $arr_data['sub_detail_report'] = array(
            '1'=>array(
                '1'=>'200',
                '7'=>'30',
                '12'=>'50',
                '17'=>'10',
                '22'=>'3',
                '26'=>'300'
            ),
            '2'=>array(
                '1'=>'20',
                '7'=>'40',
                '12'=>'80',
                '17'=>'10',
                '22'=>'14',
                '26'=>'32'
            ),
            '3'=>array(
                '1'=>'45',
                '7'=>'60',
                '12'=>'98',
                '17'=>'99',
                '22'=>'12',
                '26'=>'40'
            ),
            '4'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
            '5'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),

        );
        $arr_data['sub_detail_remain'] = array(
            '1'=>array(
                '1'=>'100',
                '7'=>'102',
                '12'=>'35',
                '17'=>'20',
                '22'=>'32',
                '26'=>'66'
            ),
            '2'=>array(
                '1'=>'12',
                '7'=>'65',
                '12'=>'32',
                '17'=>'74',
                '22'=>'75',
                '26'=>'89'
            ),
            '3'=>array(
                '1'=>'24',
                '7'=>'26',
                '12'=>'32',
                '17'=>'64',
                '22'=>'12',
                '26'=>'40'
            ),
            '4'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
            '5'=>array(
                '1'=>'0',
                '7'=>'0',
                '12'=>'0',
                '17'=>'0',
                '22'=>'0',
                '26'=>'0'
            ),
        );

        $condition = array('yy' => '2017', 'mm' => '7');

        //$arr_data['report_state'] = $this->db->from('report_result_all')->where($condition)->group_by('complaint_type_id')->get()->result_array();


        $this->libraries->report('report_result_stale/view', $arr_data);
    }
//    public function pdf(){
//
//    }
/*
    public function pdf(){
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$_GET['year'];
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status".$param;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status_max/".$_GET['year'];
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $html=$this->load->view('report_result_progress/pdf',$arr_data, true);

        $mpdf=new mPDF('th','A4-L',0,'THSaraban',15,15,16,16,9,9, 'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }

    public function excel(){
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $url = base_url("api/dropdown/current_status_lists");
        $arr_data['current_status'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$_GET['year'];
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status".$param;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_status_max/".$_GET['year'];
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $this->load->view('report_result_progress/excel',$arr_data);
    }*/


}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_result_stale extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->model('data/Key_in_model');
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
        if($_GET['yy'] != ""){
            $yy = $_GET['yy'];
        }else{
            $yy = date('Y');
        }

        if($_GET['mm'] != ""){
            $mm = $_GET['mm'];
        }else{
            $mm = date('m');
        }

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

        $arr_data['main_data'] = array();
        $arr_year_temp = array();
        $index_main = 0;
        for($i=2;$i>0;$i--){
            $index_main++;
            $con_year_start = ($yy-$i);
            $con_year_end = ($yy-($i-1));
            $start_year = ($con_year_start+543);
            $end_year = ($con_year_end+543);
            $arr_data['main_data'][$index_main] = 'เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.'.$start_year.'  และสามารถแก้ไขปัญหาจนได้ข้อยุติ  ในปีงบประมาณ พ.ศ.'.$end_year;
            $arr_year_temp[$index_main]['year_start'] = substr($start_year,2,2);
            $arr_year_temp[$index_main]['year_end'] = substr($end_year,2,2);

            $sql = "SELECT
                        num_receive,
                        num_succes,
                        num_wait,
                        num_in_month,
                        (num_wait-num_in_year) AS num_remain,
                        complain_type_id
                    FROM
                        (
                            SELECT
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') ), 1, 0 )) AS num_receive,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$con_year_end."')), 1, 0 )) AS num_succes,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( ( ( current_status_id = 1 || current_status_id = 2 ) && (yy = '".$con_year_start."') ) || ( current_status_id != 1 && current_status_id != 2 ) && (yy > '".$con_year_end."'))), 1, 0 )) AS num_wait,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$yy."' && mm = '".$mm."')), 1, 0 )) AS num_in_month,
                    SUM( IF (((YEAR(receive_date) = '".$con_year_start."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$yy."' && mm <= '".$mm."')), 1, 0 )) AS num_in_year,
                                complain_type_id
                            FROM
                                `report_result_all`
                            WHERE
                                YEAR (receive_date) = '".$con_year_start."'
                            GROUP BY
                                complain_type_id
                        ) AS t1";
            $data = $this->db->query($sql);
            $report_data = $data->result_array();
            foreach($report_data as $key => $value){
                $arr_data['sub_detail_report'][$index_main][1][$value['complain_type_id']] = $value['num_receive'];
                $arr_data['sub_detail_report'][$index_main][2][$value['complain_type_id']] = $value['num_succes'];
                $arr_data['sub_detail_report'][$index_main][3][$value['complain_type_id']] = $value['num_wait'];
                $arr_data['sub_detail_report'][$index_main][4][$value['complain_type_id']] = $value['num_in_month'];
                $arr_data['sub_detail_report'][$index_main][5][$value['complain_type_id']] = $value['num_remain'];
            }

        }

        $arr_title_sub = array(
            '1'=>'เรื่องเข้าทั้งหมดปี ',
            '2'=>'ดำเนินการจนได้ข้อยุติปี ',
            '3'=>'เรื่องค้างทั้งหมดปีงบ ',
            '4'=>'เรื่องยุติในเดือนนี้',
            '5'=>'คงเหลือ'
        );
        $arr_data['sub_data'] = array(
//            '1'=>array(
//                '1'=>'เรื่องเข้าทั้งหมดปี ๕๘',
//                '2'=>'ดำเนินการจนได้ข้อยุติปี ๕๘-๕๙',
//                '3'=>'เรื่องค้างทั้งหมดปีงบ ๕๘-๕๙',
//                '4'=>'เรื่องยุติในเดือนนี้',
//                '5'=>'คงเหลือ'
//            ),
//            '2'=>array(
//                '1'=>'เรื่องเข้าทั้งหมดปี ๕๙',
//                '2'=>'ดำเนินการจนได้ข้อยุติปี ๕๙',
//                '3'=>'เรื่องค้างทั้งหมดปีงบ ๕๙',
//                '4'=>'เรื่องยุติในเดือนนี้',
//                '5'=>'คงเหลือ'
//            )
        );
        foreach($arr_year_temp as $key => $value){
            $arr_temp_sub = array();
                foreach($arr_title_sub as $key_title => $value_title){
                    if($key_title == 1 || $key_title == 2 || $key_title == 3){
                        $arr_temp_sub[$key_title] = $value_title.$value['year_start'];
                    }else{
                        $arr_temp_sub[$key_title] = $value_title;
                    }

                }


            $arr_data['sub_data'][$key] = $arr_temp_sub;
        }

        //echo "<pre>";
        //print_r( $arr_data['sub_detail_report']);
        //die();

//        $arr_data['sub_detail_report'] = array(
//            '1'=>array(
//                '1'=>'200',
//                '7'=>'30',
//                '12'=>'50',
//                '17'=>'10',
//                '22'=>'3',
//                '26'=>'300'
//            ),
//            '2'=>array(
//                '1'=>'20',
//                '7'=>'40',
//                '12'=>'80',
//                '17'=>'10',
//                '22'=>'14',
//                '26'=>'32'
//            ),
//            '3'=>array(
//                '1'=>'45',
//                '7'=>'60',
//                '12'=>'98',
//                '17'=>'99',
//                '22'=>'12',
//                '26'=>'40'
//            ),
//            '4'=>array(
//                '1'=>'0',
//                '7'=>'0',
//                '12'=>'0',
//                '17'=>'0',
//                '22'=>'0',
//                '26'=>'0'
//            ),
//            '5'=>array(
//                '1'=>'0',
//                '7'=>'0',
//                '12'=>'0',
//                '17'=>'0',
//                '22'=>'0',
//                '26'=>'0'
//            ),
//
//        );
//        $arr_data['sub_detail_remain'] = array(
//            '1'=>array(
//                '1'=>'100',
//                '7'=>'102',
//                '12'=>'35',
//                '17'=>'20',
//                '22'=>'32',
//                '26'=>'66'
//            ),
//            '2'=>array(
//                '1'=>'12',
//                '7'=>'65',
//                '12'=>'32',
//                '17'=>'74',
//                '22'=>'75',
//                '26'=>'89'
//            ),
//            '3'=>array(
//                '1'=>'24',
//                '7'=>'26',
//                '12'=>'32',
//                '17'=>'64',
//                '22'=>'12',
//                '26'=>'40'
//            ),
//            '4'=>array(
//                '1'=>'0',
//                '7'=>'0',
//                '12'=>'0',
//                '17'=>'0',
//                '22'=>'0',
//                '26'=>'0'
//            ),
//            '5'=>array(
//                '1'=>'0',
//                '7'=>'0',
//                '12'=>'0',
//                '17'=>'0',
//                '22'=>'0',
//                '26'=>'0'
//            ),
//        );

        //$condition = array('yy' => '2017', 'mm' => '7');

        //$arr_data['report_state'] = $this->db->from('report_result_all')->where($condition)->group_by('complaint_type_id')->get()->result_array();
        $arr_data['data_detail']['year'] = $yy;
        $arr_data['data_detail']['month'] = $mm;
        $arr_data['data_detail']['month_name'] = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน","05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฎาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");

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
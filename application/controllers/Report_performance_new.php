<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_performance_new extends CI_Controller {

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

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

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

        $yearTh = ($yy+543);

        $arr_data['year_th'] = $yearTh;
        $arr_data['yy'] = $yy;
        $arr_data['mm'] = $mm;
        $arr_data['month_name'] = array(1=>"มกราคม",2=>"กุมภาพันธ์",3=>"มีนาคม",4=>"เมษายน",5=>"พฤษภาคม",6=>"มิถุนายน",7=>"กรกฎาคม",8=>"สิงหาคม",9=>"กันยายน",10=>"ตุลาคม",11=>"พฤศจิกายน",12=>"ธันวาคม");

        $sql = " SELECT
                        num_in_last_month,
                        num_in_now_month,
                        num_success_in_now_month,
                        num_in_last_month+num_in_now_month AS num_remain,
                        complain_type_id
                FROM
                        (
                                SELECT
                SUM( IF (((YEAR(receive_date) = '".$yy."') && ( current_status_id = 1 || current_status_id = 2 ) && (yy = '".$yy."' && mm = '".$mm."')), 1, 0 )) AS num_in_last_month,
                SUM( IF (((YEAR(receive_date) = '".$yy."') && ( current_status_id = 1 || current_status_id = 2 ) && (yy = '".$yy."' && mm = '".$mm."')), 1, 0 )) AS num_in_now_month,
                SUM( IF (((YEAR(receive_date) = '".$yy."') && ( current_status_id != 1 && current_status_id != 2 ) && (yy = '".$yy."' && mm = '".$mm."' )), 1, 0 )) AS num_success_in_now_month,
                complain_type_id
                                FROM
                                        `report_result_all`
                                WHERE
                                        budget = '".$yy."'
                                GROUP BY
                                        complain_type_id
                        ) AS t1 ";
        $data = $this->db->query($sql);
        $report_data = $data->result_array();
        $arr_data['outstanding_month'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        $arr_data['incoming_month'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        $arr_data['remain'] = array('1'=>0,'7'=>0,'12'=>'0','17'=>'0','22'=>'0','26'=>'0');
        foreach($report_data as $key => $value){
            $arr_data['outstanding_month'][$value['complain_type_id']] = $value['num_in_last_month'];
            $arr_data['incoming_month'][$value['complain_type_id']] = $value['num_in_now_month'];
            $arr_data['terminate_month'][$value['complain_type_id']] = $value['num_success_in_now_month'];
            $arr_data['remain'][$value['complain_type_id']] = $value['num_remain'];
        }

//        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
//        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
//        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
//        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
//        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');

        $this->libraries->report('report_performance_new/view', $arr_data);
    }
}

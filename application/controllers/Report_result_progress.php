<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_result_progress extends CI_Controller {

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

        $this->libraries->template('report_result_progress/view', $arr_data);
    }
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
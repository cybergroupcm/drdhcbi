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

        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');

        $this->libraries->report('report_performance_new/view', $arr_data);
    }

    public function pdf(){
        $param = ($_GET['year'] !="")?"/year/".$_GET['year']:"";
        $param .= ($_GET['current_status_id'] !="")?"/current_status_id/".$_GET['current_status_id']:"";
        $param .= ($_GET['partid'] !="")?"/partid/".$_GET['partid']:"";
        $param .= ($_GET['province_id'] !="")?"/province_id/".$_GET['province_id']:"";
        $param .= ($_GET['district_id'] !="")?"/district_id/".$_GET['district_id']:"";
        $param .= ($_GET['address_id'] !="")?"/address_id/".$_GET['address_id']:"";

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');

        $html=$this->load->view('report_performance_new/pdf',$arr_data, true);

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

        $url = base_url("api/dropdown/complain_type_lists/parent_id/0");
        $arr_data['complaint_type'] = api_call_get($url);

        $arr_data['outstanding_month'] = array('1'=>'28','7'=>'36','12'=>'0','17'=>'8','22'=>'5','26'=>'4');
        $arr_data['incoming_month'] = array('1'=>'7','7'=>'82','12'=>'0','17'=>'17','22'=>'11','26'=>'0');
        $arr_data['incoming_cumulative_month'] = array('1'=>'205','7'=>'882','12'=>'15','17'=>'160','22'=>'87','26'=>'41');
        $arr_data['terminate_month'] = array('1'=>'31','7'=>'89','12'=>'0','17'=>'14','22'=>'12','26'=>'0');
        $arr_data['terminate_cumulative_month'] = array('1'=>'201','7'=>'853','12'=>'15','17'=>'149','22'=>'83','26'=>'37');

        $this->load->view('report_performance_new/excel',$arr_data);
    }


}

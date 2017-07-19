<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        //$this->load->helper('cookie');
        $this->load->helper('form');
        $this->load->helper(array('html', 'url', 'api'));
        //$this->load->model('complaint_model');
        $this->load->helper('dateformat');
        $this->load->library('my_mpdf');
    }

    public function report_all_complaint()
    {
        $url = base_url('api/dropdown/complain_type_lists');
        $arr_data['complaint_type'] = api_call_get($url);
        $url = base_url('api/dropdown/channel_lists');
        $arr_data['channel'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        if(@$province_id!=''){
            $ccaa_code = substr(@$province_id, 0, 3);
            $url = base_url("api/dropdown/ccaa_lists/Aumpur/".$ccaa_code);
            $arr_data['district_list'] = api_call_get($url);
        }


        if(@$district_id!=''){
            $ccaa_code = substr(@$district_id, 0, 4);
            $url = base_url("api/dropdown/ccaa_lists/Tamboon/".$ccaa_code);
            $arr_data['subdistrict_list'] = api_call_get($url);
        }

        $url = base_url("api/report/report_all_complaint");

        $arr_data['data'] = api_call_get($url);
        //echo"<pre>";print_r($arr_data['data']);echo"</pre>";
        $this->libraries->template('report_all_complaint/report_all_complaint', $arr_data);
    }

    public function report_all_complaint_pdf()
    {
        $url = base_url('api/dropdown/complain_type_lists');
        $arr_data['complaint_type'] = api_call_get($url);
        $url = base_url('api/dropdown/channel_lists');
        $arr_data['channel'] = api_call_get($url);
        $url = base_url()."api/report/report_all_complaint";
        $arr_data['data'] = api_call_get($url);
        $html=$this->load->view('report_all_complaint/report_all_complaint_pdf',$arr_data, true);
        // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
//        echo "<pre>";
//        print_r($this->my_mpdf);
//        die();

        $mpdf=new mPDF('th','A4-L',0,'THSaraban',15,15,16,16,9,9, 'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        //$stylesheet = file_get_contents(APPPATH.'third_party/mpdf/css/mpdfstyletables.css');
        //$this->mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }
    

    public function report_by_channel()
    {
        $url = base_url('api/complaint/channel');
        $arr_data['channel'] = api_call_get($url);
        $this->libraries->template('report_by_channel/report_by_channel', $arr_data);
    }
    
    public function report_by_type()
    {
        $url = base_url('api/complaint/complaint_type');
        $arr_data['complaint_type'] = api_call_get($url);
        $this->libraries->template('report_by_type/report_by_type', $arr_data);
    }
    
    public function report_by_complainer()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_by_complainer/report_by_complainer', $arr_data);
    }
    
    public function report_by_complainant()
    {
        $url = base_url('api/complaint/accused_type');
        $arr_data['complainant'] = api_call_get($url);
        $this->libraries->template('report_by_complainant/report_by_complainant', $arr_data);
    }
    
    public function report_statistic_by_type($year='')
    {

        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$year;
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_type/".$year;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_type_max/".$year;
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $this->libraries->template('report_statistic_by_type/report_statistic_by_type', $arr_data);
    }
    
    public function report_statistic_by_status()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_statistic_by_status/report_statistic_by_status', $arr_data);
    }
    
    public function report_statistic_compare()
    {
        $url = base_url('api/complaint/complaint_type');
        $arr_data['complaint_type'] = api_call_get($url);
        $url = base_url('api/complaint/channel');
        $arr_data['channel'] = api_call_get($url);
        $this->libraries->template('report_statistic_compare/report_statistic_compare', $arr_data);
    }
    public function example_mpdf(){ 
        //load the view and saved it into $html variable
        $url = base_url('api/complaint/complaint_type');
        $arr_data['complaint_type'] = api_call_get($url);
        $url = base_url('api/complaint/channel');
        $arr_data['channel'] = api_call_get($url);
        $html=$this->load->view('report_all_complaint/report_all_complaint',$arr_data, true);
 	 // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
//        echo "<pre>";
//        print_r($this->my_mpdf);
//        die();
        $this->my_mpdf->SetDisplayMode('fullpage');
        $this->my_mpdf->list_indent_first_level = 0;
        //$stylesheet = file_get_contents(APPPATH.'third_party/mpdf/css/mpdfstyletables.css');
        //$this->mpdf->WriteHTML($stylesheet, 1);
        $this->my_mpdf->WriteHTML($html, 2);
        $this->my_mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }
    
    public function example_tcpdf(){
        $this->load->library("Pdf");
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        // Add a page
        $pdf->AddPage();
            
        $url = base_url('api/complaint/complaint_type');
        $arr_data['complaint_type'] = api_call_get($url);
        $url = base_url('api/complaint/channel');
        $arr_data['channel'] = api_call_get($url);
        //load the view and saved it into $html variable
        $html=$this->load->view('report_all_complaint/report_all_complaint',$arr_data, true);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output();
    }
    
    public function example_excel(){
        $arr_data = [];
        $this->load->view('report_all_complaint/report_all_complaint_excel',$arr_data);
    }

    public function report_statistic_by_type_pdf($year){
        $url = base_url("api/dropdown/complain_type_lists");
        $arr_data['complain_type'] = api_call_get($url);

        $url = base_url()."api/report/month_report/".$year;
        $arr_data['month_report'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_type/".$year;
        $arr_data['report_type'] = api_call_get($url);

        $url = base_url()."api/report/report_statistic_by_type_max/".$year;
        $arr_data['report_type_max'] = api_call_get($url);

        $url = base_url()."api/report/list_year/";
        $arr_data['list_year'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);

        $url = base_url("api/dropdown/area_part_lists");
        $arr_data['area_part_list'] = api_call_get($url);

        $html=$this->load->view('report_statistic_by_type/report_statistic_by_type_pdf',$arr_data, true);

        $mpdf=new mPDF('th','A4-L',0,'THSaraban',15,15,16,16,9,9, 'L');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->list_indent_first_level = 0;
        //$stylesheet = file_get_contents(APPPATH.'third_party/mpdf/css/mpdfstyletables.css');
        //$this->mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output('example_mpdf.pdf', 'I');

        //$this->my_mpdf->SetDisplayMode('fullpage');
        //$this->my_mpdf->list_indent_first_level = 0;
        //mpdf->WriteHTML($stylesheet,1);
        //$this->my_mpdf->WriteHTML($html, 2);
        //$this->my_mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        //$this->load->helper('cookie');
        //$this->load->helper('api');
        $this->load->helper('form');
        $this->load->model('complaint_model');
        $this->load->helper('dateformat');
        $this->load->library('mpdf');
    }

    public function report_all_complaint()
    {
        $url = "http://localhost/drdhcbi/api/complaint/complaint_type";
        $arr_data['complaint_type'] = api_call_get($url);
        $url = "http://localhost/drdhcbi/api/complaint/channel";
        $arr_data['channel'] = api_call_get($url);
        $this->libraries->template('report_all_complaint/report_all_complaint', $arr_data);
    }
    
    public function report_by_channel()
    {
        $url = "http://localhost/drdhcbi/api/complaint/channel";
        $arr_data['channel'] = api_call_get($url);
        $this->libraries->template('report_by_channel/report_by_channel', $arr_data);
    }
    
    public function report_by_type()
    {
        $url = "http://localhost/drdhcbi/api/complaint/complaint_type";
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
        $url = "http://localhost/drdhcbi/api/complaint/accused_type";
        $arr_data['complainant'] = api_call_get($url);
        $this->libraries->template('report_by_complainant/report_by_complainant', $arr_data);
    }
    
    public function report_statistic_by_type()
    {
        $url = "http://localhost/drdhcbi/api/complaint/complaint_type";
        $arr_data['complaint_type'] = api_call_get($url);
        $this->libraries->template('report_statistic_by_type/report_statistic_by_type', $arr_data);
    }
    
    public function report_statistic_by_status()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_statistic_by_status/report_statistic_by_status', $arr_data);
    }
    
    public function report_statistic_compare()
    {
        $url = "http://localhost/drdhcbi/api/complaint/complaint_type";
        $arr_data['complaint_type'] = api_call_get($url);
        $url = "http://localhost/drdhcbi/api/complaint/channel";
        $arr_data['channel'] = api_call_get($url);
        $this->libraries->template('report_statistic_compare/report_statistic_compare', $arr_data);
    }
    public function example_mpdf(){ 
        //load the view and saved it into $html variable
        $url = "http://localhost/drdhcbi/api/complaint/complaint_type";
        $arr_data['complaint_type'] = api_call_get($url);
        $url = "http://localhost/drdhcbi/api/complaint/channel";
        $arr_data['channel'] = api_call_get($url);
        $html=$this->load->view('report_all_complaint/report_all_complaint',$arr_data, true);
 	 // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/

        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->list_indent_first_level = 0;
        //$stylesheet = file_get_contents(APPPATH.'third_party/mpdf/css/mpdfstyletables.css');
        //$this->mpdf->WriteHTML($stylesheet, 1);
        $this->mpdf->WriteHTML($html, 2);
        $this->mpdf->Output('example_mpdf.pdf', 'I');
        exit;
    }
    
    public function example_tcpdf(){
        $this->load->library("Pdf");
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        // Add a page
        $pdf->AddPage();
            
        $url = "http://localhost/drdhcbi/api/complaint/complaint_type";
        $arr_data['complaint_type'] = api_call_get($url);
        $url = "http://localhost/drdhcbi/api/complaint/channel";
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
}
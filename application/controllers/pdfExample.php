<?php 
class pdfexample extends CI_Controller{
      function __construct() { 
 parent::__construct();
 } 
     function index()
    {
         $this->load->library("Pdf");
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
            // Add a page
            $pdf->AddPage();
            $data = [];
        //load the view and saved it into $html variable
        $html=$this->load->view('report_all_complaint/report_all_complaint',$data, true);
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output();
    }
}
?>
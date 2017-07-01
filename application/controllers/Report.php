<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        //$this->load->helper('cookie');
        //$this->load->helper('api');
        $this->load->helper('form');
        $this->load->helper('dateformat');
    }

    public function report_all_complaint()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_all_complaint/report_all_complaint', $arr_data);
    }
    
    public function report_by_chanel()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_by_chanel/report_by_chanel', $arr_data);
    }
    
    public function report_by_type()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_by_type/report_by_type', $arr_data);
    }
    
    public function report_by_complainer()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_by_complainer/report_by_complainer', $arr_data);
    }
    
    public function report_by_complainant()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_by_complainant/report_by_complainant', $arr_data);
    }
    
    public function report_statistic_by_type()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_statistic_by_type/report_statistic_by_type', $arr_data);
    }
    
    public function report_statistic_by_status()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_statistic_by_status/report_statistic_by_status', $arr_data);
    }
    
    public function report_statistic_compare()
    {
        $arr_data['arr_data'] = array();
        $this->libraries->template('report_statistic_compare/report_statistic_compare', $arr_data);
    }
}
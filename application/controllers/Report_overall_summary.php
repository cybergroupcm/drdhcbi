<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_overall_summary extends CI_Controller {

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

    public function index()
    {
        $arr_data['url'][0] = '';
        $arr_data['url'][1] = '';
        $arr_data['url'][2] = '';
        $this->libraries->template('report_overall_summary/index', $arr_data);
    }

}

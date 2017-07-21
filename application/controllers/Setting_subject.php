<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_subject extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ( ! $this->ion_auth->logged_in() || !$this->api_auth->logged_in())
        {
            redirect('alert', 'refresh');
        }
    }
    public function dashboard()
    {
        $url = base_url()."api/setting/subject";
        $arr_data['data'] = api_call_get($url);
        $this->libraries->template('setting_subject/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data = array();
        if($id != '') {
            $url = base_url()."api/setting/subject/".$id;
            $arr_data['data'] = api_call_get($url);
            $arr_data['data']['action']='edit';
        }

        $this->libraries->template('setting_subject/add',$arr_data);
    }
}
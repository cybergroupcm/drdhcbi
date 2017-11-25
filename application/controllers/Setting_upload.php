<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Setting_upload extends CI_Controller {
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
        $url = base_url()."api/setting/setting_upload/1";
        $arr_data['data'] = api_call_get($url);
        //echo"<pre>";print_r($arr_data['data']);exit;
        $this->libraries->template('setting_upload/dashboard',$arr_data);
    }

}
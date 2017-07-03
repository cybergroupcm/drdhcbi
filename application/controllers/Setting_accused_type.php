<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Setting_accused_type extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function dashboard()
    {
        $url = base_url()."api/setting/accused_type";
        $arr_data['data'] = api_call_get($url);
        $this->libraries->template('setting_accused_type/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data['data']['action']='add';
        if($id != '') {
            $url = base_url()."api/setting/accused_type/".$id;
            $arr_data['data'] = api_call_get($url);
            $arr_data['data']['action']='edit';
        }
        $this->libraries->template('setting_accused_type/add',$arr_data);
    }
}
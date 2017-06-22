<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_system extends CI_Controller {

    public function index()
    {
        $arr_data=array();
        $this->libraries->template('setting_system/menu',$arr_data);
    }
}
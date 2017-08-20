<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_org extends CI_Controller {

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
        $param = '';
        $param .= (@$_GET['type'] !="")?"/type/".@$_GET['type']:"";
        $param .= (@$_GET['parent_id'] !="")?"/parent_id/".@$_GET['parent_id']:"";

        $url = base_url()."api/setting/org".$param;
        $arr_data['data'] = api_call_get($url);
        $this->libraries->template('setting_org/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data = array();
        if($id != '') {
            $url = base_url()."api/setting/org/".$id;
            $arr_data['data'] = api_call_get($url);
            $arr_data['data']['action']='edit';
        }

        $this->libraries->template('setting_org/add',$arr_data);
    }

    public function getUseOrg($id)
    {
        $url = base_url("api/setting/use_org/" . $id);
        $arr_data['data_use'] = api_call_get($url);
        $send_org_id = 0;
        if(@$arr_data['data_use']['message']){
            $send_org_id = 0;
        }else{
            foreach ($arr_data['data_use'] AS $key => $val) {
                if ($val['send_org_id']) {
                    $send_org_id++;
                }
            }
        }

        if($send_org_id > 0){
            $result = 'NO';
        }else{
            $result = 'YES';
        }
        echo json_encode($result);
        exit;
    }
}
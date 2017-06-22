<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_complain_type extends CI_Controller {

    public function dashboard()
    {
        $arr_data=array(
            'data' => array(
                '0'=>array(
                    'complain_type_id'=>'1',
                    'complain_type_name'=>'แจ้งเบาะแสการทำผิด'
                ),
                '1'=>array(
                    'complain_type_id'=>'2',
                    'complain_type_name'=>'ปัญหาความเดือดร้อน'
                ),
                '2'=>array(
                    'complain_type_id'=>'3',
                    'complain_type_name'=>'เรื่องทั่วไป'
                ),
            )
        );

        $this->libraries->template('setting_complain_type/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data = array();
        if($id != '') {
            $arr_data = array(
                'data' => array(
                    '1' => array(
                        'complain_type_id' => '1',
                        'complain_type_name' => 'แจ้งเบาะแสการทำผิด'
                    ),
                    '2' => array(
                        'complain_type_id' => '2',
                        'complain_type_name' => 'ปัญหาความเดือดร้อน'
                    ),
                    '3' => array(
                        'complain_type_id' => '3',
                        'complain_type_name' => 'เรื่องทั่วไป'
                    ),
                )
            );
            $arr_data['data'] = $arr_data['data'][$id];
        }

        $this->libraries->template('setting_complain_type/add',$arr_data);
    }
}
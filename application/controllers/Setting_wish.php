<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_wish extends CI_Controller {

    public function dashboard()
    {
        $arr_data=array(
            'data' => array(
                '0'=>array(
                    'wish_id'=>'1',
                    'wish_name'=>'ขอความช่วยเหลือ'
                ),
                '1'=>array(
                    'wish_id'=>'2',
                    'wish_name'=>'ขอความเป็นธรรม'
                ),
                '2'=>array(
                    'wish_id'=>'3',
                    'wish_name'=>'ขอตรวจสอบข้อเท็จจริง'
                ),
            )
        );

        $this->libraries->template('setting_wish/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data = array();
        if($id != '') {
            $arr_data = array(
                'data' => array(
                    '1'=>array(
                        'wish_id'=>'1',
                        'wish_name'=>'ขอความช่วยเหลือ'
                    ),
                    '2'=>array(
                        'wish_id'=>'2',
                        'wish_name'=>'ขอความเป็นธรรม'
                    ),
                    '3'=>array(
                        'wish_id'=>'3',
                        'wish_name'=>'ขอตรวจสอบข้อเท็จจริง'
                    ),
                )
            );
            $arr_data['data'] = $arr_data['data'][$id];
        }

        $this->libraries->template('setting_wish/add',$arr_data);
    }
}
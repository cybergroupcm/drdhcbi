<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_subject extends CI_Controller {

    public function dashboard()
    {
        $arr_data=array(
            'data' => array(
                '0' => array(
                    'subject_id' => '1',
                    'subject_name' => 'ทั่วไป'
                ),
                '1' => array(
                    'subject_id' => '2',
                    'subject_name' => 'ด่วน'
                ),
                '2' => array(
                    'subject_id' => '3',
                    'subject_name' => 'ด่วนมาก'
                ),
            )
        );

        $this->libraries->template('setting_subject/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data = array();
        if($id != '') {
            $arr_data = array(
                'data' => array(
                    '1' => array(
                        'subject_id' => '1',
                        'subject_name' => 'ทั่วไป'
                    ),
                    '2' => array(
                        'subject_id' => '2',
                        'subject_name' => 'ด่วน'
                    ),
                    '3' => array(
                        'subject_id' => '3',
                        'subject_name' => 'ด่วนมาก'
                    ),
                )
            );
            $arr_data['data'] = $arr_data['data'][$id];
        }

        $this->libraries->template('setting_subject/add',$arr_data);
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_channel extends CI_Controller {

    public function dashboard()
    {
        $arr_data=array(
            'data' => array(
                '0'=>array(
                    'channel_id'=>'1',
                    'channel_name'=>'ศูนย์ดำรงธรรมส่วนกลาง'
                ),
                '1'=>array(
                    'channel_id'=>'2',
                    'channel_name'=>'ศูนย์ดำรงธรรม'
                ),
                '2'=>array(
                    'channel_id'=>'3',
                    'channel_name'=>'ศูนย์ดำรงธรรมย่อย'
                ),
            )
        );

        $this->libraries->template('setting_channel/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data = array();
        if($id != '') {
            $arr_data = array(
                'data' => array(
                    '1' => array(
                        'channel_id' => '1',
                        'channel_name' => 'ศูนย์ดำรงธรรมส่วนกลาง'
                    ),
                    '2' => array(
                        'channel_id' => '2',
                        'channel_name' => 'ศูนย์ดำรงธรรม'
                    ),
                    '3' => array(
                        'channel_id' => '3',
                        'channel_name' => 'ศูนย์ดำรงธรรมย่อย'
                    ),
                )
            );
            $arr_data['data'] = $arr_data['data'][$id];
        }

        $this->libraries->template('setting_channel/add',$arr_data);
    }
}
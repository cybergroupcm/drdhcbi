<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_accused_type extends CI_Controller {

    public function dashboard()
    {
        $arr_data=array(
            'data' => array(
                '0'=>array(
                    'accused_type_id'=>'1',
                    'accused_type'=>'หน่วยงานภายใน'
                ),
                '1'=>array(
                    'accused_type_id'=>'2',
                    'accused_type'=>'หน่วยงานภายนอก'
                ),
                '2'=>array(
                    'accused_type_id'=>'3',
                    'accused_type'=>'บุคคล/นิติบุคคล'
                ),
            )
        );
        $this->libraries->template('setting_accused_type/dashboard',$arr_data);
    }

    public function add($id='')
    {
        $arr_data = array();
        if($id != '') {
            $arr_data = array(
                'data' => array(
                    '1' => array(
                        'accused_type_id' => '1',
                        'accused_type' => 'หน่วยงานภายใน'
                    ),
                    '2' => array(
                        'accused_type_id' => '2',
                        'accused_type' => 'หน่วยงานภายนอก'
                    ),
                    '3' => array(
                        'accused_type_id' => '3',
                        'accused_type' => 'บุคคล/นิติบุคคล'
                    ),
                )
            );
            $arr_data['data'] = $arr_data['data'][$id];
        }

        $this->libraries->template('setting_accused_type/add',$arr_data);
    }
}
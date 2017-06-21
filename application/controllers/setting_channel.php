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

        //start แบ่งหน้า
        $this->load->library('pagination');
        $config['base_url'] = base_url().'complaint/dashboard/page';
        $config['total_rows'] = 200; // Count total rows in the query
        $config['full_tag_open'] = '<div class="container text-center"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['page_query_string'] = TRUE;
        $config['prev_link'] = '&lt; <';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '> &gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $this->pagination->initialize($config);
        $arr_data['pagination'] = $this->pagination->create_links();
        //end แบ่งหน้า

        $this->libraries->template('Setting_channel/dashboard',$arr_data);
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

        $this->libraries->template('Setting_channel/add',$arr_data);
    }
}
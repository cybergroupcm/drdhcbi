<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template_libraries extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		# Load libraries
		//$this->load->library('parser');
		$this->load->helper(array('html', 'url', 'api'));



	}

	public function template($bodyFile='', $arr_data=array()){

		$arr_header = array(		'img_logo' => array(
												'src' => 'template/default/images/logo.gif',
												'alt' => 'Chinese Cuisine'
												),
												'img_title_welcome' => array(
												'src' => 'template/default/images/title_welcome.gif',
												'alt' => 'Welcome to our Restaurant'
												)
											);
		$url = base_url("api/authen/token_info");
		$user_data_id = api_call_get($url);
		$url = base_url()."api/user/user/".$user_data_id['userid'];
		$arr_header['user_data'] = api_call_get($url);
		foreach($user_data_id['permission'] as $value){
			$url = base_url()."api/user/user_groups/".$value;
			$link_data = api_call_get($url);
			if($link_data[$value]['mode_id'] == 1 ){
				if($link_data[$value]['parent_id'] == 0 ){
					$arr_header['main_menu'][$value] = $link_data[$value];
				}else{
					$arr_header['sub_menu'][$link_data[$value]['parent_id']][$value] = $link_data[$value];

					$check_data = @$arr_header['main_menu'][$link_data[$value]['parent_id']];
					if(empty($check_data)){
						$url = base_url()."api/user/user_groups/".$link_data[$value]['parent_id'];
						$link_main_data = api_call_get($url);
						$arr_header['main_menu'][$link_data[$value]['parent_id']] = $link_main_data[$link_data[$value]['parent_id']];
					}
				}
			}else{
				$check_sub_data = @$arr_header['sub_menu'][$link_data[$value]['parent_id']];
				if(empty($check_sub_data)){
					$url = base_url()."api/user/user_groups/".$link_data[$value]['parent_id'];
					$link_sub_data = api_call_get($url);
					$arr_header['sub_menu'][$link_sub_data[$link_data[$value]['parent_id']]['parent_id']][$link_data[$value]['parent_id']] = $link_sub_data[$link_data[$value]['parent_id']];
					$check_data = @$arr_header['main_menu'][$link_sub_data[$link_data[$value]['parent_id']]];
					if(empty($check_data)){
						$url = base_url()."api/user/user_groups/".$link_sub_data[$link_data[$value]['parent_id']]['parent_id'];
						$link_main_data = api_call_get($url);
						$arr_header['main_menu'][$link_sub_data[$link_data[$value]['parent_id']]['parent_id']] = $link_main_data[$link_sub_data[$link_data[$value]['parent_id']]['parent_id']];

					}

				}
			}

		}
		if($bodyFile == 'login'){
				$arr_title = array('title'=>'Home','body_class'=>'login-page');
				$this->load->view('template/template_header', $arr_title);
				$this->load->view($bodyFile, $arr_data);//file view show body

		}else{
				$arr_title = array('title'=>'ศูนย์ดำรงธรรม จังหวัดชลบุรี 4.0','body_class'=>'hold-transition skin-blue fixed sidebar-mini');
				$this->load->view('template/template_header', $arr_title);
				$this->load->view('template/template_top_menu', $arr_header);
				$this->load->view('template/template_left_menu', $arr_header);
				$this->load->view($bodyFile, $arr_data);//file view show body
				$this->load->view('template/template_footer');
		}
	}


    public function template_member($bodyFile='', $arr_data=array()){

        $arr_header = array(

            'img_logo' => array(
            'src' => 'template/default/images/logo.gif',
            'alt' => 'Chinese Cuisine'

        ),
            'img_title_welcome' => array(
                'src' => 'template/default/images/title_welcome.gif',
                'alt' => 'Welcome to our Restaurant'
            )
        );

        $url = base_url("api/authen/token_info");
        $user_data_id = api_call_get($url);
        $url = base_url()."api/user/user/".$user_data_id['userid'];
        $arr_header['user_data'] = api_call_get($url);

        foreach($user_data_id['permission'] as $value){
            $url = base_url()."api/user/user_groups/".$value;
            $link_data = api_call_get($url);
            if($link_data[$value]['mode_id'] == 1 ){
                if($link_data[$value]['parent_id'] == 0 ){
                    $arr_header['main_menu'][$value] = $link_data[$value];
                }else{
                    $arr_header['sub_menu'][$link_data[$value]['parent_id']][$value] = $link_data[$value];

                    $check_data = @$arr_header['main_menu'][$link_data[$value]['parent_id']];
                    if(empty($check_data)){
                        $url = base_url()."api/user/user_groups/".$link_data[$value]['parent_id'];
                        $link_main_data = api_call_get($url);
                        $arr_header['main_menu'][$link_data[$value]['parent_id']] = $link_main_data[$link_data[$value]['parent_id']];
                    }
                }
            }else{
                $check_sub_data = @$arr_header['sub_menu'][$link_data[$value]['parent_id']];
                if(empty($check_sub_data)){
                    $url = base_url()."api/user/user_groups/".$link_data[$value]['parent_id'];
                    $link_sub_data = api_call_get($url);
                    $arr_header['sub_menu'][$link_sub_data[$link_data[$value]['parent_id']]['parent_id']][$link_data[$value]['parent_id']] = $link_sub_data[$link_data[$value]['parent_id']];
                    $check_data = @$arr_header['main_menu'][$link_sub_data[$link_data[$value]['parent_id']]];
                    if(empty($check_data)){
                        $url = base_url()."api/user/user_groups/".$link_sub_data[$link_data[$value]['parent_id']]['parent_id'];
                        $link_main_data = api_call_get($url);
                        $arr_header['main_menu'][$link_sub_data[$link_data[$value]['parent_id']]['parent_id']] = $link_main_data[$link_sub_data[$link_data[$value]['parent_id']]['parent_id']];

                    }

                }
            }

        }
        if($bodyFile == 'login'){
            $arr_title = array('title'=>'Home','body_class'=>'login-page');
            $this->load->view('template/template_header', $arr_title);
            $this->load->view($bodyFile, $arr_data);//file view show body

        }else{
            $arr_title = array('title'=>'ศูนย์ดำรงธรรม จังหวัดชลบุรี 4.0','body_class'=>'hold-transition skin-blue ');
            $this->load->view('template/template_header', $arr_title);
            $this->load->view('template/template_top_menu_no_sidebar', $arr_header);
            //$this->load->view('template/template_left_menu', $arr_header);
            $this->load->view($bodyFile, $arr_data);//file view show body
            $this->load->view('template/template_footer');
        }
    }


    public function report($bodyFile='', $arr_data=array()){

        $arr_header = array(		'img_logo' => array(
            'src' => 'template/default/images/logo.gif',
            'alt' => 'Chinese Cuisine'
        ),
            'img_title_welcome' => array(
                'src' => 'template/default/images/title_welcome.gif',
                'alt' => 'Welcome to our Restaurant'
            )
        );
        $url = base_url("api/authen/token_info");
        $user_data_id = api_call_get($url);
        $url = base_url()."api/user/user/".$user_data_id['userid'];
        $arr_header['user_data'] = api_call_get($url);
        foreach($user_data_id['permission'] as $value){
            $url = base_url()."api/user/user_groups/".$value;
            $link_data = api_call_get($url);
            if($link_data[$value]['mode_id'] == 1 ){
                if($link_data[$value]['parent_id'] == 0 ){
                    $arr_header['main_menu'][$value] = $link_data[$value];
                }else{
                    $arr_header['sub_menu'][$link_data[$value]['parent_id']][$value] = $link_data[$value];

                    $check_data = @$arr_header['main_menu'][$link_data[$value]['parent_id']];
                    if(empty($check_data)){
                        $url = base_url()."api/user/user_groups/".$link_data[$value]['parent_id'];
                        $link_main_data = api_call_get($url);
                        $arr_header['main_menu'][$link_data[$value]['parent_id']] = $link_main_data[$link_data[$value]['parent_id']];
                    }
                }
            }else{
                $check_sub_data = @$arr_header['sub_menu'][$link_data[$value]['parent_id']];
                if(empty($check_sub_data)){
                    $url = base_url()."api/user/user_groups/".$link_data[$value]['parent_id'];
                    $link_sub_data = api_call_get($url);
                    $arr_header['sub_menu'][$link_sub_data[$link_data[$value]['parent_id']]['parent_id']][$link_data[$value]['parent_id']] = $link_sub_data[$link_data[$value]['parent_id']];
                    $check_data = @$arr_header['main_menu'][$link_sub_data[$link_data[$value]['parent_id']]];
                    if(empty($check_data)){
                        $url = base_url()."api/user/user_groups/".$link_sub_data[$link_data[$value]['parent_id']]['parent_id'];
                        $link_main_data = api_call_get($url);
                        $arr_header['main_menu'][$link_sub_data[$link_data[$value]['parent_id']]['parent_id']] = $link_main_data[$link_sub_data[$link_data[$value]['parent_id']]['parent_id']];

                    }

                }
            }

        }
        if($bodyFile == 'login'){
            $arr_title = array('title'=>'Home','body_class'=>'login-page');
            $this->load->view('template/template_header', $arr_title);
            $this->load->view($bodyFile, $arr_data);

        }else{
            $arr_title = array('title'=>'ศูนย์ดำรงธรรม จังหวัดชลบุรี 4.0','body_class'=>'');
            $this->load->view('template/template_header', $arr_title);
            $this->load->view($bodyFile, $arr_data);
            $this->load->view('template/template_report_footer');
        }
    }

}

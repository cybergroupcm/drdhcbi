<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template_libraries extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		# Load libraries
		//$this->load->library('parser');
		$this->load->helper('html');
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
		if($bodyFile == 'login'){
				$arr_title = array('title'=>'Home','body_class'=>'login-page');
				$this->load->view('template/template_header', $arr_title);
				$this->load->view($bodyFile, $arr_data);//file view show body

		}else{
				$arr_title = array('title'=>'Home','body_class'=>'skin-blue');
				$this->load->view('template/template_header', $arr_title);
				$this->load->view('template/template_top_menu', $arr_header);
				$this->load->view('template/template_left_menu', $arr_header);
				$this->load->view($bodyFile, $arr_data);//file view show body
				$this->load->view('template/template_footer');
		}
	}

}

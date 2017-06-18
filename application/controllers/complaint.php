<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Complaint extends CI_Controller {

	public function key_in()
	{
            //$this->load->model('Template_libraries', 'libraries');
            $this->libraries->template('complaint/key_in',$arr_data=array());
	}
}

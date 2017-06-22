<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	/*public function index()
	{
		$this->load->view('welcome_message');
	}*/

	public function index()
	{

		//$this->load->model('Template_libraries', 'libraries');
		$this->libraries->template('main',$arr_data=array('test'=>'test'));

		//$this->load->view('main');
	}

	public function login()
	{

		$this->libraries->template('login',$arr_data=array());
		/*
		$this->load->model('Travel_data', 'home');

		$year = $this->input->get_post('year','');
			$obj = $this->home->showdata($year);
		$arr_data = array('data'=>$obj);
		$this->libraries->template('template',$arr_data);*/

	}
        
        public function register()
	{

		$this->libraries->template('register/register',$arr_data=array());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

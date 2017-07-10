<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

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
	public $user_data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/dashboard_model');
	}
	/*public function index()
	{
		$this->load->view('welcome_message');
	}*/

	public function index()
	{
		$this->load->model('Template_libraries', 'libraries');
		$this->load->model('main/Main_model','main');

//		echo "<pre>";
//		print_r($arr_data);
//		die();
		//จำนวนสถานะการดำเนิดการ
		$arr_data['sum_status'] = $this->main->get_sum_status();
		//ข้อมูลเรื่องร้องทุกข์ทั้งหมดจำแนกรายพื้นที่
		$obj_area = $this->main->get_area();
		foreach($obj_area as $row_area){
			$arr_area_data[$row_area->area_id] = $row_area->area_id;
		}
		$arr_data['area_data'] = $arr_area_data;
		//เรื่องร้องทุกข์ 5 ประเภทที่มีผู้ร้องเรียนมากสุด
		$arr_data['sum_type'] = $this->main->get_sum_type();
		$this->libraries->template('main',$arr_data);
		//$this->load->view('main');
	}


	public function get_xml_map($area_id='')
	{
		header("Content-type: text/xml; charset=utf-8");
		$this->load->model('main/Main_model','main');
		$obj_area = $this->main->get_area($area_id);

		//$arr_point = @explode(",",$shape_data['g_point']);

		$str =  "<markers>";
		foreach($obj_area as $row_area){
					$shape = $row_area->g_shape;
					$arr_point = @explode(",",$row_area->g_point);
					if($shape != ""){
						$str .= '<marker ';
						$str .= 'name="'.$row_area->area_name.'" ';
						$str .= 'address="" ';
						$str .= 'lat="'.$arr_point[1].'" ';
						$str .= 'lng="'.$arr_point[0].'" ';
						$str .= 'shape="'.trim($shape).'" ';
						$str .= 'shape_color="#00FF00" ';
						$str .= 'shape_opacity="0.5" ';
						$str .= 'picture="picture" ';
						$str .= 'icon="'.base_url().'assets/images/pin-map.png" ';
						$str .= 'identify="" />';
				}
			}
		$str .= "</markers>";
		echo $str;
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
        $url = base_url()."api/jwt/token_info";
        $arr_data['token'] = api_call_get($url);
//        echo "<pre>";
//        print_r($arr_data['token']);
//        echo "</pre>";exit;
        $id=$arr_data['token']['userid'];
        $arr_data['id'] = $id;
        $url = base_url()."api/user/user/".$id;
        $arr_data['data'] = api_call_get($url);
        $url = base_url()."api/dropdown/title_name_lists";
        $arr_data['title_name'] = api_call_get($url);
        
        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $arr_data['province_list'] = api_call_get($url);
        
        if(@$arr_data['data']['user']['address_id']!=''){
            $ccaa_code = substr(@$arr_data['data']['address_id'], 0, 3);
        }else{
            $ccaa_code = '200';
        }
        $url = base_url("api/dropdown/ccaa_lists/Aumpur/".$ccaa_code);
        $arr_data['district_list'] = api_call_get($url);
        
        if(@$arr_data['data']['user']['address_id']!=''){
            $ccaa_code = substr(@$arr_data['data']['address_id'], 0, 4);
            $url = base_url("api/dropdown/ccaa_lists/Tamboon/".$ccaa_code);
            $arr_data['subdistrict_list'] = api_call_get($url);
        }
        
        $this->libraries->template('register/register',$arr_data);

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

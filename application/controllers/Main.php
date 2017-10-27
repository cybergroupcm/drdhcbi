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
		$this->load->helper(array('html', 'url', 'api'));
		$this->load->model('admin/dashboard_model');
        if ( ! $this->ion_auth->logged_in() || !$this->api_auth->logged_in())
        {
            redirect('alert', 'refresh');
        }
	}
	/*public function index()
	{
		$this->load->view('welcome_message');
	}*/

	public function index()
	{
		$this->load->model('Template_libraries', 'libraries');
		$this->load->model('main/Main_model','main');

        $url = base_url("api/authen/token_info");
        $user_data_id = api_call_get($url);

        $url = base_url("api/complaint/user_mode_permission/user_id/".$user_data_id['userid']);
        $user_modes_groups = api_call_get($url);

        $overall = 0; // สถานะการมองเห็นทั้งหมด 0 มองเห้นเฉพาะที่ตนเองสร้าง , 1 มองเห็นทั้งหมด

        if( !empty($user_modes_groups[3]) ){
            foreach( $user_modes_groups[3] as $key => $value ){
                if( $value == 19 ){ $overall = 1; }
            }
        }

//		echo "<pre>";
//		print_r($arr_data);
//		die();
		//จำนวนสถานะการดำเนิดการ
        if( $overall == 0 ) {
            $arr_data['sum_status'] = $this->main->get_sum_status($user_data_id['userid']);
        }else{
            $arr_data['sum_status'] = $this->main->get_sum_status();
        }
		//ข้อมูลเรื่องร้องทุกข์ทั้งหมดจำแนกรายพื้นที่
		$obj_area = $this->main->get_area();
		foreach($obj_area as $row_area){
			$arr_area_data[$row_area->area_id] = array('area_id'=>$row_area->area_id, 'area_name'=>$row_area->area_name);
		}
		$arr_data['area_data'] = $arr_area_data;
		//สัญลักษณ์ประเภทเรื่อง
		$obj_complain_type = $this->main->get_complain_type_list();
		foreach ($obj_complain_type as $row)
		{
			$arr_complain_type_list_icon[] = array('complain_type_name'=>$row->complain_type_name,'icon_pin'=>$row->icon_pin);
		}
		$arr_data['complain_type_list_icon'] = $arr_complain_type_list_icon;
		//ข้อมูลสถานะ
		$obj_status = $this->main->get_current_status();
		foreach ($obj_status as $row)
		{
			$arr_status_data[$row->current_status_id] = array('status_id'=>$row->current_status_id,'status_name'=>$row->current_status_name);
		}
		$arr_data['current_status_data'] = $arr_status_data;
		//เรื่องร้องทุกข์ 5 ประเภทที่มีผู้ร้องเรียนมากสุด
        if( $overall == 0 ) {
            $arr_data['sum_type'] = $this->main->get_sum_type($user_data_id['userid']);
        }else{
            $arr_data['sum_type'] = $this->main->get_sum_type();
        }
		$this->libraries->template('main',$arr_data);
		//$this->load->view('main');
	}

	public function parseToXML($htmlStr) {
		$xmlStr = str_replace('<','&lt;', $htmlStr);
		$xmlStr = str_replace('>','&gt;', $xmlStr);
		$xmlStr = str_replace('"','&quot;', $xmlStr);
		$xmlStr = str_replace("'",'&#39;', $xmlStr);
		$xmlStr = str_replace("&",'&amp;', $xmlStr);
		return $xmlStr;
	}

	public function get_xml_map_status($status_id='')
	{
		header("Content-type: text/xml; charset=utf-8");
		$this->load->model('main/Main_model','main');
		$obj_data_status = $this->main->get_data_status($status_id);

		//$arr_point = @explode(",",$shape_data['g_point']);

		$str =  "<markers>";
		foreach($obj_data_status as $row){
					$icon = $this->main->get_complain_type_icon($row->complain_type_id);
					$name = 'เลขที่เรื่อง : '.$row->complain_no;
					$lat = $row->latitude;
					$lng = $row->longitude;
					if($lat != "" && $lng != ""){
						$str .= '<marker ';
						$str .= 'name="'.$name.'" ';
						$str .= 'address="" ';
						$str .= 'lat="'.$lat.'" ';
						$str .= 'lng="'.$lng.'" ';
						$str .= 'shape="" ';
						$str .= 'shape_color="" ';
						$str .= 'shape_opacity="0.1" ';
						$str .= 'picture="picture" ';
						$str .= 'icon="'.base_url().'assets/images/'.$icon.'" ';
						$str .= 'identify="main/map_detail/'.$row->keyin_id.'" />';
				}
			}
		$str .= "</markers>";
		echo $str;
	}
	public function map_detail($keyin_id=''){
			$this->load->model('main/Main_model','main');
			$url = base_url("api/complaint/key_in/" . $keyin_id);
			$arr_data['key_in_data'] = api_call_get($url);
			$arr_data['keyin_id']= $keyin_id;
			$this->load->view('map_detail', $arr_data);
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
						$str .= 'shape_opacity="0.1" ';
						$str .= 'picture="picture" ';
						$str .= 'icon="'.base_url().'assets/images/pin-map-blank.png" ';
						$str .= 'identify="" />';
				}
			}
		$str .= "</markers>";
		echo $str;
	}

	public function login()
	{


        redirect('auth/login', 'refresh');
		//$this->libraries->template('login',$arr_data=array());

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
	  $url = base_url()."api/dropdown/title_name_lists/prename_en";
	  $arr_data['title_name_en'] = api_call_get($url);
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


      $url = base_url("api/complaint/user_groups/user_id/" . $id);
      $user_modes_groups = api_call_get($url);

      if(in_array(2, $user_modes_groups)) {
          $this->libraries->template_member('register/register', $arr_data);
      }else{
          $this->libraries->template('register/register', $arr_data);
      }

    }

	public function check_username($username)
	{
		$query = $this->db->get_where('au_users', array('username' => $username));
		$row = $query->row_array();
		echo $row['id'];
		exit;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

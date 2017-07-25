<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Complain_type
{
	public function __construct()
	{
//		$this->load->helper(array('cookie','url','api'));
	}
	public function sort_complain_type($id){
		$complain_type = $this->get_complaint_type_parent($id);
		$complain_type = substr($complain_type,0,-2);
		$complain_type_arr = explode("_",$complain_type);
		$complain_type = array();
		for($i=count($complain_type_arr)-1;$i>=0;$i--){
			$complain_type[] = $complain_type_arr[$i];
		}
		return $complain_type;
	}

	public function get_complaint_type_parent($id){
		$url = base_url("api/complaint/complain_type/".$id);
		$complain_type = api_call_get($url);
		if(@$complain_type['parent_id'] == ''){
			return true;
		}else {
			$complain_type_return = @$complain_type['complain_type_id']."_".$this->get_complaint_type_parent(@$complain_type['parent_id']);

			return $complain_type_return;
		}
	}
}

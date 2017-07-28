<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accused_type
{
	public function __construct()
	{
//		$this->load->helper(array('cookie','url','api'));
	}
	public function sort_accused($id){
		$accused_type = $this->get_accused_parent($id);
		$accused_type = substr($accused_type,0,-2);
		$accused_type_arr = explode("_",$accused_type);
		$accused = array();
		for($i=count($accused_type_arr)-1;$i>=0;$i--){
			$accused[] = $accused_type_arr[$i];
		}
		return $accused;
	}

	public function get_accused_parent($id){
		$url = base_url("api/complaint/accused_type/".$id);
		$accused_type = api_call_get($url);
		if(@$accused_type['parent_id'] == ''){
			return true;
		}else {
			$accused = @$accused_type['accused_type_id']."_".$this->get_accused_parent(@$accused_type['parent_id']);

			return $accused;
		}
	}
}

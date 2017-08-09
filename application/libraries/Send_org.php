<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_org
{
	public function __construct()
	{
//		$this->load->helper(array('cookie','url','api'));
	}
	public function sort_send_org($id){
		$send_org = $this->get_send_org_parent($id);
		$send_org = substr($send_org,0,-2);
		$send_org_arr = explode("_",$send_org);
		$send_org = array();
		for($i=count($send_org_arr)-1;$i>=0;$i--){
			$send_org[] = $send_org_arr[$i];
		}
		return $send_org;
	}

	public function get_send_org_parent($id){
		$url = base_url("api/complaint/send_org/".$id);
		$send_org = api_call_get($url);
		if(@$send_org['parent_id'] == ''){
			return true;
		}else {
			$send_org_return = @$send_org['send_org_id']."_".$this->get_send_org_parent(@$send_org['parent_id']);

			return $send_org_return;
		}
	}
}

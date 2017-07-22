<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_auth
{
	public function __construct()
	{
//		$this->load->helper(array('cookie','url','api'));
	}
	public function logged_in()
	{
	    $url = base_url('api/authen/token_info');
	    $result = api_call_get($url);
        if (array_key_exists('status', $result)) {
            $status = $result['status'];
            if($status == 'invalid_token'|| $status==' empty_bearer'|| $status=='empty_authorization'){
                return false;
            }
        }
		return true;
	}
}

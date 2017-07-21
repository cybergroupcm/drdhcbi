<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Alert extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->libraries->template('alert');
        header('Refresh:4; url= '. site_url('auth/logout'));
    }
}
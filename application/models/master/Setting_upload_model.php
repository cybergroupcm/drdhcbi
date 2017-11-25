<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_upload_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_setting_upload';
        $this->primary_key = 'setting_id';

    }
}
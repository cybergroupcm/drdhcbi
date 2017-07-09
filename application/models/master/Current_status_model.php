<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Current_status_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_current_status';
        $this->primary_key = 'current_status_id';
        $this->timestamps = FALSE;
    }
}
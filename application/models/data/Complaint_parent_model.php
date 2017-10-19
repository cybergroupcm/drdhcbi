<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint_parent_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'report_result_parent';
        $this->primary_key = 'keyin_id';
        $this->timestamps = False;

    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComplainType_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'ms_complain_type';
        $this->primary_key = 'complain_type_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';
        parent::__construct();
    }
}
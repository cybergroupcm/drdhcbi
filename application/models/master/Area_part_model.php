<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_part_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_area_part';
        $this->primary_key = 'partid';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';

    }
}
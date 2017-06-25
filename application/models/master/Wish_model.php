<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wish_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'ms_wish';
        $this->primary_key = 'wish_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';
        parent::__construct();
    }
}
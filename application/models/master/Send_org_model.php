<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_org_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_send_org';
        $this->primary_key = 'send_org_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';

    }
}
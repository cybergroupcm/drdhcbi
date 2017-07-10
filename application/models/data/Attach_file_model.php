<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attach_file_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'dt_attach_file';
        $this->primary_key = 'file_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';

    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Au_group_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'au_groups';
        $this->primary_key = 'id';
        $this->timestamps = FALSE;

    }
}
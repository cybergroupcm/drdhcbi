<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TitleName_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_prename';
        $this->primary_key = 'pn_id';
        $this->timestamps = FALSE;
    }
}
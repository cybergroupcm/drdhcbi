<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccaa_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ms_ccaa';
        $this->primary_key = 'ccDigi';
        $this->timestamps = FALSE;

    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'au_users';
        $this->primary_key = 'id';
        $this->timestamps = TRUE;
    }

    public function sql_query($sql){
        return $this->db->query($sql);
    }
}
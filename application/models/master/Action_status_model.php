<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action_status_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_action_status($action_status_id='')
    {
      $sql = "SELECT action_status_id, action_status FROM ms_action_status ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }
}
?>

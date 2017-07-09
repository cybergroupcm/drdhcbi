<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function get_file_install()
    {     
        if (file_exists('install.php'))
        {
            $val = '<div class="row">';
            $val.= '<div class="col-md-12">';
            $val.= '<div class="alert alert-danger">';
            $val.= '<h4><i class="icon fa fa-warning"></i>' . lang('actions_security_error') . '</h4>';
            $val.= '<p>' . sprintf(lang('actions_file_install_exist'), '<a href="#" class="btn btn-warning btn-flat btn-xs">' . strtolower(lang('actions_delete')) . '</a>') . '</p>';
            $val.= '</div>';
            $val.= '</div>';
            $val.= '</div>';

            return $val;
        }
    }

    public  function save_permiss($data,$id){
        $this->db->where('gid',$id);
        $this->db->delete('au_groups_permissions');
        $org = explode(',', $data);
        foreach ($org as $value) {
            $this->db->set('appid',$value);
            $this->db->set('gid',$id);
            $this->db->set('authority','1');
            $this->db->insert('au_groups_permissions');
        }
    }

    public  function get_group_permiss($id){

        $this->db->select('appid');
        $this->db->where('gid',$id);
        $this->db->from('au_groups_permissions');
        $query = $this->db->get();
        $data = array();
        if(count($query->result()) != 0 ){
            foreach($query->result() as $row){
                $data[] = $row->appid;
            }

        }
        return $data;
    }

    function getOrg($parent='0',&$data=array()){
        $this->db->select('*');
        $this->db->where('parent_id',$parent);
        $this->db->from('au_applications');
        $query = $this->db->get();
        if( count($query->result()) != 0){
            foreach($query->result() as $row){
                $data[$parent][] = $row;
                $this->getOrg($row->app_id,$data);
            }
            return $data;
        }
    }

    function genOrgTree($org,$parent=0,&$ul=''){
        $ul .= '<ul>';
        foreach ($org[$parent] as $key => $value) {
            $ul .= "<li id='{$value->app_id}'>".$value->app_name;
            if(!empty($org[$value->app_id])){
                $this->genOrgTree( $org, $value->app_id ,$ul);
            }
            $ul .= '</li>';
        }
        $ul .= '</ul>';

        return $ul;
    }
}

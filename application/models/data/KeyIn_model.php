<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KeyIn_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'dt_keyin';
        $this->primary_key = 'keyin_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';
        $this->has_many_pivot['complaint_type'] = array(
            'foreign_model' => 'master/ComplainType_model',
            'pivot_table' => 'dt_complain_type',
            'local_key' => 'keyin_id',
            'pivot_local_key' => 'keyin_id',
            'pivot_foreign_key' => 'complain_type_id',
            'foreign_key' => 'complain_type_id');
        $this->has_many_pivot['wish'] = array(
            'foreign_model' => 'master/Wish_model',
            'pivot_table' => 'dt_wish',
            'local_key' => 'keyin_id',
            'pivot_local_key' => 'keyin_id',
            'pivot_foreign_key' => 'wish_id',
            'foreign_key' => 'wish_id');
        $this->before_create[] = 'changeDateFormat';
        $ci = get_instance();
        $ci->load->helper('dateformat');
    }

    /*public $rules = [
        'insert' => [
            'complain_date'=>[
                'field'=>'complain_date',
                'label'=>'complain_date',
                'rules'=>'required'
            ],
            'recipient'=>[
                'field'=>'recipient',
                'label'=>'recipient',
                'rules'=>'required'
            ],
            'complain_type_id'=>[
                'field'=>'complain_type_id',
                'label'=>'complain_type_id',
                'rules'=>'required'
            ],
            'complain_name'=>[
                'field'=>'complain_name',
                'label'=>'complain_name',
                'rules'=>'required'
            ],
            'channel_id'=>[
                'field'=>'channel_id',
                'label'=>'channel_id',
                'rules'=>'required'
            ]

        ]
    ];*/


    protected function changeDateFormat($data)
    {
        $data['complain_date'] = date_eng($data['complain_date'] );
        $data['doc_receive_date'] = date_eng($data['doc_receive_date'] );
        $data['doc_send_date'] = date_eng($data['doc_send_date'] );
        $data['scene_date'] = date_eng($data['scene_date'] );
//        $data['receive_date'] = date_eng($data['receive_date'] );
//        $data['reply_date'] = date_eng($data['reply_date'] );
//        $data['send_org_date'] = date_eng($data['send_org_date'] );
        return $data;
    }

    public function genComplainNo(){
         /*$thisdb-->fields('complain_no')->where('complain_nod','like','201704','before')->get_all()*/
        $query = $this->db->select('complain_no')->like('complain_no', '201704', 'before')->get('dt_keyin');
        $row = $query->row();
        return $row;
    }

    public function insertPivotComplaintType($keyinId, $complainTypeId)
    {
        //$this->db->delete('dt_complain_type',['keyin_id'=>$keyinId]);
        $data = array('keyin_id' => $keyinId, 'complain_type_id' => $complainTypeId);
        return $this->db->insert('dt_complain_type', $data);
    }

    public function insertPivotWish($keyinId, $wishId)
    {
        //$this->db->delete('dt_wish',['keyin_id'=>$keyinId]);
        $data = array('keyin_id' => $keyinId, 'wish_id' => $wishId);
        return $this->db->insert('dt_wish', $data);
    }

}
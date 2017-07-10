<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Key_in_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'dt_keyin';
        $this->primary_key = 'keyin_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';
        $this->has_many['title_name'] = array(
            'foreign_model'=>'master/Title_name_model',
            'foreign_table'=>'ms_prename',
            'foreign_key'=>'pn_id',
            'local_key'=>'pn_id');
        $this->has_many['current_status'] = array(
            'foreign_model'=>'master/Current_status_model',
            'foreign_table'=>'ms_current_status',
            'foreign_key'=>'current_status_id',
            'local_key'=>'current_status_id');
        $this->has_many['subject'] = array(
            'foreign_model'=>'master/Subject_model',
            'foreign_table'=>'ms_subject',
            'foreign_key'=>'subject_id',
            'local_key'=>'subject_id');
        $this->has_many['channel'] = array(
            'foreign_model'=>'master/Channel_model',
            'foreign_table'=>'ms_channel',
            'foreign_key'=>'channel_id',
            'local_key'=>'channel_id');
        $this->has_many['attach_file'] = array(
            'foreign_model'=>'data/Attach_file_model',
            'foreign_table'=>'dt_attach_file',
            'foreign_key'=>'keyin_id',
            'local_key'=>'keyin_id');
        $this->has_many_pivot['complaint_type'] = array(
            'foreign_model' => 'master/Complain_type_model',
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
        $this->before_create = array('changeDateFormat','genComplainNo');
        $this->before_update[] = 'changeDateFormat';
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
        if (array_key_exists('complain_date',$data)){
            $data['complain_date'] = date_eng($data['complain_date'] );
//            $data['complain_no'] = $this->genComplainNo($data['complain_date']);
        }

        if (array_key_exists('doc_receive_date',$data)){
            $data['doc_receive_date'] = date_eng($data['doc_receive_date'] );
        }

        if (array_key_exists('doc_send_date',$data)){
            $data['doc_send_date'] = date_eng($data['doc_send_date'] );
        }

        if (array_key_exists('scene_date',$data)){
            $data['scene_date'] = date_eng($data['scene_date'] );
        }


        if (array_key_exists('receive_date',$data)){
            $data['receive_date'] = date_eng($data['receive_date'] );
        }

        if (array_key_exists('reply_date',$data)){
            $data['reply_date'] = date_eng($data['reply_date'] );
        }

        if (array_key_exists('send_org_date',$data)){
            $data['send_org_date'] = date_eng($data['send_org_date'] );
        }
        return $data;
    }

    protected function genComplainNo($data){
        if (array_key_exists('complain_date',$data)){
            $prefix = $data['complain_date'];
        }else{
            $prefix = date('Y-m-d');
        }
        $prefix  = explode('-',$prefix);
        $search = $prefix[0].$prefix[1];
        $query = $this->db->select('complain_no')->like('complain_no', $search , 'after')->order_by('complain_no', 'DESC')->limit(1)->get('dt_keyin');
        if($query->num_rows()>0){
            $row = $query->row();
            $result = substr($row->complain_no,6,4);
            $data['complain_no'] = sprintf("%s%'.04d",$search,$result+1);
        }else{
            $data['complain_no'] = $search."0001";
        }
        return $data;
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
    public function beforeInsertPivotComplaintType($keyinId)
    {
        return $this->db->delete('dt_complain_type',['keyin_id'=>$keyinId]);
    }
    public function beforeInsertPivotWish($keyinId)
    {
        return $this->db->delete('dt_wish',['keyin_id'=>$keyinId]);
    }

}
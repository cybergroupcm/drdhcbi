<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'dt_result';
        $this->primary_key = 'result_id';
        $this->timestamps = TRUE;
        $this->_created_at_field = 'create_datetime';
        $this->_updated_at_field = 'update_datetime';
        $this->before_create = array('changeDateFormat');
        $this->before_update[] = 'changeDateFormat';
    }

    protected function changeDateFormat($data)
    {
        if (array_key_exists('result_date',$data)){
            $arrResultDate = explode(' ',$data['result_date']);
            $resultDate = explode('/',$arrResultDate[0]);
            $resultTime = $arrResultDate[1];
            $resultDateTime = ($resultDate[2]-543).'-'.$resultDate[1].'-'.$resultDate[0].' '.$resultTime;
            $data['result_date'] = $resultDateTime;
        }

        return $data;
    }

}
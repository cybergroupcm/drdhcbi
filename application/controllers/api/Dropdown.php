<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Dropdown extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/Accused_type_model');
        $this->load->model('master/Channel_model');
        $this->load->model('master/Complain_type_model');
        $this->load->model('master/Subject_model');
        $this->load->model('master/Wish_model');
        $this->load->model('master/Title_name_model');
        $this->load->model('master/Ccaa_model');
        $this->load->model('master/Send_org_model');
        $this->load->model('master/Area_part_model');
        $this->load->model('master/Current_status_model');
    }

    public function accused_type_lists_get()
    {
        $types = $this->Accused_type_model->as_dropdown('accused_type')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No accused type were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function channel_lists_get()
    {
        $types = $this->Channel_model->as_dropdown('channel_name')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No channel were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function complain_type_lists_get()
    {
        $types = $this->Complain_type_model->as_dropdown('complain_type_name')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No complain type were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function subject_lists_get()
    {
        $types = $this->Subject_model->as_dropdown('subject_name')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No subject were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function wish_lists_get()
    {

        $types = $this->Wish_model->as_dropdown('wish_name')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No wish were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function title_name_lists_get()
    {

        $types = $this->Title_name_model->as_dropdown('prename')->where('status_active','on')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No title name were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function ccaa_lists_get($ccType,$ccaa_code='')
    {
        $conditions = array();
        $conditions['ccType'] = $ccType;
        if($ccaa_code!=''){
            $conditions['ccDigi LIKE'] = $ccaa_code."%";
        }
        $types = $this->Ccaa_model->as_dropdown('ccName')->where($conditions)->get_all();
        
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No title name were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
      
    }


    public function send_org_parent_lists_get()
    {
        $types = $this->Send_org_model->as_dropdown('send_org_name')->where('parent_id','0')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No title name were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function send_org_lists_get()
    {
        $parent_list = $this->Send_org_model->as_dropdown('send_org_name')->where('parent_id','0')->get_all();
        $arr_send_org = array();
        foreach($parent_list AS $parent_id => $parent_name) {
            $arr_send_org[$parent_id] = $this->Send_org_model->as_dropdown('send_org_name')->where('parent_id',$parent_id)->get_all();
        }

        $types = $arr_send_org;

        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No complain type were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function area_part_lists_get()
    {
        $types = $this->Area_part_model->as_dropdown('area_part')->get_all();
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No title name were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function current_status_lists_get()
    {
        $types = $this->Current_status_model->as_dropdown('current_status_name')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No complain type were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function current_subject_lists_get()
    {
        $types = $this->Subject_model->as_dropdown('subject_name')->get_all();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No complain type were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}
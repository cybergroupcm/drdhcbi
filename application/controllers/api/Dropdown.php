<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Dropdown extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/AccusedType_model');
        $this->load->model('master/Channel_model');
        $this->load->model('master/ComplainType_model');
        $this->load->model('master/Subject_model');
        $this->load->model('master/Wish_model');
        $this->load->model('master/TitleName_model');
        $this->load->model('master/SendOrg_model');
    }

    public function accused_type_lists_get()
    {
        $types = $this->AccusedType_model->as_dropdown('accused_type')->get_all();
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
        $types = $this->ComplainType_model->as_dropdown('complain_type_name')->get_all();
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

        $types = $this->TitleName_model->as_dropdown('prename')->where('status_active','on')->get_all();
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

    public function send_org_parent_lists_get()
    {
        $types = $this->SendOrg_model->as_dropdown('send_org_name')->where('parent_id','0')->get_all();
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
        $parent_list = $this->SendOrg_model->as_dropdown('send_org_name')->where('parent_id','0')->get_all();
        $arr_send_org = array();
        foreach($parent_list AS $parent_id => $parent_name) {
            $arr_send_org[$parent_id] = $this->SendOrg_model->as_dropdown('send_org_name')->where('parent_id',$parent_id)->get_all();
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

}
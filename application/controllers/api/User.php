<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('master/AccusedType_model');
        $this->load->library(array('ion_auth'));
    }

    public function user_get()
    {
        $id = $this->get('id');
        $user          = $this->ion_auth->user($id)->row();
        $groups        = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        $data['user']          = $user;
        $data['groups']        = $groups;
        $data['currentGroups'] = $currentGroups;

        if (!empty($data)) {
            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function user_post()
    {
        $username = strtolower($this->post('username'));
        $email    = strtolower($this->post('email'));
        $password = $this->post('password');

        $additional_data = array(
            'first_name' => $this->post('first_name'),
            'last_name'  => $this->post('last_name'),
            'company'    => $this->post('company'),
            'phone'      => $this->post('phone'),
            'idcard' => $this->post('idcard'),
            'prename_th'=> $this->post('prename_th'),
            'prename_en'=> $this->post('prename_en'),
            'first_name_en' => $this->post('first_name_en'),
            'last_name_en'  => $this->post('last_name_en')
        );

        $ids = $this->ion_auth->register($username, $password, $email, $additional_data);
        //$this->response($this->post(), REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function user_put()
    {
        $data = array(
            'email' => $this->post('email'),
            'password' => $this->post('password'),
            'first_name' => $this->post('first_name'),
            'last_name'  => $this->post('last_name'),
            'company'    => $this->post('company'),
            'phone'      => $this->post('phone'),
            'idcard' => $this->post('personal_id'),
            'prename_th'=> $this->post('prename'),
            'prename_en'=> $this->post('prename_eng'),
            'first_name_en' => $this->post('first_name_eng'),
            'last_name_en'  => $this->post('last_name_eng')
        );

        $ids = $this->ion_auth->update($this->post('id'), $data);
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function user_delete()
    {
        $id = (int)$this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $ids = $this->AccusedType_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function user_groups_get()
    {
        $id = $this->get('id');
        $data = $this->ion_auth->permission_data_detail($id);
        if (!empty($data)) {
            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }



}
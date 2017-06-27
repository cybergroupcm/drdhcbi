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
        $types = $this->AccusedType_model->get_all();
        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($types) {
                // Set the response and exit
                $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int)$id;

        // Validate the id.
        if ($id <= 0) {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        //$type = NULL;
        $type = $this->AccusedType_model->get($id);

        if (!empty($type)) {
            $this->set_response($type, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function user_post()
    {
        $username = strtolower($this->post('first_name')) . ' ' . strtolower($this->post('last_name'));
        $email    = strtolower($this->post('email'));
        $password = $this->input->post('password');

        $additional_data = array(
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

        //$ids = $this->ion_auth->register($username, $password, $email, $additional_data);
        $this->response($this->post(), REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
        //$this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function user_put()
    {
        //$id = $this->put('accused_type');
        //$ids = $this->AccusedType_model->update(array('accused_type' => $this->put('accused_type')),$id);
        $ids = $this->AccusedType_model->update(array('accused_type' => $this->put('accused_type')),$this->put('accused_type_id'));
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



}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Complaint extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('complaint_model');
    }

    public function dashboard_get()
    {
        $users = $this->complaint_model->get_dashboard_data();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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

        $user = NULL;

        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if (isset($value['id']) && $value['id'] === $id) {
                    $user = $value;
                }
            }
        }

        if (!empty($user)) {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function complaint_type_get(){
        $complaint_type = $this->complaint_model->get_complaint_type();
        if ($complaint_type) {
            $this->response($complaint_type, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }
    public function accused_type_get(){
        $accused_type = $this->complaint_model->get_accused_type();
        if ($accused_type) {
            $this->response($accused_type, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }
    public function channel_get(){
        $channel = $this->complaint_model->get_channel();
        if ($channel) {
            $this->response($channel, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }
}
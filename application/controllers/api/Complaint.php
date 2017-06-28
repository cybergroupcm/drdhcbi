<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Complaint extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data/KeyIn_model');
    }

    public function dashboard_get()
    {
        $users = $this->KeyIn_model->get_dashboard_data();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else {
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
        }
        else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function key_in_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $complaint = $this->KeyIn_model->as_array()->get_all();
            if ($complaint) {
                $this->response($complaint, REST_Controller::HTTP_OK);
            }
            else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No complaint were found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
        $id = (int)$id;
        if ($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }
        $complaint = $this->KeyIn_model->get($id);
        if (!empty($complaint)) {
            $this->set_response($complaint, REST_Controller::HTTP_OK);
        }
        else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'complaint could not be found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

    }

    public function key_in_post()
    {

    }

    public function key_in_put()
    {

    }

    public function key_in_delete()
    {

    }

    //รับเรื่อง
    public function received_put(){
        $ids = $this->KeyIn_model->update(array('receive_date' => $this->put('receive_date')), $this->put('keyin_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    //ส่งต่อเรื่องร้องทุกข์
    public function send_put(){
        $ids = $this->KeyIn_model->update(array(
            'reply_date' => $this->put('reply_date'),
            'send_org_date' => $this->put('send_org_date'),
            'send_org_id' => $this->put('send_org_id'),
        ), $this->put('keyin_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Setting extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/AccusedType_model');
        $this->load->model('master/Channel_model');
        $this->load->model('master/ComplainType_model');
        $this->load->model('master/Subject_model');
        $this->load->model('master/Wish_model');
    }

    public function accused_type_get()
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

    public function accused_type_post()
    {
        $ids = $this->AccusedType_model->insert(array('accused_type' => $this->post('accused_type')));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function accused_type_put()
    {
        //$id = $this->put('accused_type');
        //$ids = $this->AccusedType_model->update(array('accused_type' => $this->put('accused_type')),$id);
        $ids = $this->AccusedType_model->update(array('accused_type' => $this->put('accused_type')), $this->put('accused_type_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function accused_type_delete()
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

    public function channel_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            $types = $this->Channel_model->get_all();
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
        $type = $this->Channel_model->get($id);

        if (!empty($type)) {
            $this->set_response($type, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function channel_post()
    {
        $ids = $this->Channel_model->insert(array('channel_name' => $this->post('channel_name')));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function channel_put()
    {
        //$id = $this->put('accused_type');
        //$ids = $this->AccusedType_model->update(array('accused_type' => $this->put('accused_type')),$id);
        $ids = $this->Channel_model->update(array('channel_name' => $this->put('channel_name')), $this->put('channel_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function channel_delete()
    {
        $id = (int)$this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $ids = $this->Channel_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function complain_type_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            $types = $this->ComplainType_model->get_all();
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
        $type = $this->ComplainType_model->get($id);

        if (!empty($type)) {
            $this->set_response($type, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function complain_type_post()
    {
        $ids = $this->ComplainType_model->insert(array('complain_type_name' => $this->post('complain_type_name')));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function complain_type_put()
    {
        //$id = $this->put('accused_type');
        //$ids = $this->AccusedType_model->update(array('accused_type' => $this->put('accused_type')),$id);
        $ids = $this->ComplainType_model->update(array('complain_type_name' => $this->put('complain_type_name')), $this->put('complain_type_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function complain_type_delete()
    {
        $id = (int)$this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $ids = $this->ComplainType_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function subject_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            $types = $this->Subject_model->get_all();
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
        $type = $this->Subject_model->get($id);

        if (!empty($type)) {
            $this->set_response($type, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function subject_post()
    {
        $ids = $this->Subject_model->insert(array('subject_name' => $this->post('subject_name')));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function subject_put()
    {
        $ids = $this->Subject_model->update(array('subject_name' => $this->put('subject_name')), $this->put('subject_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function subject_delete()
    {
        $id = (int)$this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $ids = $this->Subject_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function wish_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            $types = $this->Wish_model->get_all();
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
        $type = $this->Wish_model->get($id);

        if (!empty($type)) {
            $this->set_response($type, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function wish_post()
    {
        $ids = $this->Wish_model->insert(array('wish_name' => $this->post('wish_name')));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function wish_put()
    {
        $ids = $this->Wish_model->update(array('wish_name' => $this->put('wish_name')), $this->put('wish_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function wish_delete()
    {
        $id = (int)$this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $ids = $this->Wish_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
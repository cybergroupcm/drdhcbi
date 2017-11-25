<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Setting extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/Accused_type_model');
        $this->load->model('master/Channel_model');
        $this->load->model('master/Complain_type_model');
        $this->load->model('master/Subject_model');
        $this->load->model('master/Wish_model');
        $this->load->model('master/Send_org_model');
        $this->load->model('master/Setting_upload_model');
        $this->load->model('data/Key_in_model');
    }

    public function accused_type_get()
    {
        $id = $this->get('id');
        $type= $this->get('type');
        $parent_id= $this->get('parent_id');

        if($type == 'parent'){
            $data_result = $this->Accused_type_model->where('parent_id', $parent_id)->order_by('accused_type_id', 'DESC')->get_all();
        }else {
            $data_result = $this->Accused_type_model->where('parent_id', '0')->order_by('accused_type_id', 'DESC')->get_all();
        }
        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($data_result) {
                // Set the response and exit
                $this->response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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
        $data_result = $this->Accused_type_model->get($id);

        if (!empty($data_result)) {
            $this->set_response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function accused_type_post()
    {
        $ids = $this->Accused_type_model->insert(array(
            'accused_type' => $this->post('accused_type'),
            'parent_id' => $this->post('parent_id')
        ));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function accused_type_put()
    {
        //$id = $this->put('accused_type');
        //$ids = $this->AccusedType_model->update(array('accused_type' => $this->put('accused_type')),$id);
        $ids = $this->Accused_type_model->update(array(
            'accused_type' => $this->put('accused_type'),
            'parent_id' => $this->put('parent_id')
        ), $this->put('accused_type_id'));
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

        $ids = $this->Accused_type_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function channel_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            $types = $this->Channel_model->order_by('channel_id', 'DESC')->get_all();
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
        $type= $this->get('type');
        $parent_id= $this->get('parent_id');
        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            $types = $this->Complain_type_model->get_all();

            if($type == 'parent'){
                $data_result = $this->Complain_type_model->where('parent_id', $parent_id)->order_by('complain_type_id', 'DESC')->get_all();
            }else {
                $data_result = $this->Complain_type_model->where('parent_id', '0')->order_by('complain_type_id', 'DESC')->get_all();
            }
            if ($data_result) {
                // Set the response and exit
                $this->response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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
        $data_result = $this->Complain_type_model->get($id);

        if (!empty($data_result)) {
            $this->set_response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function complain_type_post()
    {
        $ids = $this->Complain_type_model->insert(array(
            'complain_type_name' => $this->post('complain_type_name'),
            'parent_id' => $this->post('parent_id'),
            'status_active' => '1',
            'icon_pin' => $this->post('icon_pin')
        ));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function complain_type_put()
    {
        $data = $this->put();
        if (!array_key_exists('complain_type_name', $data)) {
            unset($data['complain_type_name']);
        }
        if (!array_key_exists('parent_id', $data)) {
            unset($data['parent_id']);
        }
        if (!array_key_exists('icon_pin', $data)) {
            unset($data['icon_pin']);
        }

        $status_active = $data['status_active'];
        if (!array_key_exists('status_active', $data)) {
            unset($data['status_active']);
        }
        if (array_key_exists('complain_type_id', $data)) {
            $complain_type_id = $data['complain_type_id'];
            unset($data['complain_type_id']);
        }

        if (!empty($complain_type_id)) {
            if ($status_active != '' || !empty($status_active)) {
                $data_result = $this->Complain_type_model->where('parent_id', $complain_type_id)->order_by('complain_type_id', 'DESC')->get_all();
                foreach($data_result AS $val){
                    $this->Complain_type_model->update(array(
                        'status_active' => $status_active
                    ), $val->complain_type_id);
                }
            }
            $ids = $this->Complain_type_model->update($data, $complain_type_id);
        }

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

        $ids = $this->Complain_type_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function subject_get()
    {

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            $types = $this->Subject_model->order_by('subject_id', 'DESC')->get_all();
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
            $types = $this->Wish_model->order_by('wish_id', 'DESC')->get_all();
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

    public function org_get()
    {
        $id = $this->get('id');
        $type= $this->get('type');
        $parent_id= $this->get('parent_id');

        if ($id === NULL) {
            if($type == 'parent'){
                $data_result = $this->Send_org_model->where(array('parent_id'=> $parent_id,'active'=>'1'))->order_by('send_org_id', 'DESC')->get_all();
            }else {
                $data_result = $this->Send_org_model->where(array('parent_id'=>'0','active'=>'1'))->order_by('send_org_id', 'DESC')->get_all();
            }
            if ($data_result) {
                $this->response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        $id = (int)$id;
        if ($id <= 0) {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $data_result = $this->Send_org_model->get($id);

        if (!empty($data_result)) {
            $this->set_response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function org_post()
    {
        $ids = $this->Send_org_model->insert(array(
            'send_org_name' => $this->post('send_org_name'),
            'parent_id' => $this->post('parent_id')
        ));
        $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function org_put()
    {
        $ids = $this->Send_org_model->update(array(
            'send_org_name' => $this->put('send_org_name'),
            'parent_id' => $this->put('parent_id')
        ), $this->put('send_org_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function org_delete()
    {
        $id = (int)$this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $ids = $this->Send_org_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function use_org_get()
    {
        $id = $this->get('id');
        $data_result = $this->Key_in_model->where('send_org_id', $id)->get_all();
        if ($data_result) {
            $this->response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function use_accused_type_get()
    {
        $id = $this->get('id');
        $data_result = $this->Key_in_model->where('accused_type_id', $id)->get_all();
        if ($data_result) {
            $this->response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function use_complain_type_get()
    {
        $id = $this->get('id');
        $data_result = $this->Key_in_model->where('complain_type_id', $id)->get_all();
        if ($data_result) {
            $this->response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function setting_upload_get($id)
    {
        $data_result = $this->Setting_upload_model->where('setting_id', $id)->get();
        if ($data_result) {
            $this->response($data_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function setting_upload_post()
    {
        //$ids = $this->Setting_upload_model->update(array(
            //'upload_size' => $this->post('upload_size'),
            //'upload_type' => $this->post('upload_type')
        //), $this->post('setting_id'));
            //echo $this->post('upload_size')." ".$this->post('upload_type')." ".$this->post('setting_id');
        $ids = $this->db->query("UPDATE ms_setting_upload SET upload_size = '".$this->post('upload_size')."', upload_type = '".$this->post('upload_type')."' WHERE setting_id = '".$this->post('setting_id')."' ");
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }else{
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Complaint extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data/KeyIn_model');
        $this->load->helper('file');
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
            $complaint = $this->KeyIn_model->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->get_all();
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
        $complaint = $this->KeyIn_model->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->get($id);
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

        $data = $this->post();
        $complaintType = $data['complaint_type'];
        unset($data['complaint_type']);
        $wish = $data['wish'];
        unset($data['wish']);
        //$attachFile = $data['attach_file'];
        unset($data['attach_file']);
        $keyInID = $this->KeyIn_model->insert($data);
        if(!empty($keyInID)&&count($complaintType)>0){
            foreach ($complaintType as $item){
                $this->KeyIn_model->insertPivotComplaintType($keyInID,$item);
            }
        }
        if(!empty($keyInID)&&count($wish)>0){
            foreach ($wish as $item){
                $this->KeyIn_model->insertPivotWish($keyInID,$item);
            }
        }
        //print_r($_FILES['attach_file']);
        //$uploads = $this->do_uploads('attach_file');
        /*if(!empty($keyInID)&&count($attachFile)>0){
            foreach ($wish as $item){
            }
        }*/

        /*$data = [
            'create_user_id' => $this->post('create_user_id'),
            'update_user_id' => $this->post('create_user_id'),
            'complain_no' => '',
            'complain_date' => $this->post('complain_date'),
            'recipient' => $this->post('recipient'),
            'doc_receive_date' => $this->post('doc_receive_date'),
            'doc_receive_no' => $this->post('doc_receive_no'),
            'doc_send_date' => $this->post('doc_send_date'),
            'doc_send_no' => $this->post('doc_send_no'),
            'complain_type_id' => '2',
            'complain_name' => 'แจ้งเรื่องการทุจริต',
            'channel_id' => '2',
            'subject_id' => '2',
            'user_complain_type_id' => '1',
            'id_card' => '''',
            'pn_id' => '0',
            'first_name' => ',
            'last_name' => '''',
            'phone_number' => '''',
            'accused_type_id' => '2',
            'accused_name' => 'นายสุชาติ นามจริง',
            'scene_date' => '0000-00-00',
            'place_scene' => 'พื้นที่ตำบลห้วยกะปิ',
            'province_id' => '20000000',
            'district_id' => '20010000',
            'subdistrict_id' => '20011500',
            'complaint_detail' => 'แจ้งเรื่องการทุจริต การทำถนน',
            'latitude' => '13.3078520014',
            'longitude' => '100.9673699996',
            'wish_detail' => 'ตรวจสอบข้อเท็จจริง',
            'receive_date' => '0000-00-00',
            'reply_date' => '0000-00-00',
            'send_org_id' => '0',
            'send_org_date' => '0000-00-00'
        ];*/
        $this->set_response($uploads, REST_Controller::HTTP_CREATED);
//        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }

    public function key_in_put()
    {
        $data = $this->put();
        unset($data['complaint_type']);
        unset($data['wish']);
        unset($data['attach_file']);
        $keyInID = $this->KeyIn_model->insert($data);
        /*$data = [
            'create_user_id' => $this->post('create_user_id'),
            'update_user_id' => $this->post('create_user_id'),
            'complain_no' => '',
            'complain_date' => $this->post('complain_date'),
            'recipient' => $this->post('recipient'),
            'doc_receive_date' => $this->post('doc_receive_date'),
            'doc_receive_no' => $this->post('doc_receive_no'),
            'doc_send_date' => $this->post('doc_send_date'),
            'doc_send_no' => $this->post('doc_send_no'),
            'complain_type_id' => '2',
            'complain_name' => 'แจ้งเรื่องการทุจริต',
            'channel_id' => '2',
            'subject_id' => '2',
            'user_complain_type_id' => '1',
            'id_card' => '''',
            'pn_id' => '0',
            'first_name' => ',
            'last_name' => '''',
            'phone_number' => '''',
            'accused_type_id' => '2',
            'accused_name' => 'นายสุชาติ นามจริง',
            'scene_date' => '0000-00-00',
            'place_scene' => 'พื้นที่ตำบลห้วยกะปิ',
            'province_id' => '20000000',
            'district_id' => '20010000',
            'subdistrict_id' => '20011500',
            'complaint_detail' => 'แจ้งเรื่องการทุจริต การทำถนน',
            'latitude' => '13.3078520014',
            'longitude' => '100.9673699996',
            'wish_detail' => 'ตรวจสอบข้อเท็จจริง',
            'receive_date' => '0000-00-00',
            'reply_date' => '0000-00-00',
            'send_org_id' => '0',
            'send_org_date' => '0000-00-00'
        ];*/
        $this->set_response($keyInID, REST_Controller::HTTP_CREATED);

    }

    public function key_in_delete()
    {

    }

    public function test_get(){
        //$complaint = $this->KeyIn_model->fields('complain_no')->where('complain_nod','like','201704','before')->get_all();
        $complaint = $this->KeyIn_model->genComplainNo();

        $this->response($complaint, REST_Controller::HTTP_OK);
    }

    private function do_uploads($field)
    {
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png';
//        $config['max_size']             = 100;
//        $config['max_width']            = 1024;
//        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        $this->load->library('my_upload', $config);


        if ( ! $this->upload->do_multi_upload($field))
        {
            return $error = array('error' => $this->upload->display_errors());

            //$this->load->view('upload_form', $error);
        }
        else
        {
            return $data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);
        }
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
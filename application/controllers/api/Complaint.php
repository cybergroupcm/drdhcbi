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
        $page = $this->get('page');
        $total_complaint = $this->KeyIn_model->count_rows(); // retrieve the total number of posts
        $complaint = $this->KeyIn_model->order_by('keyin_id', 'DESC')->with_prename('fields:prename')->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->paginate(15, $total_complaint, $page); // paginate with 10 rows per page -

        if ($complaint) {
            // Set the response and exit
            $this->response($complaint, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No complaint were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    public function total_row_get()
    {
        $total_complaint = $this->KeyIn_model->count_rows(); // retrieve the total number of posts

        if ($total_complaint) {
            // Set the response and exit
            $this->response($total_complaint, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No complaint were found'
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
        if (!empty($keyInID) && count($complaintType) > 0) {
            foreach ($complaintType as $item) {
                $this->KeyIn_model->insertPivotComplaintType($keyInID, $item);
            }
        }
        if (!empty($keyInID) && count($wish) > 0) {
            foreach ($wish as $item) {
                $this->KeyIn_model->insertPivotWish($keyInID, $item);
            }
        }
        //print_r($_FILES['attach_file']);
        //$uploads = $this->do_uploads('attach_file');
        /*if(!empty($keyInID)&&count($attachFile)>0){
            foreach ($wish as $item){
            }
        }*/
        $this->set_response($keyInID, REST_Controller::HTTP_CREATED);
    }

    public function key_in_put()
    {
        $data = $this->put();
        unset($data['keyin_id']);
        $complaintType = $data['complaint_type'];
        unset($data['complaint_type']);
        $wish = $data['wish'];
        unset($data['wish']);
        //$attachFile = $data['attach_file'];
        unset($data['attach_file']);
        if (!empty($keyInID)) {
            $updateRow = $this->KeyIn_model->update($data, $keyInID);
        }
        $this->KeyIn_model->beforeInsertPivotComplaintType($keyInID);
        if (!empty($keyInID) && count($complaintType) > 0) {
            foreach ($complaintType as $item) {
                $this->KeyIn_model->insertPivotComplaintType($keyInID, $item);
            }
        }
        $this->KeyIn_model->beforeInsertPivotWish($keyInID);
        if (!empty($keyInID) && count($wish) > 0) {
            foreach ($wish as $item) {
                $this->KeyIn_model->insertPivotWish($keyInID, $item);
            }
        }
        $this->set_response($updateRow, REST_Controller::HTTP_ACCEPTED);

    }

    public function key_in_delete()
    {
        $id = $this->delete('id');
        if ($id == NULL) {
            $this->response([
                'status' => FALSE,
                'message' => 'complaint could not be delete'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        else {
            $complaint = $this->KeyIn_model->delete($id);
            $this->response($complaint, REST_Controller::HTTP_OK);
        }

    }

    public function test_com_get()
    {
        $complaint = $this->KeyIn_model->genComplainNo('2017-05-01');

        $this->response($complaint, REST_Controller::HTTP_OK);
    }

    private function do_uploads($field)
    {
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size']             = 100;
//        $config['max_width']            = 1024;
//        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        $this->load->library('my_upload', $config);


        if (!$this->upload->do_multi_upload($field)) {
            return $error = array('error' => $this->upload->display_errors());

            //$this->load->view('upload_form', $error);
        }
        else {
            return $data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);
        }
    }

    //รับเรื่อง
    public function received_put()
    {
        $ids = $this->KeyIn_model->update(array(
            'receive_date' => $this->put('receive_date'),
            'current_status_id' => $this->put('current_status_id')
        ), $this->put('keyin_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    //ส่งต่อเรื่องร้องทุกข์
    public function send_put()
    {
        $ids = $this->KeyIn_model->update(array(
            'reply_date' => $this->put('reply_date'),
            'send_org_date' => $this->put('send_org_date'),
            'send_org_id' => $this->put('send_org_id'),
            'current_status_id' => $this->put('current_status_id')
        ), $this->put('keyin_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }
}
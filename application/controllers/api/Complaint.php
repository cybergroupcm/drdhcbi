<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Complaint extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data/Key_in_model');
        $this->load->model('data/Result_model');
        $this->load->model('data/User_model');
        $this->load->model('data/Attach_file_model');
        $this->load->helper('file','url','api');
    }

    public function dashboard_get()
    {
        $page = $this->get('page');
        $total_complaint = $this->Key_in_model->count_rows(); // retrieve the total number of posts
        $complaint = $this->Key_in_model->order_by('keyin_id', 'DESC')->with_title_name('fields:prename')->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->with_current_status('fields:current_status_name')->paginate(15, $total_complaint, $page); // paginate with 10 rows per page -

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
        $total_complaint = $this->Key_in_model->count_rows(); // retrieve the total number of posts

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
            $complaint = $this->Key_in_model->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->with_title_name('fields:prename')->with_subject('fields:subject_name')->with_channel('fields:channel_name')->with_attach_file('fields:file_id,file_name,file_system_name')->get_all();
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
        $complaint = $this->Key_in_model->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->with_title_name('fields:prename')->with_subject('fields:subject_name')->with_channel('fields:channel_name')->with_attach_file('fields:file_id,file_name,file_system_name')->get($id);
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
        $user = $this->jwt_decode($this->jwt_token());
        $data = $this->post();
        if (array_key_exists('userid', $user)) {
            $data['create_user_id'] = $user ['userid'];
            $data['update_user_id'] = $user ['userid'];
        }
        $complaintType = null;
        $wish = null;
        if (array_key_exists('complaint_type', $data)) {
            $complaintType = $data['complaint_type'];
            unset($data['complaint_type']);
        }
        if (array_key_exists('wish', $data)) {
            $wish = $data['wish'];
            unset($data['wish']);
        }
        $keyInID = $this->Key_in_model->insert($data);
        if (!is_null($keyInID) && count($complaintType) > 0) {
            foreach ($complaintType as $item) {
                $this->Key_in_model->insertPivotComplaintType($keyInID, $item);
            }
        }
        if (!is_null($keyInID) && count($wish) > 0) {
            foreach ($wish as $item) {
                $this->Key_in_model->insertPivotWish($keyInID, $item);
            }
        }
        $this->set_response($keyInID, REST_Controller::HTTP_CREATED);
    }

    public function key_in_put()
    {
        $data = $this->put();
        if (array_key_exists('keyin_id', $data)) {
            $keyInID = $data['keyin_id'];
            unset($data['keyin_id']);
        }
        else {
            $this->response([
                'status' => FALSE,
                'message' => 'No keyin_id were found'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        unset($data['complain_no']);

        if (array_key_exists('complaint_type', $data)) {
            $complaintType = $data['complaint_type'];
            unset($data['complaint_type']);
        }
        if (array_key_exists('wish', $data)) {
            $wish = $data['wish'];
            unset($data['wish']);
        }

        if (!empty($keyInID)) {
            $updateRow = $this->Key_in_model->update($data, $keyInID);
        }
        $this->Key_in_model->beforeInsertPivotComplaintType($keyInID);
        if (!empty($keyInID) && count($complaintType) > 0) {
            foreach ($complaintType as $item) {
                $this->Key_in_model->insertPivotComplaintType($keyInID, $item);
            }
        }
        $this->Key_in_model->beforeInsertPivotWish($keyInID);
        if (!empty($keyInID) && count($wish) > 0) {
            foreach ($wish as $item) {
                $this->Key_in_model->insertPivotWish($keyInID, $item);
            }
        }
        $this->set_response($keyInID, REST_Controller::HTTP_CREATED);

    }

    public function key_in_delete()
    {
        $id = (int)$this->get('id');
        if ($id == NULL) {
            $this->response([
                'status' => FALSE,
                'message' => 'complaint could not be delete'
            ], REST_Controller::HTTP_NOT_ACCEPTABLE);
        }
        else {
            $complaint = $this->Key_in_model->delete($id);
            $this->response($complaint, REST_Controller::HTTP_OK);
        }

    }

    public function key_in_file_post()
    {
        $post = $this->post();
        $files = $this->do_uploads($post['keyin_id'], 'attach_file');
        $result = [];
        if (array_key_exists('error', $files)) {
            $this->response($files['error'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        }
        else {
            $docPath = str_replace('application/','',APPPATH);
            foreach ($files['upload_data'] as $file) {
                $data = [
                    'keyin_id' => $post['keyin_id'],
                    'file_name' => $file['file_name'],
                    'file_system_name' => str_replace($docPath, '', $file['full_path']),
                ];
                $result[] = $this->Attach_file_model->insert($data);
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }

    public function key_in_file_delete()
    {
        $id = (int) $this->get('id');
        if ($id == NULL) {
            $this->response([
                'status' => FALSE,
                'message' => 'file upload could not be delete'
            ], REST_Controller::HTTP_NOT_ACCEPTABLE);
        }
        else {
            $docPath = str_replace('application/','',APPPATH);
            $file = $this->Attach_file_model->get($id);
            $files = $this->Attach_file_model->delete($id);
            if($files){
                $path = $docPath.$file->file_system_name;
                delete_files($path);
                $this->response($files, REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'file upload could not be delete'
                ], REST_Controller::HTTP_NOT_ACCEPTABLE);
            }
        }
    }

    private function do_uploads($keyin_id, $field)
    {
        $config['upload_path'] = './upload/complaints/' . $keyin_id;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = 'fileupload';

        if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

        $this->load->library('upload', $config);
        $this->load->library('my_upload', $config);

        $upload = $this->upload->do_multi_upload($field);
        if (!$upload) {
            return $error = array('error' => $this->upload->display_errors());
        }
        else {
            return $data = array('upload_data' => $upload);
        }
    }

    //รับเรื่อง
    public function received_put()
    {
        $ids = $this->Key_in_model->update(array(
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
        $ids = $this->Key_in_model->update(array(
            'reply_date' => $this->put('reply_date'),
            'send_org_date' => $this->put('send_org_date'),
            'send_org_id' => $this->put('send_org_id'),
            'current_status_id' => $this->put('current_status_id')
        ), $this->put('keyin_id'));
        if ($ids) {
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function result_post(){
        $data = $this->post();
        $id = $this->Result_model->insert($data);
        if(!$id){
            $this->response($id, REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response($id, REST_Controller::HTTP_OK);
        }
    }

    public function result_put(){
        $data = $this->put();
        $id = $this->Result_model->update($data);
        if(!$id){
            $this->response($id, REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response($id, REST_Controller::HTTP_OK);
        }
    }

    public function result_delete(){
        $data = $this->delete('result_id');
        $id = $this->Result_model->delete($data);
        if(!$id){
            $this->response($id, REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response($id, REST_Controller::HTTP_OK);
        }
    }

    public function user_mode_permission_get()
    {
        $user_id = $this->get('user_id');
        $sql = " SELECT
                    au_applications.mode_id,
                    au_applications.app_id,
                    au_applications.app_name
                FROM au_users_groups
                INNER JOIN au_groups_permissions ON au_groups_permissions.gid = au_users_groups.group_id
                INNER JOIN au_applications ON au_applications.app_id = au_groups_permissions.appid
                WHERE au_users_groups.user_id = '".$user_id."'
                ORDER BY au_applications.order_by ASC ";
        $user_data = $this->User_model->sql_query($sql)->result_array();
        if( !empty($user_data) ) {
            $result_data = array();
            foreach( $user_data as $key => $value ){
                $result_data[$value['mode_id']][$value['app_id']] = $value['app_id'];
            }
            $this->response($result_data, REST_Controller::HTTP_OK);
        }else{
            $this->response($user_id, REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
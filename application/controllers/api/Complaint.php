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
        $this->load->model('data/Result_attach_file_model');
        $this->load->helper('file');
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
            $complaint = $this->Key_in_model->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->get_all();
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
        $complaint = $this->Key_in_model->with_complaint_type('fields:complain_type_name')->with_wish('fields:wish_name')->get($id);
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
        if(array_key_exists('userid',$user)){
            $data['create_user_id'] = $user ['userid'];
            $data['update_user_id'] = $user ['userid'];
        }
        $complaintType=null;
        $wish=null;
        if (array_key_exists('complaint_type', $data)) {
            $complaintType = $data['complaint_type'];
            unset($data['complaint_type']);
        }
        if (array_key_exists('wish', $data)) {
            $wish = $data['wish'];
            unset($data['wish']);
        }
        /*if (array_key_exists('attach_file', $data)) {
            //$attachFile = $data['attach_file'];
            unset($data['attach_file']);
        }*/
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
        //parse_str(file_get_contents("php://input"),$data);
        print_r($data);
        if (array_key_exists('keyin_id', $data)) {
            $keyInID = $data['keyin_id'];
            unset($data['keyin_id']);
        }else{
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

        if (array_key_exists('attach_file', $data)) {
            //$attachFile = $data['attach_file'];
            unset($data['attach_file']);
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
        $this->set_response($updateRow, REST_Controller::HTTP_CREATED);

    }

    public function key_in_delete()
    {
        $id = (int) $this->get('id');
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

    public function key_in_file_post(){

    }

    public function test_com_get()
    {
        $complaint = $this->Key_in_model->genComplainNo('2017-05-01');

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

    public function resule_file_attach_post(){
        //echo"<pre>";print_r($_POST);print_r($_FILES);echo"</pre>";
        foreach(@$_FILES['attach_file']['name'] as $key_file => $value_file){
            if(@$value_file!=''){
                $output_dir = "./upload/result_attach_file/";
                //echo $output_dir;
                if(!@mkdir($output_dir,0,true)){
                   chmod($output_dir, 0777);
                }else{
                   chmod($output_dir, 0777);
                }
                    $ret = array();
                    $error =$_FILES["attach_file"]["error"][$key_file];
                    $fileName=array();
                    $list_dir = array(); 
                        $cdir = scandir($output_dir); 
                        foreach ($cdir as $key => $value) { 
                           if (!in_array($value,array(".",".."))) { 
                              if (is_dir(@$dir . DIRECTORY_SEPARATOR . $value)){ 
                                $list_dir[$value] = dirToArray(@$dir . DIRECTORY_SEPARATOR . $value); 
                              }else{
                                if(substr($value,0,8) == date('Ymd')){
                                $list_dir[] = $value;
                                }
                              } 
                           } 
                        }
                        $explode_arr=array();
                        foreach($list_dir as $key => $value){
                            $task = explode('.',$value);
                            $task2 = explode('_',$task[0]);
                            $explode_arr[] = $task2[1];
                        }
                        $max_run_num = sprintf("%04d",count($explode_arr)+1);
                        $explode_old_file = explode('.',$_FILES["attach_file"]["name"][$key_file]);
                        $new_file_name = date('Ymd')."_".$max_run_num.".".$explode_old_file[(count($explode_old_file)-1)];
                    if(!is_array($_FILES["attach_file"]["name"][$key_file])) //single file
                    {
                            $fileName['name'] = $new_file_name;
                            $fileName['size'] = $_FILES["attach_file"]["size"][$key_file];
                            $fileName['type'] = $_FILES["attach_file"]["type"][$key_file];
                            $fileName['old_name'] = $_FILES["attach_file"]["name"][$key_file];
                            move_uploaded_file($_FILES["attach_file"]["tmp_name"][$key_file],$output_dir.$fileName['name']);
                    }
                    $data = array(
                        'keyin_id' => $this->post('keyin_id_result'),
                        'file_name' => $_FILES["attach_file"]["name"][$key_file],
                        'file_system_name' => $fileName['name'],
                    );
                $id = $this->Result_attach_file_model->insert($data);
                if(!$id){
                    $this->response($id, REST_Controller::HTTP_NOT_FOUND);
                }else{
                    $this->response($id, REST_Controller::HTTP_OK);
                }
            }
        }
        exit;
    }
}
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
        $this->load->model('data/Result_attach_file_model');
        $this->load->model('data/Attach_file_model');
        $this->load->model('master/Accused_type_model');
        $this->load->model('master/Complain_type_model');
        $this->load->model('master/Send_org_model');
        $this->load->helper('file','url','api');
        $this->load->library(array('accused_type','complain_type'));
    }

    public function dashboard_last_month_get()
    {
        $filter = [];
        $channel = $this->get('channel_id');
        $subject = $this->get('subject_id');
        $complainType = $this->get('complain_type_id');
        $province = $this->get('province_id');
        $district = $this->get('district_id');
        $address = $this->get('address_id');
        $currentStatus = $this->get('current_status');
        $complainNo = $this->get('complain_no');
        $complaintDetail = $this->get('complaint_detail');
        $petitioner = $this->get('petitioner');
        $dateStart = $this->get('complaint_date_start');
        $dateEnd = $this->get('complaint_date_end');
        $timeStart = $this->get('time_start');
        $timeEnd = $this->get('time_end');
        $overall = $this->get('overall');
        $user_id = $this->get('user_id');
        $no_status = $this->get('no_status');
        if (!is_null($channel)) {
            $filter['channel_id'] = $channel;
        }
        if (!is_null($subject)) {
            $filter['subject_id'] = $subject;
        }
        if (!is_null($complainType)) {
            $filter['complain_type_id'] = $complainType;
        }
        if (!is_null($address)) {
            $filter['address_id'] = $address;
        }elseif (!is_null($district)) {
            $filter['address_id LIKE'] = substr($district,0,4). '%';
        }elseif (!is_null($province)) {
            $filter['address_id LIKE'] = substr($province,0,2). '%';
        }
        if (!is_null($currentStatus) && $currentStatus >= 1 && $currentStatus <= 6) {
            $filter['current_status_id'] = $currentStatus;
        }
        if (!is_null($complainNo)) {
            $filter['complain_no LIKE'] = '%' . urldecode($complainNo) . '%';
        }
        if (!is_null($complaintDetail)) {
            $filter['complaint_detail LIKE'] = '%' . urldecode($complaintDetail) . '%';
        }
        if (!is_null($petitioner)) {
            $filter['CONCAT(first_name,last_name) LIKE'] = '%' . urldecode($petitioner) . '%';
        }
        if (!is_null($dateStart) && !is_null($dateEnd)) {
            $filter['complain_date >='] = urldecode($dateStart);
            $filter['complain_date <='] = urldecode($dateEnd);
        }
        elseif (!is_null($dateStart) && is_null($dateEnd)) {
            $filter['complain_date >='] = urldecode($dateStart);
        }
        elseif (is_null($dateStart) && !is_null($dateEnd)) {
            $filter['complain_date <='] = urldecode($dateEnd);
        }
        if (!is_null($timeStart) && !is_null($timeEnd)) {
            $filter['TIME(complain_date) >='] = urldecode($timeStart);
            $filter['TIME(complain_date) <='] = urldecode($timeEnd);
        }
        elseif (!is_null($timeStart) && is_null($timeEnd)) {
            $filter['TIME(complain_date) >='] = urldecode($timeStart);
        }
        elseif (is_null($timeStart) && !is_null($timeEnd)) {
            $filter['TIME(complain_date) <='] = urldecode($timeEnd);
        }
        if(count($filter)==0){
            $filter['MONTH(complain_date)'] = date('m');
            $filter['YEAR(complain_date)'] = date('Y');
        }
        $no_show_status['current_status_id <> '] = $no_status; #ไม่แสดงสถานะยกเลิก
        if ($overall == 1) { // มองเห็น เรื่องร้องเรียนทั้งหมด
            $complaint = $this->Key_in_model
                ->where($no_show_status)
                ->where($filter)
                ->order_by('complain_no', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->with_attach_file('fields:file_name')
                ->get_all();
        }
        else {
            $complaint = $this->Key_in_model
                ->where($no_show_status)
                ->where($filter)
                ->where('create_user_id', $user_id)
                ->order_by('complain_no', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->with_attach_file('fields:file_name')
                ->get_all();
        }
        if ($complaint) {
            // Set the response and exit
            $this->response($complaint, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No complaint were found',
                $filter
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function dashboard_mobile_get()
    {
        $filter = [];
        $currentStatus = $this->get('current_status');
        $complainNo = $this->get('complain_no');
        $complaintDetail = $this->get('complaint_detail');
        $petitioner = $this->get('petitioner');
        $dateStart = $this->get('complaint_date_start');
        $dateEnd = $this->get('complaint_date_end');
//        $overall = $this->get('overall');
        $overall = 1;
        $user_id = $this->get('user_id');
        $page = $this->get('page');
        if (!is_null($currentStatus) && $currentStatus >= 1 && $currentStatus <= 4) {
            $filter['current_status_id'] = $currentStatus;
        }
        if (!is_null($complainNo)) {
            $filter['complain_no LIKE'] = '%' . urldecode($complainNo) . '%';
        }
        if (!is_null($complaintDetail)) {
            $filter['complaint_detail LIKE'] = '%' . urldecode($complaintDetail) . '%';
        }
        if (!is_null($petitioner)) {
            $filter['CONCAT(first_name,last_name) LIKE'] = '%' . urldecode($petitioner) . '%';
        }
        if (!is_null($dateStart) && !is_null($dateEnd)) {
            $filter['complain_date >='] = urldecode($dateStart);
            $filter['complain_date <='] = urldecode($dateEnd);
        }
        elseif (!is_null($dateStart) && is_null($dateEnd)) {
            $filter['complain_date >='] = urldecode($dateStart);
        }
        elseif (is_null($dateStart) && !is_null($dateEnd)) {
            $filter['complain_date <='] = urldecode($dateEnd);
        }
        /*if(count($filter)==0){
            $filter['MONTH(complain_date)'] = date('m');
            $filter['YEAR(complain_date)'] = date('Y');
        }*/
        if ($overall == 1) { // มองเห็น เรื่องร้องเรียนทั้งหมด
            $total_complaint = $this->Key_in_model
                ->where($filter)
                ->order_by('complain_no', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->count_rows();
            if(!$total_complaint){
                $total_complaint = 1;
            }
            $complaint = $this->Key_in_model
                ->where($filter)
                ->order_by('complain_no', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->paginate(15, $total_complaint, $page);
        }
        else {
            $total_complaint = $this->Key_in_model
                ->where($filter)
                ->where('create_user_id', $user_id)
                ->order_by('complain_no', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->count_rows();
            if(!$total_complaint){
                $total_complaint = 1;
            }
            $complaint = $this->Key_in_model
                ->where($filter)
                ->where('create_user_id', $user_id)
                ->order_by('complain_no', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->paginate(15, $total_complaint, $page);
        }

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

    public function dashboard_get()
    {
        $filter = $this->get('filter');
        if(!is_null($filter)){
            $whereKey= 'complain_type_id';
            $whereData= $filter;
        }else{
            $whereKey= '1=1';
            $whereData= null;
        }
        $page = $this->get('page');
        $overall = $this->get('overall');
        $user_id = $this->get('user_id');
        if( $overall == 1 ) { // มองเห็น เรื่องร้องเรียนทั้งหมด
            $total_complaint = $this->Key_in_model->count_rows(); // retrieve the total number of posts
            if( $total_complaint == 0 ){ $total_complaint = 1; }
            $complaint = $this->Key_in_model
                ->where($whereKey,$whereData)
                ->order_by('keyin_id', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->paginate(15, $total_complaint, $page); // paginate with 10 rows per page -
        }else{
            $total_complaint = $this->Key_in_model->where('create_user_id', $user_id)->count_rows(); // retrieve the total number of posts
            if( $total_complaint == 0 ){ $total_complaint = 1; }
            $complaint = $this->Key_in_model
                ->where($whereKey,$whereData)
                ->where('create_user_id', $user_id)
                ->order_by('keyin_id', 'DESC')
                ->with_title_name('fields:prename')
                ->with_complaint_type('fields:complain_type_name')
                ->with_wish('fields:wish_name')
                ->with_current_status('fields:current_status_name')
                ->paginate(15, $total_complaint, $page); // paginate with 10 rows per page -
        }

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
        $filter = $this->get('filter');
        if(!is_null($filter)){
            $whereKey= 'complain_type_id';
            $whereData= $filter;
        }else{
            $whereKey= '1=1';
            $whereData= null;
        }
        $overall = $this->get('overall');
        $user_id = $this->get('user_id');
        if( $overall == 1 ) { // มองเห็น เรื่องร้องเรียนทั้งหมด

            $total_complaint = $this->Key_in_model
                ->where($whereKey,$whereData)
                ->count_rows(); // retrieve the total number of posts
        }else{
            $total_complaint = $this->Key_in_model
                ->where($whereKey,$whereData)
                ->where('create_user_id', $user_id)
                ->count_rows();
        }
        if( $total_complaint == 0 ){ $total_complaint = 1; }
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
            $complain_type_id = $complaint->complain_type_id;
            $complain_type_relation = $this->complain_type->sort_complain_type($complain_type_id);
            foreach($complain_type_relation as $key => $value){
                $complaint->complain_type_relation[$key] = $value;
            }

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
        if (array_key_exists('step_now', $data)) {
            unset($data['step_now']);
        }
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
        $step_now=null;

        if (array_key_exists('step_now', $data)) {
            $step_now = $data['step_now'];
            unset($data['step_now']);
        }
        if (array_key_exists('province_id', $data)) {
            unset($data['province_id']);
        }
        if (array_key_exists('district_id', $data)) {
            unset($data['district_id']);
        }

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
        $complaintType = array();
        if (array_key_exists('complaint_type', $data)) {
            $complaintType = $data['complaint_type'];
            unset($data['complaint_type']);
        }
        $wish = array();
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
        if($step_now=='3') {
                $this->Key_in_model->beforeInsertPivotWish($keyInID);
                if (!empty($keyInID) && count($wish) > 0) {
                    foreach ($wish as $item) {
                        $this->Key_in_model->insertPivotWish($keyInID, $item);
                    }
                }
            }

        $keyInID = (int)$keyInID;
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
        $config['allowed_types'] = '*';//gif|jpg|png
        $config['max_size'] = 256000;
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

    public function result_get()
    {
        $id = $this->get('id');
        //echo $id;exit;
        $query = $this->db->get_where('dt_result',array('keyin_id'=>$id));
        $result['result'] = $query->row_array();
        $this->db->where('keyin_id',$id);
        $query = $this->db->get('dt_result_attach_file');
        $result['result_attach_file'] = $query->result();
        if ($result) {
            // Set the response and exit
            $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No result were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
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
        //echo"<pre>";print_r($data);echo"</pre>";exit;
        $id = $this->Result_model->update($data, array('keyin_id'=>$data['keyin_id']));
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

    public function result_file_attach_post(){
        //echo"<pre>";print_r($_POST);print_r($_FILES);echo"</pre>";
    if(!is_array(@$_FILES['attach_file']['name'])){
        exit;
    }else{
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
            }
        }
        if(!$id){
            $this->response($id, REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response($id, REST_Controller::HTTP_OK);
        }
        exit;
    }
    }

    public function result_file_delete_post(){
        $file_id = $this->post('file_id');
        $file_name = $this->post('file_name');
        $output_dir = "./upload/result_attach_file/";
        unlink($output_dir.$file_name);
        //echo"<pre>";print_r($file_id);print_r($file_name);echo"</pre>";exit;
        $id = $this->Result_attach_file_model->delete($file_id);
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
                    au_applications.app_name,
                    au_users_groups.group_id
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

    public function user_groups_get()
    {
        $user_id = $this->get('user_id');
        $sql = " SELECT
                  au_users_groups.user_id,
                  au_groups.id,
                  au_groups.`name`
                  FROM
                  au_groups
                  JOIN au_users_groups
                  ON au_groups.id = au_users_groups.group_id
                  WHERE au_users_groups.user_id='".$user_id."' ";
        $user_data = $this->User_model->sql_query($sql)->result_array();
        if( !empty($user_data) ) {
            $result_data = array();
            foreach( $user_data as $key => $value ){
                $result_data[] = $value['id'];
            }
            $this->response($result_data, REST_Controller::HTTP_OK);
        }else{
            $this->response($user_id, REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function user_detail_get()
    {
        $id = @$this->get('id');
        $idcard = @$this->get('idcard');
        $where = '';
        if($id != ''){
            $where .= " AND id = '".$id."' ";
        }
        if($idcard != ''){
            $where .= " AND idcard = '".$idcard."' ";
        }
        $sql = "SELECT
                    first_name,
                    last_name,
                    first_name_en,
                    last_name_en,
                    company,
                    phone,
                    idcard,
                    prename_th,
                    prename_th_id,
                    prename_en,
                    prename_en_id,
                    address,
                    address_id,
                    gender,
                    position,
                    email
                FROM
                    au_users
                WHERE 1=1 ".$where;
        $query = $this->User_model->sql_query($sql)->row_array();
        $result_data = $query;
        $this->response($result_data, REST_Controller::HTTP_OK);
    }

    public function accused_type_get($id){
        $types = $this->Accused_type_model->where('accused_type_id', $id)->get();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response('', REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function complain_type_get($id){
        #status_active = 1 คือ สถานะใช้งาน
        $where_status_active = [];
        $status_active= $this->get('status_active');
        if (!is_null($status_active)) {
            $where_status_active['status_active'] = $status_active;
        }
        $types = $this->Complain_type_model->where('complain_type_id', $id)->where($where_status_active)->get();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response('', REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function send_org_get($id){
        $types = $this->Send_org_model->where('send_org_id', $id)->get();
        // Check if the users data store contains users (in case the database result returns NULL)
        if ($types) {
            // Set the response and exit
            $this->response($types, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response('', REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}

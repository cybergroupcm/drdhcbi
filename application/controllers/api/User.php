<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data/User_model');
        $this->load->library(array('ion_auth'));
    }

    public function user_get()
    {
        if($this->get('id') != ""){
            $id = $this->get('id');
        }else{
            $user_data = $this->jwt_decode($this->jwt_token());
            $id = $user_data['$output_data'];
        }
        $user          = $this->ion_auth->user($id)->row();
        $groups        = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        $data['user']          = $user;
        $data['groups']        = $groups;
        $data['currentGroups'] = $currentGroups;

        if (!empty($data)) {
            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function user_post()
    {
        //echo"<pre>";print_r(@$_POST);print_r(@$_FILES);echo"</pre>";exit;
        //บันทึกข้อมูล
        if($this->post('id')==''){
        $username = strtolower($this->post('username'));
        $email    = strtolower($this->post('email'));
        $password = $this->post('password');

        $additional_data = array(
            'first_name' => $this->post('first_name'),
            'last_name'  => $this->post('last_name'),
            'company'    => $this->post('company'),
            'phone'      => $this->post('phone'),
            'idcard' => $this->post('idcard'),
            'prename_th_id'=> $this->post('prename_th_id'),
            'prename_th'=> $this->post('prename_th'),
            'prename_en'=> $this->post('prename_en'),
            'first_name_en' => $this->post('first_name_en'),
            'last_name_en'  => $this->post('last_name_en'),
            'address'  => $this->post('address'),
            'address_id'  => $this->post('address_id'),
            'gender'  => $this->post('gender'),
            'position'  => $this->post('position')
        );

        $ids = $this->ion_auth->register($username, $password, $email, $additional_data);
        }else{
            $data = array(
            'email' => $this->post('email'),
            'password' => $this->post('password'),
            'first_name' => $this->post('first_name'),
            'last_name'  => $this->post('last_name'),
            'company'    => $this->post('company'),
            'phone'      => $this->post('phone'),
            'idcard' => $this->post('idcard'),
            'prename_th_id'=> $this->post('prename_th_id'),
            'prename_th'=> $this->post('prename_th'),
            'prename_en'=> $this->post('prename_en'),
            'first_name_en' => $this->post('first_name_en'),
            'last_name_en'  => $this->post('last_name_en'),
            'address'  => $this->post('address'),
            'address_id'  => $this->post('address_id'),
            'gender'  => $this->post('gender'),
            'position'  => $this->post('position')
            );

            $ids = $this->ion_auth->update($this->post('id'), $data);
        }
        // บันทึกข้อมูล
        if($this->post('id')!=''){
            $now_id = $this->post('id');
        }else{
            $now_id = $ids;
        }
        //upload file
        if(isset($_FILES['register_photo']) && $_FILES['register_photo']['name']!=''){
            $output_dir = "./upload/register_photos/";
            //echo $output_dir;
            if(!@mkdir($output_dir,0,true)){
               chmod($output_dir, 0777);
            }else{
               chmod($output_dir, 0777);
            }
                $ret = array();
                $error =$_FILES["register_photo"]["error"];
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
                    $explode_old_file = explode('.',$_FILES["register_photo"]["name"]);
                    $new_file_name = date('Ymd')."_".$max_run_num.".".$explode_old_file[(count($explode_old_file)-1)];
                if(!is_array($_FILES["register_photo"]["name"])) //single file
                {
                        $fileName['name'] = $new_file_name;
                        $fileName['size'] = $_FILES["register_photo"]["size"];
                        $fileName['type'] = $_FILES["register_photo"]["type"];
                        $fileName['old_name'] = $_FILES["register_photo"]["name"];
                        move_uploaded_file($_FILES["register_photo"]["tmp_name"],$output_dir.$fileName['name']);
                }
                $sql = "UPDATE au_users SET register_photo = '".$new_file_name."' WHERE id='".$now_id."'";
                $update_file = $this->User_model->sql_query($sql);
        }
        //upload file
        //$this->response($this->post(), REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
        if($this->post('id')==''){
            $this->set_response($ids, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }else{
            $this->response($ids, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }

    public function user_put()
    {
        $data = array(
            'email' => $this->post('email'),
            'password' => $this->post('password'),
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

        $ids = $this->ion_auth->update($this->post('id'), $data);
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

        $ids = $this->Accused_type_model->delete($id);

        $this->set_response($ids, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function user_groups_get()
    {
        $id = $this->get('id');
        $data = $this->ion_auth->permission_data_detail($id);
        if (!empty($data)) {
            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

}
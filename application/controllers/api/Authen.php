<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Authen extends REST_Controller
{
    private $user;
    private $permission;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Ion_auth_model');
    }

    //User JWT authentication to get the toekn
    public function token_post()
    {
        $this->load->library('form_validation');

        $this->load->library('form_validation');
		header('Access-Control-Allow-Origin: *');
        $this->form_validation->set_data([
            'username' => $this->post('username'),
            'password' => $this->post('password'),
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            if ($this->login($this->post('username'), $this->post('password'))) {
                $this->user_info($this->post('username'));
                $this->permission_info($this->post('username'));
                $token['userid'] = $this->user->id;
                $token['username'] = $this->user->username;
                $token['permission'] = $this->permission;
                $date = new DateTime();
                $token['iat'] = $date->getTimestamp();
                $token['exp'] = $date->getTimestamp() + $this->config->item('jwt_token_expire');
                $output_data['token'] = $this->jwt_encode($token);
                $this->response($output_data, REST_Controller::HTTP_OK);

            }
            else {
                $output_data[$this->config->item('rest_status_field_name')] = "invalid_credentials";
                $output_data[$this->config->item('rest_message_field_name')] = "Invalid username or password!";
                $this->response($output_data, REST_Controller::HTTP_UNAUTHORIZED);
            }
        }
        else {
            $output_data[$this->config->item('rest_status_field_name')] = "empty_fields";
            $output_data[$this->config->item('rest_message_field_name')] = $this->form_validation->error_array();

            $this->response($output_data, REST_Controller::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    // JWT test endpoint, it shows the token information (need token authorization)
    public function token_info_get()
    {
        try {
            $output_data = $this->jwt_decode($this->jwt_token());
            $this->response($output_data, REST_Controller::HTTP_OK);
        } catch (Exception $e) {
            $output_data[$this->config->item('rest_status_field_name')] = "invalid_token";
            $output_data[$this->config->item('rest_message_field_name')] = $e->getMessage();
            $this->response($output_data, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    // Login model emulation, login funcation
    private function login($username, $password)
    {
        if ($this->Ion_auth_model->login_api($username, $password)) {
            return TRUE;
        }
        return FALSE;
    }

    private function user_info($username)
    {
        $this->user = $this->Ion_auth_model->user_api($username);
    }

    private function permission_info($username)
    {
        $this->permission = $this->Ion_auth_model->permission_api($username);
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
        $this->load->helper('url');
	}


	function index()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            redirect('main', 'refresh');
        }
	}


    function login()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            /* Load */
            $this->load->config('admin/dp_config');
            $this->load->config('common/dp_config');

            /* Valid form */
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            /* Data */
            $this->data['title']               = $this->config->item('title');
            $this->data['title_lg']            = $this->config->item('title_lg');
            $this->data['auth_social_network'] = $this->config->item('auth_social_network');
            $this->data['forgot_password']     = $this->config->item('forgot_password');
            $this->data['new_membership']      = $this->config->item('new_membership');

            if ($this->form_validation->run() == TRUE)
            {
                $remember = (bool) $this->input->post('remember');

                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
                {
                    $data = [
                        "username"=>$this->input->post('identity'),
                        'password'=>$this->input->post('password')
                    ];
                    $url = base_url('api/authen/token');
                    $token = api_call_post($url,$data);
                    if(array_key_exists('token',$token)){
                        $cookie = [
                            'name' => 'token',
                            'value' => $token['token'],
                            'expire' => '43200',
                        ];
                        $this->input->set_cookie($cookie);
                    }
                    if ( ! $this->ion_auth->is_admin())
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect('main', 'refresh');
                    }
                    else
                    {
                        /* Data */
                        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                        /* Load Template */
                        //$this->template->auth_render('main', $this->data);
                        redirect('admin', 'refresh');
                    }
                }
                else
                {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
				    redirect('auth/login', 'refresh');
                }
            }
            else
            {
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['identity'] = array(
                    'name'        => 'identity',
                    'id'          => 'identity',
                    'type'        => 'text',
                    'value'       => $this->form_validation->set_value('identity'),
                    'class'       => 'form-control',
                    'placeholder' => lang('auth_your_email')
                );
                $this->data['password'] = array(
                    'name'        => 'password',
                    'id'          => 'password',
                    'type'        => 'password',
                    'class'       => 'form-control',
                    'placeholder' => lang('auth_your_password')
                );

                /* Load Template */
                $this->template->auth_render('auth/login', $this->data);
            }
        }
        else
        {
            redirect('main', 'refresh');
        }
   }


    function logout($src = NULL)
	{
        $logout = $this->ion_auth->logout();

        $this->session->set_flashdata('message', $this->ion_auth->messages());

        delete_cookie('token','122.155.197.104','/sysdamrongdham/','api_');

        if ($src == 'admin')
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            redirect('/', 'refresh');
        }
	}

    function register()
    {
        /* Load */
        $this->load->config('admin/dp_config');
        $this->load->config('common/dp_config');

        /* Valid form */
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        /* Data */
        $this->data['title']               = $this->config->item('title');
        $this->data['title_lg']            = $this->config->item('title_lg');
        $this->data['auth_social_network'] = $this->config->item('auth_social_network');
        $this->data['forgot_password']     = $this->config->item('forgot_password');
        $this->data['new_membership']      = $this->config->item('new_membership');

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

        $this->data['identity'] = array(
            'name'        => 'identity',
            'id'          => 'identity',
            'type'        => 'email',
            'value'       => $this->form_validation->set_value('identity'),
            'class'       => 'form-control',
            'placeholder' => lang('auth_your_email')
        );
        $this->data['password'] = array(
            'name'        => 'password',
            'id'          => 'password',
            'type'        => 'password',
            'class'       => 'form-control',
            'placeholder' => lang('auth_your_password')
        );

        $url = base_url()."api/dropdown/title_name_lists";
        $this->data['title_name'] = api_call_get($url);

        $this->template->auth_render('auth/register',$this->data);
    }

    /*function save_user(){
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'company'    => $this->input->post('company'),
            'phone'      => $this->input->post('phone'),
            'email'      => $this->input->post('email'),
            'password'      => $this->input->post('password'),
            'idcard' => $this->input->post('idcard'),
            'prename'=> $this->input->post('prename'),
            'prename_eng'=> $this->input->post('prename_en'),
            'first_name_eng' => $this->input->post('first_name_en'),
            'last_name_eng'  => $this->input->post('last_name_en')
        );
        $url = "http://localhost/drdhcbi/api/user/user/";
        $save_user = api_call_post($url,$data);
        //echo $save_user;
    }*/

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_users'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_users'), 'admin/users');

        $this->load->model('data/User_model');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Get all users */
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user)
            {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }

            /* Load Template */
            $this->libraries->template('admin/users/index',$this->data);
            //$this->template->admin_render('admin/users/index', $this->data);
        }
	}


	public function create_bk()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_users_create'), 'admin/users/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		$tables = $this->config->item('tables', 'ion_auth');

		/* Validate form input */
		$this->form_validation->set_rules('first_name', 'lang:users_firstname', 'required');
		$this->form_validation->set_rules('last_name', 'lang:users_lastname', 'required');
		$this->form_validation->set_rules('email', 'lang:users_email', 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('phone', 'lang:users_phone', 'required');
		$this->form_validation->set_rules('company', 'lang:users_company', 'required');
		$this->form_validation->set_rules('password', 'lang:users_password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'lang:users_password_confirm', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
				'idcard' => $this->input->post('personal_id'),
				'prename_th'=> $this->input->post('prename'),
				'prename_en'=> $this->input->post('prename_eng'),
				'first_name_en' => $this->input->post('first_name_eng'),
				'last_name_en'  => $this->input->post('last_name_eng')
			);
		}

		if ($this->form_validation->run() == TRUE && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/users', 'refresh');
		}
		else
		{
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['personal_id'] = array(
				'name'  => 'personal_id',
				'id'    => 'personal_id',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('personal_id'),
			);
			$this->data['prename'] = array(
				'name'  => 'prename',
				'id'    => 'prename',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('prename'),
			);
			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['prename_eng'] = array(
				'name'  => 'prename_eng',
				'id'    => 'prename_eng',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('prename_eng'),
			);
			$this->data['first_name_eng'] = array(
				'name'  => 'first_name_eng',
				'id'    => 'first_name_eng',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('first_name_eng'),
			);
			$this->data['last_name_eng'] = array(
				'name'  => 'last_name_eng',
				'id'    => 'last_name_eng',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('last_name_eng'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'email',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'id'    => 'company',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['position'] = array(
				'name'  => 'position',
				'id'    => 'position',
				'type'  => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('position'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'tel',
                'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['address'] = array(
				'name'  => 'address',
				'id'    => 'address',
				'type'  => 'textarea',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('address'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('password_confirm'),
			);

            /* Load Template */
            $this->template->admin_render('admin/users/create_bk', $this->data);
        }
	}


	public function delete()
	{
        /* Load Template */
		$this->libraries->template('admin/users/delete', $this->data);
	}


	public function edit($id)
	{
        $id = (int) $id;

		if ( ! $this->ion_auth->logged_in() OR ( ! $this->ion_auth->is_admin() && ! ($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_users_edit'), 'admin/users/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Data */
		$user          = $this->ion_auth->user($id)->row();
		$groups        = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		/* Validate form input */
		$this->form_validation->set_rules('first_name', 'lang:edit_user_validation_fname_label', 'required');
		$this->form_validation->set_rules('last_name', 'lang:edit_user_validation_lname_label', 'required');
		$this->form_validation->set_rules('phone', 'lang:edit_user_validation_phone_label', 'required');
		$this->form_validation->set_rules('company', 'lang:edit_user_validation_company_label', 'required');

		if (isset($_POST) && ! empty($_POST))
		{
            if ($this->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

            if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
					'idcard' => $this->input->post('personal_id'),
					'prename_th'=> $this->input->post('prename'),
					'prename_en'=> $this->input->post('prename_eng'),
					'first_name_en' => $this->input->post('first_name_eng'),
					'last_name_en'  => $this->input->post('last_name_eng')
				);

                if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

                if ($this->ion_auth->is_admin())
				{
                    $groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData))
                    {
						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp)
                        {
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

                if($this->ion_auth->update($user->id, $data))
			    {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());

				    if ($this->ion_auth->is_admin())
					{
						redirect('admin/users', 'refresh');
					}
					else
					{
						redirect('admin', 'refresh');
					}
			    }
			    else
			    {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());

				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}
			    }
			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user']          = $user;
		$this->data['groups']        = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['personal_id'] = array(
			'name'  => 'personal_id',
			'id'    => 'personal_id',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('personal_id',$user->idcard),
		);

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
            'class' => 'form-control',
			'value' => $this->form_validation->set_value('first_name', $user->first_name)
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
            'class' => 'form-control',
			'value' => $this->form_validation->set_value('last_name', $user->last_name)
		);

		$this->data['prename'] = array(
			'name'  => 'prename',
			'id'    => 'prename',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('prename',$user->prename_th),
		);

		$this->data['prename_eng'] = array(
			'name'  => 'prename_eng',
			'id'    => 'prename_eng',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('prename_eng',$user->prename_en),
		);
		$this->data['first_name_eng'] = array(
			'name'  => 'first_name_eng',
			'id'    => 'first_name_eng',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('first_name_eng',$user->first_name_en),
		);
		$this->data['last_name_eng'] = array(
			'name'  => 'last_name_eng',
			'id'    => 'last_name_eng',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('last_name_eng',$user->last_name_en),
		);

		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
            'class' => 'form-control',
			'value' => $this->form_validation->set_value('company', $user->company)
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
            'type'  => 'tel',
            'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$',
            'class' => 'form-control',
			'value' => $this->form_validation->set_value('phone', $user->phone)
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
            'class' => 'form-control',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
            'class' => 'form-control',
			'type' => 'password'
		);


        /* Load Template */
		$this->libraries->template('admin/users/edit', $this->data);
	}


	function activate($id, $code = FALSE)
	{
        $id = (int) $id;

		if ($code !== FALSE)
		{
            $activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
            $this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('admin/users', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('auth/forgot_password', 'refresh');
		}
	}


	public function deactivate($id = NULL)
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
            return show_error('You must be an administrator to view this page.');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_users_deactivate'), 'admin/users/deactivate');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('confirm', 'lang:deactivate_validation_confirm_label', 'required');
		$this->form_validation->set_rules('id', 'lang:deactivate_validation_user_id_label', 'required|alpha_numeric');

		$id = (int) $id;

		if ($this->form_validation->run() === FALSE)
		{
			$user = $this->ion_auth->user($id)->row();

            $this->data['csrf']       = $this->_get_csrf_nonce();
            $this->data['id']         = (int) $user->id;
            $this->data['firstname']  = ! empty($user->first_name) ? htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') : NULL;
            $this->data['lastname']   = ! empty($user->last_name) ? ' '.htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8') : NULL;

            /* Load Template */
            $this->libraries->template('admin/users/deactivate', $this->data);
		}
		else
		{
            if ($this->input->post('confirm') == 'yes')
			{
                if ($this->_valid_csrf_nonce() === FALSE OR $id != $this->input->post('id'))
				{
                    show_error($this->lang->line('error_csrf'));
				}

                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			redirect('admin/users', 'refresh');
		}
	}


	public function profile($id)
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_users_profile'), 'admin/groups/profile');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Data */
        $id = (int) $id;

        $this->data['user_info'] = $this->ion_auth->user($id)->result();
        foreach ($this->data['user_info'] as $k => $user)
        {
            $this->data['user_info'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        /* Load Template */
		$this->libraries->template('admin/users/profile', $this->data);
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}


	public function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
public function create($id='')
    {
    $this->breadcrumbs->unshift(2, lang('menu_users_create'), 'admin/users/create');
    $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['id'] = $id;
		if($id) {
			$url = base_url() . "api/user/user/" . $id;
			$this->data['data'] = api_call_get($url);
		}
        $url = base_url()."api/dropdown/title_name_lists";
        $this->data['title_name'] = api_call_get($url);

        $url = base_url()."api/dropdown/title_name_lists/prename_en";
				$this->data['title_name_en'] = api_call_get($url);

        $url = base_url("api/dropdown/ccaa_lists/Changwat");
        $this->data['province_list'] = api_call_get($url);

        if(@$this->data['data']['user']['address_id']!=''){
            $ccaa_code = substr(@$this->data['data']['address_id'], 0, 3);
        }else{
            $ccaa_code = '200';
        }
        $url = base_url("api/dropdown/ccaa_lists/Aumpur/".$ccaa_code);
        $this->data['district_list'] = api_call_get($url);

		$url = base_url("api/dropdown/au_group_list/");
		$this->data['user_group'] = api_call_get($url);

		$url = base_url("api/dropdown/send_org_parent_lists/allow/1");
		$this->data['org_user'] = api_call_get($url);

        if(@$this->data['data']['user']['address_id']!=''){
            $ccaa_code = substr(@$this->data['data']['address_id'], 0, 4);
            $url = base_url("api/dropdown/ccaa_lists/Tamboon/".$ccaa_code);
            $this->data['subdistrict_list'] = api_call_get($url);
        }
        $this->libraries->template('admin/users/create',$this->data);

    }

}

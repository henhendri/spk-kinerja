<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		// if ($this->session->userdata('email')) {
		// 	redirect('auth/login');
		// }

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Form Login';
			$this->load->view('auth/login', $data);
		} else {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));

			$admin = $this->auth_model->select_Admin($email);
			if ($admin) {
				// terdapat data admin
				if ($password == $admin['password']) {
					$data = [
						'email' => $admin['email'],
						'akses' => $admin['akses']
					];
					$this->session->set_userdata($data);
					$this->session->set_flashdata('done', 'Login Success');
					redirect('admin');
				} else {
					$this->session->set_flashdata('fail', 'Wrong Password');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('fail', 'Email is Not Available ');
				redirect('auth');
			}
		}
	}

	public function register()
	{
		if ($this->session->userdata('email')) {
			redirect('admin');
		}

		$this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admin.email]', [
			'is_unique' => 'This email already registered.'
		]);
		$this->form_validation->set_rules('passwordsignin', 'Password', 'required|trim|min_length[3]|matches[confirmpassword]', [
			'matches' => 'Password dont match.',
			'min_length' => 'Password too short.'
		]);
		$this->form_validation->set_rules('confirmpassword', 'Password', 'required|trim|matches[passwordsignin]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Form Register';
			$this->load->view('auth/register', $data);
		} else {
			$this->auth_model->insert_Admin();
			$this->session->set_flashdata('done', 'Success Create Account');
			redirect('auth');
		}
	}


	public function logout()
	{
		$this->auth_model->logout_Admin();
	}

	public function blok()
	{
		$this->load->view('auth/blok');
	}

	public function not_found()
	{
		$this->load->view('auth/tidak_ditemukan');
	}
}

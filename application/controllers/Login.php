<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index(){
		// if ($this->session->userdata('email')){
		// 	redirect('user');
		// }

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == false){
			$data['title'] = 'Login';
			$this->load->view('Templates/Auth_header', $data);
            $this->load->view('Auth/Login', $data);
			$this->load->view('Templates/Auth_footer');
		}else{
			// validasi sukses
			$this->Login_masuk();
		}
	}

	private function Login_masuk(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

        // buat cek nama password hash
        $p = password_hash($password, PASSWORD_DEFAULT);

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		// jika user ada
		if($user > 0){
            // cek password
            if(password_verify($password, $user['password'])){
                $data = [
                    'email' => $user['email']
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Login</div>');
                redirect('Auth');
                
            }else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('Login');
            }
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div>');
			redirect('Login');
		}
	}

	public function Registration(){
		if ($this->session->userdata('email')){
			redirect('user');
		}
		
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
				'matches' => 'Password berbeda!',
				'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if($this->form_validation->run() == false){
			$data['title'] = 'Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else{
			$data = [
					'name' => htmlspecialchars($this->input->post('name', true)),
					'email' => htmlspecialchars($this->input->post('email', true)),
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil! Silahkan login</div>');
			redirect('Login');
		}
	}

	public function Masuk_registration(){
		$this->load->view('Templates/Auth_header');
		$this->load->view('Auth/Registration');
		$this->load->view('Templates/Auth_footer');
	}

	public function Logout(){
		$this->session->unset_userdata('email');

		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kamu berhasil logout!</div>');
		redirect('Login');
	}

	public function blocked(){
		$this->load->view('auth/blocked');
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	private $SESSION;

	function __construct(){
		parent::__construct();
		$this->load->model('AuthModel');
		$this->SESSION = $this->tools->_read_session();
	}
// index = root
	public function index() {
		$notif = $this->tools->_read_notification();
		$data['passNotif']		= (isset($notif['notif'])) ? $notif['notif'] : '';
		$data['passNotifType']	= (isset($notif['notif-type'])) ? $notif['notif-type'] : '';
		$data['builder'] = 'metrical';
		if (isset($this->SESSION['logged_in'])) {
			redirect('event');
			// $data['page'] = 'index';
			// $data['MAIN_CONTENT'] = 'dashboard';
		} else {
			$data['page'] = 'login';
		}
		$this->load->view('index', $data);
		
	}

	// function utuk regist

	public function regist() {
		$notif = $this->tools->_read_notification();
		$data['passNotif']		= (isset($notif['notif'])) ? $notif['notif'] : '';
		$data['passNotifType']	= (isset($notif['notif-type'])) ? $notif['notif-type'] : '';
		$data['builder'] = 'metrical';
		if (isset($this->SESSION['logged_in'])) {
			redirect('event');
			// $data['page'] = 'index';
			// $data['MAIN_CONTENT'] = 'dashboard';
		} else {
			$data['page'] = 'register';
		}
		$this->load->view('index', $data);
	}

	public function auth() {
		$method = $this->input->method();
		$post = $this->input->post();
		if (NULL===$method) {
			show_404();
		}
		if ($method!=='post') {
			show_404();
		}
		$data = $this->AuthModel->_get_user_by_email($post['email']);
		if (count($data) == 0 || !$this->_check_password($post['password'], $data[0]['password'])) {
			$this->tools->_create_notification('Invalid Email or Password', 'error');
			redirect();
		}
		$this->tools->_set_session(array(
			'logged_in' => true,
			'user_id' 	=> $data[0]['id'],
			'email' 	=> $data[0]['email'],
			'nama_lengkap' => $data[0]["nama_lengkap"]
		));
		redirect();
	}

	public function action_register() {
		$method = $this->input->method();
		$post = $this->input->post();
		if (NULL===$method) {
			show_404();
		}
		if ($method!=='post') {
			show_404();
		}

		$data = $this->AuthModel->_get_user_by_email($post['email']);
		if (count($data)>0){
			$this->tools->_create_notification('Email Sudah Terdaftar','error');
			redirect(base_url("base/regist"));
		}
		else {
			$password = password_hash($post['password'], PASSWORD_DEFAULT);
			$insert_data=array(
				"nama_lengkap" => $post["nama_lengkap"],
				"email" => $post["email"],
				"password" => $password,
				'salt'	=> md5($password.$post['email']),
				'created_at' => date('Y-m-d')
			);
			$this->AuthModel->_insert($insert_data);
			$this->tools->_create_notification('Data Berhasil Terdaftar','success');
			redirect(base_url("base"));
		}
	}

	function logout() {
		$this->tools->_unset_session();
		redirect();
	}

	function _check_password($inputPassword, $savedPassword) {
		return password_verify($inputPassword, $savedPassword);
	}

}

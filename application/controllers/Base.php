<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	private $SESSION;

	function __construct(){
		parent::__construct();
		$this->load->model('AuthModel');
		$this->SESSION = $this->tools->_read_session();
	}

	public function index() {
		$data['builder'] = 'metrical';
		if (isset($this->SESSION['logged_in'])) {
			$data['page'] = 'index';
			$data['MAIN_CONTENT'] = 'dashboard';
		} else {
			$data['page'] = 'login';
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
			return false;
		}
		$this->tools->_set_session(array(
			'logged_in' => true,
			'user_id' 	=> $data[0]['id'],
			'email' 	=> $data[0]['email']
		));
		redirect();
	}

	function logout() {
		$this->tools->_unset_session();
		redirect();
	}

	function _check_password($inputPassword, $savedPassword) {
		return password_verify($inputPassword, $savedPassword);
	}

}

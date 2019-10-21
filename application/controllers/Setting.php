<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	private $SESSION;

	function __construct(){
		parent::__construct();
		$this->load->model('AuthModel');
		$this->SESSION = $this->tools->_read_session();
	}

	public function index() {
		$this->tools->_restrict_not_logged_in();
		$notif = $this->tools->_read_notification();
		$data['passNotif']		= (isset($notif['notif'])) ? $notif['notif'] : '';
		$data['passNotifType']	= (isset($notif['notif-type'])) ? $notif['notif-type'] : '';
		$data['builder'] = 'metrical';
		$data['page'] = 'index';
		$data['MAIN_CONTENT'] = 'setting/index';
		$data['user'] = $this->AuthModel->_get_user_by_id($this->SESSION['user_id']);
		$this->load->view('index', $data);
	}

	public function update() {
		$this->tools->_restrict_not_logged_in();
		$method = $this->input->method();
		$post = $this->input->post();
		if (NULL===$method) {
			show_404();
		}
		if ($method!=='post') {
			show_404();
		}
		$id = $this->SESSION['user_id'];
		$saveData = array(
			'username' => $post['username'],
			'email' => $post['email'],
			'updated_at'  => date('Y-m-d H:i:s')
		);
		if ($post['password']) {
			$saveData['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
		}

		$this->AuthModel->_update_profile($id, $saveData);
		$this->tools->_create_notification('Update profile success','success');
		if ($post['email'] || $post['password']) {
			redirect(site_url('logout'));
		} else {
			redirect(site_url('setting'));
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public $defaultResponse = array(
		"header" => array(
			"error" 		=> "",
			"status_code" 	=> 0,
			"response_time" => 0,
			"total_data" 	=> 0
		),
		"data" => array()
	);

	function __construct(){
		parent::__construct();
		$this->load->model('AuthModel');
	}

	public function index() {
		$this->load->view('index');
	}

	public function api($path = NULL) {
		if ($path===null){
			show_404();
		}

		$headers = $this->input->request_headers();
		$method = $this->input->method();
		$authorization = $headers['Authorization'];

		$apiResponse = $this->defaultResponse;
		$apiResponse["header"]["status_code"] = 200;
		$apiResponse["header"]["jwt"] = $authorization;

		switch($path){
			case 'login':
				if (!$this->_validateMethod($method, "post")) {
					return $this->_writeResponse($this->_errorResponse(405, "invalid method"), 405);
				}
				$body = json_decode($this->input->raw_input_stream, 1);
				$data = $this->AuthModel->_get_user_by_email($body['email']);
				if (count($data) == 0 || !$this->_check_password($body['password'], $data[0]['password'])) {
					return $this->_writeResponse($this->_errorResponse(400, "user not found or invalid password"), 400);
				}
				$apiResponse['data'] = $data[0];
				break;
			case 'register':
				if (!$this->_validateMethod($method, "post")) {
					return $this->_writeResponse($this->_errorResponse(405, "invalid method"), 405);
				}
				$body = json_decode($this->input->raw_input_stream, 1);
				$totalUsed = intval($this->AuthModel->_check_email($body['email']));
				if ($totalUsed > 0) {
					return $this->_writeResponse($this->_errorResponse(400, "email already used"), 400);
				}
				$password = password_hash($body['password'], PASSWORD_DEFAULT);
				$userData = array(
					'email'			=> $body['email'],
					'password' 		=> $password,
					'salt'			=> md5($password.$body['email']),
					'created_at'	=> date('Y-m-d')
				);
				$inserted = $this->AuthModel->_register_user('tbl_user', $userData);
				if ($inserted > 0) {
					$userData['id'] = $inserted;
					$apiResponse['data'] = $userData;
				}
				break;
			default:
				return $this->_writeResponse($this->_errorResponse(405, "invalid url"), 405);
				break;
		}

		$apiResponse["header"]["response_time"] = $this->benchmark->elapsed_time();

		return $this->_writeResponse($apiResponse, 200);
	}

	function _writeResponse($apiResponse, $code) {
		return $this->output
			->set_content_type('application/json')
			->set_status_header($code)
			->set_output(
				json_encode($apiResponse)
			);
	}

	function _check_password($inputPassword, $savedPassword) {
		return password_verify($inputPassword, $savedPassword);
	}

	function _validateMethod($method, $allow) {
		return $method === $allow;
	}

	function _errorResponse($errorCode, $errorMessage) {
		$errorResponse = $this->defaultResponse;
		$errorResponse["header"]["error"] = $errorMessage;
		$errorResponse["header"]["status_code"] = $errorCode;
		return $errorResponse;
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

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
		$this->load->model('FeedModel');
	}

    public function index() {
		$data['include_js'] = array(
			'@/pages/user-list.js'
		);
		$data['include_js'] = array_merge($this->direct_datatables_js_include, $data['include_js']);

		$data['include_css'] = array();
		$data['include_css'] = array_merge($this->direct_datatables_css_include, $data['include_css']);

		$data['builder'] 	= 'base';
		$data['page'] 		= 'user/list';
		$this->load->view('index', $data);
    }

    public function api($path = NULL) {
		if ($path===null){
			show_404();
		}

		$headers = $this->input->request_headers();
		$method = $this->input->method();

		$apiResponse = $this->defaultResponse;
		$apiResponse["header"]["status_code"] = 200;

		switch($path){
			case 'list':
				if (!$this->_validateMethod($method, "get")) {
					return $this->_writeResponse($this->_errorResponse(405, "invalid method"), 405);
                }
                $get = $this->input->get();
                $qs = array(
                    'skip' => isset($get['page']) && intval($get['page']) > 0 ? (intval($get['page']) - 1) : 0,
                    'limit' => isset($get['show']) ? intval($get['show']) : 10,
                );
                $data = $this->FeedModel->_get_feed($qs);
                $apiResponse['attribute'] = $qs;
				$apiResponse['data'] = $data;
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
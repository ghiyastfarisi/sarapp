<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	private $defaultResponse = array(
		"header" => array(
			"error" 		=> "",
			"status_code" 	=> 0,
			"response_time" => 0,
			"total_data" 	=> 0
		),
		"data" => array()
	);

	private $datatables_css = array(
		"template/metrical/assets/plugins/datatables/jquery.dataTables.min.css",
		"template/metrical/assets/plugins/datatables/extensions/dataTables.jqueryui.min.css"
	);

	private $datatables_js = array(
		"template/metrical/assets/plugins/datatables/jquery.dataTables.min.js",
		"template/metrical/assets/plugins/datatables/responsive/dataTables.responsive.js",
		"template/metrical/assets/plugins/datatables/extensions/dataTables.jqueryui.min.js"
	);

	function __construct(){
		parent::__construct();
		$this->load->model('EventModel');
	}

	public function index() {
		$this->tools->_restrict_not_loggin();
		$data['include_css'] = $this->datatables_css;
		$data['include_js'] = array_merge(
			$this->datatables_js,
			array(
				'bundle/dist/pages/event.index.js'
			)
		);
		$data['builder'] = 'metrical';
		$data['page'] = 'index';
		$data['pageheader'] = 'Event Management';
		$data['MAIN_CONTENT'] = 'event/index';
		$eventData = $this->EventModel->_get_event(array('skip'=>0, 'limit'=>1000));
		$data['eventData'] = $this->_event_list_transform($eventData);
		$this->load->view('index', $data);
	}

	function form() {
		$this->tools->_restrict_not_loggin();
		$notif = $this->tools->_read_notification();
		$data['include_css'] = array(
			'template/metrical/assets/plugins/datepicker/css/datepicker.min.css'
		);
		$data['include_js'] = array(
			'template/metrical/assets/plugins/datepicker/js/datepicker.min.js',
			'template/metrical/assets/plugins/datepicker/js/datepicker.es.js',
			'bundle/dist/pages/event.form.js'
		);
		$data['builder'] 		= 'metrical';
		$data['page'] 			= 'index';
		$data['pageheader'] 	= 'Event Management';
		$data['MAIN_CONTENT'] 	= 'event/form';
		$data['passNotif']		= (isset($notif['notif'])) ? $notif['notif'] : '';
		$data['passNotifType']	= (isset($notif['notif-type'])) ? $notif['notif-type'] : '';
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
				$data = $this->_event_list_transform($this->EventModel->_get_event($qs));
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

	function _format_image_url($url) {
		if (substr( $url, 0, 4 ) === "http") {
			return $url;
		} else {
			return base_url($url);
		}
	}

	function _event_list_transform($data) {
		$order = 1;
		foreach($data as $i => $v) {
			$data[$i]['image_url'] = $this->_format_image_url($data[$i]['image_url']);
			$data[$i]['ordered'] = $order;
			$data[$i]['action'] = '
				<button class="btn btn-xs btn-info">
					<i class="fa fa-eye"></i>
				</button>
				<button class="btn btn-xs btn-warning">
					<i class="fa fa-edit"></i>
				</button>
				<button class="btn btn-xs btn-danger">
					<i class="fa fa-remove"></i>
				</button>
			';
			$order++;
		}
		return $data;
	}

	function add_event() {
		$this->tools->_restrict_not_loggin();
		$method = $this->input->method();
		$post = $this->input->post();
		if (NULL===$method) {
			show_404();
		}
		if ($method!=='post') {
			show_404();
		}
		// upload file and replace
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['overwrite']            = false;
		$config['max_size']             = 2048; // 4mb limit
		$this->load->library('upload', $config);
		$config['upload_path'] = './files/upload';
		$config['file_name'] = md5(rand(111,999)+rand(111,999)).'-'.md5(date('YmdHis'));
		$this->upload->initialize($config);
		if($this->upload->do_upload('event_image')){
			$fileUploaded = $this->upload->data();
			$filePath = '/files/upload/'.$fileUploaded['file_name'];
			$fileType = explode('/', $fileUploaded['file_type'])[0];
			$parsedDate = explode('/', $post['date']);
			$saveData = array(
				'image_url'     => $filePath,
				'title'       	=> $post['title'],
				'caption'       => $post['caption'],
				'location_name' => $post['location'],
				'location_link' => '',
				'date'  		=> $parsedDate[2].'-'.$parsedDate[0].'-'.$parsedDate[1],
				'created_at'  => date('Y-m-d H:i:s')
			);
			$this->EventModel->_save_event($saveData);
			$this->tools->_create_notification('Add event success','success');
			var_dump('gak error');
			redirect(site_url('event'));
		} else {
			$extraError = $this->upload->display_errors('','');
			var_dump('error', $extraError);
			$this->tools->_create_notification('Add event failed: '. $extraError, 'error');
			redirect(site_url('event'));
		}
	}

}

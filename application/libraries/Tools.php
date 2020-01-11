<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools {

    public $CI;

    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('session');
	}

    public function _path_builder($path) {
        return preg_replace('/^' . preg_quote('@', '/') . '/', '/bundle/dist', $path);
    }

    public function _read_session() {
        return $this->CI->session->userdata();
    }

    public function _set_session($newdata) {
        return $this->CI->session->set_userdata($newdata);
    }

    public function _unset_session() {
        return $this->CI->session->sess_destroy();
    }

    public function _restrict_not_logged_in() {
        $session = $this->CI->session->userdata();
        if (!isset($session['logged_in'])) {
            redirect();
        }
    }

    public function _create_notification($data, $type) {
        $this->CI->session->set_flashdata('notif', $data);
        $this->CI->session->set_flashdata('notif-type', $type);
        return true;
    }

    public function _read_notification() {
        return array(
            'notif' => $this->CI->session->flashdata('notif'),
            'type'  => $this->CI->session->flashdata('notif-type')
        );
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {
    function _check_email($email) {
        return $this->db
            ->query("SELECT count(id) as total FROM tbl_user WHERE ( deleted_at != '0000-00-00' OR deleted_at IS NULL ) ")
            ->result_array()[0]['total'];
    }
    function _register_user($tbl, $data) {
        if ($this->db->insert($tbl, $data)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }
    function _get_user_by_email($email) {
        return $this->db
            ->query("SELECT * FROM tbl_user WHERE email = '$email' AND ( deleted_at != '0000-00-00' OR deleted_at IS NULL ) ")
            ->result_array();
    }
}
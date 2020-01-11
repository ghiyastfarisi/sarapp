<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventModel extends CI_Model {
    function _get_event($qs) {
        $skip = $qs['skip'] * $qs['limit'];
        $limit = $qs['limit'];
        return $this->db
            ->query("SELECT * FROM tbl_event WHERE ( deleted_at != '0000-00-00' OR deleted_at IS NULL ) ORDER BY id DESC LIMIT $skip, $limit ")
            ->result_array();
    }

    function _get_event_by_id($id) {
        return $this->db
            ->query("SELECT * FROM tbl_event WHERE id = ? AND ( deleted_at != '0000-00-00' OR deleted_at IS NULL )", array($id))
            ->result_array();
    }

    function _save_event($data) {
        return $this->db->insert('tbl_event', $data);
    }

    function _update_event($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_event', $data);
    }

    function _delete_event($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_event');
    }
}
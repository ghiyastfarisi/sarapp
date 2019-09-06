<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FeedModel extends CI_Model {
    function _get_feed($qs) {
        $skip = $qs['skip'] * $qs['limit'];
        $limit = $qs['limit'];
        return $this->db
            ->query("SELECT * FROM tbl_feed WHERE ( deleted_at != '0000-00-00' OR deleted_at IS NULL ) LIMIT $skip, $limit")
            ->result_array();
    }
}
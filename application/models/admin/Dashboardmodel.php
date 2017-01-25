<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function checkPassword($id, $password) {
        $query = $this->db->get_where('admin', array('id' => $id, 'password' => md5($password)));
        return $query->num_rows();
    }

    public function updatePassword($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
     
}

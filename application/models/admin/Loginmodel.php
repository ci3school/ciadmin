<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->cache_on();
    }
    
    public function checkUser($email, $password) { 
        $this->db->from('admin');
        $this->db->where(array('email' => $email, 'password' => $password));
        $query = $this->db->get();
        return $query->row();
    }
    
    public function checkEmail($email){
        $query = $this->db->get_where('admin', array('email' => $email));
        return $query->num_rows();
    }

    public function resetPassword($email, $password){
        $this->db->where('email', $email);
        $this->db->update('admin', array('password' => md5($password)));
        return true;
    }
    
    public function insert($data){
        $this->db->insert('admin', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}

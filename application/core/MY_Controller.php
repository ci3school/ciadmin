<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function isAdminLogged($user = 'admin') {
        if ($this->session->userdata($user) != '') {
            return true;
        } else {
            return false;
        }
    }
    
    public function admin_user($user = 'admin'){
        $user = $this->session->userdata($user);
        return $user['id'];
    }

    public function send_email($from, $to, $subject, $message) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'xxxxxxx',
            'smtp_pass' => 'xxxxxxx',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($from, 'Checklist App');
        $this->email->to($to);

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

}

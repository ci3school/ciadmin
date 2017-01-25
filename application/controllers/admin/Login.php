<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/loginmodel', 'login');
        $this->load->helper(array('form', 'url'));
        if ($this->isAdminLogged('admin')) {
            $path = base_url() . 'admin/dashboard';
            redirect($path);
        }
    }

    public function checklogin() {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $password = md5($this->input->post('password'));


        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $this->form_validation->set_message('required', '%s field is required.');
        $this->form_validation->set_message('valid_email', '%s must be valid.');

        if ($this->form_validation->run() == TRUE) {
            $data = $this->login->checkUser($email, $password);
            if (!empty($data)) {
                if ($data->active) {
                    $logdetails = array(
                        'id' => $data->id,
                        'email' => $data->email,
                        'first_name' => $data->first_name,
                        'last_name' => $data->last_name
                    );
                    $this->session->set_userdata('admin', $logdetails);
                    redirect(base_url() . 'admin/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Your account is inactive. Please activate <a href="#">here</a>.');
                    redirect(base_url('admin/login'));
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password!');
                redirect(base_url('admin/login'));
            }
        }
        $this->load->view('admin/login');
    }

    public function forgotpassword() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email');
        $this->form_validation->set_message('required', '%s is required.');
        $this->form_validation->set_message('valid_email', '%s must contain a valid email address.');
        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $password = random_string('alnum', 15);
            $this->login->resetPassword($email, $password);
            $message = 'Email: ' . $email . ', Password: ' . $password;
            $this->send_email('admin@ci3school.com', $email, 'Forgot Password', $message);
            $this->session->set_flashdata('msg', 'New password has been sent to ' . $email . '.');
            redirect(base_url('admin/login'));
        }
        $this->load->view('admin/forgotpassword');
    }

    public function check_email($email) {
        $response = $this->login->checkEmail($email);
        if ($response) {
            return true;
        } else {
            $this->form_validation->set_message('check_email', '%s is not registered with us.');
            return false;
        }
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/admin/Login.php */
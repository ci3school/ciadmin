<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/dashboardmodel', 'dashboard');
        if (!$this->isAdminLogged('admin')) {
            $path = base_url() . 'admin/login';
            redirect($path);
        }
    }

    public function index() {
        $data = array('title' => 'Dashboard');
        $this->template->load('default', 'dashboard/index', 'admin', $data);
    }

    public function settings() {
        $data = array('title' => 'Settings');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_checkpassword');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('matches', '%s doesn\'t match the %s.');
        if ($this->form_validation->run() == true) {
            $data = array(
                'password' => md5($this->input->post('new_password'))
            );
            $admin = $this->session->userdata('admin');
            $response = $this->dashboard->updatePassword($admin['id'], $data);
            if ($response) {
                $this->session->set_flashdata('msg', 'Password has been reset successfully!');
            } else {
                $this->session->set_flashdata('error', 'Technical error. Please try after some time!');
            }
            redirect(base_url('admin/settings'));
        }
        $this->template->load('default', 'dashboard/settings', 'admin', $data);
    }

    public function checkpassword($password) {
        $admin = $this->session->userdata('admin');
        $result = $this->dashboard->checkPassword($admin['id'], $password);
        if (!$result) {
            $this->form_validation->set_message('checkpassword', "Incorrect %s.");
            return false;
        } else {
            return true;
        }
    }

    public function logout() {
        $this->session->unset_userdata('admin');
        redirect(base_url() . 'admin/login');
    }

}
/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */
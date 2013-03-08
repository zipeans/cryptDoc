<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/LoginBase.php' );
// --

class login extends ApplicationBase {

    // constructor
    public function  Login() {
        parent::__construct();
    }

    // view
    public function index() {
        // set template content
        $this->smarty->assign("template_content", "login/view.html");
        // bisnis proses

        // output
        parent::display();
    }

    // error
    public function error() {
        // set template content
        $this->smarty->assign("template_content", "login/error.html");
        // bisnis proses

        // output
        parent::display();
    }

    // login process
    public function login_process() {
        // load libraries
        $this->load->library('form_validation');
        // set rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required');
        // process
        if ($this->form_validation->run() !== FALSE) {
            $this->session->set_userdata('cismart', TRUE);
            // output
            redirect('home/welcome');
        }
        // output
        redirect('login/login/error');
    }

    // logout process
    public function logout_process() {
        $this->session->unset_userdata('cismart');
        // output
        redirect('login/login');
    }
}
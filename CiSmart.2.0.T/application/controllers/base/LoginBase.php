<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ApplicationBase extends CI_Controller {

    // base variable

    // parent constructor
    public function __construct() {
        // load basic controller
        parent::__construct();
        // load app data
        $this->base_load_app();
        // view app data
        $this->base_view_app();
    }

    /*
     * Method pengolah base load
     * diperbolehkan untuk dioverride pada class anaknya
    */

    protected function base_load_app() {
        // load themes (themes default : default)
        $this->smarty->load_themes("login");
        // load base models

        // load base javascript

        // load base style

    }

    /*
     * Method pengolah base view
     * diperbolehkan untuk dioverride pada class anaknya
    */

    protected function base_view_app() {
        // config for url helper
        $this->smarty->assign("config", $this->config);
        // call base method

    }

    /*
     * Method layouting base document
     * diperbolehkan untuk dioverride pada class anaknya
    */

    protected function display($tmpl_name = 'base/login/document.html') {
        // set another base template
        //
        // 
        // set template
        $this->smarty->display($tmpl_name);
    }

    /*
     * base private method here
     * private function with prefix ( _ )
    */
    

}

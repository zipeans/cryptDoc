<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class plugins extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
    }

    public function index() {
        // set template content
        $this->smarty->assign("template_content", "template/plugins/welcome.html");
        // bisnis proses

        // output
        parent::display();
    }
}

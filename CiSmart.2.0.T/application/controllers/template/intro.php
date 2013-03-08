<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class intro extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
    }

    public function index() {
        // set template content
        $this->smarty->assign("template_content", "template/intro/welcome.html");
        // bisnis proses

        // output
        parent::display();
    }

    public function controller() {
        // set template content
        $this->smarty->assign("template_content", "template/intro/controller.html");
        // assign variable
        $this->smarty->assign("a", "a say nothing");
        $this->smarty->assign("b", "b say don't get carelless");
        // if statement
        $this->smarty->assign("name", "andi");
        $this->smarty->assign("what", "andi");
        // foreach statement
        $items_list = array(23 => array('no' => 2456, 'label' => 'Salad'), 96 => array('no' => 4889, 'label' => 'Cream'));
        $this->smarty->assign('items', $items_list);
        // output
        parent::display();
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class jasper extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
        // load
        $this->load->library('tcpdf');
        $this->load->library('phpjasperxml', array("lang" => "en", "pdflib" => "TCPDF"));
    }

    public function index() {
        // set template content
        $this->smarty->assign("template_content", "template/jasper/welcome.html");
        // bisnis proses

        // output
        parent::display();
    }

    // report output
    public function report() {
        error_reporting(0);
        // read xml
        $xml =  simplexml_load_file("resource/doc/jasper/sample1.jrxml");
        // $this->phpjasperxml->debugsql = true;
        $this->phpjasperxml->arrayParameter = array("parameter1" => "SELECT * FROM ex_data");
        $this->phpjasperxml->xml_dismantle($xml);
        $this->phpjasperxml->transferDBtoArray($this->db->hostname, $this->db->username, $this->db->password, $this->db->database);
        $this->phpjasperxml->outpage("I");
    }
}
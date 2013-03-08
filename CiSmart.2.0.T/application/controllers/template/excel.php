<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class excel extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
        // load
        $this->load->library('phpexcel');
    }

    // PHP Excel
    public function index() {
        // set template content
        $this->smarty->assign("template_content", "template/excel/welcome.html");

        // output
        parent::display();

    }

    // simple create excel
    public function simple() {
        // write
        $this->phpexcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Hello')
                ->setCellValue('B2', 'world!')
                ->setCellValue('C1', 'Hello')
                ->setCellValue('D2', 'world!');
        // setting
        $this->phpexcel->getActiveSheet()->setTitle('Simple');
        $this->phpexcel->setActiveSheetIndex(0);
        // download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="simple.xlsx"');
        header('Cache-Control: max-age=0');

        // save lokal
        /*
        $obj_writer = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
        $obj_writer->save('resource/doc/data/simple.xlsx');
         * 
        */
    }

    // simple read excel
    public function read() {
        // set template content
        $this->smarty->assign("template_content", "template/excel/read.html");
        // read
        if(is_file("resource/doc/data/simple.xlsx")) {
            $worksheet = PHPExcel_IOFactory::load("resource/doc/data/simple.xlsx");
            $sheet = $worksheet->getSheet(0);
            $cells = $sheet->getCellCollection();
            // get value from cell collection
            if(is_array($cells)) {
                $html = array();
                foreach($cells as $cell) {
                    $cell_data = $sheet->getCell($cell);
                    $html[$cell] = $cell_data->getValue();
                }
                $this->smarty->assign("rs_id", $html);
            }
        }
        // output
        parent::display();
    }
}
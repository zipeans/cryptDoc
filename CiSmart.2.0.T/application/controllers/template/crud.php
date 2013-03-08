<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class crud extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
        // load
        $this->load->model('m_data');
        $this->load->library('tnotification');
    }

    // list data
    public function index() {
        // set template content
        $this->smarty->assign("template_content", "template/crud/list.html");
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // get list data
        $this->smarty->assign("rs_id", $this->m_data->get_all_data());
        // output
        parent::display();
    }

    // form tambah
    public function add() {
        // set template content
        $this->smarty->assign("template_content", "template/crud/add.html");
        // get list radio
        $radio_array = array("single" => "Belum Menikah", "suami" => "Suami", "istri" => "Istri", "anak" => "Anak");
        $this->smarty->assign("radio_array", $radio_array);
        // get list data references
        $this->smarty->assign("ref_data", $this->m_data->get_all_references());
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // process tambah
    public function process_add() {
        // cek input
        $this->tnotification->set_rules('teks', 'Example Teks', 'trim|required|max_length[50]');
        $this->tnotification->set_rules('radiobaten', 'Example Radio', 'trim|required');
        $this->tnotification->set_rules('selekbok', 'Example Select', 'trim|required');
        $this->tnotification->set_rules('selekbok_id', 'Example Select By References', 'trim|required');
        // process
        if ($this->tnotification->run() !== FALSE) {
            $params = array($this->input->post('teks'), $this->input->post('radiobaten'), $this->input->post('selekbok'), $this->input->post('selekbok_id'));
            // insert
            if($this->m_data->insert($params)) {
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
            }else {
                // default error
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
        } else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal disimpan");
        }
        // default redirect
        redirect("template/crud/add");
    }

    // form edit
    public function edit($id_data = "") {
        // set template content
        $this->smarty->assign("template_content", "template/crud/edit.html");
        // get detail data
        $this->smarty->assign("result", $this->m_data->get_data_by_id($id_data));
        // get list radio
        $radio_array = array("single" => "Belum Menikah", "suami" => "Suami", "istri" => "Istri", "anak" => "Anak");
        $this->smarty->assign("radio_array", $radio_array);
        // get list data references
        $this->smarty->assign("ref_data", $this->m_data->get_all_references());
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // process edit
    public function process_edit() {
        // cek input
        $this->tnotification->set_rules('id_data', 'ID', 'trim|required');
        $this->tnotification->set_rules('teks', 'Example Teks', 'trim|required|max_length[50]');
        $this->tnotification->set_rules('radiobaten', 'Example Radio', 'trim|required');
        $this->tnotification->set_rules('selekbok', 'Example Select', 'trim|required');
        $this->tnotification->set_rules('selekbok_id', 'Example Select By References', 'trim|required');
        // process
        if ($this->tnotification->run() !== FALSE) {
            $params = array($this->input->post('teks'), $this->input->post('radiobaten'),
                    $this->input->post('selekbok'), $this->input->post('selekbok_id'), $this->input->post('id_data'));
            // insert
            if($this->m_data->update($params)) {
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
            }else {
                // default error
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
        }else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal disimpan");
        }
        // default redirect
        redirect("template/crud/edit/" . $this->input->post('id_data', 0));
    }

    // form hapus
    public function hapus($id_data = "") {
        // set template content
        $this->smarty->assign("template_content", "template/crud/hapus.html");
        // get detail data
        $this->smarty->assign("result", $this->m_data->get_data_by_id($id_data));
        // notification
        $this->tnotification->display_notification();
        // output
        parent::display();
    }

    // process hapus
    public function process_delete() {
        // cek input
        $this->tnotification->set_rules('id_data', 'ID', 'trim|required');
        // process
        if ($this->tnotification->run() !== FALSE) {
            $params = array($this->input->post('id_data'));
            // insert
            if($this->m_data->delete($params)) {
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil dihapus");
                // default redirect
                redirect("template/crud");
            }else {
                // default error
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }
        }else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal disimpan");
        }
        // default redirect
        redirect("template/crud/hapus/" . $this->input->post('id_data', 0));
    }
}

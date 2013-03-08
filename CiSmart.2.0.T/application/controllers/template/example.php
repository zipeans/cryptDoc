<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// load base class if needed
require_once( APPPATH . 'controllers/base/AdminBase.php' );
// --

class example extends ApplicationBase {

    // constructor
    public function  __construct() {
        parent::__construct();
        // load
        $this->load->model('m_data');
        $this->load->library('pagination');
        $this->load->library('tnotification');
    }

    // pagination
    public function pagination() {
        // set template content
        $this->smarty->assign("template_content", "template/example/pagination.html");
        /* start of pagination --------------------- */
        // pagination
        $config['base_url'] = site_url("template/example/pagination/");
        $config['total_rows'] = $this->m_data->get_total_data();
        $config['uri_segment'] = 4;
        $config['per_page'] = 3;
        $this->pagination->initialize($config);
        $pagination['data'] = $this->pagination->create_links();
        // pagination attribute
        $start = $this->uri->segment(4, 0) + 1;
        $end = $this->uri->segment(4, 0) + $config['per_page'];
        $end = (($end > $config['total_rows'])?$config['total_rows']:$end);
        $pagination['start'] = $start;
        $pagination['end'] = $end;
        $pagination['total'] = $config['total_rows'];
        // pagination assign value
        $this->smarty->assign("pagination", $pagination);
        $this->smarty->assign("no", $start);
        /* end of pagination ---------------------- */
        // get list data
        $params = array(intval($this->uri->segment(4, 0)), $config['per_page']);
        $this->smarty->assign("rs_id", $this->m_data->get_all_data_limit($params));
        // output
        parent::display();
    }

    // form uploader
    public function uploader () {
        // set template content
        $this->smarty->assign("template_content", "template/example/upload.html");
        // images
        $img_path = 'resource/doc/images/example/test.jpg';
        if(!is_file($img_path)) {
            $img_path = 'resource/doc/temp/images.gif';
        }
        $this->smarty->assign("image_path", base_url() . $img_path);
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();
    }

    // process uploader
    public function process_upload () {
        // load
        $this->load->library('tupload');
        // upload config
        $config['upload_path'] = 'resource/doc/images/example/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '800';
        $config['file_name'] = 'test';
        $this->tupload->initialize($config);
        // process upload images
        if ( ! $this->tupload->do_upload_image('image')) {
            // jika gagal (kembalikan pesan)
            $this->tnotification->set_error_message($this->tupload->display_errors());
            $this->tnotification->sent_notification("error", "Data gagal disimpan");
        } else {
            // jika sukses

            // resize config
            $config['source_file'] = 'resource/doc/images/example/test.jpg';
            $config['target_dir'] = 'resource/doc/images/example/';
            $config['new_file_name'] = '';
            $config['new_width'] = 300;
            $config['new_height'] = FALSE;
            // resize
            if ( ! $this->tupload->do_resize_image($config)) {
                // jika gagal
                $this->tnotification->set_error_message($this->tupload->display_errors());
                $this->tnotification->sent_notification("error", "Data gagal disimpan");
            }else {
                $data = $this->tupload->data_resize();
                // jika sukses
                $this->tnotification->set_error_message("Gambar " . $data['source_file'] . " berhasil di resize");
                $this->tnotification->sent_notification("success", "Data berhasil disimpan");
            }
        }
        // default redirect
        redirect("template/example/uploader");
    }

    // Berkolaborasi dengan JQuery UI
    public function jqueryui() {
        // set template content
        $this->smarty->assign("template_content", "template/jqueryui/welcome.html");
        // load javascript
        $this->smarty->load_javascript("resource/js/jquery/jquery-1.5.1.min.js");
        $this->smarty->load_javascript("resource/js/jquery/jquery-ui-1.8.13.custom.min.js");
        // load style ui
        $this->smarty->load_style("jquery.ui/redmond/jquery-ui-1.8.13.custom.css");

        // output
        parent::display();
    }

    // Ajax
    public function ajax_form() {
        // set template content
        $this->smarty->assign("template_content", "template/ajax/welcome.html");
        // load javascript
        $this->smarty->load_javascript("resource/js/jquery/jquery-1.5.1.min.js");
        // load style
        $this->smarty->load_style("styles/wall.css");

        // output
        parent::display();
    }

    // Ajax
    public function ajax_result($content = "") {
        // set template content to self
        // load javascript
        $this->smarty->load_javascript("resource/js/jquery/jquery-1.5.1.min.js");
        // load style
        $this->smarty->load_style("styles/wall.css");
        // assign
        $this->smarty->assign("ajax_content", $content);
        // output
        $this->smarty->display("template/ajax/ajax_result.html");
    }

    // Email Form
    public function email() {
        // set template content
        $this->smarty->assign("template_content", "template/example/email.html");
        // notification
        $this->tnotification->display_notification();
        $this->tnotification->display_last_field();
        // output
        parent::display();

    }

    // Email Send
    public function email_send() {
        // load
        $config['protocol'] = 'smtp';
        $config['charset'] = 'iso-8859-1';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = '';
        $config['smtp_pass'] = '';
        $config['smtp_port'] = '465';
        $config['smtp_timeout']='30';
        $config['newline'] = "\r\n";
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        // cek input
        $this->tnotification->set_rules('email_subject', '<b>Subject</b>', 'trim|required');
        $this->tnotification->set_rules('email_to', '<b>To</b>', 'trim|required');
        $this->tnotification->set_rules('email_msg', '<b>Message</b>', 'trim|required');
        // process
        if ($this->tnotification->run() !== FALSE) {
            // send mail
            $this->email->from('tedevel@gmail.com', 'Nama Saya');
            $this->email->to($this->input->post('email_to'));
            $this->email->subject($this->input->post('email_subject'));
            $this->email->message($this->input->post('email_msg'));
            if ( ! $this->email->send()) {
                // Generate error
                $this->tnotification->sent_notification("error", "Data gagal dikirim");
            }else {
                $this->tnotification->delete_last_field();
                $this->tnotification->sent_notification("success", "Data berhasil dikirim");
            }
            // echo $this->email->print_debugger();
        }else {
            // default error
            $this->tnotification->sent_notification("error", "Data gagal dikirim");
        }
        // default redirect
        redirect("template/example/email/");
    }
}
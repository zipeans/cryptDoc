<?php
class ApplicationBase extends CI_Controller {

    // base variable
    private $current = array();
    private $int_nav = 0;
    private $int_parent = 0;
    private $int_parent_selected = 0;

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
        $this->smarty->load_themes();
        // load base models

        // load base javascript

        // load base style

    }

    /*
     * Method pengolah base view
     * diperbolehkan untuk dioverride pada class anaknya
    */
    
    protected function base_view_app() {
        $this->smarty->assign("config", $this->config);
        // check security
        self::_check_authority();
        // display global link
        self::_display_base_link();
        // display site title
        self::_display_site_title();
        // display top navigation
        self::_display_top_navigation();
        // display sidebar navigation
        self::_display_sidebar_navigation();
    }

    /*
     * Method layouting base document
     * diperbolehkan untuk dioverride pada class anaknya
    */
    protected function display($tmpl_name = 'base/admin/document.html') {
        // --
        $this->smarty->assign("template_sidebar", "base/admin/sidebar.html");
        // set template
        $this->smarty->display($tmpl_name);
    }

    //

    // base private method here
    // prefix ( _ )

    // base link
    private function _display_base_link() {
        // logout
        $this->smarty->assign("url_logout", site_url("login/login/logout_process"));
        // side url
        $this->smarty->assign("url_side_welcome", site_url("home/welcome"));
        $this->smarty->assign("url_side_role", site_url("sistem/role"));
        $this->smarty->assign("url_side_menu", site_url("sistem/menu"));
        $this->smarty->assign("url_side_user", site_url("sistem/user"));
        $this->smarty->assign("url_side_access", site_url("sistem/access"));
    }

    // authority
    private function _check_authority() {
        // authority
        if(!$this->session->userdata('cismart')) {
            // output
            redirect('login/login');
        }
    }

    // site title
    private function _display_site_title() {
        // get current page
        $url_menu = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
        $url_menu = trim($url_menu, '/');
        $result = $this->m_site->get_current_page(array($url_menu));
        if (!empty($result)) {
            $this->current = $result;
            $this->int_nav = $result['id_nav'];
            $this->int_parent = $result['id_parent'];
        }
    }

    // top navigation
    private function _display_top_navigation() {
        // get parent selected
        $this->int_parent_selected = self::_get_parent_group($this->int_parent, 0);
        if ($this->int_parent_selected == 0) {
            $this->int_parent_selected = $this->int_nav;
        }
        // get data
        $this->smarty->assign("list_top_nav", $this->m_site->get_navigation_by_parent(array(0)));
        $this->smarty->assign("top_menu_selected", $this->int_parent_selected);
    }

    // sidebar navigation
    private function _display_sidebar_navigation() {
        // get parent selected
        $int_parent_selected = self::_get_parent_group($this->int_parent, $this->int_parent_selected);
        if ($int_parent_selected == 0) {
            $int_parent_selected = $this->int_nav;
        }
        // get data
        $this->smarty->assign("list_side_nav", $this->m_site->get_navigation_by_parent($this->int_parent_selected));
        $this->smarty->assign("side_menu_selected", $int_parent_selected);
    }

    // utility to get parent selected
    private function _get_parent_group($int_nav, $int_limit) {
        $selected_parent = 0;
        $result = $this->m_site->get_menu_by_id($int_nav);
        if (!empty($result)) {
            if ($result['id_parent'] == $int_limit) {
                $selected_parent = $result['id_nav'];
            } else {
                return self::_get_parent_group($result['id_parent'], $int_limit);
            }
        } else {
            $selected_parent = $result['id_nav'];
        }
        return $selected_parent;
    }
}
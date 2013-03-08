<?php
class m_site extends CI_Model {

    function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get current page
    function get_current_page($params) {
        $sql = "SELECT * FROM sys_build_menu_m
                WHERE url_menu = ?
                ORDER BY no_menu DESC LIMIT 0,1";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    // get menu by id
    function get_menu_by_id($params) {
        $sql = "SELECT * FROM sys_build_menu_m WHERE id_nav = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function get_navigation_by_parent($params) {
        $sql = "SELECT * FROM sys_build_menu_m
                WHERE id_parent = ? AND displayed = 'yes'
                ORDER BY no_menu ASC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return false;
        }
    }

    function get_parent_group_by_idnav($int_parent, $limit) {
        $sql = "SELECT a.id_nav, a.id_parent FROM sys_build_menu_m a WHERE a.id_nav = ?
                ORDER BY a.id_nav DESC LIMIT 0, 1";
        $query = $this->db->query($sql, array($int_parent));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            if($result['id_parent'] == $limit) {
                return $result['id_nav'];
            }else {
                return self::get_parent_group_by_idnav($result['id_parent'], $limit);
            }
        }else {
            return $int_parent;
        }
    }
}
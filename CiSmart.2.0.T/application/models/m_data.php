<?php
class m_data extends CI_Model {

    function  __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    // get total data
    function get_total_data () {
        $sql = "SELECT COUNT(*)'total' FROM ex_data";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        }else {
            return 0;
        }
    }

    // get all data
    function get_all_data () {
        $sql = "SELECT a.*, nama FROM ex_data a
                LEFT JOIN ex_reference b ON a.selekbok_id = b.id_ref";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
    }

    // get all data
    function get_all_data_limit ($params) {
        $sql = "SELECT a.*, nama FROM ex_data a
                LEFT JOIN ex_reference b ON a.selekbok_id = b.id_ref
                LIMIT ?, ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
    }

    // get all data references
    function get_all_references () {
        $sql = "SELECT * FROM ex_reference ORDER BY nama ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
    }

    // get detail data by id
    function get_data_by_id ($id_user) {
        $sql = "SELECT * FROM ex_data a INNER JOIN ex_reference b ON a.selekbok_id = b.id_ref
                WHERE id_data = ?";
        $query = $this->db->query($sql, $id_user);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }else {
            return array();
        }
    }

    // insert
    function insert ($params) {
        $sql = "INSERT INTO ex_data (teks, radiobaten, selekbok, selekbok_id) VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, $params);
    }

    // update
    function update ($params) {
        $sql = "UPDATE ex_data SET teks = ?, radiobaten = ?, selekbok = ?, selekbok_id = ?
                WHERE id_data = ?";
        return $this->db->query($sql, $params);
    }

    // delete
    function delete ($params) {
        $sql = "DELETE FROM ex_data
                WHERE id_data = ?";
        return $this->db->query($sql, $params);
    }
}
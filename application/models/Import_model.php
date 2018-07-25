<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Import_model extends CI_Model {
 
    private $_batchImport;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

 
    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }
 /*
    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('existing_excel', $data);
    }*/

    public function importData() {
        $data = $this->_batchImport;
      //  $this->db->set($data);
        $this->db->insert_batch('ifois_excel', $data);
    }

    // get employee list
    public function employeeList() {
        $this->db->select(array('e.id', 'e.first_name', 'e.last_name', 'e.email', 'e.dob', 'e.contact_no'));
        $this->db->from('import as e');
        $query = $this->db->get();
        return $query->result_array();
    }
 
}
 
?>
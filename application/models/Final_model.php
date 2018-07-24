<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Final_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_outstanding($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS summ FROM existing');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang)) as TES');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM (select e.OSPOKOKCONVERSION from existing_archive e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang)) as TES');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM (select e.OSPOKOKCONVERSION from existing_archive e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'")) AS TES');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
        	return $query->result_array();
        }


}
        
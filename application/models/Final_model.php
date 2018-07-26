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
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM existing');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang)) as TES');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from existing_archive e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang)) as TES');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_OS  FROM (select e.OSPOKOKCONVERSION from existing_archive e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'")) AS TES');
            } else {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
        	return $query->result_array();
        }

        public function get_kol2($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_KOL2 FROM existing WHERE KOLCIF = 2;');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_KOL2 FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang) AND e.KOLCIF = 2) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_KOL2 FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND e.KOLCIF = 2) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_KOL2  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND e.KOLCIF = 2) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }

        public function get_npf($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM existing WHERE KOLCIF = 3  OR KOLCIF = 4 OR KOLCIF = 5;');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang) AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_NPF  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }

        public function get_runoff($jabatan, $nama_lokasi)
        {
            $os_sekarang = $this->get_outstanding($jabatan, $nama_lokasi);
            
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM existing WHERE KOLCIF = 3  OR KOLCIF = 4 OR KOLCIF = 5;');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang) AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_NPF  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           

            $os_bulan_lalu = $query->result_array();
            $os1 = $os_sekarang[0]['SUM_OS'];
            $os2 = $os_bulan_lalu[0]['SUM_OS'];

        }

        public function get_cair($jabatan, $nama_lokasi)
        {





            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM existing WHERE KOLCIF = 3  OR KOLCIF = 4 OR KOLCIF = 5;');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang) AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_NPF  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.KOLCIF = 3 OR e.KOLCIF = 4 OR e.KOLCIF = 5)) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }





}
        
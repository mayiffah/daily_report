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
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
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


        public function get_cair($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM existing WHERE (`P/B` = 'Pencairan Baru' OR 'Pencairan baru');');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang) AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru')) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru')) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_NPF  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru')) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }

        public function get_cair_b2b($jabatan, $nama_lokasi)
        {

            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM existing WHERE (`P/B` = 'Pencairan Baru' OR 'Pencairan baru');');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang) AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru') AND (e.GRUP = 'B to B')) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru')   AND (e.GRUP = 'B to B')  ) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_NPF  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru') AND (e.GRUP = 'B to B')) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }

        public function get_cair_b2c($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM existing WHERE (`P/B` = 'Pencairan Baru' OR 'Pencairan baru');');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang) AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru') AND (e.GRUP = 'B to C')) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru')   AND (e.GRUP = 'B to C')  ) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_NPF  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.`P/B` = 'Pencairan Baru' OR 'Pencairan baru') AND (e.GRUP = 'B to C')) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();

        }

        public function get_runoff($jabatan, $nama_lokasi)
        {
            $os_sekarang = $this->get_outstanding($jabatan, $nama_lokasi);
            $cair_baru = $this->get_cair($jabatan, $nama_lokasi);
            $tahun = date(Y);
            $bulan_ini = date(m);
            if ($bulan_ini === "01") {
                $bulan_lalu = "12";
                $tahun = intval($tahun) - 1;
            } else {
                $bulan_lalu = intval($bulan_ini) - 1;
            }

            $table_bulan_lalu = 'existing_akhir_bulan'.$tahun.'-'.$bulan_lalu;
            
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM existing');
            } else if ($jabatan === '3' || $jabatan === '4') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and EXISTS (select c.kode_cabang from cabang c, area a, wilayah w where w.id = (select z.id from wilayah z where z.nama_wilayah = "'.$nama_lokasi.'") and c.id_area = a.id and a.id_wilayah = w.id and a.kode_cabang = c.kode_cabang)) as TES');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from existing_archive e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang)) as TES');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_OS  FROM (select e.OSPOKOKCONVERSION from existing_archive e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'")) AS TES');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }               

            $os_bulan_lalu = $query->result_array();
            $os1 = $os_sekarang[0]['SUM_OS'];
            $os2 = $os_bulan_lalu[0]['SUM_OS'];
            $cair = $cair_baru[0]['SUM_OS'];
            //os2 + cair skrg - os1
            $run_off = $os2 + $cair - $os1;
            return $run_off;
        }

        /*
upgrade=
SELECT DISTINCT a.nomorcif,  b.nomorcif, a.kolcif, b.kolcif FROM `existing` a, `existing_akhir_bulan2018-06` b WHERE (a.nomorcif = b.nomorcif) AND (a.kolcif = 1  OR a.kolcif = 2) AND ((b.kolcif = 3) OR (b.kolcif = 4) OR (b.kolcif = 5))

downgrade=
SELECT DISTINCT a.nomorcif,  b.nomorcif, a.kolcif, b.kolcif FROM `existing` a, `existing_akhir_bulan2018-06` b WHERE (a.nomorcif = b.nomorcif) AND ((a.kolcif = 1  AND b.kolcif = 2) OR (a.kolcif = 2 AND ((b.kolcif = 3) OR (b.kolcif = 4) OR (b.kolcif = 5)))

*/
        public function get_upgrade($jabatan, $nama_lokasi)
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
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }


        public function get_downgrade($jabatan, $nama_lokasi)
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
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }











}
        
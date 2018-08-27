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
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);


                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from existing e where (e.KANWIL = "'.$nomor.'")) as TES');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang)) as TES');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_OS  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'")) AS TES');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
        	return $query->result_array();
        }

        public function get_kol2($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_KOL2 FROM existing WHERE kolciffinal = 2;');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_KOL2 FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and (e.KANWIL = "'.$nomor.'") AND e.kolciffinal = 2) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_KOL2 FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND e.kolciffinal = 2) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_KOL2  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND e.kolciffinal = 2) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }

        public function get_npf($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM existing WHERE kolciffinal = 3  OR kolciffinal = 4 OR kolciffinal = 5;');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and (e.KANWIL = "'.$nomor.'") AND (e.kolciffinal = 3 OR e.kolciffinal = 4 OR e.kolciffinal = 5)) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_NPF FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.kolciffinal = 3 OR e.kolciffinal = 4 OR e.kolciffinal = 5)) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_NPF  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.kolciffinal = 3 OR e.kolciffinal = 4 OR e.kolciffinal = 5)) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }


        public function get_cair($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM existing WHERE (`P/B` = "Pencairan Baru" OR "Pencairan baru");');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and (e.KANWIL = "'.$nomor.'") AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru")) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru")) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_CAIR  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru")) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }

        public function get_cair_b2b($jabatan, $nama_lokasi)
        {

            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM existing WHERE (`P/B` = "Pencairan Baru" OR "Pencairan baru") AND (e.GRUP = "B to B");');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and (e.KANWIL = "'.$nomor.'") AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru") AND (e.GRUP = "B to B")) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru")   AND (e.GRUP = "B to B")  ) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_CAIR  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru") AND (e.GRUP = "B to B")) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }

        public function get_cair_b2c($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM existing WHERE (`P/B` = "Pencairan Baru" OR "Pencairan baru") AND (e.GRUP = "B to C");');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM (select e.OSPOKOKCONVERSION from existing e, cabang a where e.KODECABANGBARU = a.kode_cabang and (e.KANWIL = "'.$nomor.'") AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru") AND (e.GRUP = "B to C")) as TES;');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_CAIR FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang) AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru")   AND (e.GRUP = "B to C")  ) as TES;');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_CAIR  FROM (select e.OSPOKOKCONVERSION from existing e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'") AND (e.`P/B` = "Pencairan Baru" OR "Pencairan baru") AND (e.GRUP = "B to C")) AS TES;');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();

        }

        public function get_runoff($jabatan, $nama_lokasi)
        {
            $os_sekarang = $this->get_outstanding($jabatan, $nama_lokasi);
            $cair_baru = $this->get_cair($jabatan, $nama_lokasi);
           
            
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM `existing_akhir_bulan`');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from `existing_akhir_bulan` e, cabang a where e.KODECABANGBARU = a.kode_cabang and (e.KANWIL = "'.$nomor.'")) as TES');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) AS SUM_OS FROM (select e.OSPOKOKCONVERSION from `existing_akhir_bulan` e, cabang c where e.KODECABANGBARU = c.kode_cabang and EXISTS (select d.kode_cabang from cabang d where id_area = (select a.id from area a where a.nama_area = "'.$nama_lokasi.'") and c.kode_cabang = d.kode_cabang)) as TES');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION)  AS SUM_OS  FROM (select e.OSPOKOKCONVERSION from `existing_akhir_bulan` e, cabang c where e.KODECABANGBARU = c.kode_cabang and c.kode_cabang = (select a.kode_cabang from cabang a where a.nama_cabang = "'.$nama_lokasi.'")) AS TES');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }               

            $os_bulan_lalu = $query->result_array();
            $os1 = $os_sekarang[0]['SUM_OS'];
            $os2 = $os_bulan_lalu[0]['SUM_OS'];
            $cair = $cair_baru[0]['SUM_CAIR'];
            //run off = os2 + cair skrg - os1
            $run_off = $os2 + $cair - $os1;
            return $run_off;
        }

        public function get_upgrade($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM (SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu FROM `existing` a, `existing_akhir_bulan` b WHERE (a.nomorcif = b.nomorcif) AND (a.kolciffinal = 1 OR a.kolciffinal = 2) AND ((b.kolciffinal = 3) OR (b.kolciffinal = 4) OR (b.kolciffinal = 5))) AS cari_upgrade');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM (SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu 
                    FROM `existing` a, `existing_akhir_bulan` b, cabang ca 
                    WHERE   
                    a.KODECABANGBARU = ca.kode_cabang AND
                    (a.nomorcif = b.nomorcif) AND 
                    (a.KANWIL = "'.$nomor.'")
                    AND
                    (a.kolciffinal = 1 OR a.kolciffinal = 2) AND ((b.kolciffinal = 3) OR (b.kolciffinal = 4) OR (b.kolciffinal = 5))
                    ) AS cari_upgrade');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM ( SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu FROM `existing` a, `existing_akhir_bulan` b, cabang ca WHERE a.KODECABANGBARU = ca.kode_cabang AND a.nomorcif = b.nomorcif AND 
                    EXISTS (select * from (select d.kode_cabang from cabang d where id_area = (select ar.id from area ar where ar.nama_area = "'.$nama_lokasi.'") ) temp_tab) AND (a.kolciffinal = 1 OR a.kolciffinal = 2) AND ((b.kolciffinal = 3) OR (b.kolciffinal = 4) OR (b.kolciffinal = 5)) ) AS cari_upgrade');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM (SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu 
                    FROM `existing` a, `existing_akhir_bulan` b, cabang ca 
                    WHERE   
                    a.KODECABANGBARU = ca.kode_cabang AND
                    (a.nomorcif = b.nomorcif) AND 
                    ca.kode_cabang = (select d.kode_cabang from cabang d where d.nama_cabang = "'.$nama_lokasi.'") AND
                    (a.kolciffinal = 1 OR a.kolciffinal = 2) AND ((b.kolciffinal = 3) OR (b.kolciffinal = 4) OR (b.kolciffinal = 5))
                    ) AS cari_upgrade');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }


        public function get_downgrade($jabatan, $nama_lokasi)
        {
            if ($jabatan === "1" || $jabatan === "2") {
                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM (SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu FROM `existing` a, `existing_akhir_bulan` b WHERE (a.nomorcif = b.nomorcif) AND (b.kolciffinal = 1 OR b.kolciffinal = 2) AND ((a.kolciffinal = 3) OR (a.kolciffinal = 4) OR (a.kolciffinal = 5))) AS cari_downgrade');
            } else if ($jabatan === '3' || $jabatan === '4') {
                list($regional, $nomor) = explode(' ', $nama_lokasi, 2);

                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM (SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu 
                    FROM `existing` a, `existing_akhir_bulan` b, cabang ca 
                    WHERE 
                    a.KODECABANGBARU = ca.kode_cabang AND
                    (a.nomorcif = b.nomorcif) AND 
                    (a.KANWIL = "'.$nomor.'") 
                    AND
                    (b.kolciffinal = 1 OR b.kolciffinal = 2) AND ((a.kolciffinal = 3) OR (a.kolciffinal = 4) OR (a.kolciffinal = 5))
                    ) AS cari_downgrade');
            } else if ($jabatan === '5' || $jabatan === '7') {
                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM (SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu       FROM `existing` a, `existing_akhir_bulan` b, cabang ca WHERE  a.KODECABANGBARU = ca.kode_cabang AND
                    a.nomorcif = b.nomorcif AND 
                    EXISTS (select * from
                     (select d.kode_cabang from cabang d where id_area = (select ar.id from area ar where ar.nama_area = "'.$nama_lokasi.'") ) temp_tab) AND
                    (b.kolciffinal = 1 OR b.kolciffinal = 2) AND ((a.kolciffinal = 3) OR (a.kolciffinal = 4) OR (a.kolciffinal = 5))
                    ) AS cari_downgrade');
            } else if ($jabatan === '6' || $jabatan === '8') {
                $query = $this->db->query('SELECT SUM(coba) AS SUM_NPF FROM (SELECT DISTINCT a.OSPOKOKCONVERSION AS coba, a.nomorcif AS nomorcif_skrg, b.nomorcif AS nomorcif_dulu, a.kolciffinal AS kolciffinal_skrg, b.kolciffinal AS kolciffinal_dulu 
                    FROM `existing` a, `existing_akhir_bulan` b, cabang ca 
                    WHERE   
                    a.KODECABANGBARU = ca.kode_cabang AND
                    (a.nomorcif = b.nomorcif) AND 
                    ca.kode_cabang = (select d.kode_cabang from cabang d where d.nama_cabang = "'.$nama_lokasi.'") AND
                    (b.kolciffinal = 1 OR b.kolciffinal = 2) AND ((a.kolciffinal = 3) OR (a.kolciffinal = 4) OR (a.kolciffinal = 5))
                    ) AS cari_downgrade');
            } else {
               // $query = $this->db->query('SELECT SUM(OSPOKOKCONVERSION) FROM existing');
            }           
            return $query->result_array();
        }











}
        
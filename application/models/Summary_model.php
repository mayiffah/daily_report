<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Summary_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

        public function get_summary($title = TRUE)
        {
            if ($title === 'all') {
              $query = $this->db->query('SELECT * FROM `summary`');
            } else {
              $query = $this->db->query('SELECT * FROM `summary` WHERE id = "'.$title.'"');
            }
        	
        	return $query->result();
        }

        public function get_summary_portfolio() 
        {
            $hasil = array();
            $count = 1;
            $persen_npf = 0;
            $persen_kol2 = 0;
            $query = $this->db->query('SELECT Outstanding, NPF, Kol_2, Kol_1 FROM `summary` WHERE id = 1');
            $result = $query->result();
            $os = 0;

            foreach($result[0] as $r) {
                $temp = floatval($r);
                $temp = $temp / 1000000000;
                $hasil[] = number_format($temp, 2, '.', '');
                if ($count === 1) {
                    $os = $temp;
                } elseif ($count === 2) {
                    $persen_npf = ($temp/$os)*100;
                } elseif ($count === 3) {
                    $persen_kol2 = ($temp/$os)*100;
                }
                $count++;
            }

            $hasil[] = number_format($persen_npf, 2, '.', '');
            $hasil[] = number_format($persen_kol2, 2, '.', '');
            return $hasil;

            
        }


}
        
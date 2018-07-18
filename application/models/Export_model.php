<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Export_model extends CI_Model {

	public function __construct()
        {
            parent::__construct();
          	$this->load->database();
        }

    // get final list
    public function finalList($tgl) {
        $this->db->select(array(  `FICMISDATE`,  `NOLOAN`,`NOMORCIF`,`NAMALENGKAP`,`KODECABANGBARU`,`NAMACABANG`,`JENISPIUTANGPEMBIAYAAN`,`SEKTOREKONOMICODE`,`TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`,`DIVISI`,`CURRENCY`,`LOANTYPE`,`LoanTypeDesc`,`CATEGORY`,`RESTRUCTFLAG`,`PRICING`,`REKPEMBYPOKOK`,`TENOR`,`RESTRUCTDATE`,`KOLBSM`,`KOLCIF`,`SOURCEDATACODE`,`OSPOKOKCONVERSION`,`OSMARGINCONVERSION`,`OSGROSSCONVERSION`,`TUNGGAKANPOKOKCONVERSION`,`TUNGGAKANMARGINCONVERSION`,`TUNGGAKANGROSSCONVERSION`,`PENCAIRANPOKOKCONVERSION`,`PENCAIRANMARGINCONVERSION`,`PENCAIRANGROSSCONVERSION`,`REALISASI_BAGIHASIL`,`PROYEKSI_BAGIHASIL`,`ACCOUNTOFFICER`,`EQVRATE`,`MISACCOUNTOFFICR`,`NAMAPERUSAHAANNASABAH`,`LD_ECONOMICSECTOR`,`TUNGGAKANPENALTYCONVERSION`,`NAPNO`,`STATUS_PENCAIRAN`,`Segmen`,`Produk`,`P/B`,`grup`,`AREA`,`KANWIL`,`E/C`,`sektor_ekon`,`Produk2`,`Tahun Booking`));
        $this->db->from('`existing'.$tgl.'`');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
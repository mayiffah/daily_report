<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('./application/spout/spout-2.7.3/src/Spout/Autoloader/autoload.php'); // don't forget to change the path!
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;



class Upload extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->database();
        $this->load->model('export_model');
        $this->load->model('import_model');
    }
    
    public function index()
    {
        $this->load->view('/upload_form', array(
            'error' => ' '
        ));
    }
    
    public function do_upload()
    {
        $config['upload_path']   = './application/uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 200000;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        //        $config['file_name']        = date("Y_m_d H:i:s");
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            
            $this->load->view('/upload_form', $error);
        } else {
            /*$data = array('upload_data'=>$this->upload->data('full_path'));*/
            $data = array(
                'upload_data' => $this->upload->data('full_path')
            );
            
            $file_name = $this->upload->data('full_path');
            $kemarin = date('Y-m-d-H:i:s',strtotime("-1 days"));
            $query = $this->db->query("RENAME TABLE existing TO `existing".$kemarin."`;");

            $query = $this->db->query("CREATE TABLE existing LIKE `existing".$kemarin."`;");

            //    $result = mysql_query("LOAD DATA INFILE '$data'"." INTO TABLE coba FIELDS TERMINATED BY '|'");
              $query = $this->db->query("LOAD DATA INFILE '$file_name'"." INTO TABLE existing FIELDS TERMINATED BY ',' IGNORE 1 LINES (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `JENISPENGGUNAANCODE`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM_SISTEM`, `KOLLOANFINAL`, `KOLCIFFINAL`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `INTEREST_RATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Kol_Lalu`, `Cek`, `Kol_Group`, `Mutasi`, `Limit`, `Nama_Perusahaan_Final`, `Nama_Perusahaan_Intiplasma`, `kol_group_bulan_lalu`, `Tahun_Booking`, `Modal_kerja_or_investasi`, `lebel_BI`, `desc_Sektor_ekon`, `Bulan_Jatuh_tempo`, `DIVISI_FINAL`)");

              $query = $this->db->query("DROP TRIGGER IF EXISTS rbh_dibagi_pbh");
              $query = $this->db->query("RENAME TABLE watchlist TO `watchlist".$kemarin."`;");

              $query = $this->db->query("CREATE TABLE watchlist LIKE `watchlist".$kemarin."`;");

              $query = $this->db->query("CREATE TRIGGER rbh_dibagi_pbh BEFORE INSERT ON watchlist FOR EACH ROW SET NEW.rbh_bagi_pbh = NEW.realisasi_bagi_hasil / NEW.proyeksi_bagi_hasil");
              $query = $this->db->query("INSERT INTO watchlist (`no_loan`, `no_cif`, `nama_lengkap`, `kode_cabang`, `nama_cabang`, `jenis_piutang_pembiayaan`, `tanggal_pencairan`, `tanggal_jatuh_tempo`, `day_past_due`, `restruct_date`, `kol_bsm`, `kol_cif`, `os_pokok_conversion`, `tung_pokok_conversion`, `tung_margin_conversion`, `tung_gross_conversion`, `realisasi_bagi_hasil`, `proyeksi_bagi_hasil`, `grup`) 
                SELECT `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`,`RESTRUCTDATE`, `KOLBSM_SISTEM`, `KOLCIFFINAL`, `OSPOKOKCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `grup` FROM existing
"); 
/*            $query = $this->db->query("call show_nasional()");
            $query = $this->db->query("call show_produk()");
            $query = $this->db->query("call show_sektor()");*/
            $this->load->view('/upload_success', $data);
        }
    }

    public function do_upload_akhir_bulan()
    {
        $config['upload_path']   = './application/uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 200000;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        //        $config['file_name']        = date("Y_m_d H:i:s");
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            
            $this->load->view('/upload_form', $error);
        } else {
            /*$data = array('upload_data'=>$this->upload->data('full_path'));*/
            $data = array(
                'upload_data' => $this->upload->data('full_path')
            );
            
            $file_name = $this->upload->data('full_path');
            $kemarin = date('Y-m-d-H:i:s',strtotime("-1 days"));
            $query = $this->db->query("RENAME TABLE existing TO `existing".$kemarin."`;");

            $query = $this->db->query("CREATE TABLE existing LIKE `existing".$kemarin."`;");

            //    $result = mysql_query("LOAD DATA INFILE '$data'"." INTO TABLE coba FIELDS TERMINATED BY '|'");
              $query = $this->db->query("LOAD DATA INFILE '$file_name'"." INTO TABLE existing FIELDS TERMINATED BY ',' IGNORE 1 LINES (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `JENISPENGGUNAANCODE`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM_SISTEM`, `KOLLOANFINAL`, `KOLCIFFINAL`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `INTEREST_RATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Kol_Lalu`, `Cek`, `Kol_Group`, `Mutasi`, `Limit`, `Nama_Perusahaan_Final`, `Nama_Perusahaan_Intiplasma`, `kol_group_bulan_lalu`, `Tahun_Booking`, `Modal_kerja_or_investasi`, `lebel_BI`, `desc_Sektor_ekon`, `Bulan_Jatuh_tempo`, `DIVISI_FINAL`)");

              $query = $this->db->query("DROP TRIGGER IF EXISTS rbh_dibagi_pbh");
              $query = $this->db->query("RENAME TABLE watchlist TO `watchlist".$kemarin."`;");

              $query = $this->db->query("CREATE TABLE watchlist LIKE `watchlist".$kemarin."`;");

              $query = $this->db->query("CREATE TRIGGER rbh_dibagi_pbh BEFORE INSERT ON watchlist FOR EACH ROW SET NEW.rbh_bagi_pbh = NEW.realisasi_bagi_hasil / NEW.proyeksi_bagi_hasil");
              $query = $this->db->query("INSERT INTO watchlist (`no_loan`, `no_cif`, `nama_lengkap`, `kode_cabang`, `nama_cabang`, `jenis_piutang_pembiayaan`, `tanggal_pencairan`, `tanggal_jatuh_tempo`, `day_past_due`, `restruct_date`, `kol_bsm`, `kol_cif`, `os_pokok_conversion`, `tung_pokok_conversion`, `tung_margin_conversion`, `tung_gross_conversion`, `realisasi_bagi_hasil`, `proyeksi_bagi_hasil`, `grup`) 
                SELECT `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`,`RESTRUCTDATE`, `KOLBSM_SISTEM`, `KOLCIFFINAL`, `OSPOKOKCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `grup` FROM existing
"); 
              $query = $this->db->query("RENAME TABLE existing_akhir_bulan TO `existing_akhir_bulan".$kemarin."`;");
              $query = $this->db->query("CREATE TABLE existing_akhir_bulan LIKE `existing_akhir_bulan".$kemarin."`;");
              $query = $this->db->query("LOAD DATA INFILE '$file_name'"." INTO TABLE existing_akhir_bulan FIELDS TERMINATED BY ',' IGNORE 1 LINES (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `JENISPENGGUNAANCODE`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM_SISTEM`, `KOLLOANFINAL`, `KOLCIFFINAL`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `INTEREST_RATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Kol_Lalu`, `Cek`, `Kol_Group`, `Mutasi`, `Limit`, `Nama_Perusahaan_Final`, `Nama_Perusahaan_Intiplasma`, `kol_group_bulan_lalu`, `Tahun_Booking`, `Modal_kerja_or_investasi`, `lebel_BI`, `desc_Sektor_ekon`, `Bulan_Jatuh_tempo`, `DIVISI_FINAL`)");


              /*$query = $this->db->query("call show_nasional()");
              $query = $this->db->query("call show_produk()");
              $query = $this->db->query("call show_sektor()");
              */
            $this->load->view('/upload_success', $data);
        }
    }

    public function tes() {
      $this->load->view('/upload_success');
    }

    public function do_upload_akhir_bulan_coba()
    {
        $config['upload_path']   = './application/uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 200000;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        //        $config['file_name']        = date("Y_m_d H:i:s");
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('userfile')) {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            
            $this->load->view('/upload_form', $error);
        } else {
            /*$data = array('upload_data'=>$this->upload->data('full_path'));*/
            $data = array(
                'upload_data' => $this->upload->data('full_path')
            );
            
            $file_name = $this->upload->data('full_path');
            $kemarin = date('Y-m-d-H:i:s',strtotime("-1 days"));

            //    $result = mysql_query("LOAD DATA INFILE '$data'"." INTO TABLE coba FIELDS TERMINATED BY '|'");
              $query = $this->db->query("LOAD DATA INFILE '$file_name'"." INTO TABLE `existing_akhir_bulan_jul2018` FIELDS TERMINATED BY ',' IGNORE 1 LINES (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `JENISPENGGUNAANCODE`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM_SISTEM`, `KOLLOANFINAL`, `KOLCIFFINAL`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `INTEREST_RATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Kol_Lalu`, `Cek`, `Kol_Group`, `Mutasi`, `Limit`, `Nama_Perusahaan_Final`, `Nama_Perusahaan_Intiplasma`, `kol_group_bulan_lalu`, `Tahun_Booking`, `Modal_kerja_or_investasi`, `lebel_BI`, `desc_Sektor_ekon`, `Bulan_Jatuh_tempo`, `DIVISI_FINAL`)");

              
              /*$query = $this->db->query("call show_nasional()");
              $query = $this->db->query("call show_produk()");
              $query = $this->db->query("call show_sektor()");
              */
            $this->load->view('/upload_success', $data);
        }
    }
    
    
}
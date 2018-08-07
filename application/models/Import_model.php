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

    public function importData($tgl) {

        $data = $this->_batchImport;
  
        // echo '<script>console.log(\'' . implode('-',$data) . '\')</script>';
//        $tgl = '_excel';
//        $mod_date=date("Y-m-d-H:i:s", filemtime($upload_data));
   //     $query = $this->db->query("CREATE TABLE `ifois_excel".$tgl."` LIKE ifois_excel");
        $kemarin = date('Y-m-d-H:i:s',strtotime("-1 days"));
        //MASUKKIN IFOIS EXCEL
   /*     $this->db->insert_batch("ifois_excel".$tgl, $data);*/
        $this->db->insert_batch("data_all", $data, 0, 1000);
        

/*
        $query = $this->db->query("ALTER TABLE `ifois".$tgl."` ADD KEY `NOLOAN` (`NOLOAN`), ADD KEY `LOANTYPE` (`LOANTYPE`), ADD KEY `KODECABANGBARU` (`KODECABANGBARU`), ADD KEY `TGLPENCAIRAN` (`TGLPENCAIRAN`), ADD KEY `DIVISI` (`DIVISI`)");

        $query = $this->db->query("RENAME TABLE existing TO `existing".$kemarin."`;");

        $query = $this->db->query("CREATE TABLE existing LIKE `existing".$kemarin."`;");


        $query = $this->db->query("INSERT into existing  (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`) SELECT a.FICMISDATE, a.NOLOAN, a.NOMORCIF, a.NAMALENGKAP, a.KODECABANGBARU, a.NAMACABANG,a.JENISPIUTANGPEMBIAYAAN, a.SEKTOREKONOMICODE
, a.TGLPENCAIRAN, a.TGLJTTEMPO, a.DAYPASTDUE, a.DIVISI, a.CURRENCY, a.LOANTYPE, c.LoanTypeDesc, a.CATEGORY, a.RESTRUCTFLAG, a.PRICING
, a.REKPEMBYPOKOK, a.TENOR, a.RESTRUCTDATE, a.KOLBSM_SISTEM, a.KOLCIFFINAL, a.SOURCEDATACODE, a.OSPOKOKCONVERSION, a.OSMARGINCONVERSION
, a.OSGROSSCONVERSION, a.TUNGGAKANPOKOKCONVERSION, a.TUNGGAKANMARGINCONVERSION, a.TUNGGAKANGROSSCONVERSION
, a.PENCAIRANPOKOKCONVERSION, a.PENCAIRANMARGINCONVERSION, a.PENCAIRANGROSSCONVERSION, a.REALISASI_BAGIHASIL
, a.PROYEKSI_BAGIHASIL, a.ACCOUNTOFFICER, a.EQVRATE,  a.MISACCOUNTOFFICR, a.NAMAPERUSAHAANNASABAH
, a.LD_ECONOMICSECTOR, a.TUNGGAKANPENALTYCONVERSION, a.NAPNO , b.Segmen, b.Produk, b.`P/B`, b.grup 
, d.AREA, d.KANWIL, b.`E/C`, b.sektor_ekon, b.Produk2, b.`Tahun Booking`
FROM `ifois_excel_akhir_juni` a
left outer join lalu b on a.NOLOAN = b.NoLoan
left outer join Loantype2017 c on a.LOANTYPE = c.LoanType
left outer join cabang2017new d on a.KODECABANGBARU = d.outletcode
where b.NoLoan is not null"); 


        $query = $this->db->query("INSERT into cair_baru (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`,  `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`)
        SELECT a.FICMISDATE, a.NOLOAN, a.NOMORCIF, a.NAMALENGKAP, a.KODECABANGBARU, a.NAMACABANG, a.JENISPIUTANGPEMBIAYAAN, a.SEKTOREKONOMICODE
        , a.TGLPENCAIRAN, a.TGLJTTEMPO, a.DAYPASTDUE, a.DIVISI, a.CURRENCY, a.LOANTYPE, c.LoanTypeDesc, a.CATEGORY, a.RESTRUCTFLAG, a.PRICING
        , a.REKPEMBYPOKOK, a.TENOR, a.RESTRUCTDATE, a.KOLBSM_SISTEM, a.KOLCIFFINAL, a.SOURCEDATACODE, a.OSPOKOKCONVERSION, a.OSMARGINCONVERSION
        , a.OSGROSSCONVERSION, a.TUNGGAKANPOKOKCONVERSION, a.TUNGGAKANMARGINCONVERSION, a.TUNGGAKANGROSSCONVERSION
        , a.PENCAIRANPOKOKCONVERSION, a.PENCAIRANMARGINCONVERSION, a.PENCAIRANGROSSCONVERSION, a.REALISASI_BAGIHASIL
        , a.PROYEKSI_BAGIHASIL, a.ACCOUNTOFFICER, a.EQVRATE, a.MISACCOUNTOFFICR, a.NAMAPERUSAHAANNASABAH
        , a.LD_ECONOMICSECTOR, a.TUNGGAKANPENALTYCONVERSION, a.NAPNO, b.Segmen, b.Produk, b.`P/B`, b.grup 
        , d.AREA, d.KANWIL, b.`E/C`, b.sektor_ekon, b.Produk2, b.`Tahun Booking`
        FROM `ifois_excel_akhir_juni` a
        left outer join lalu b on a.NOLOAN = b.NoLoan
        left outer join Loantype2017 c on a.LOANTYPE = c.LoanType
        left outer join cabang2017new d on a.KODECABANGBARU = d.outletcode
        where (a.TGLPENCAIRAN between '2018-06-31' and '2018-06-31') and  a.DIVISI in ('BBG')");

        $query = $this->db->query(" INSERT into div_code (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`)
SELECT a.FICMISDATE, a.NOLOAN, a.NOMORCIF, a.NAMALENGKAP, a.KODECABANGBARU, a.NAMACABANG, a.JENISPIUTANGPEMBIAYAAN, a.SEKTOREKONOMICODE
, a.TGLPENCAIRAN, a.TGLJTTEMPO, a.DAYPASTDUE, a.DIVISI, a.CURRENCY, a.LOANTYPE, c.`LoanTypeDesc`, a.CATEGORY, a.RESTRUCTFLAG, a.PRICING
, a.REKPEMBYPOKOK, a.TENOR, a.RESTRUCTDATE, a.KOLBSM_SISTEM, a.KOLCIFFINAL, a.SOURCEDATACODE, a.OSPOKOKCONVERSION, a.OSMARGINCONVERSION
, a.OSGROSSCONVERSION, a.TUNGGAKANPOKOKCONVERSION, a.TUNGGAKANMARGINCONVERSION, a.TUNGGAKANGROSSCONVERSION
, a.PENCAIRANPOKOKCONVERSION, a.PENCAIRANMARGINCONVERSION, a.PENCAIRANGROSSCONVERSION, a.REALISASI_BAGIHASIL
, a.PROYEKSI_BAGIHASIL, a.ACCOUNTOFFICER, a.EQVRATE, a.MISACCOUNTOFFICR, a.NAMAPERUSAHAANNASABAH
, a.LD_ECONOMICSECTOR, a.TUNGGAKANPENALTYCONVERSION, a.NAPNO,  b.Segmen, b.Produk,b.`P/B`,b. `grup` 
, d.AREA, d.KANWIL, b.`E/C`, b.sektor_ekon, b.Produk2, b.`Tahun Booking`
FROM `ifois_excel_akhir_juni` a
left outer join lalu b on a.NOLOAN = b.NoLoan
left outer join Loantype2017 c on a.LOANTYPE = c.LoanType
left outer join cabang2017new d on a.KODECABANGBARU = d.outletcode
where a.DIVISI in ('BBG')");

        $query = $this->db->query("INSERT INTO existing2 (SELECT * FROM div_code d WHERE NOT EXISTS (SELECT * FROM existing e WHERE d.NOMORCIF = e.NOMORCIF))");

        $query = $this->db->query("INSERT INTO existing (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STATUS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`)
 SELECT `FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STATUS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`
 FROM existing2");

         $query = $this->db->query("TRUNCATE existing2");
         $query = $this->db->query("TRUNCATE lalu");
         $query = $this->db->query("TRUNCATE div_code");





         
        */


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
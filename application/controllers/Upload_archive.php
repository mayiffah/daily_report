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
SELECT `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`,`RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `OSPOKOKCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `grup` FROM existing
"); 
            $this->load->view('/upload_success', $data);
        }
    }
    
    // create xlsx
    public function createXLS()
    {
        // create file name
        //  $tgl = $this->uri->segment(3); 
        $fileName = 'D:\data_final' . time() . '.xlsx';
        // load excel library
        $this->load->library('excel');
        $empInfo     = $this->export_model->finalList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['FICMISDATE']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['NOLOAN']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['NOMORCIF']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['NAMALENGKAP']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['KODECABANGBARU']);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        // header("Content-Type: application/vnd.ms-excel");
        
        // We'll be outputting a PDF
        header('Content-Type: application/xlsx');
        
        // It will be called downloaded.pdf
        header('Content-Disposition: attachment; filename="data_final"' . time() . '".xlsx"');
        
        // The PDF source is in original.pdf
        readfile('D:\data_final' . time() . '.xlsx');
        redirect("HTTP_UPLOAD_IMPORT_PATH" . $fileName, "refresh");
    }

    // read excel file with spout
    public function save_spout()
    {
        /*
        $path = './application/uploads/';
            
        $config['upload_path']   = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = TRUE;
        $config['max_size']      = 200000;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;

        $this->load->library('upload', $config);

        $full_path = $this->upload->data('full_path');
        */

        $full_path = './application/uploads/data_all4.xlsx';
       

        $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        //$reader = ReaderFactory::create(Type::CSV); // for CSV files
        //$reader = ReaderFactory::create(Type::ODS); // for ODS files

        $reader->open($full_path);
        $array_input   = array();
        $count = 1;
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                // do stuff with the row
               /* if ($count != 1) {
                    $coba = $row[3]; 
                    $array_input[] = array(
                      'FICMISDATE' => $row[0],  
                      'NOLOAN' => $row[1],  
                      'NOMORCIF' => $row[2],  
                      'NAMALENGKAP' => $row[3],  
                      'KODECABANGBARU' => $row[4],  
                      'NAMACABANG' => $row[5],  
                      'JENISPIUTANGPEMBIAYAAN' => $row[6],  
                      'JENISPENGGUNAANCODE' => $row[7],  
                      'SEKTOREKONOMICODE' => $row[8],  
                      'TGLPENCAIRAN' => $row[9],  
                      'TGLJTTEMPO' => $row[10],  
                      'DAYPASTDUE' => $row[11],  
                      'DIVISI' => $row[12],  
                      'CURRENCY' => $row[13],  
                      'LOANTYPE' => $row[14],  
                      'LoanTypeDesc' => $row[15],  
                      'CATEGORY' => $row[16],  
                      'RESTRUCTFLAG' => $row[17],  
                      'PRICING' => $row[18],  
                      'REKPEMBYPOKOK' => $row[19],  
                      'TENOR' => $row[20],  
                      'RESTRUCTDATE' => $row[21],  
                      'KOLBSM_SISTEM' => $row[22],  
                      'KOLLOANFINAL' => $row[23],  
                      'KOLCIFFINAL' => $row[24],  
                      'SOURCEDATACODE' => $row[25],  
                      'OSPOKOKCONVERSION' => $row[26], 
                      'OSMARGINCONVERSION' => $row[27],
                      'OSGROSSCONVERSION' => $row[28],
                      'TUNGGAKANPOKOKCONVERSION' => $row[29],
                      'TUNGGAKANMARGINCONVERSION' => $row[30],
                      'TUNGGAKANGROSSCONVERSION' => $row[31],
                      'PENCAIRANPOKOKCONVERSION' => $row[32],  
                      'PENCAIRANMARGINCONVERSION' => $row[33],  
                      'PENCAIRANGROSSCONVERSION' => $row[34],  
                      'REALISASI_BAGIHASIL' => $row[35],  
                      'PROYEKSI_BAGIHASIL' => $row[36],  
                      'ACCOUNTOFFICER' => $row[37],  
                      'EQVRATE' => $row[38],  
                      'INTEREST_RATE' => $row[39],  
                      'MISACCOUNTOFFICR' => $row[40],  
                      'NAMAPERUSAHAANNASABAH' => $row[41],  
                      'LD_ECONOMICSECTOR' => $row[42],  
                      'TUNGGAKANPENALTYCONVERSION' => $row[43],  
                      'NAPNO' => $row[44],  
                      'STS_PENCAIRAN' => $row[45],  
                      'Segmen' => $row[46],
                      'Produk' => $row[47],  
                      'P/B' => $row[48],
                      'grup' => $row[49],   
                      'AREA' => $row[50],  
                      'KANWIL' => $row[51],  
                      'E/C' => $row[52],  
                      'sektor_ekon' => $row[53],  
                      'Produk2' => $row[54],  
                      'Kol_Lalu' => $row[55],  
                      'Cek' => $row[56],  
                      'Kol_Group' => $row[57],  
                      'Mutasi' => $row[58],  
                      'Limit' => $row[59],  
                      'Nama_Perusahaan_Final' => $row[60],  
                      'Nama_Perusahaan_Intiplasma' => $row[61],  
                      'kol_group_bulan_lalu' => $row[62],  
                      'Tahun_Booking' => $row[63],  
                      'Modal_kerja_or_investasi' => $row[64],  
                      'lebel_BI' => $row[65],  
                      'desc_Sektor_ekon' => $row[66],  
                      'Bulan_Jatuh_tempo' => $row[67],  
                      'DIVISI_FINAL' => $row[68]  
                    );
                } else {

                } */
                
                $count++;
            }
        }

        $reader->close();
        $data['jumlah'] = $count;
        $data['coba'] = $coba;

      //  $data['arr']           = $array_input;
      //  $this->import_model->setBatchImport($array_input);
      //  $this->import_model->importData("2018-07-31");
        $this->load->view('/upload_success_excel_spout', $data);


    }
    
    
    // import excel data
    public function save()
    {
        $this->load->library('excel');
        
        if ($this->input->post('importfile')) {
            
            $path = './application/uploads/';
            
            $config['upload_path']   = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $config['max_size']      = 200000;
            $config['max_width']     = 1024;
            $config['max_height']    = 768;
            // $this->initialize($config);
            $this->load->library('upload', $config);
            $full_path = $this->upload->data('full_path');
            $mod_date = date("Y-m-d-H:i:s", filemtime($full_path));

            if (!$this->upload->do_upload('userfile')) {
                $error = array(
                    'error' => $this->upload->display_errors()
                );
            } else {
                $data = array(
                    'upload_data' => $this->upload->data()
                );
            }
            
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;

            echo '<script>console.log(\'' . $inputFileName . '\')</script>';

            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel   = $objReader->load($inputFileName);

                echo '<script>console.log(\'' . $inputFileType . '\')</script>';
            }
            catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }
            
            $object = PHPExcel_IOFactory::load($inputFileName);
            // $count = 0;
            // $masukmana = 'tes';
            foreach ($object->getWorksheetIterator() as $worksheet) {

                echo '<script>console.log(\'====WORKSHEET=====\')</script>';
                // echo '<script>console.log(\'' . $worksheet->getHighestColumn() . '\')</script>';
                $masukmana     = $worksheet->calculateWorksheetDimension();
                $highestRow    = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $array_input   = array();
                for ($row = 2; $row <= $highestRow; $row++) {
                    // $masukmana = $highestColumn;
                 //   echo '<script>console.log(\'====ROW ' . $row . '=====\')</script>';
                    $FICMISDATE                 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $NOLOAN                     = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $NOMORCIF                   = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $NAMALENGKAP                = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $KODECABANGBARU             = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $NAMACABANG                 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $JENISPIUTANGPEMBIAYAAN     = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $JENISPENGGUNAANCODE        = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $SEKTOREKONOMICODE          = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $TGLPENCAIRAN               = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $TGLJTTEMPO                 = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $DAYPASTDUE                 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $DIVISI                     = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $DIVISI_PISAH               = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $DIVISI_FINAL               = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $CURRENCY                   = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $LOANTYPE                   = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $CATEGORY                   = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $RESTRUCTFLAG               = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $PRICING                    = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $REKPEMBYPOKOK              = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $TENOR                      = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    $RESTRUCTDATE               = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                    $KOLBSM_SISTEM              = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                    $KOLLOANFINAL               = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                    $KOLCIFFINAL                = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                    $SOURCEDATACODE             = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                    $OSPOKOKCONVERSION          = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                    $OSMARGINCONVERSION         = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                    $OSGROSSCONVERSION          = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                    $TUNGGAKANPOKOKCONVERSION   = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                    $TUNGGAKANMARGINCONVERSION  = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                    $TUNGGAKANGROSSCONVERSION   = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                    $PENCAIRANPOKOKCONVERSION   = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                    $PENCAIRANMARGINCONVERSION  = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                    $PENCAIRANGROSSCONVERSION   = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                    $REALISASI_BAGIHASIL        = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                    $PROYEKSI_BAGIHASIL         = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                    $ACCOUNTOFFICER             = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                    $EQVRATE                    = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                    $INTEREST_RATE              = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                    $MISACCOUNTOFFICR           = $worksheet->getCellByColumnAndRow(41, $row)->getValue();
                    $NAMAPERUSAHAANNASABAH      = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                    $LD_ECONOMICSECTOR          = $worksheet->getCellByColumnAndRow(43, $row)->getValue();
                    $TUNGGAKANPENALTYCONVERSION = $worksheet->getCellByColumnAndRow(44, $row)->getValue();
                    $NAPNO                      = $worksheet->getCellByColumnAndRow(45, $row)->getValue();
                    $Kol                        = $worksheet->getCellByColumnAndRow(46, $row)->getValue();
                    // echo '<script>console.log(\'' . $Kol . '\')</script>';
                    // echo '<script>console.log(\'' . $FICMISDATE                 . '\')</script>' ;
                    // echo '<script>console.log(\'' . $NOLOAN                     . '\')</script>' ;
                    // echo '<script>console.log(\'' . $NOMORCIF                   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $NAMALENGKAP                . '\')</script>' ;
                    // echo '<script>console.log(\'' . $KODECABANGBARU             . '\')</script>' ;
                    // echo '<script>console.log(\'' . $NAMACABANG                 . '\')</script>' ;
                    // echo '<script>console.log(\'' . $JENISPIUTANGPEMBIAYAAN     . '\')</script>' ;
                    // echo '<script>console.log(\'' . $JENISPENGGUNAANCODE        . '\')</script>' ;
                    // echo '<script>console.log(\'' . $SEKTOREKONOMICODE          . '\')</script>' ;
                    // echo '<script>console.log(\'' . $TGLPENCAIRAN               . '\')</script>' ;
                    // echo '<script>console.log(\'' . $TGLJTTEMPO                 . '\')</script>' ;
                    // echo '<script>console.log(\'' . $DAYPASTDUE                 . '\')</script>' ;
                    // echo '<script>console.log(\'' . $DIVISI                     . '\')</script>' ;
                    // echo '<script>console.log(\'' . $DIVISI_PISAH               . '\')</script>' ;
                    // echo '<script>console.log(\'' . $DIVISI_FINAL               . '\')</script>' ;
                    // echo '<script>console.log(\'' . $CURRENCY                   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $LOANTYPE                   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $CATEGORY                   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $RESTRUCTFLAG               . '\')</script>' ;
                    // echo '<script>console.log(\'' . $PRICING                    . '\')</script>' ;
                    // echo '<script>console.log(\'' . $REKPEMBYPOKOK              . '\')</script>' ;
                    // echo '<script>console.log(\'' . $TENOR                      . '\')</script>' ;
                    // echo '<script>console.log(\'' . $RESTRUCTDATE               . '\')</script>' ;
                    // echo '<script>console.log(\'' . $KOLBSM_SISTEM              . '\')</script>' ;
                    // echo '<script>console.log(\'' . $KOLLOANFINAL               . '\')</script>' ;
                    // echo '<script>console.log(\'' . $KOLCIFFINAL                . '\')</script>' ;
                    // echo '<script>console.log(\'' . $SOURCEDATACODE             . '\')</script>' ;
                    // echo '<script>console.log(\'' . $OSPOKOKCONVERSION          . '\')</script>' ;
                    // echo '<script>console.log(\'' . $OSMARGINCONVERSION         . '\')</script>' ;
                    // echo '<script>console.log(\'' . $OSGROSSCONVERSION          . '\')</script>' ;
                    // echo '<script>console.log(\'' . $TUNGGAKANPOKOKCONVERSION   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $TUNGGAKANMARGINCONVERSION  . '\')</script>' ;
                    // echo '<script>console.log(\'' . $TUNGGAKANGROSSCONVERSION   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $PENCAIRANPOKOKCONVERSION   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $PENCAIRANMARGINCONVERSION  . '\')</script>' ;
                    // echo '<script>console.log(\'' . $PENCAIRANGROSSCONVERSION   . '\')</script>' ;
                    // echo '<script>console.log(\'' . $REALISASI_BAGIHASIL        . '\')</script>' ;
                    // echo '<script>console.log(\'' . $PROYEKSI_BAGIHASIL         . '\')</script>' ;
                    // echo '<script>console.log(\'' . $ACCOUNTOFFICER             . '\')</script>' ;
                    // echo '<script>console.log(\'' . $EQVRATE                    . '\')</script>' ;
                    // echo '<script>console.log(\'' . $INTEREST_RATE              . '\')</script>' ;
                    // echo '<script>console.log(\'' . $MISACCOUNTOFFICR           . '\')</script>' ;
                    // echo '<script>console.log(\'' . $NAMAPERUSAHAANNASABAH      . '\')</script>' ;
                    // echo '<script>console.log(\'' . $LD_ECONOMICSECTOR          . '\')</script>' ;
                    // echo '<script>console.log(\'' . $TUNGGAKANPENALTYCONVERSION . '\')</script>' ;
                    // echo '<script>console.log(\'' . $NAPNO                      . '\')</script>' ;
                    // echo '<script>console.log(\'' . $Kol                        . '\')</script>' ;
                    
                    $array_input[] = array(
                        'FICMISDATE' => $FICMISDATE,
                        'NOLOAN' => $NOLOAN,
                        'NOMORCIF' => $NOMORCIF,
                        'NAMALENGKAP' => $NAMALENGKAP,
                        'KODECABANGBARU' => $KODECABANGBARU,
                        'NAMACABANG' => $NAMACABANG,
                        'JENISPIUTANGPEMBIAYAAN' => $JENISPIUTANGPEMBIAYAAN,
                        'JENISPENGGUNAANCODE' => $JENISPENGGUNAANCODE,
                        'SEKTOREKONOMICODE' => $SEKTOREKONOMICODE,
                        'TGLPENCAIRAN' => $TGLPENCAIRAN,
                        'TGLJTTEMPO' => $TGLJTTEMPO,
                        'DAYPASTDUE' => $DAYPASTDUE,
                        'DIVISI' => $DIVISI,
                        'DIVISI_PISAH' => $DIVISI_PISAH,
                        'DIVISI_FINAL' => $DIVISI_FINAL,
                        'CURRENCY' => $CURRENCY,
                        'LOANTYPE' => $LOANTYPE,
                        'CATEGORY' => $CATEGORY,
                        'RESTRUCTFLAG' => $RESTRUCTFLAG,
                        'PRICING' => $PRICING,
                        'REKPEMBYPOKOK' => $REKPEMBYPOKOK,
                        'TENOR' => $TENOR,
                        'RESTRUCTDATE' => $RESTRUCTDATE,
                        'KOLBSM_SISTEM' => $KOLBSM_SISTEM,
                        'KOLLOANFINAL' => $KOLLOANFINAL,
                        'KOLCIFFINAL' => $KOLCIFFINAL,
                        'SOURCEDATACODE' => $SOURCEDATACODE,
                        'OSPOKOKCONVERSION' => $OSPOKOKCONVERSION,
                        'OSMARGINCONVERSION' => $OSMARGINCONVERSION,
                        'OSGROSSCONVERSION' => $OSGROSSCONVERSION,
                        'TUNGGAKANPOKOKCONVERSION' => $TUNGGAKANPOKOKCONVERSION,
                        'TUNGGAKANMARGINCONVERSION' => $TUNGGAKANMARGINCONVERSION,
                        'TUNGGAKANGROSSCONVERSION' => $TUNGGAKANGROSSCONVERSION,
                        'PENCAIRANPOKOKCONVERSION' => $PENCAIRANPOKOKCONVERSION,
                        'PENCAIRANMARGINCONVERSION' => $PENCAIRANMARGINCONVERSION,
                        'PENCAIRANGROSSCONVERSION' => $PENCAIRANGROSSCONVERSION,
                        'REALISASI_BAGIHASIL' => $REALISASI_BAGIHASIL,
                        'PROYEKSI_BAGIHASIL' => $PROYEKSI_BAGIHASIL,
                        'ACCOUNTOFFICER' => $ACCOUNTOFFICER,
                        'EQVRATE' => $EQVRATE,
                        'INTEREST_RATE' => $INTEREST_RATE,
                        'MISACCOUNTOFFICR' => $MISACCOUNTOFFICR,
                        'NAMAPERUSAHAANNASABAH' => $NAMAPERUSAHAANNASABAH,
                        'LD_ECONOMICSECTOR' => $LD_ECONOMICSECTOR,
                        'TUNGGAKANPENALTYCONVERSION' => $TUNGGAKANPENALTYCONVERSION,
                        'NAPNO' => $NAPNO,
                        'Kol_CIF_BulanLalu' => $Kol
                    );
                    //  $count++;
                }
            
                $data['arr']           = $array_input;
                // echo '<script>console.log(\'' . $array_input . '\')</script>';
                $data['highestrow']    = $highestRow;
                $data['inputFileName'] = $inputFileName;
                $data['masukmana']     = $masukmana;
                
                if ($highestRow > 2) {
                  $this->load->view('/upload_success_excel', $data);
                  $this->import_model->setBatchImport($array_input);
                  $this->import_model->importData($mod_date);
                }
            }
            
            // $data['arr']           = $array_input;
            // echo '<script>console.log(\'' . implode('-', $array_input) . '\')</script>';
            // $data['highestrow']    = $highestRow;
            // $data['inputFileName'] = $inputFileName;
            // $data['masukmana']     = $masukmana;
            // $this->load->view('/upload_success_excel', $data);
            //    $this->import_model->setBatchImport($array_input);
            //   $this->import_model->importData($array_input);
        }
        
        
    }
    
}
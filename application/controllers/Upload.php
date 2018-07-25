<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->database();
                $this->load->model('export_model');
                $this->load->model('import_model');
        }

        public function index()
        {
                $this->load->view('/upload_form', array('error'=>' '));
        }

        public function do_upload()
        {
                $config['upload_path']          = './application/uploads/';
                $config['allowed_types']        = 'txt';
                $config['max_size']             = 200000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
        //        $config['file_name']        = date("Y_m_d H:i:s");

                $this->load->library('upload', $config);

                if ( !$this->upload->do_upload('userfile'))
                {
                        $error = array('error'=>$this->upload->display_errors());

                        $this->load->view('/upload_form', $error);
                }
                else
                {
                        /*$data = array('upload_data'=>$this->upload->data('full_path'));*/
                        $data = array('upload_data'=>$this->upload->data('full_path'));
                        
                    //    $result = mysql_query("LOAD DATA INFILE '$data'"." INTO TABLE coba FIELDS TERMINATED BY '|'");
                      //  $result = mysql_query("LOAD DATA INFILE '$data'"." INTO TABLE coba FIELDS TERMINATED BY '|' IGNORE 1 LINES");
                        $this->load->view('/upload_success', $data);
                } 
        }

        // create xlsx
        public function createXLS() 
        {
            // create file name
          //  $tgl = $this->uri->segment(3); 
            $fileName = 'D:\data_final'.time().'.xlsx'; 
            // load excel library
            $this->load->library('excel');
            $empInfo = $this->export_model->finalList();
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
            header('Content-Disposition: attachment; filename="data_final"'.time().'".xlsx"' );

            // The PDF source is in original.pdf
            readfile('D:\data_final'.time().'.xlsx');
            redirect("HTTP_UPLOAD_IMPORT_PATH".$fileName, "refresh");
        }


            // import excel data
        public function save() 
        {
            $this->load->library('excel');
            
            if ($this->input->post('importfile')) {
                
                $path = './application/uploads/';
     
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls';
                $config['remove_spaces'] = TRUE;
                $config['max_size']      = 200000;
                $config['max_width']     = 1024;
                $config['max_height']    = 768;
               // $this->initialize($config);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' . $e->getMessage());
                }

                $object = PHPExcel_IOFactory::load($inputFileName);
               // $count = 0;
                $masukmana = 'tes';
                foreach($object->getWorksheetIterator() as $worksheet)
               {
                $masukmana = 'foreach';
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $array_input = array();
                for($row=2; $row<=$highestRow; $row++)
                {
                  $masukmana = 'for';
                $FICMISDATE = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $NOLOAN = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $NOMORCIF = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $NAMALENGKAP = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $KODECABANGBARU = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $NAMACABANG = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $JENISPIUTANGPEMBIAYAAN = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $JENISPENGGUNAANCODE  = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $SEKTOREKONOMICODE  = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $TGLPENCAIRAN = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                $TGLJTTEMPO = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                $DAYPASTDUE = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                $DIVISI   = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                $DIVISI_PISAH   = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                $DIVISI_FINAL   = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                $CURRENCY   = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                $LOANTYPE   = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                $CATEGORY   = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                $RESTRUCTFLAG   = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                $PRICING  = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                $REKPEMBYPOKOK  = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                $TENOR  = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                $RESTRUCTDATE = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                $KOLBSM_SISTEM    = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                $KOLLOANFINAL   = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                $KOLCIFFINAL    = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                $SOURCEDATACODE   = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                $OSPOKOKCONVERSION  = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                $OSMARGINCONVERSION   = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                $OSGROSSCONVERSION  = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                $TUNGGAKANPOKOKCONVERSION = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                $TUNGGAKANMARGINCONVERSION  = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                $TUNGGAKANGROSSCONVERSION = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                $PENCAIRANPOKOKCONVERSION   = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                $PENCAIRANMARGINCONVERSION  = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                $PENCAIRANGROSSCONVERSION   = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                $REALISASI_BAGIHASIL  = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                $PROYEKSI_BAGIHASIL = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                $ACCOUNTOFFICER   = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                $EQVRATE  = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                $INTEREST_RATE  = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                $MISACCOUNTOFFICR   = $worksheet->getCellByColumnAndRow(41, $row)->getValue();
                $NAMAPERUSAHAANNASABAH  = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                $LD_ECONOMICSECTOR  = $worksheet->getCellByColumnAndRow(43, $row)->getValue();
                $TUNGGAKANPENALTYCONVERSION   = $worksheet->getCellByColumnAndRow(44, $row)->getValue();
                $NAPNO  = $worksheet->getCellByColumnAndRow(45, $row)->getValue();
                $Kol  = $worksheet->getCellByColumnAndRow(46, $row)->getValue();

                 $array_input[] =array(
                  'FICMISDATE'  => $FICMISDATE,
                  'NOLOAN'   => $NOLOAN,
                  'NOMORCIF'    => $NOMORCIF,
                  'NAMALENGKAP'  => $NAMALENGKAP,
                  'KODECABANGBARU'   => $KODECABANGBARU,
                  'NAMACABANG'=> $NAMACABANG,
                  'JENISPIUTANGPEMBIAYAAN'=> $JENISPIUTANGPEMBIAYAAN,
                  'JENISPENGGUNAANCODE' => $JENISPENGGUNAANCODE,
                  'SEKTOREKONOMICODE' => $SEKTOREKONOMICODE, 
                  'TGLPENCAIRAN'=> $TGLPENCAIRAN,
                  'TGLJTTEMPO'=> $TGLJTTEMPO,
                  'DAYPASTDUE'=> $DAYPASTDUE,
                  'DIVISI'  => $DIVISI ,
                  'DIVISI_PISAH'  => $DIVISI_PISAH, 
                  'DIVISI_FINAL'  => $DIVISI_FINAL,
                  'CURRENCY'  => $CURRENCY, 
                  'LOANTYPE'  => $LOANTYPE, 
                  'CATEGORY'  => $CATEGORY, 
                  'RESTRUCTFLAG'  => $RESTRUCTFLAG, 
                  'PRICING' => $PRICING, 
                  'REKPEMBYPOKOK' => $REKPEMBYPOKOK, 
                  'TENOR' => $TENOR, 
                  'RESTRUCTDATE'=> $RESTRUCTDATE,
                  'KOLBSM_SISTEM'   => $KOLBSM_SISTEM,  
                  'KOLLOANFINAL'  => $KOLLOANFINAL,  
                  'KOLCIFFINAL'   => $KOLCIFFINAL,  
                  'SOURCEDATACODE'  => $SOURCEDATACODE, 
                  'OSPOKOKCONVERSION' => $OSPOKOKCONVERSION,
                  'OSMARGINCONVERSION'  => $OSMARGINCONVERSION, 
                  'OSGROSSCONVERSION' => $OSGROSSCONVERSION, 
                  'TUNGGAKANPOKOKCONVERSION'=> $TUNGGAKANPOKOKCONVERSION,
                  'TUNGGAKANMARGINCONVERSION' => $TUNGGAKANMARGINCONVERSION,
                  'TUNGGAKANGROSSCONVERSION'=> $TUNGGAKANGROSSCONVERSION,
                  'PENCAIRANPOKOKCONVERSION'  => $PENCAIRANPOKOKCONVERSION, 
                  'PENCAIRANMARGINCONVERSION' => $PENCAIRANMARGINCONVERSION, 
                  'PENCAIRANGROSSCONVERSION'  => $PENCAIRANGROSSCONVERSION, 
                  'REALISASI_BAGIHASIL' => $REALISASI_BAGIHASIL,
                  'PROYEKSI_BAGIHASIL'=> $PROYEKSI_BAGIHASIL,
                  'ACCOUNTOFFICER'  => $ACCOUNTOFFICER, 
                  'EQVRATE' => $EQVRATE, 
                  'INTEREST_RATE' => $INTEREST_RATE, 
                  'MISACCOUNTOFFICR'  => $MISACCOUNTOFFICR, 
                  'NAMAPERUSAHAANNASABAH' => $NAMAPERUSAHAANNASABAH, 
                  'LD_ECONOMICSECTOR' => $LD_ECONOMICSECTOR, 
                  'TUNGGAKANPENALTYCONVERSION'  => $TUNGGAKANPENALTYCONVERSION, 
                  'NAPNO' => $NAPNO, 
                  'Kol CIF BulanLalu' => $Kol
                 );
               //  $count++;
                }
               }

                $data['arr'] = $array_input;
                $data['highestrow'] = $highestRow;
                $data['inputFileName'] = $inputFileName; 
                $data['masukmana'] = $highestColumn;
                $this->load->view('/upload_success_excel', $data);
            //    $this->import_model->setBatchImport($array_input);
             //   $this->import_model->importData($array_input);
            }
            
            
        } 

}

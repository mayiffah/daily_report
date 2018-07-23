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
            $tgl = $this->uri->segment(3); 
            $fileName = 'D:\data_final'.time().'.xlsx'; 
         //   $name = 'data_final'.$tgl.'.xlsx'; 
            // load excel library
            $this->load->library('excel');
            $empInfo = $this->export_model->finalList($tgl);
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
                $config['max_size']             = 200000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
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
                $count = 0;
                foreach($object->getWorksheetIterator() as $worksheet)
               {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                $array_input = array();
                for($row=2; $row<=$highestRow; $row++)
                {
                 $customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                 $address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                 $city = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                 $postal_code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                 $country = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                 $array_input[] =array(
                  'FICMISDATE'  => $customer_name,
                  'NOLOAN'   => $address,
                  'NOMORCIF'    => $city,
                  'NAMALENGKAP'  => $postal_code,
                  'KODECABANGBARU'   => $country
                 );
                 $count++;
                }
               }

               /*$count_del = 0;
               foreach($array_input as $a) {
                   if ($count_del === $count) {
                    break;
                   }
                 unset($array_input[$count_del]);
                $count_del++;
               }
*/
                $this->import_model->setBatchImport($array_input);
                $this->import_model->importData($array_input);
   //            $data['message'] = var_dump($array_input);

                /*
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                
                $arrayCount = count($allDataInSheet);
                $flag = 0;
                //createArray adalah array yg ada di excel
                $createArray = array('id', 'FICMISDATE', 'NOLOAN', 'NOMORCIF', 'NAMALENGKAP', 'KODECABANGBARU');
                $makeArray = array('id' => 'id','FICMISDATE' => 'FICMISDATE', 'NOLOAN' => 'NOLOAN', 'NOMORCIF' => 'NOMORCIF', 'NAMALENGKAP' => 'NAMALENGKAP', 'KODECABANGBARU' => 'KODECABANGBARU');

                $SheetDataKey = array();
                foreach ($allDataInSheet as $dataInSheet) {
                    $imported = 'masuk foreach1';
                    $count = 0;
                    foreach ($dataInSheet as $key => $value) {
                        if (in_array(trim($value), $createArray)) {
                            $imported = 'masuk if di foreach';
                            $value = preg_replace('/\s+/', '', $value);
                            $SheetDataKey[trim($value)] = $key;
                        } else {
                            
                        }
                    }
                }
                //comparing array
                $data = array_diff_key($makeArray, $SheetDataKey);
               // $data['message'] = var_dump($SheetDataKey);
               
                if (empty($data)) {
                    $flag = 1;
                    //array is empty
                }
                if ($flag == 1) {
                    for ($i = 2; $i <= $arrayCount; $i++) {
                        $addresses = array();
                        $firstName = $SheetDataKey['FICMISDATE'];
                        $lastName = $SheetDataKey['NOLOAN'];
                        $email = $SheetDataKey['NOMORCIF'];
                        $dob = $SheetDataKey['NAMALENGKAP'];
                        $contactNo = $SheetDataKey['KODECABANGBARU'];
                        $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                        $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                        $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
                        $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                        $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
                        $fetchData[] = array('id' => null, 'FICMISDATE' => $firstName, 'NOLOAN' => $lastName, 'NOMORCIF' => $email, 'NAMALENGKAP' => $dob, 'KODECABANGBARU' => $contactNo);
                    }              
                    $data['employeeInfo'] = $fetchData;
                    $this->import->setBatchImport($fetchData);
                    $this->import->importData();
                    $data['message'] = 'imported';
                } else {
                    echo "Please import correct file";

                    $data['message'] = 'not imported';
                }*/
            }
            $this->load->view('/upload_success_excel', $data);
            
        } 

}

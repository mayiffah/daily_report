<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->database();
                $this->load->model('export_model');
        }

        public function index()
        {
                $this->load->view('/upload_form', array('error'=>' '));
        }

        public function do_upload()
        {
                $config['upload_path']          = './application/uploads/';
                $config['allowed_types']        = 'txt|pdf|gif|jpg|png';
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
        public function createXLS() {
            // create file name
            $tgl = $this->uri->segment(3); 
            $fileName = 'data_existing-'.$tgl.'.xlsx';  
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
            $objWriter->save(ROOT_UPLOAD_IMPORT_PATH.$fileName);
            // download file
            header("Content-Type: application/vnd.ms-excel");
            redirect("HTTP_UPLOAD_IMPORT_PATH.$fileName", "refresh");
        }
}

<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->database();
        }

        public function index()
        {
                $this->load->view('/upload_form', array('error'=>' '));
        }

        public function do_upload()
        {
                $config['upload_path']          = './application/uploads/';
                $config['allowed_types']        = 'txt|pdf|gif|jpg|png';
                $config['max_size']             = 5000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( !$this->upload->do_upload('userfile'))
                {
                        $error = array('error'=>$this->upload->display_errors());

                        $this->load->view('/upload_form', $error);
                }
                else
                {
                        $data = array('upload_data'=>$this->upload->data('full_path'));
                        
                    //    $result = mysql_query("LOAD DATA INFILE '$data'"." INTO TABLE coba FIELDS TERMINATED BY '|'");
                      //  $result = mysql_query("LOAD DATA INFILE '$data'"." INTO TABLE coba FIELDS TERMINATED BY '|' IGNORE 1 LINES");
                        $this->load->view('/upload_success', $data);
                } 
        }
}

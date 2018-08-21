<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('summary_model');
            $this->load->model('wilayah_model');
            $this->load->model('area_model');
            $this->load->model('cabang_model');
            $this->load->model('final_model');
            $this->load->model('bbrm_model');
          	$this->load->helper('url');
            $this->load->library('session');
        }

        //filtering berdasarkan area yg ada di database
        public function portfolio_area($id_jabatan, $nama_outlet) 
        {
        	$this->load->helper('url');
            if ($id_jabatan === '1' or $id_jabatan === '2') {
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah('ALL');
                $data['list_area'] = $this->area_model->get_area('ALL');
                $data['list_cabang'] = $this->cabang_model->get_cabang('ALL');
                $data['wil_ada'] = false;
                $data['area_ada'] = false;
                $data['cbg_ada'] = false;
            } else if ($id_jabatan === '3' or $id_jabatan === '4') {


                $nama_outlet = str_replace('%20', ' ', $nama_outlet);
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah_by_name($nama_outlet);
                $data['list_area'] = $this->area_model->get_area('ALL');
                $data['list_cabang'] = $this->cabang_model->get_cabang('ALL');
                $data['wil_ada'] = false;
                $data['area_ada'] = false;
                $data['cbg_ada'] = false;
           
            } else if ($id_jabatan === '5' or $id_jabatan === '7') {

                $nama_outlet = str_replace('%20', ' ', $nama_outlet);
                $data['list_area'] = $this->area_model->get_area_by_name($nama_outlet);
                $data['list_cabang'] = $this->cabang_model->get_cabang('ALL');
                $data['wil_ada'] = true;
                $data['area_ada'] = false;
                $data['cbg_ada'] = false;
           
            } else if ($id_jabatan === '6' or $id_jabatan === '8') {

                $nama_outlet = str_replace('%20', ' ', $nama_outlet);
                $data['list_cabang'] = $this->cabang_model->get_cabang_by_name($nama_outlet);
                $data['wil_ada'] = true;
                $data['area_ada'] = true;
                $data['cbg_ada'] = true;
           
            }
 	
            $data['ada_outstanding'] = false;
            $data['tess'] = 'blm ada';
       //     $data['isi_header'] = 'Silahkan isi pilihan untuk melihat data wilayah, area, atau cabang';
        	$this->load->view('/portfolio_area', $data);	
        }

        public function portfolio_area_baru($id_jabatan, $nama_outlet)
        {
        	$wil = $this->input->get('wilayah');
        	$area = $this->input->get('area');
        	$cabang = $this->input->get('cabang');

            $data['wil'] = $wil;
            $data['ar'] = $area;
            $data['cab'] = $cabang;

            /*if ($wil == '' || $wil == '0') {
                $this->portfolio_area($id_jabatan, $nama_outlet);   
            }*/
            
			if ($id_jabatan === '1' or $id_jabatan === '2') {
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah('ALL');
            } else if ($id_jabatan === '3' or $id_jabatan === '4') {
                $data['list_wilayah'] = $this->wilayah_model->get_wilayah($wil);
            } else if ($id_jabatan === '5' or $id_jabatan === '7') {
                //gausah ada wilayah
                $w_coba = $this->area_model->get_area($area);
                $wil = $w_coba[0]->id_wilayah;
            } else if ($id_jabatan === '6' or $id_jabatan === '8') {
                //gausah ada wilayah dan area
                

                $a_coba = $this->cabang_model->get_cabang($cabang);
                $area = $a_coba[0]->id_area;

                $w_coba = $this->area_model->get_area($area);
                $wil = $w_coba[0]->id_wilayah;
            } 			
        	$data['wil_ada'] = true;
            $data['ada_outstanding'] = true;
            
            $nama_outlet = str_replace('%20', ' ', $nama_outlet);
            $data['tes1'] = $nama_outlet;
           // $data['jabatan'] = $id_jabatan;
            

            $area_by_wilayah = false;
            if ($area != '' and $area != '0') {
                $area_1 = $this->area_model->get_area_with_wilayah($wil);
                foreach($area_1 as $a) {
                    if ($a->id === $area) {
                        $area_by_wilayah = true;
                        break;
                    }
                }
            }
            
          //  $area_by_wilayah ='tes';
        	$data['area_by_wilayah'] = $area_by_wilayah;
        	if ($area_by_wilayah === true) {
                if ($id_jabatan === '1' or $id_jabatan === '2') {
                    $data['list_area'] = $this->area_model->get_area_with_wilayah($wil);
                } else if ($id_jabatan === '3' or $id_jabatan === '4') {
                    $data['list_area'] = $this->area_model->get_area_with_wilayah($wil);
                }  else if ($id_jabatan === '5' or $id_jabatan === '7') {
                    $data['list_area'] = $this->area_model->get_area($area);
                } 

        		
      			$data['area_ada'] = true;

                $cabang_by_area = false;
                if ($cabang != '' and $cabang != '0') {
                    $cabang_1 = $this->cabang_model->get_cabang_with_area($area);
                    foreach($cabang_1 as $c) {
                        if ($c->id === $cabang) {
                            $cabang_by_area = true;
                            break;
                        }
                    }
                }



      			if ($cabang_by_area === true) {
        			if ($id_jabatan === '1' or $id_jabatan === '2') {
                    $data['list_cabang'] = $this->cabang_model->get_cabang_with_area($area);
                    } else if ($id_jabatan === '3' or $id_jabatan === '4') {
                        $data['list_cabang'] = $this->cabang_model->get_cabang_with_area($area);
                    }  else if ($id_jabatan === '5' or $id_jabatan === '7') {
                        $data['list_cabang'] = $this->cabang_model->get_cabang_with_area($area);
                    } else if ($id_jabatan === '6' or $id_jabatan === '8') {
                        $data['list_cabang'] = $this->cabang_model->get_cabang($cabang);
                    } 

	      			$data['cbg_ada'] = true;
	        	} else {
	        		$data['list_cabang'] = $this->cabang_model->get_cabang_with_area($area);
	        		$data['cbg_ada'] = false;
	        	}
        	} else {
        		$data['list_area'] = $this->area_model->get_area_with_wilayah($wil);
        		$data['area_ada'] = false;
                $data['cbg_ada'] = false;
                  
        	}
        	
            if ($data['cbg_ada'] === true) {
                $nama_cabang = $this->cabang_model->get_cabang($cabang);
                $nama = $nama_cabang[0]->nama_cabang;

                $data['list_bbrm'] = $this->bbrm_model->get_bbrm($nama);
                
                $target_os = $nama_cabang[0]->target_os;
                $target_b2b = $nama_cabang[0]->target_b2b;
                $target_b2c = $nama_cabang[0]->target_b2c;
                $target_kol2 = $nama_cabang[0]->target_kol2;
                $target_npf = $nama_cabang[0]->target_npf;
                
                $os = $this->final_model->get_outstanding('6', $nama);
                $data['outstanding'] = $os[0]['SUM_OS'];
               


                $kol2 = $this->final_model->get_kol2('6', $nama);
                $data['kol2'] = $kol2[0]['SUM_KOL2'];
                

                $npf = $this->final_model->get_npf('6', $nama);
                $data['npf'] = $npf[0]['SUM_NPF'];
                

                $b2b = $this->final_model->get_cair_b2b('6', $nama);
                $data['cair_b2b'] = $b2b[0]['SUM_CAIR'];
               

                $b2c = $this->final_model->get_cair_b2c('6', $nama);
                $data['cair_b2c'] = $b2c[0]['SUM_CAIR'];


                $data['runoff'] = $this->final_model->get_runoff('6', $nama);

                $ug = $this->final_model->get_upgrade('6', $nama);
                $data['upgrade'] = $ug[0]['SUM_NPF'];

                $dg = $this->final_model->get_downgrade('6', $nama);
                $data['downgrade'] = $dg[0]['SUM_NPF'];


                if ($target_os == 0) {
                        $data['target_os'] = number_format(($data['outstanding']/$data['outstanding'])*100, 2);
                } else {
                        $data['target_os'] = number_format(($data['outstanding']/($target_os*1000000))*100, 2);
                }

                if ($target_kol2 == 0) {
                        $data['target_kol2'] = number_format(($data['kol2']/$data['kol2'])*100, 2);
                } else {
                        $data['target_kol2'] = number_format(($data['kol2']/($target_kol2*1000000))*100, 2);
                }

                if ($target_npf == 0) {
                        $data['target_npf'] = number_format(($data['npf']/$data['npf'])*100, 2);
                } else {
                        $data['target_npf'] = number_format(($data['npf']/($target_npf*1000000))*100, 2);
                }


                if ($target_b2b == 0) {
                        $data['target_b2b'] = number_format(($data['cair_b2b']/$data['cair_b2b'])*100, 2);
                } else {
                        $data['target_b2b'] = number_format(($data['cair_b2b']/($target_b2b*1000000))*100, 2);
                }


                if ($target_b2c == 0) {
                        $data['target_b2c'] = number_format(($data['cair_b2c']/$data['cair_b2c'])*100, 2);
                } else {
                        
                        $data['target_b2c'] = number_format(($data['cair_b2c']/($target_b2c*1000000))*100, 2);
                }


                $data['isi_header'] = 'Selamat datang di cabang '.$nama;

            } elseif ($data['area_ada'] ===true) {
                $nama_area = $this->area_model->get_area($area);
                $nama = $nama_area[0]->nama_area;

                $data['list_bbrm'] = $this->bbrm_model->get_bbrm($nama);
                
                $target_os = $nama_area[0]->target_os;
                $target_b2b = $nama_area[0]->target_b2b;
                $target_b2c = $nama_area[0]->target_b2c;
                $target_kol2 = $nama_area[0]->target_kol2;
                $target_npf = $nama_area[0]->target_npf;       
                
                $os = $this->final_model->get_outstanding('5', $nama);
                $data['outstanding'] = $os[0]['SUM_OS'];
                $data['target_os'] = number_format(($data['outstanding']/($target_os*1000000))*100, 2);





                $kol2 = $this->final_model->get_kol2('5', $nama);
                $data['kol2'] = $kol2[0]['SUM_KOL2'];
                

                $npf = $this->final_model->get_npf('5', $nama);
                $data['npf'] = $npf[0]['SUM_NPF'];
                

                $b2b = $this->final_model->get_cair_b2b('5', $nama);
                $data['cair_b2b'] = $b2b[0]['SUM_CAIR'];
                

                $b2c = $this->final_model->get_cair_b2c('5', $nama);
                $data['cair_b2c'] = $b2c[0]['SUM_CAIR'];
                


                $data['runoff'] = $this->final_model->get_runoff('5', $nama);

                $ug = $this->final_model->get_upgrade('5', $nama);
                $data['upgrade'] = $ug[0]['SUM_NPF'];

                $dg = $this->final_model->get_downgrade('5', $nama);
                $data['downgrade'] = $dg[0]['SUM_NPF'];


                if ($target_os == 0) {
                        $data['target_os'] = number_format(($data['outstanding']/$data['outstanding'])*100, 2);
                } else {
                        $data['target_os'] = number_format(($data['outstanding']/($target_os*1000000))*100, 2);
                }

                if ($target_kol2 == 0) {
                        $data['target_kol2'] = number_format(($data['kol2']/$data['kol2'])*100, 2);
                } else {
                        $data['target_kol2'] = number_format(($data['kol2']/($target_kol2*1000000))*100, 2);
                }

                if ($target_npf == 0) {
                        $data['target_npf'] = number_format(($data['npf']/$data['npf'])*100, 2);
                } else {
                        $data['target_npf'] = number_format(($data['npf']/($target_npf*1000000))*100, 2);
                }


                if ($target_b2b == 0) {
                        $data['target_b2b'] = number_format(($data['cair_b2b']/$data['cair_b2b'])*100, 2);
                } else {
                        $data['target_b2b'] = number_format(($data['cair_b2b']/($target_b2b*1000000))*100, 2);
                }


                if ($target_b2c == 0) {
                        $data['target_b2c'] = number_format(($data['cair_b2c']/$data['cair_b2c'])*100, 2);
                } else {
                        
                        $data['target_b2c'] = number_format(($data['cair_b2c']/($target_b2c*1000000))*100, 2);
                }

                $data['isi_header'] = 'Selamat datang di area '.$nama;

            } elseif ($data['wil_ada'] === true) {
                $nama_wil = $this->wilayah_model->get_wilayah($wil);
                $nama = $nama_wil[0]->nama_wilayah;
                $wilayah_summary = $this->summary_model->get_wilayah($nama);

               
                $data['list_bbrm'] = $this->bbrm_model->get_bbrm($nama);

                $target_os = $wilayah_summary[0]->Target;
                $target_b2b = $wilayah_summary[0]->Target_B2B;
                $target_b2c = $wilayah_summary[0]->Target_B2C;
                $target_kol2 = $wilayah_summary[0]->Target_Kol2;
                $target_npf = $wilayah_summary[0]->Target_NPF;

                $os = $this->final_model->get_outstanding('3', $nama);
                $data['outstanding'] = $os[0]['SUM_OS'];
                $data['target_os'] = number_format(($data['outstanding']/($target_os*1000000))*100, 2);



                $kol2 = $this->final_model->get_kol2('3', $nama);
                $data['kol2'] = $kol2[0]['SUM_KOL2'];
                 

                $npf = $this->final_model->get_npf('3', $nama);
                $data['npf'] = $npf[0]['SUM_NPF'];
                

                $b2b = $this->final_model->get_cair_b2b('3', $nama);
                $data['cair_b2b'] = $b2b[0]['SUM_CAIR'];
                

                $b2c = $this->final_model->get_cair_b2c('3', $nama);
                $data['cair_b2c'] = $b2c[0]['SUM_CAIR'];
                


                $data['runoff'] = $this->final_model->get_runoff('3', $nama);

                $ug = $this->final_model->get_upgrade('3', $nama);
                $data['upgrade'] = $ug[0]['SUM_NPF'];

                $dg = $this->final_model->get_downgrade('3', $nama);
                $data['downgrade'] = $dg[0]['SUM_NPF'];

                if ($target_os == 0) {
                        $data['target_os'] = number_format(($data['outstanding']/$data['outstanding'])*100, 2);
                } else {
                        $data['target_os'] = number_format(($data['outstanding']/($target_os*1000000))*100, 2);
                }

                if ($target_kol2 == 0) {
                        $data['target_kol2'] = number_format(($data['kol2']/$data['kol2'])*100, 2);
                } else {
                        $data['target_kol2'] = number_format(($data['kol2']/($target_kol2*1000000))*100, 2);
                }

                if ($target_npf == 0) {
                        $data['target_npf'] = number_format(($data['npf']/$data['npf'])*100, 2);
                } else {
                        $data['target_npf'] = number_format(($data['npf']/($target_npf*1000000))*100, 2);
                }


                if ($target_b2b == 0) {
                        $data['target_b2b'] = number_format(($data['cair_b2b']/$data['cair_b2b'])*100, 2);
                } else {
                        $data['target_b2b'] = number_format(($data['cair_b2b']/($target_b2b*1000000))*100, 2);
                }


                if ($target_b2c == 0) {
                        $data['target_b2c'] = number_format(($data['cair_b2c']/$data['cair_b2c'])*100, 2);
                } else {
                        
                        $data['target_b2c'] = number_format(($data['cair_b2c']/($target_b2c*1000000))*100, 2);
                }

                $data['isi_header'] = 'Selamat datang di wilayah '.$nama;
            } else {
                $data['tess'] = 'jangan kasih data';
            }

        	$this->load->view('/portfolio_area', $data);	
        }

        // Logout from admin page
        public function logout() {

        // Removing session data
        $sess_array = array(
        'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Successfully Logout';
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('login', $data);
    }


}
        
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Portfolio Nasional</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"> </script>
   
    <!-- Bootstrap core CSS-->
    <link  href="<?php echo base_url('bootstrap/vendor/bootstrap/css/bootstrap.min.css');?>"  rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link type="text/css" href="<?php echo base_url('bootstrap/vendor/font-awesome/css/font-awesome.min.css');?>"  rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link  href="<?php echo base_url('bootstrap/vendor/datatables/dataTables.bootstrap4.css');?>" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('bootstrap/css/sb-admin.css');?>"  rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('bootstrap/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('bootstrap/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url('bootstrap/vendor/chart.js/Chart.min.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendor/datatables/jquery.dataTables.js');?>"></script>
    <script src="<?php echo base_url('bootstrap/vendor/datatables/dataTables.bootstrap4.js');?>"></script>

    <!-- Custom scripts for all pages>
    <script src="<?php echo base_url('bootstrap/js/sb-admin.min.js');?>"></script>
    <--Custom scripts for this page-->
    <script src="<?php echo base_url('bootstrap/js/sb-admin-datatables.min.js');?>"></script>
    <!--script src="<?php echo base_url('bootstrap/js/sb-admin-charts.min.js');?>"></script-->

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
  </head>
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
      HALOHA
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href='<?php echo base_url ('/index.php/nasional/index'); ?>'>Portfolio Nasional || Business Banking Group || Bank Syariah Mandiri</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Portfolio Nasional">
            <a class="nav-link" href='<?php echo base_url ('/index.php/nasional/index'); ?>'>
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Portfolio Nasional</span>
            </a>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Portfolio Area">
            <a class="nav-link" href='<?php echo base_url ('/index.php/area/portfolio_area'); ?>'>
              <i class="fa fa-fw fa-sitemap"></i>
              <span class="nav-link-text">Portfolio Area</span>
            </a>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Upload Data Harian">
            <a class="nav-link" href='<?php echo base_url ('/index.php/Upload/index'); ?>'>
              <i class="fa fa-fw fa-wrench"></i>
              <span class="nav-link-text">Upload Data Harian</span>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Upload Data Harian</li>
          </ol>
        
            <h3>Semangat fah</h3>
        <h3>File berhasil diupload</h3>

    
      <?php 

/*
      
      if(!is_array($upload_data)){
    
                echo $upload_data;
                $mod_date=date("Y-m-d-H:i:s", filemtime($upload_data));
                $kemarin = date('Y-m-d-H:i:s',strtotime("-1 days"));

                echo '<br>'. $mod_date;

              $table_existing = 'existing'.$mod_date;
              $this->load->database();

              $query = $this->db->query("CREATE TABLE `ifois".$mod_date."` LIKE ifois_archive;");

              //MASUKKIN IFOIS
               $query = $this->db->query("LOAD DATA INFILE '$upload_data'"." INTO TABLE `ifois".$mod_date."` FIELDS TERMINATED BY '|' IGNORE 1 LINES (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `JENISPENGGUNAANCODE`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `ACCOUNTOFFICER2`, `EQVRATE`, `INTEREST_RATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `SCHEDTYPE`, `SOCODE`, `PEKERJAAN`, `SEGMENTASI`, `STATUS_PENCAIRAN`, `RELATED_TRN`) ");
              //constraint: file yang dimasukkan akhirnya ada 000nya
              $query = $this->db->query("DELETE FROM `ifois".$mod_date."` order by id desc limit 1");

              $query = $this->db->query("ALTER TABLE `ifois".$mod_date."` ADD KEY `NOLOAN` (`NOLOAN`), ADD KEY `LOANTYPE` (`LOANTYPE`), ADD KEY `KODECABANGBARU` (`KODECABANGBARU`), ADD KEY `TGLPENCAIRAN` (`TGLPENCAIRAN`), ADD KEY `DIVISI` (`DIVISI`)");

              $query = $this->db->query("RENAME TABLE existing TO `existing".$kemarin."`;");

              $query = $this->db->query("CREATE TABLE existing LIKE `existing".$kemarin."`;");

              $query = $this->db->query("INSERT into existing  (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STATUS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`) SELECT a.FICMISDATE, a.NOLOAN, a.NOMORCIF, a.NAMALENGKAP, a.KODECABANGBARU, a.NAMACABANG,a.JENISPIUTANGPEMBIAYAAN, a.SEKTOREKONOMICODE
, a.TGLPENCAIRAN, a.TGLJTTEMPO, a.DAYPASTDUE, a.DIVISI, a.CURRENCY, a.LOANTYPE, c.LoanTypeDesc, a.CATEGORY, a.RESTRUCTFLAG, a.PRICING
, a.REKPEMBYPOKOK, a.TENOR, a.RESTRUCTDATE, a.KOLBSM, a.KOLCIF, a.SOURCEDATACODE, a.OSPOKOKCONVERSION, a.OSMARGINCONVERSION
, a.OSGROSSCONVERSION, a.TUNGGAKANPOKOKCONVERSION, a.TUNGGAKANMARGINCONVERSION, a.TUNGGAKANGROSSCONVERSION
, a.PENCAIRANPOKOKCONVERSION, a.PENCAIRANMARGINCONVERSION, a.PENCAIRANGROSSCONVERSION, a.REALISASI_BAGIHASIL
, a.PROYEKSI_BAGIHASIL, a.ACCOUNTOFFICER, a.EQVRATE,  a.MISACCOUNTOFFICR, a.NAMAPERUSAHAANNASABAH
, a.LD_ECONOMICSECTOR, a.TUNGGAKANPENALTYCONVERSION, a.NAPNO , a.STATUS_PENCAIRAN , b.Segmen, b.Produk, b.`P/B`, b.grup 
, d.AREA, d.KANWIL, b.`E/C`, b.sektor_ekon, b.Produk2, b.`Tahun Booking`
FROM `ifois".$mod_date."` a
left outer join lalu b on a.NOLOAN = b.NoLoan
left outer join Loantype2017 c on a.LOANTYPE = c.LoanType
left outer join cabang2017new d on a.KODECABANGBARU = d.outletcode
where b.NoLoan is not null"); 

             

              $query = $this->db->query("INSERT into cair_baru (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STATUS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`)
SELECT a.FICMISDATE, a.NOLOAN, a.NOMORCIF, a.NAMALENGKAP, a.KODECABANGBARU, a.NAMACABANG, a.JENISPIUTANGPEMBIAYAAN, a.SEKTOREKONOMICODE
, a.TGLPENCAIRAN, a.TGLJTTEMPO, a.DAYPASTDUE, a.DIVISI, a.CURRENCY, a.LOANTYPE, c.LoanTypeDesc, a.CATEGORY, a.RESTRUCTFLAG, a.PRICING
, a.REKPEMBYPOKOK, a.TENOR, a.RESTRUCTDATE, a.KOLBSM, a.KOLCIF, a.SOURCEDATACODE, a.OSPOKOKCONVERSION, a.OSMARGINCONVERSION
, a.OSGROSSCONVERSION, a.TUNGGAKANPOKOKCONVERSION, a.TUNGGAKANMARGINCONVERSION, a.TUNGGAKANGROSSCONVERSION
, a.PENCAIRANPOKOKCONVERSION, a.PENCAIRANMARGINCONVERSION, a.PENCAIRANGROSSCONVERSION, a.REALISASI_BAGIHASIL
, a.PROYEKSI_BAGIHASIL, a.ACCOUNTOFFICER, a.EQVRATE, a.MISACCOUNTOFFICR, a.NAMAPERUSAHAANNASABAH
, a.LD_ECONOMICSECTOR, a.TUNGGAKANPENALTYCONVERSION, a.NAPNO, a.STATUS_PENCAIRAN, b.Segmen, b.Produk, b.`P/B`, b.grup 
, d.AREA, d.KANWIL, b.`E/C`, b.sektor_ekon, b.Produk2, b.`Tahun Booking`
FROM `ifois".$mod_date."` a
left outer join lalu b on a.NOLOAN = b.NoLoan
left outer join Loantype2017 c on a.LOANTYPE = c.LoanType
left outer join cabang2017new d on a.KODECABANGBARU = d.outletcode
where (a.TGLPENCAIRAN between '2018-05-31' and '2018-05-31') and  a.DIVISI in ('BBG')");
          
              $query = $this->db->query("INSERT into div_code (`FICMISDATE`, `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `SEKTOREKONOMICODE`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`, `DIVISI`, `CURRENCY`, `LOANTYPE`, `LoanTypeDesc`, `CATEGORY`, `RESTRUCTFLAG`, `PRICING`, `REKPEMBYPOKOK`, `TENOR`, `RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `SOURCEDATACODE`, `OSPOKOKCONVERSION`, `OSMARGINCONVERSION`, `OSGROSSCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `PENCAIRANPOKOKCONVERSION`, `PENCAIRANMARGINCONVERSION`, `PENCAIRANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `ACCOUNTOFFICER`, `EQVRATE`, `MISACCOUNTOFFICR`, `NAMAPERUSAHAANNASABAH`, `LD_ECONOMICSECTOR`, `TUNGGAKANPENALTYCONVERSION`, `NAPNO`, `STATUS_PENCAIRAN`, `Segmen`, `Produk`, `P/B`, `grup`, `AREA`, `KANWIL`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`)
SELECT a.FICMISDATE, a.NOLOAN, a.NOMORCIF, a.NAMALENGKAP, a.KODECABANGBARU, a.NAMACABANG, a.JENISPIUTANGPEMBIAYAAN, a.SEKTOREKONOMICODE
, a.TGLPENCAIRAN, a.TGLJTTEMPO, a.DAYPASTDUE, a.DIVISI, a.CURRENCY, a.LOANTYPE, c.`LoanTypeDesc`, a.CATEGORY, a.RESTRUCTFLAG, a.PRICING
, a.REKPEMBYPOKOK, a.TENOR, a.RESTRUCTDATE, a.KOLBSM, a.KOLCIF, a.SOURCEDATACODE, a.OSPOKOKCONVERSION, a.OSMARGINCONVERSION
, a.OSGROSSCONVERSION, a.TUNGGAKANPOKOKCONVERSION, a.TUNGGAKANMARGINCONVERSION, a.TUNGGAKANGROSSCONVERSION
, a.PENCAIRANPOKOKCONVERSION, a.PENCAIRANMARGINCONVERSION, a.PENCAIRANGROSSCONVERSION, a.REALISASI_BAGIHASIL
, a.PROYEKSI_BAGIHASIL, a.ACCOUNTOFFICER, a.EQVRATE, a.MISACCOUNTOFFICR, a.NAMAPERUSAHAANNASABAH
, a.LD_ECONOMICSECTOR, a.TUNGGAKANPENALTYCONVERSION, a.NAPNO , a.STATUS_PENCAIRAN , b.Segmen, b.Produk,b.`P/B`,b. `grup` 
, d.AREA, d.KANWIL, b.`E/C`, b.sektor_ekon, b.Produk2, b.`Tahun Booking`
FROM `ifois".$mod_date."` a
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
              $query = $this->db->query("TRUNCATE cair_baru");
              

              $query = $this->db->query("INSERT INTO lalu (`NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `Segmen`, `Produk`, `P/B`, `grup`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking`)
SELECT `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `Segmen`, `Produk`, `P/B`, `grup`, `E/C`, `sektor_ekon`, `Produk2`, `Tahun Booking` FROM existing
");
              $query = $this->db->query("DROP TRIGGER IF EXISTS rbh_dibagi_pbh");
              $query = $this->db->query("RENAME TABLE watchlist TO `watchlist".$kemarin."`;");

              $query = $this->db->query("CREATE TABLE watchlist LIKE `watchlist".$kemarin."`;");

              $query = $this->db->query("CREATE TRIGGER rbh_dibagi_pbh BEFORE INSERT ON watchlist FOR EACH ROW SET NEW.rbh_bagi_pbh = NEW.realisasi_bagi_hasil / NEW.proyeksi_bagi_hasil");
              $query = $this->db->query("INSERT INTO watchlist (`no_loan`, `no_cif`, `nama_lengkap`, `kode_cabang`, `nama_cabang`, `jenis_piutang_pembiayaan`, `tanggal_pencairan`, `tanggal_jatuh_tempo`, `day_past_due`, `restruct_date`, `kol_bsm`, `kol_cif`, `os_pokok_conversion`, `tung_pokok_conversion`, `tung_margin_conversion`, `tung_gross_conversion`, `realisasi_bagi_hasil`, `proyeksi_bagi_hasil`, `grup`) 
SELECT `NOLOAN`, `NOMORCIF`, `NAMALENGKAP`, `KODECABANGBARU`, `NAMACABANG`, `JENISPIUTANGPEMBIAYAAN`, `TGLPENCAIRAN`, `TGLJTTEMPO`, `DAYPASTDUE`,`RESTRUCTDATE`, `KOLBSM`, `KOLCIF`, `OSPOKOKCONVERSION`, `TUNGGAKANPOKOKCONVERSION`, `TUNGGAKANMARGINCONVERSION`, `TUNGGAKANGROSSCONVERSION`, `REALISASI_BAGIHASIL`, `PROYEKSI_BAGIHASIL`, `grup` FROM existing
"); 
      } else {
        echo 'masuk <br>';
                $count = 1;
                foreach ($upload_data as $item) {
                    echo $count.' ' . $item;
                    echo '<br>';
                    $count++;
                }       
                echo 'ada ';
                echo $count-1;
      }
       */
       ?>
      
    
    <p><?php echo anchor('/upload/do_upload', 'Upload Lagi'); ?></p>

    </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {


        //for the tooltip of side navbar
        !function(e){"use strict";e('.navbar-sidenav [data-toggle="tooltip"]').tooltip({template:'<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}),e("#sidenavToggler").click(function(o){o.preventDefault(),e("body").toggleClass("sidenav-toggled"),e(".navbar-sidenav .nav-link-collapse").addClass("collapsed"),e(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show")}),e(".navbar-sidenav .nav-link-collapse").click(function(o){o.preventDefault(),e("body").removeClass("sidenav-toggled")}),e("body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse").on("mousewheel DOMMouseScroll",function(e){var o=e.originalEvent,t=o.wheelDelta||-o.detail;this.scrollTop+=30*(t<0?1:-1),e.preventDefault()}),e(document).scroll(function(){e(this).scrollTop()>100?e(".scroll-to-top").fadeIn():e(".scroll-to-top").fadeOut()}),e('[data-toggle="tooltip"]').tooltip(),e(document).on("click","a.scroll-to-top",function(o){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);


      }); 
    </script> 
  </body>
</html>

        
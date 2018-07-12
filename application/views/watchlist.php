<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
} else {
header("location:". base_url() . "index.php/nasional/login");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Watchlist Nasional</title>

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

<!-- 
    <script src="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/scroller/1.5.1/css/scroller.dataTables.min.css"></script> -->

  </head>
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
      HALOHA
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="index">Portfolio Nasional || Business Banking Group || Bank Syariah Mandiri</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Portfolio Nasional">
            <a class="nav-link" href="index">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Portfolio Nasional</span>
            </a>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Portfolio Area">
            <a class="nav-link" href='<?php echo base_url ('/index.php/area/portfolio_area'); ?>'>
              <i class="fa fa-fw fa-sitemap"></i>
              <span class="nav-link-text">Portfolio Area</span>
            </a>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Daily Report">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
              <i class="fa fa-fw fa-area-chart"></i>
              <span class="nav-link-text">Daily Report</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li>
                <a href='<?php echo base_url ('/index.php/daily/posisi'); ?>'>Posisi</a>
              </li>
              <li>
                <a href='<?php echo base_url ('/index.php/daily/runoff'); ?>'>Run Off</a>
              </li>
              <li>
                <a href='<?php echo base_url ('/index.php/daily/cair'); ?>'>Cair</a>
              </li>
              <li>
                <a href='<?php echo base_url ('/index.php/daily/kol2'); ?>'>Kol 2</a>
              </li>
            </ul>
          </li>
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
            <?php
             echo '<a class="nav-link" >Welcome, ' . $username . '</a>';
            ?></li>
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
          <li class="breadcrumb-item active">Watchlist Nasional</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">26 New Messages!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-list"></i>
                </div>
                <div class="mr-5">11 New Tasks!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">123 New Orders!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-support"></i>
                </div>
                <div class="mr-5">13 New Tickets!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <table id="exampleTable" width="100%"  cellspacing="0">
            <thead>
                <tr>
                    <th>NOLOAN</th>
                    <th>NOMORCIF</th>
                    <th>NAMALENGKAP</th>
                    <th>KODECABANG</th>
                    <th>NAMACABANG</th>
                    <th>JENISPIUTANGPEMBIAYAAN</th>
                    <th>TGLPENCAIRAN</th>
                    <th>TGL JT TEMPO</th>
                    <th>DAY PAST DUE</th>
                    <th>RESTRUCT DATE</th>
                    <th>KOLBSM SISTEM</th>
                    <th>KOL CIF</th>
                    <th>OSPOKOK CONVERSION</th> 
                    <th>TUNGGAKANPOKOKCONVERSION</th> 
                    <th>TUNGGAKANMARGINCONVERSION</th>
                    <th>TUNGGAKANGROSSCONVERSION</th>
                    <th>REALISASI BAGI HASIL</th>
                    <th>PROYEKSI BAGI HASIL</th>
                    <th>RBH/PBH</th>
                    <th>GRUP</th>
                    <th>Detail</th>
                </tr>
            </thead>
          </table>
        </div>

         <!-- Watchlist Nasabah-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i>Watchlist Nasabah</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>NOLOAN</th>
                    <th>NOMORCIF</th>
                    <th>NAMALENGKAP</th>
                    <th>KODECABANG</th>
                    <th>NAMACABANG</th>
                    <th>JENISPIUTANGPEMBIAYAAN</th>
                    <th>TGLPENCAIRAN</th>
                    <th>TGL JT TEMPO</th>
                    <th>DAY PAST DUE</th>
                    <th>RESTRUCT DATE</th>
                    <th>KOLBSM SISTEM</th>
                    <th>KOL CIF</th>
                    <th>OSPOKOK CONVERSION</th> 
                    <th>TUNGGAKANPOKOKCONVERSION</th> 
                    <th>TUNGGAKANMARGINCONVERSION</th>
                    <th>TUNGGAKANGROSSCONVERSION</th>
                    <th>REALISASI BAGI HASIL</th>
                    <th>PROYEKSI BAGI HASIL</th>
                    <th>RBH/PBH</th>
                    <th>GRUP</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>NOLOAN</th>
                    <th>NOMORCIF</th>
                    <th>NAMALENGKAP</th>
                    <th>KODECABANG</th>
                    <th>NAMACABANG</th>
                    <th>JENISPIUTANGPEMBIAYAAN</th>
                    <th>TGLPENCAIRAN</th>
                    <th>TGL JT TEMPO</th>
                    <th>DAY PAST DUE</th>
                    <th>RESTRUCT DATE</th>
                    <th>KOLBSM SISTEM</th>
                    <th>KOL CIF</th>
                    <th>OSPOKOK CONVERSION</th> 
                    <th>TUNGGAKANPOKOKCONVERSION</th> 
                    <th>TUNGGAKANMARGINCONVERSION</th>
                    <th>TUNGGAKANGROSSCONVERSION</th>
                    <th>REALISASI BAGI HASIL</th>
                    <th>PROYEKSI BAGI HASIL</th>
                    <th>RBH/PBH</th>
                    <th>GRUP</th>
                    <th>Detail</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                  /*
                    foreach ($list_watchlist as $watchlist) {
                      echo' <tr>
                      <td>'.$watchlist->no_loan.'</td>
                      <td>'.$watchlist->no_cif.'</td>
                      <td>'.$watchlist->nama_lengkap.'</td>
                      <td>'.$watchlist->kode_cabang.'</td>
                      <td>'.$watchlist->nama_cabang.'</td>
                      <td>'.$watchlist->jenis_piutang_pembiayaan.'</td>
                      <td>'.$watchlist->tanggal_pencairan.'</td>
                      <td>'.$watchlist->tanggal_jatuh_tempo.'</td>
                      <td>'.$watchlist->day_past_due.'</td>
                      <td>'.$watchlist->restruct_date.'</td>
                      <td>'.$watchlist->kol_bsm.'</td>
                      <td>'.$watchlist->kol_cif.'</td>
                      <td>'.$watchlist->os_pokok_conversion.'</td>
                      <td>'.$watchlist->tung_pokok_conversion.'</td>
                      <td>'.$watchlist->tung_margin_conversion.'</td>
                      <td>'.$watchlist->tung_gross_conversion.'</td>
                      <td>'.$watchlist->realisasi_bagi_hasil.'</td>
                      <td>'.$watchlist->proyeksi_bagi_hasil.'</td>
                      <td>'.$watchlist->rbh_bagi_pbh.'</td>
                      <td>'.$watchlist->grup.'</td>';
                      echo '<td><a href="';echo base_url('index.php/nasional/detail/'.$watchlist->id); echo'" class="btn btn-primary" > Detail</a></td>
                     </tr>';
                    }*/
                  ?>                 
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                   <!--  <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th> -->
                    <th>Detail</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                  <!--   <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th> -->
                    <th>Detail</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                    foreach ($list_employee as $employee) {
                      echo' <tr>
                      <td>'.$employee->name.'</td>
                      <td>'.$employee->position.'</td>
                      <td>'.$employee->office.'</td>';
                      /*<td>'.$employee->age.'</td>
                      <td>'.$employee->start_date.'</td>
                      <td>$'.$employee->salary.'</td>*/
                      echo '<td><a href="';echo base_url('index.php/nasional/detail/'.$employee->id); echo'" class="btn btn-primary" > Detail</a></td>
                     </tr>';
                    }
                  ?>                 
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

       

      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © BBG 2018</small>
          </div>
        </div>
      </footer>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="logout">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {

        var data = [];
       /* for ( var i=0 ; i<50000 ; i++ ) {
            data.push( [ i, i, i, i, i ] );
        }*/

         <?php
          foreach ($list_watchlist as $watchlist) {
           // 
          ?>
            data.push([<?php echo"`$watchlist->no_loan`,`$watchlist->no_cif`,`$watchlist->nama_lengkap`, `$watchlist->kode_cabang`, `$watchlist->nama_cabang`,`$watchlist->jenis_piutang_pembiayaan`,`$watchlist->tanggal_pencairan`,`$watchlist->tanggal_jatuh_tempo`,`$watchlist->day_past_due`,`$watchlist->restruct_date`,`$watchlist->kol_bsm`,`$watchlist->kol_cif`,`$watchlist->os_pokok_conversion`,`$watchlist->tung_pokok_conversion`,`$watchlist->tung_margin_conversion`,`$watchlist->tung_gross_conversion`,`$watchlist->realisasi_bagi_hasil`,`$watchlist->proyeksi_bagi_hasil`,`$watchlist->rbh_bagi_pbh`,`$watchlist->grup`"?>]);
          <?php    
          }
          ?>

       
         
        $('#exampleTable').DataTable( {
            data:           data,
            deferRender:    true,
            scrollY:        300,
            //scrollCollapse: true,
            scroller:       true
        } );

        //for the tooltip of side navbar
        !function(e){"use strict";e('.navbar-sidenav [data-toggle="tooltip"]').tooltip({template:'<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}),e("#sidenavToggler").click(function(o){o.preventDefault(),e("body").toggleClass("sidenav-toggled"),e(".navbar-sidenav .nav-link-collapse").addClass("collapsed"),e(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show")}),e(".navbar-sidenav .nav-link-collapse").click(function(o){o.preventDefault(),e("body").removeClass("sidenav-toggled")}),e("body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse").on("mousewheel DOMMouseScroll",function(e){var o=e.originalEvent,t=o.wheelDelta||-o.detail;this.scrollTop+=30*(t<0?1:-1),e.preventDefault()}),e(document).scroll(function(){e(this).scrollTop()>100?e(".scroll-to-top").fadeIn():e(".scroll-to-top").fadeOut()}),e('[data-toggle="tooltip"]').tooltip(),e(document).on("click","a.scroll-to-top",function(o){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);



      }); 
    </script> 
  </body>
</html>

<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$id_jabatan = ($this->session->userdata['logged_in']['id_jabatan']);
$nama_outlet = ($this->session->userdata['logged_in']['nama_outlet']);

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
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </head>
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
      HALOHA
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href='<?php echo base_url ('/index.php/nasional/login');?>'>Portfolio Nasional || Business Banking Group || Bank Syariah Mandiri</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Portfolio Nasional">
            <a class="nav-link" href='<?php echo base_url ('/index.php/nasional/login'); ?>'>
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Portfolio Nasional</span>
            </a>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Portfolio Area">
            <a class="nav-link" href='<?php echo base_url ('/index.php/area/portfolio_area/'.$id_jabatan.'/'.$nama_outlet);?>'>
              <i class="fa fa-fw fa-sitemap"></i>
              <span class="nav-link-text">Portfolio Area</span>
            </a>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Watchlsit Nasional">
            <a class="nav-link" href='<?php echo base_url ('/index.php/nasional/watchlist'); ?>'>
              <i class="fa fa-eye"></i>
              <span class="nav-link-text">Watchlist Nasional</span>
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
          <li class="breadcrumb-item active">Portfolio Nasional</li>
        </ol>

        <?php 
        if ($id_jabatan === null) {
          echo 'id jabatan is null';
        } else { 
          echo 'id jabatan:'.$id_jabatan;
        }


         if ($nama_outlet === null) {
          echo 'nama outlet is null';
        } else { 
          echo '<br>nama outlet:'.$nama_outlet;
        }
       // echo var_dump($outstanding);
    //    echo '<br>outstanding: '.$outstanding[0]['SUM_OS'];

       $b2b_awal_ = floatval($list_summary[0]->Cair_B2B);
       $b2b_fix = number_format($b2b_awal_/1000000000, 2);

       $b2c_awal_ = floatval($list_summary[0]->Cair_B2C);
       $b2c_fix = number_format($b2c_awal_/1000000000, 2);


        ?>

        <h1 align="center">Selamat datang di Halaman Nasional</h1>
        <br>  

          <!-- Speedometer Outstanding -->
          <div id="containeros" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto; float:left;" value="150">
          </div>
        
        <div style="width: 700px; overflow: hidden; margin: 0 auto;">
          <!-- Speedometer Cair B to B -->
          <div id="containerb2b" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>

          <!-- Speedometer Cair B to C -->
          <div id="containerb2c" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>
        </div>

        <div style="width: 700px; overflow: hidden; margin: 0 auto;">
          <!-- Speedometer Kol 2 -->
          <div id="containerkol2" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>

          <!-- Speedometer NPF -->
          <div id="containernpf" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>
        </div>

       <!--  <div style="width: 700px; overflow: hidden; margin: 0 auto;">
          
          <div id="containerug" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>

          <div id="containerdg" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>
        </div> -->

        <br>
        <br>
        <br>

        <?php
        echo number_format($nasional[3], 2);
        /*echo $nasional->out;
        foreach($nasional as $n) {
          echo '<br>';
          echo $n;
        }*/
        

        ?>

        <!-- Review -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Review Nasional dan Wilayah</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="reviewTable" class="display nowrap" width="100%"  cellspacing="0">
            <thead>
                <tr>
                  <th>No.</th>
                  <th>Wilayah Review </th>
                  <th>O/S</th>
                  <th>Target (satuan juta)</th>
                  <th>%</th>
                  <th>Noa</th>
                  <th>O/S Lalu</th>
                  <th>Growth</th>
                  <th>Kol 1</th>
                  <th>Kol 2</th>
                  <th>Kol 3</th>
                  <th>Kol 4</th>
                  <th>Kol 5</th>
                  <th>NPF</th>
                </tr>
            </thead>
          </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>


         <!-- Nasional -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Ringkasan Nasional</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="nasionalTable" class="display nowrap" width="100%"  cellspacing="0">
            <thead>
                <tr>
                  <th>No.</th>
                  <th>Wilayah</th>
                  <th>Outstanding</th>
                  <th>Kol 2</th>
                  <th>NPF</th>
                  <th>Cair B2B</th>
                  <th>Cair B2C</th>
                  <th>Runoff</th>
                  <th>Upgrade NPF</th>
                  <th>Downgrade NPF</th>
                </tr>
            </thead>
          </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <!-- Produk B2B-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Trend Produk Nasional B2B</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="produkb2bTable" class="display nowrap" width="100%"  cellspacing="0">
            <thead>
                <tr>
                  <th>Produk</th>
                  <th>Juli 2018</th>
                  <th>Agustus 2018</th>
                </tr>
            </thead>
          </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <!-- Produk B2C-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Trend Produk Nasional B2C</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="produkb2cTable" class="display nowrap" width="100%"  cellspacing="0">
            <thead>
                <tr>
                  <th>Produk</th>
                  <th>Juli 2018</th>
                  <th>Agustus 2018</th>
                </tr>
            </thead>
          </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>



         <!-- Sektor B2B-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Trend Sektor Nasional B2B</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="sektorb2bTable" class="display nowrap" width="100%"  cellspacing="0">
            <thead>
                <tr>
                  <th>Sektor</th>
                  <th>Juli 2018</th>
                  <th>Agustus 2018</th>
                </tr>
            </thead>
          </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <!-- Sektor B2C-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Trend Sektor Nasional B2C</div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="sektorb2cTable" class="display nowrap" width="100%"  cellspacing="0">
            <thead>
                <tr>
                  <th>Sektor</th>
                  <th>Juli 2018</th>
                  <th>Agustus 2018</th>
                </tr>
            </thead>
          </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <!-- <tbody></tbody> -->
        </table>

         <!-- Combination Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-area-chart"></i> Portfolio Nasional 2018</div>
          <div class="card-body">
            <div id="myCombinationChart" style="height: 300px; width: 100%;"></div>
            <br>
            <table border="1" width=100%>
              <thead>
                <th></th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Juli</th>
                <th>Agustus</th>
                <!-- <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th> -->
              </thead>
              <tbody>
                <tr>
                  <td>OS Pokok</td>
                  <td><?php echo $nasional_jan[0]?></td>
                  <td><?php echo $nasional_feb[0]?></td>
                  <td><?php echo $nasional_mar[0]?></td>
                  <td><?php echo $nasional_apr[0]?></td>
                  <td><?php echo $nasional_mei[0]?></td>
                  <td><?php echo $nasional_jun[0]?></td>
                  <td><?php echo $nasional_jul[0]?></td>
                  <td><?php echo $nasional[0]?></td>
                  <!-- <td></td> 
                  <td></td>
                  <td></td>
                  <td></td> -->
                  
                </tr>
                <tr>
                  <td>NPF</td>
                  <td><?php echo $nasional_jan[1]?></td>
                  <td><?php echo $nasional_feb[1]?></td>
                  <td><?php echo $nasional_mar[1]?></td>
                  <td><?php echo $nasional_apr[1]?></td>
                  <td><?php echo $nasional_mei[1]?></td>
                  <td><?php echo $nasional_jun[1]?></td>
                  <td><?php echo $nasional_jul[1]?></td>
                  <td><?php echo $nasional[1]?></td>
                  <!-- <td></td>
                  <td></td>
                  <td></td>
                  <td></td> -->
                </tr>
                <tr>
                  <td>Kol 2</td>
                  <td><?php echo $nasional_jan[2]?></td>
                  <td><?php echo $nasional_feb[2]?></td>
                  <td><?php echo $nasional_mar[2]?></td>
                  <td><?php echo $nasional_apr[2]?></td>
                  <td><?php echo $nasional_mei[2]?></td>
                  <td><?php echo $nasional_jun[2]?></td>
                  <td><?php echo $nasional_jul[2]?></td>
                  <td><?php echo $nasional[2]?></td>
                  <!-- <td></td>
                  <td></td>
                  <td></td>
                  <td></td> -->
                </tr>
                <tr>
                  <td>Kol 1</td>
                  <td><?php echo $nasional_jan[3]?></td>
                  <td><?php echo $nasional_feb[3]?></td>
                  <td><?php echo $nasional_mar[3]?></td>
                  <td><?php echo $nasional_apr[3]?></td>
                  <td><?php echo $nasional_mei[3]?></td>
                  <td><?php echo $nasional_jun[3]?></td>
                  <td><?php echo $nasional_jul[3]?></td>
                  <td><?php echo $nasional[3]?></td>
                 <!--  <td></td>
                  <td></td>
                  <td></td>
                  <td></td> -->

                </tr>
                <tr>
                  <td>% NPF</td>
                  <td><?php echo $nasional_jan[4]?></td>
                  <td><?php echo $nasional_feb[4]?></td>
                  <td><?php echo $nasional_mar[4]?></td>
                  <td><?php echo $nasional_apr[4]?></td>
                  <td><?php echo $nasional_mei[4]?></td>
                  <td><?php echo $nasional_jun[4]?></td>
                  <td><?php echo $nasional_jul[4]?></td>
                  <td><?php echo $nasional[4]?></td>
                  <!-- <td></td>
                  <td></td>
                  <td></td>
                  <td></td> -->
                </tr>
                <tr>
                  <td>% Kol 2</td>
                  <td><?php echo $nasional_jan[5]?></td>
                  <td><?php echo $nasional_feb[5]?></td>
                  <td><?php echo $nasional_mar[5]?></td>
                  <td><?php echo $nasional_apr[5]?></td>
                  <td><?php echo $nasional_mei[5]?></td>
                  <td><?php echo $nasional_jun[5]?></td>
                  <td><?php echo $nasional_jul[5]?></td>
                  <td><?php echo $nasional[5]?></td>
                  <!-- <td></td>
                  <td></td>
                  <td></td>
                  <td></td> -->
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>




        <div class="row">
          <div class="col-lg-12">
            <!-- Example Bar Chart Card-->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-bar-chart"></i> Grafik Pencairan (dalam miliar rupiah)</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8 my-auto">
                    <canvas id="myBarChart" width="100" height="50"></canvas>
                  </div>
                  <div class="col-sm-4 text-center my-auto">
                    <div class="h4 mb-0 text-secondary">Cair Bulan Ini:</div>
                    <hr>
                    <div class="h4 mb-0 text-primary">B to B</div>
                    <div class="small text-muted">Rp <?php echo $b2b_fix ?></div>
                    <hr>
                    <hr>
                    <div class="h4 mb-0 text-danger">B to C</div>
                    <div class="small text-muted">Rp <?php echo $b2c_fix ?></div>
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div>
          <div class="col-lg-4">
          </div>
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


        var b2b_awal = parseFloat(<?php echo $list_summary[0]->Cair_B2B?>);
        var b2b = b2b_awal/1000000000;
        
        var b2c_awal = parseFloat(<?php echo $list_summary[0]->Cair_B2C?>);
        var b2c = b2c_awal/1000000000;

        var b2b_awal_jan = parseFloat(<?php echo $cair_jan[0]->Cair_B2B?>);
        var b2b_jan = b2b_awal_jan/1000000000;
        
        var b2c_awal_jan = parseFloat(<?php echo $cair_jan[0]->Cair_B2C?>);
        var b2c_jan = b2c_awal_jan/1000000000;


        var b2b_awal_feb= parseFloat(<?php echo $cair_feb[0]->Cair_B2B?>);
        var b2b_feb= b2b_awal_feb/1000000000;
        
        var b2c_awal_feb= parseFloat(<?php echo $cair_feb[0]->Cair_B2C?>);
        var b2c_feb= b2c_awal_feb/1000000000;


        var b2b_awal_mar = parseFloat(<?php echo $cair_mar[0]->Cair_B2B?>);
        var b2b_mar = b2b_awal_mar/1000000000;
        
        var b2c_awal_mar = parseFloat(<?php echo $cair_mar[0]->Cair_B2C?>);
        var b2c_mar = b2c_awal_mar/1000000000;


        var b2b_awal_apr= parseFloat(<?php echo $cair_apr[0]->Cair_B2B?>);
        var b2b_apr = b2b_awal_apr/1000000000;
        
        var b2c_awal_apr= parseFloat(<?php echo $cair_apr[0]->Cair_B2C?>);
        var b2c_apr = b2c_awal_apr/1000000000;


        var b2b_awal_mei = parseFloat(<?php echo $cair_mei[0]->Cair_B2B?>);
        var b2b_mei = b2b_awal_mei/1000000000;
        
        var b2c_awal_mei = parseFloat(<?php echo $cair_mei[0]->Cair_B2C?>);
        var b2c_mei = b2c_awal_mei/1000000000;


        var b2b_awal_jun = parseFloat(<?php echo $cair_jun[0]->Cair_B2B?>);
        var b2b_jun = b2b_awal_jun/1000000000;
        
        var b2c_awal_jun = parseFloat(<?php echo $cair_jun[0]->Cair_B2C?>);
        var b2c_jun = b2c_awal_jun/1000000000;


        var b2b_awal_jul = parseFloat(<?php echo $cair_jul[0]->Cair_B2B?>);
        var b2b_jul = b2b_awal_jul/1000000000;
        
        var b2c_awal_jul = parseFloat(<?php echo $cair_jul[0]->Cair_B2C?>);
        var b2c_jul = b2c_awal_jul/1000000000;




        //for showing charts
        Chart.defaults.global.defaultFontFamily='-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',Chart.defaults.global.defaultFontColor="#292b2c"; 

        ctx=document.getElementById("myBarChart"),
        myLineChart=new Chart(ctx,{type:"bar",
          data:{labels:["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus"/*,"September","Oktober","November","Desember"*/],
          datasets:[
            {label:"Cair B2B",backgroundColor:"rgba(2,117,216,1)",
            borderColor:"rgba(2,117,216,1)",
            data:[b2b_jan.toFixed(2),b2b_feb.toFixed(2),b2b_mar.toFixed(2),b2b_apr.toFixed(2),b2b_mei.toFixed(2),b2b_jun.toFixed(2),b2b_jul.toFixed(2),b2b.toFixed(2)]},
            {label:"Cair B2C",backgroundColor:"#dc3545",
            borderColor:"#dc3545",
            data:[b2c_jan.toFixed(2),b2c_feb.toFixed(2),b2c_mar.toFixed(2),b2c_apr.toFixed(2),b2c_mei.toFixed(2),b2c_jun.toFixed(2),b2c_jul.toFixed(2),b2c.toFixed(2)]}
          ]},
          options:{scales:{xAxes:[{time:{unit:"month"},gridLines:{display:!1},ticks:{maxTicksLimit:6}}],yAxes:[{ticks:{min:0,max:300,maxTicksLimit:5},gridLines:{display:!0}}]},legend:{display:!1}}}); 

        //combination chart

        var chart = new CanvasJS.Chart("myCombinationChart", {

            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: true,
            title:{
              text: "Portfolio Nasional 2018"
            },
            subtitles: [{
              text: "Business Banking Group"
            }],
            axisX: {
              valueFormatString: "MMM"
            },
            axisY: {
              includeZero:false, 
              prefix: "",
              title: "Rp Miliar"
            },
            axisY2: {
              prefix: "",
              suffix: "%",
              title: "",
              tickLength: 0
            },
            toolTip: {
              shared: true
            },
            legend: {
              reversed: true,
              cursor: "pointer",
              itemclick: toggleDataSeries
            },     
            data: [{
            type: "stackedColumn",
            showInLegend: true,
            color: "#696661",
            name: "Kol 1",
            dataPoints: [
              { y: parseFloat(<?php echo $nasional_jan[3]?>), x: new Date(2018,0) },
              { y: parseFloat(<?php echo $nasional_feb[3]?>), x: new Date(2018,1) },
              { y: parseFloat(<?php echo $nasional_mar[3]?>), x: new Date(2018,2) },
              { y: parseFloat(<?php echo $nasional_apr[3]?>), x: new Date(2018,3) },
              { y: parseFloat(<?php echo $nasional_mei[3]?>), x: new Date(2018,4) },
              { y: parseFloat(<?php echo $nasional_jun[3]?>), x: new Date(2018,5) },
              { y: parseFloat(<?php echo $nasional_jul[3]?>), x: new Date(2018,6) },
              { y: parseFloat(<?php echo $nasional[3]?>), x: new Date(2018,7) },
              { y: 0, x: new Date(2018,8) },
              { y: 0, x: new Date(2018,9) },
              { y: 0, x: new Date(2018,10) },
              { y: 0, x: new Date(2018,11) }
            ]
            },
            {        
              type: "stackedColumn",
              showInLegend: true,
              name: "Kol 2",
              color: "#EDCA93",
              dataPoints: [
                
              { y: parseFloat(<?php echo $nasional_jan[2]?>), x: new Date(2018,0) },
              { y: parseFloat(<?php echo $nasional_feb[2]?>), x: new Date(2018,1) },
              { y: parseFloat(<?php echo $nasional_mar[2]?>), x: new Date(2018,2) },
              { y: parseFloat(<?php echo $nasional_apr[2]?>), x: new Date(2018,3) },
              { y: parseFloat(<?php echo $nasional_mei[2]?>), x: new Date(2018,4) },
              { y: parseFloat(<?php echo $nasional_jun[2]?>), x: new Date(2018,5) },
              { y: parseFloat(<?php echo $nasional_jul[2]?>), x: new Date(2018,6) },
              { y: parseFloat(<?php echo $nasional[2]?>), x: new Date(2018,7) },
                { y: 0, x: new Date(2018,8) },
                { y: 0, x: new Date(2018,9) },
                { y: 0, x: new Date(2018,10) },
                { y: 0, x: new Date(2018,11) }
              ]
            },
            {        
              type: "stackedColumn",
              showInLegend: true,
              name: "NPF",
              color: "#B6B1A8",
              dataPoints: [
              { y: parseFloat(<?php echo $nasional_jan[1]?>), x: new Date(2018,0) },
              { y: parseFloat(<?php echo $nasional_feb[1]?>), x: new Date(2018,1) },
              { y: parseFloat(<?php echo $nasional_mar[1]?>), x: new Date(2018,2) },
              { y: parseFloat(<?php echo $nasional_apr[1]?>), x: new Date(2018,3) },
              { y: parseFloat(<?php echo $nasional_mei[1]?>), x: new Date(2018,4) },
              { y: parseFloat(<?php echo $nasional_jun[1]?>), x: new Date(2018,5) },
              { y: parseFloat(<?php echo $nasional_jul[1]?>), x: new Date(2018,6) },
              { y: parseFloat(<?php echo $nasional[1]?>), x: new Date(2018,7) },
                { y: 0, x: new Date(2018,8) },
                { y: 0, x: new Date(2018,9) },
                { y: 0, x: new Date(2018,10) },
                { y: 0, x: new Date(2018,11) }
              ]
            },
            {
              type: "line",
              showInLegend: true,
              name: "% Kol 2",
              axisYType: "secondary",
              yValueFormatString: "###.## '%'",
              xValueFormatString: "MMMM",
              dataPoints: [
                { x: new Date(2018, 0), y:  parseFloat(<?php echo $nasional_jan[5]?>) },
                { x: new Date(2018, 1), y:  parseFloat(<?php echo $nasional_feb[5]?>) },
                { x: new Date(2018, 2), y:  parseFloat(<?php echo $nasional_mar[5]?>) },
                { x: new Date(2018, 3), y:  parseFloat(<?php echo $nasional_apr[5]?>) },
                { x: new Date(2018, 4), y:  parseFloat(<?php echo $nasional_mei[5]?>) },
                { x: new Date(2018, 5), y: parseFloat(<?php echo $nasional_jun[5]?>) },
                { x: new Date(2018, 6), y:  parseFloat(<?php echo $nasional_jul[5]?>) },
                { x: new Date(2018, 7), y:  parseFloat(<?php echo $nasional[5]?>) },
                { x: new Date(2018, 8), y: 0 },
                { x: new Date(2018, 9), y: 0 },
                { x: new Date(2018, 10), y: 0 },
                { x: new Date(2018, 11), y: 0 }
              ]
            },
            {
              type: "line",
              showInLegend: true,
              name: "% NPF",
              axisYType: "secondary",
              yValueFormatString: "###.##'%'",
              xValueFormatString: "MMMM",
              dataPoints: [
                { x: new Date(2018, 0), y:  parseFloat(<?php echo $nasional_jan[4]?>) },
                { x: new Date(2018, 1), y:  parseFloat(<?php echo $nasional_feb[4]?>) },
                { x: new Date(2018, 2), y:  parseFloat(<?php echo $nasional_mar[4]?>) },
                { x: new Date(2018, 3), y:  parseFloat(<?php echo $nasional_apr[4]?>) },
                { x: new Date(2018, 4), y:  parseFloat(<?php echo $nasional_mei[4]?>) },
                { x: new Date(2018, 5), y: parseFloat(<?php echo $nasional_jun[4]?>) },
                { x: new Date(2018, 6), y:  parseFloat(<?php echo $nasional_jul[4]?>) },
                { x: new Date(2018, 7), y:  parseFloat(<?php echo $nasional[4]?>) },
                { x: new Date(2018, 8), y: 0 },
                { x: new Date(2018, 9), y: 0 },
                { x: new Date(2018, 10), y: 0 },
                { x: new Date(2018, 11), y: 0 }
              ]
            }]
          }

          );
          chart.render();

          function toggleDataSeries(e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              e.dataSeries.visible = false;
            } else {
              e.dataSeries.visible = true;
            }
            e.chart.render();
          }





        //for the tooltip of side navbar
        !function(e){"use strict";e('.navbar-sidenav [data-toggle="tooltip"]').tooltip({template:'<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}),e("#sidenavToggler").click(function(o){o.preventDefault(),e("body").toggleClass("sidenav-toggled"),e(".navbar-sidenav .nav-link-collapse").addClass("collapsed"),e(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show")}),e(".navbar-sidenav .nav-link-collapse").click(function(o){o.preventDefault(),e("body").removeClass("sidenav-toggled")}),e("body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse").on("mousewheel DOMMouseScroll",function(e){var o=e.originalEvent,t=o.wheelDelta||-o.detail;this.scrollTop+=30*(t<0?1:-1),e.preventDefault()}),e(document).scroll(function(){e(this).scrollTop()>100?e(".scroll-to-top").fadeIn():e(".scroll-to-top").fadeOut()}),e('[data-toggle="tooltip"]').tooltip(),e(document).on("click","a.scroll-to-top",function(o){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);

        var data_nasional = [];
        var data_review = [];
        var data_produk_b2b = [];
        var data_sektor_b2b = [];
        var data_produk_b2c = [];
        var data_sektor_b2c = [];

          <?php
          foreach ($list_summary as $summary) {
           // 
          ?>
            data_nasional.push([<?php echo"`$summary->id`,`$summary->Wilayah`,`$summary->Outstanding`,`$summary->Kol_2`,`$summary->NPF`,`$summary->Cair_B2B`,`$summary->Cair_B2C`,`$summary->Runoff`,`$summary->Upgrade`,`$summary->Downgrade`"?>]);

            data_review.push([<?php echo"`$summary->id`,`$summary->Wilayah`,`$summary->Outstanding`,`$summary->Target`,`$summary->Persen`,`$summary->Noa`,`$summary->OS_Lalu`,`$summary->Growth`,`$summary->Kol_1`,`$summary->Kol_2`,`$summary->Kol_3`,`$summary->Kol_4`,`$summary->Kol_5`, `$summary->NPF`"?>]);
          <?php    
          }
          ?>

         <?php
          foreach ($list_produk_b2b as $produk) {
           // 
          ?>
            data_produk_b2b.push([<?php echo"`$produk->nama_produk`,`$produk->Juli_2018`, `$produk->Agustus_2018`"?>]);
          <?php    
          }
          ?>

         <?php
          foreach ($list_sektor_b2b as $sektor) {
           // 
          ?>
            data_sektor_b2b.push([<?php echo"`$sektor->nama_produk`,`$sektor->Juli_2018`, `$sektor->Agustus_2018`"?>]);
          <?php    
          }
          ?>

          <?php
          foreach ($list_produk_b2c as $produk) {
           // 
          ?>
            data_produk_b2c.push([<?php echo"`$produk->nama_produk`,`$produk->Juli_2018`, `$produk->Agustus_2018`"?>]);
          <?php    
          }
          ?>

         <?php
          foreach ($list_sektor_b2c as $sektor) {
           // 
          ?>
            data_sektor_b2c.push([<?php echo"`$sektor->nama_produk`,`$sektor->Juli_2018`, `$sektor->Agustus_2018`"?>]);
          <?php    
          }
          ?>

        if ( $.fn.dataTable.isDataTable( '#reviewTable' ) ) {
            table = $('#reviewTable').DataTable();
        }
        else {
            table = $('#reviewTable').DataTable( {
            data:           data_review,
            deferRender:    true,
            scrollY:        300,
            scrollCollapse: true,
            scroller:       true,
            scrollX :       true,
            "pageLength":   20
            } );
        }



        if ( $.fn.dataTable.isDataTable( '#nasionalTable' ) ) {
            table = $('#nasionalTable').DataTable();
        }
        else {
            table = $('#nasionalTable').DataTable( {
            data:           data_nasional,
            deferRender:    true,
            scrollY:        300,
            scrollCollapse: true,
            scroller:       true,
            scrollX :       true,
            "pageLength":   20
            } );
        }

        if ( $.fn.dataTable.isDataTable( '#produkb2bTable' ) ) {
            table = $('#produkb2bTable').DataTable();
        }
        else {
            table = $('#produkb2bTable').DataTable( {
            data:           data_produk_b2b,
            deferRender:    true,
            scrollY:        300,
            scrollCollapse: true,
            scroller:       true,
            scrollX :       true,
            "pageLength":   20
            } );
        }

        if ( $.fn.dataTable.isDataTable( '#sektorb2bTable' ) ) {
            table = $('#sektorb2bTable').DataTable();
        }
        else {
            table = $('#sektorb2bTable').DataTable( {
            data:           data_sektor_b2b,
            deferRender:    true,
            scrollY:        300,
            scrollCollapse: true,
            scroller:       true,
            scrollX :       true,
            "pageLength":   20
            } );
        }


        if ( $.fn.dataTable.isDataTable( '#produkb2cTable' ) ) {
            table = $('#produkb2cTable').DataTable();
        }
        else {
            table = $('#produkb2cTable').DataTable( {
            data:           data_produk_b2c,
            deferRender:    true,
            scrollY:        300,
            scrollCollapse: true,
            scroller:       true,
            scrollX :       true,
            "pageLength":   20
            } );
        }

        if ( $.fn.dataTable.isDataTable( '#sektorb2cTable' ) ) {
            table = $('#sektorb2cTable').DataTable();
        }
        else {
            table = $('#sektorb2cTable').DataTable( {
            data:           data_sektor_b2c,
            deferRender:    true,
            scrollY:        300,
            scrollCollapse: true,
            scroller:       true,
            scrollX :       true,
            "pageLength":   20
            } );
        }

        //for the speedometer
//        var valueo =  $('#containeros').attr("value");

//        console.log(valueo+10);
        var valueos = parseFloat(<?php echo $list_summary[0]->Persen;?>);
        var valueb2b = parseFloat(<?php echo $list_pencapaian[0]->Cair_B2B;?>);
        var valueb2c = parseFloat(<?php echo $list_pencapaian[0]->Cair_B2C;?>);
        var valuekol2 = parseFloat(<?php echo $list_pencapaian[0]->Kol_2;?>);
        var valuenpf = parseFloat(<?php echo $list_pencapaian[0]->NPF;?>);
        var valueInt = 150;
  //      console.log(valueInt+10);

        $('#containeros').highcharts({

            chart: {
                type: 'gauge',
                 // Edit chart spacing
                spacingBottom: 15,
                spacingTop: 10,
                spacingLeft: 10,
                spacingRight: 10,

                // Explicitly tell the width and height of a chart
                width: null,
                height: null
            },

            title: {
                text: 'Outstanding'
            },

            pane: {
                startAngle: -90,
                endAngle: 90, 
                background: null
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 200,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '%'
                },
                plotBands: [{
                    from: 0,
                    to: 95,
                    color: '#DF5353' // red 
                }, {
                    from: 96,
                    to: 100,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 200,
                    color: '#55BF3B' // green
                }, {
                  from: 100,
                    to: 140,
                    color: '#6677ff',
                    innerRadius: '100%',
                    outerRadius: '110%'
                }]
            },

            series: [{
                name: 'Outstanding',
                data: [valueos],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

        $('#containerb2b').highcharts({

            chart: {
                type: 'gauge'
            },

            title: {
                text: 'Cair B to B'
            },

            pane: {
                startAngle: -90,
                endAngle: 90, 
                background: null
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 200,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '%'
                },
                plotBands: [{
                    from: 0,
                    to: 95,
                    color: '#DF5353' // red
                }, {
                    from: 96,
                    to: 100,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 200,
                    color: '#55BF3B' // green
                }, {
                  from: 100,
                    to: 140,
                    color: '#6677ff',
                    innerRadius: '100%',
                    outerRadius: '110%'
                }]
            },

            series: [{
                name: 'Cair',
                data: [valueb2b],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

        $('#containerb2c').highcharts({

            chart: {
                type: 'gauge'
            },

            title: {
                text: 'Cair B to C'
            },

            pane: {
                startAngle: -90,
                endAngle: 90, 
                background: null
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 200,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '%'
                },
                plotBands: [{
                    from: 0,
                    to: 95,
                    color: '#DF5353' // red
                }, {
                    from: 96,
                    to: 100,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 200,
                    color: '#55BF3B' // green
                }, {
                  from: 100,
                    to: 140,
                    color: '#6677ff',
                    innerRadius: '100%',
                    outerRadius: '110%'
                }]
            },

            series: [{
                name: 'Cair',
                data: [valueb2c],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

        $('#containerkol2').highcharts({

            chart: {
                type: 'gauge'
            },

            title: {
                text: 'Kol 2'
            },

            pane: {
                startAngle: -90,
                endAngle: 90, 
                background: null
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 200,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '%'
                },
                plotBands: [{
                    from: 0,
                    to: 95,
                    color: '#55BF3B' // green
                }, {
                    from: 96,
                    to: 100,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 200,
                    color: '#DF5353' // red 
                }, {
                  from: 0,
                    to: 40,
                    color: '#6677ff',
                    innerRadius: '100%',
                    outerRadius: '110%'
                }]
            },

            series: [{
                name: 'Kol 2',
                data: [valuekol2],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

        $('#containernpf').highcharts({

            chart: {
                type: 'gauge'
            },

            title: {
                text: 'NPF'
            },

            pane: {
                startAngle: -90,
                endAngle: 90, 
                background: null
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 200,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '%'
                },
                plotBands: [{
                    from: 0,
                    to: 95,
                    color: '#55BF3B' // green 
                }, {
                    from: 96,
                    to: 100,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 200,
                    color: '#DF5353' // red
                }, {
                  from: 0,
                    to: 40,
                    color: '#6677ff',
                    innerRadius: '100%',
                    outerRadius: '110%'
                }]
            },

            series: [{
                name: 'NPF',
                data: [valuenpf],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

        $('#containerug').highcharts({

            chart: {
                type: 'gauge'
            },

            title: {
                text: 'Upgrade NPF'
            },

            pane: {
                startAngle: -90,
                endAngle: 90, 
                background: null
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 200,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '%'
                },
                plotBands: [{
                    from: 0,
                    to: 120,
                    color: '#DF5353' // red
                }, {
                    from: 120,
                    to: 160,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 160,
                    to: 200,
                    color: '#55BF3B' // green
                }, {
                  from: 100,
                    to: 140,
                    color: '#6677ff',
                    innerRadius: '100%',
                    outerRadius: '110%'
                }]
            },

            series: [{
                name: 'Upgrade',
                data: [valueInt],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

        $('#containerdg').highcharts({

            chart: {
                type: 'gauge'
            },

            title: {
                text: 'Downgrade NPF'
            },

            pane: {
                startAngle: -90,
                endAngle: 90, 
                background: null
            },

            // the value axis
            yAxis: {
                min: 0,
                max: 200,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: '%'
                },
                plotBands: [{
                    from: 0,
                    to: 120,
                    color: '#55BF3B' // green
                }, {
                    from: 120,
                    to: 160,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 160,
                    to: 200,
                    color: '#DF5353' // red 
                }, {
                  from: 100,
                    to: 140,
                    color: '#6677ff',
                    innerRadius: '100%',
                    outerRadius: '110%'
                }]
            },

            series: [{
                name: 'Downgrade',
                data: [valueInt],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

      }); 
    </script> 
  </body>
</html>

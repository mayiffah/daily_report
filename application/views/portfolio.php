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
        echo '<br>outstanding: '.$outstanding[0]['SUM_OS'];



        ?>
        <br>
        <br>
        <br>
        Tabel Nasional
        <table class="table table-bordered">
          <thead>
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
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>Nasional</td>
              <?php echo '<td>'.$outstanding[0]['SUM_OS'].'</td>';?>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
            <tr>
              <td>2</td>
              <td>WIlayah I</td>
              <td>Outstanding</td>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Wilayah II</td>
              <td>Outstanding</td>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Wilayah III</td>
              <td>Outstanding</td>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
            <tr>
              <td>5</td>
              <td>Wilayah IV</td>
              <td>Outstanding</td>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Wilayah V</td>
              <td>Outstanding</td>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Wilayah VI</td>
              <td>Outstanding</td>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Wilayah VII</td>
              <td>Outstanding</td>
              <td>Kol 2</td>
              <td>NPF</td>
              <td>Cair B2B</td>
              <td>Cair B2C</td>
              <td>Runoff</td>
              <td>Upgrade NPF</td>
              <td>Downgrade NPF</td>
            </tr>
           
          </tbody>
        </table>
        <!-- Speedometer Outstanding -->
        <div id="containeros" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>
        <!-- Speedometer Run Off-->
        <div id="containerro" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>
        <!-- Speedometer Cair B to B -->
        <div id="containerb2b" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>

        <!-- Speedometer Cair B to C -->
        <div id="containerb2c" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>

        <!-- Speedometer Kol 2 -->
        <div id="containerkol2" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>

        <!-- Speedometer NPF -->
        <div id="containernpf" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>

        <!-- Speedometer Downgrade NPF -->
        <div id="containerug" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>


        <!-- Speedometer Upgrade NPF -->
        <div id="containerdg" style="min-width: 300px; max-width: 300px; height: 300px; margin: 0 auto" value="150">
        </div>

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
        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-area-chart"></i> Area Chart Example</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <!-- Example Bar Chart Card-->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-bar-chart"></i> Bar Chart Example</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8 my-auto">
                    <canvas id="myBarChart" width="100" height="50"></canvas>
                  </div>
                  <div class="col-sm-4 text-center my-auto">
                    <div class="h4 mb-0 text-primary">B to B</div>
                    <div class="small text-muted">Rp 34,693</div>
                    <hr>
                    <div class="h4 mb-0 text-warning">Rp 18,474</div>
                    <div class="small text-muted">YTD Expenses</div>
                    <hr>
                    <div class="h4 mb-0 text-danger">B to C</div>
                    <div class="small text-muted">Rp 16,219</div>
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
            <!-- Card Columns Example Social Feed-->
            
            <!-- /Card Columns-->
          </div>
          <div class="col-lg-4">
            <!-- Example Pie Chart Card-->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-pie-chart"></i> Pie Chart Example</div>
              <div class="card-body">
                <canvas id="myPieChart" width="100%" height="100"></canvas>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
            <!-- Example Notifications Card-->
          </div>
        </div>

         <!-- Watchlist Nasabah-->
          
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

        //for showing charts
        Chart.defaults.global.defaultFontFamily='-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',Chart.defaults.global.defaultFontColor="#292b2c"; 
        var ctx=document.getElementById("myAreaChart"),
        myLineChart=new Chart(ctx,{type:"line",
          data:{
            labels:["Mar 1","Mar 2","Mar 3","Mar 4","Mar 5","Mar 6","Mar 7","Mar 8","Mar 9","Mar 10","Mar 11","Mar 12","Mar 13"],
            datasets:[

            {label:"Upgrade NPF",lineTension:.3,backgroundColor:"rgba(2,117,216,0.2)",borderColor:"rgba(2,117,216,1)",pointRadius:5,pointBackgroundColor:"rgba(2,117,216,1)",pointBorderColor:"rgba(255,255,255,0.8)",pointHoverRadius:5,pointHoverBackgroundColor:"rgba(2,117,216,1)",pointHitRadius:20,pointBorderWidth:2,data:[1e4,30162,26263,18394,18287,28682,31274,33259,25849,24159,32651,31984,38451],},

            {label:"Downgrade NPF",lineTension:.3,backgroundColor:"rgba(40,167,69,0.2)",borderColor:"#28a745",pointRadius:5,pointBackgroundColor:"#28a745",pointBorderColor:"rgba(255,255,255,0.8)",pointHoverRadius:5,pointHoverBackgroundColor:"#28a745",pointHitRadius:20,pointBorderWidth:2,data:[2e4,25000,20000,10000,15000,25000,25000,30000,20000,20000,30000,25000,30000],},
            
            {label:"Kol 2",lineTension:.3,backgroundColor:"rgba(220,53,69,0.2)",borderColor:"#dc3545",pointRadius:5,pointBackgroundColor:"#dc3545",pointBorderColor:"rgba(255,255,255,0.8)",pointHoverRadius:5,pointHoverBackgroundColor:"#dc3545",pointHitRadius:20,pointBorderWidth:2,data:[3e4,35000,40000,32000,11100,22200,6000,3000,12000,27000,39000,20000,31000],},
            



            ]
        },options:{scales:{xAxes:[{time:{unit:"date"},gridLines:{display:!1},ticks:{maxTicksLimit:7}}],yAxes:[{ticks:{min:0,max:4e4,maxTicksLimit:5},gridLines:{color:"rgba(0, 0, 0, .125)"}}]},legend:{display:!1}}}),
        ctx=document.getElementById("myBarChart"),
        myLineChart=new Chart(ctx,{type:"bar",
          data:{labels:["January","February","March","April","May","June"],
          datasets:[
            {label:"Revenue",backgroundColor:"rgba(2,117,216,1)",
            borderColor:"rgba(2,117,216,1)",
            data:[4215,5312,6251,7841,9821,14984]},
            {label:"Revenue",backgroundColor:"#dc3545",
            borderColor:"#dc3545",
            data:[12000,5555,2222,5343,3333,12000]}

          ]},
          options:{scales:{xAxes:[{time:{unit:"month"},gridLines:{display:!1},ticks:{maxTicksLimit:6}}],yAxes:[{ticks:{min:0,max:15e3,maxTicksLimit:5},gridLines:{display:!0}}]},legend:{display:!1}}}),
        ctx=document.getElementById("myPieChart"),myPieChart=new Chart(ctx,{type:"pie",data:{labels:["Blue","Red","Yellow","Green"],datasets:[{data:[12.21,15.58,11.25,8.32],backgroundColor:["#007bff","#dc3545","#ffc107","#28a745"]}]}}); 


        //for the tooltip of side navbar
        !function(e){"use strict";e('.navbar-sidenav [data-toggle="tooltip"]').tooltip({template:'<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}),e("#sidenavToggler").click(function(o){o.preventDefault(),e("body").toggleClass("sidenav-toggled"),e(".navbar-sidenav .nav-link-collapse").addClass("collapsed"),e(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show")}),e(".navbar-sidenav .nav-link-collapse").click(function(o){o.preventDefault(),e("body").removeClass("sidenav-toggled")}),e("body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse").on("mousewheel DOMMouseScroll",function(e){var o=e.originalEvent,t=o.wheelDelta||-o.detail;this.scrollTop+=30*(t<0?1:-1),e.preventDefault()}),e(document).scroll(function(){e(this).scrollTop()>100?e(".scroll-to-top").fadeIn():e(".scroll-to-top").fadeOut()}),e('[data-toggle="tooltip"]').tooltip(),e(document).on("click","a.scroll-to-top",function(o){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);


        //for the speedometer
        var valueo =  $('#containeros').attr("value");
        console.log(valueo+10);
        var valueInt = parseInt(valueo);
        console.log(valueInt+10);

        $('#containeros').highcharts({

            chart: {
                type: 'gauge'
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
                name: 'Outstanding',
                data: [valueInt],
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        });

        $('#containerro').highcharts({

            chart: {
                type: 'gauge'
            },

            title: {
                text: 'Run Off'
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
                name: 'Run Off',
                data: [valueInt],
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
                name: 'Cair',
                data: [valueInt],
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
                name: 'Cair',
                data: [valueInt],
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
                name: 'Kol 2',
                data: [valueInt],
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
                name: 'NPF',
                data: [valueInt],
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

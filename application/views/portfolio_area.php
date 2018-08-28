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
    <title>Portfolio Area</title>

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
            <a class="nav-link" href='<?php echo base_url ('/index.php/nasional/login'); ?>'>
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Portfolio Nasional</span>
            </a>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Portfolio Area">
            <a class="nav-link" href='<?php echo base_url ('/index.php/area/portfolio_area/'.$id_jabatan.'/'.$nama_outlet);?>'>
              <i class="fa fa-fw fa-sitemap"></i>
              <span class="nav-link-text">Portfolio Area</span>
            </a>


           <?php if ($id_jabatan === '1' or $id_jabatan === '2') {?>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Watchlsit Nasional">
            <a class="nav-link" href='<?php echo base_url ('/index.php/nasional/watchlist'); ?>'>
              <i class="fa fa-eye"></i>
              <span class="nav-link-text">Watchlist Nasional</span>
            </a>
          <?php }?>

          <?php if ($id_jabatan === '1') {?>
          
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Upload Data Harian">
            <a class="nav-link" href='<?php echo base_url ('/index.php/Upload/index'); ?>'>
              <i class="fa fa-fw fa-wrench"></i>
              <span class="nav-link-text">Upload Data Harian</span>
            </a>
          <?php }?>


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
          <li class="breadcrumb-item active">Portfolio Area</li>
        </ol>

        <?php 

          if ($hide_area === false) {

          }

          if ($hide_wil === false) {

          }
        ?>

        <?php

        ?>
        <form id = "form_area" name = "form_area_name" action="<?=site_url('area/portfolio_area_baru/'.$id_jabatan.'/'.$nama_outlet);?>" method="get">
        <?php
          if ($hide_wil === false) { 
        ?>
          <div id = "div_wilayah">
            
            <label>Wilayah: </label>
            <select id="id_wilayah" name="wilayah" onchange="this.form.submit()">
              <?php
                if ($wil_ada === true) {
                  echo '<option value="0"> Pilih wilayah...</option>';
                  foreach ($list_wilayah as $wilayah) 
                  {
                    if ($wilayah->id === $wil) {
                      echo '<option value="'.$wilayah->id.'" selected="selected">'.$wilayah->nama_wilayah.'</option>';
                    } else {
                      echo '<option value="'.$wilayah->id.'">'.$wilayah->nama_wilayah.'</option>';
                    }
                    
                  }

                } else {
                  echo '<option value="0"> Pilih wilayah...</option>';
                  foreach ($list_wilayah as $wilayah) 
                  {
                    echo '<option value="'.$wilayah->id.'">'.$wilayah->nama_wilayah.'</option>';
                  }

                }
              ?>
            </select>
          </div>
        <?php
          }
        ?>

          <?php

          if ($wil_ada === true and $hide_area === false) {
            //  echo 'adaa wilayah';
          ?>
            <div id = "div_area">
            <label>Area: </label>
            <select id="id_area" name="area" onchange="this.form.submit()">

            <?php
              if ($area_ada === true) {
                  echo '<option value="0"> Pilih area...</option>';
                  foreach ($list_area as $area) 
                  {
                    if ($area->id === $ar) {
                      echo '<option value="'.$area->id.'" selected="selected">'.$area->nama_area.'</option>';
                    } else {
                      echo '<option value="'.$area->id.'">'.$area->nama_area.'</option>'; 
                    }
                    
                  }

                } else {
                  echo '<option value="0"> Pilih area...</option>';
                  foreach ($list_area as $area) 
                  {
                    echo '<option value="'.$area->id.'">'.$area->nama_area.'</option>';
                  }

                }
                ?>
              
            </select>
          </div>
          <?php
            if ($area_ada === true) {
              //  echo 'adaa area';
              ?>

            <div>
            <label>Cabang: </label>
            <select id="id_cabang" name="cabang" onchange="this.form.submit()">

            <?php
              if ($cbg_ada === true) {
                  echo '<option value="0"> Pilih cabang...</option>';
                  foreach ($list_cabang as $cabang) 
                  {
                    if ($cabang->id === $cab) {
                      echo '<option value="'.$cabang->id.'" selected="selected">'.$cabang->nama_cabang.'</option>';
                    } else {
                      echo '<option value="'.$cabang->id.'">'.$cabang->nama_cabang.'</option>';
                    }
                    
                  }

                } else {
                  echo '<option value="0"> Pilih cabang...</option>';
                  foreach ($list_cabang as $cabang) 
                  {
                    echo '<option value="'.$cabang->id.'">'.$cabang->nama_cabang.'</option>';
                  }

                }
                ?>
              
            </select>
            </div>

              <?php
            } else {
              
            }
          } elseif ($hide_area === true) {
           //hide_area === true
          ?>  
          <div>
            <label>Cabang: </label>
            <select id="id_cabang" name="cabang" onchange="this.form.submit()">

            <?php
              if ($cbg_ada === true) {
                  echo '<option value="0"> Pilih cabang...</option>';
                  foreach ($list_cabang as $cabang) 
                  {
                    if ($cabang->id === $cab) {
                      echo '<option value="'.$cabang->id.'" selected="selected">'.$cabang->nama_cabang.'</option>';
                    } else {
                      echo '<option value="'.$cabang->id.'">'.$cabang->nama_cabang.'</option>';
                    }
                    
                  }

                } else {
                  echo '<option value="0"> Pilih cabang...</option>';
                  foreach ($list_cabang as $cabang) 
                  {
                    echo '<option value="'.$cabang->id.'">'.$cabang->nama_cabang.'</option>';
                  }

                }
                ?>
              
            </select>
            </div>
<?php          }
            


          ?>
          
        </form>

        <?php if (($wil_ada === true and $hide_wil === false) || ($area_ada === true and $hide_area === false) || $cbg_ada === true) {

 
          $b2b_awal_ = floatval($cair_b2b );
          $b2b_fix = number_format($b2b_awal_/1000000000, 2);

          $b2c_awal_ = floatval($cair_b2c );
          $b2c_fix = number_format($b2c_awal_/1000000000, 2);




          ?>


         <h1 align="center"><?php echo $isi_header?></h1>
         <div>
           Business Banking Relationship Manager (BBRM):
           <?php
            if (sizeof($list_bbrm) == 0) {
              echo '<br> Tidak ada BBRM';
            } else {
              foreach($list_bbrm as $bbrm) {
              echo '<br>'.$bbrm->nip_bbrm.' - '.$bbrm->nama_bbrm;

             }
            }
           ?>
         <br>
         <br>  
         </div>
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
<!-- 
        <div style="width: 700px; overflow: hidden; margin: 0 auto;">
          
          <div id="containerug" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>

          <div id="containerdg" style="min-width: 300px; max-width: 300px; height: 300px; float:left;" value="150">
          </div>
        </div> -->
        <!-- Icon Cards-->
        
         <!-- Nasional -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Ringkasan </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="ringkasanTable" class="display nowrap" width="100%"  cellspacing="0">
            <thead>
                <tr>
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
            <tbody> 
                <tr>
                  <td><?php echo $outstanding ?></td>
                  <td><?php echo $kol2 ?></td>
                  <td><?php echo $npf ?></td>
                  <td><?php echo $cair_b2b ?></td>
                  <td><?php echo $cair_b2c ?></td>
                  <td><?php echo $runoff ?></td>
                  <td><?php echo $upgrade ?></td>
                  <td><?php echo $downgrade ?></td>
                  
                </tr>
            </tbody>
          </table>
            </div>
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
                    <div class="h4 mb-0 text-primary">B to B</div>
                    <div class="small text-muted">Rp <?php echo $b2b_fix ?></div>
                    <hr>
                    <div class="h4 mb-0 text-warning"></div>
                    <div class="small text-muted"></div>
                    <hr>
                    <div class="h4 mb-0 text-danger">B to C</div>
                    <div class="small text-muted">Rp <?php echo $b2c_fix ?></div>
                  </div>
                </div>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div>



        </div>
        
      </div>


    <?php }?>
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
              <a class="btn btn-primary" href='<?php echo base_url ('/index.php/nasional/logout'); ?>'>Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript"> 

      

      $(document).ready(function () {


        <?php if ($wil_ada === true || $area_ada === true || $cbg_ada === true) { ?>
        var b2b_awal = parseFloat(<?php echo $cair_b2b ?>);
        var b2b = b2b_awal/1000000000;
        
        var b2c_awal = parseFloat(<?php echo $cair_b2c ?>);
        var b2c = b2c_awal/1000000000;
        //for showing charts
        Chart.defaults.global.defaultFontFamily='-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',Chart.defaults.global.defaultFontColor="#292b2c";




        var ctx=document.getElementById("myBarChart"),
        myLineChart=new Chart(ctx,{type:"bar",
          data:{labels:[/*"Januari","Februari","Maret","April","Mei",*/"Agustus"/*,"Juli","Agustus","September","Oktober","November","Desember"*/],
          datasets:[
            {label:"Cair B2B",backgroundColor:"rgba(2,117,216,1)",
            borderColor:"rgba(2,117,216,1)",
            data:[b2b.toFixed(2)]},
            {label:"Cair B2C",backgroundColor:"#dc3545",
            borderColor:"#dc3545",
            data:[b2c.toFixed(2)]}
          ]},
          options:{scales:{xAxes:[{time:{unit:"month"},gridLines:{display:!1},ticks:{maxTicksLimit:6}}],yAxes:[{ticks:{min:0,max:15,maxTicksLimit:5},gridLines:{display:!0}}]},legend:{display:!1}}});


        //for the tooltip of side navbar
        !function(e){"use strict";e('.navbar-sidenav [data-toggle="tooltip"]').tooltip({template:'<div class="tooltip navbar-sidenav-tooltip" role="tooltip" style="pointer-events: none;"><div class="arrow"></div><div class="tooltip-inner"></div></div>'}),e("#sidenavToggler").click(function(o){o.preventDefault(),e("body").toggleClass("sidenav-toggled"),e(".navbar-sidenav .nav-link-collapse").addClass("collapsed"),e(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show")}),e(".navbar-sidenav .nav-link-collapse").click(function(o){o.preventDefault(),e("body").removeClass("sidenav-toggled")}),e("body.fixed-nav .navbar-sidenav, body.fixed-nav .sidenav-toggler, body.fixed-nav .navbar-collapse").on("mousewheel DOMMouseScroll",function(e){var o=e.originalEvent,t=o.wheelDelta||-o.detail;this.scrollTop+=30*(t<0?1:-1),e.preventDefault()}),e(document).scroll(function(){e(this).scrollTop()>100?e(".scroll-to-top").fadeIn():e(".scroll-to-top").fadeOut()}),e('[data-toggle="tooltip"]').tooltip(),e(document).on("click","a.scroll-to-top",function(o){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);


         //for the speedometer
        var valueos = parseFloat(<?php echo $target_os;?>);
        var valueb2b = parseFloat(<?php echo $target_b2b;?>);
        var valueb2c = parseFloat(<?php echo $target_b2c;?>);
        var valuekol2 = parseFloat(<?php echo $target_kol2;?>);
        var valuenpf = parseFloat(<?php echo $target_npf;?>);
        var valueInt = 150;




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
                max: 500,

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
                    to: 160,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 500,
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
                max: 500,

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
                    to: 160,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 500,
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
                max: 500,

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
                    to: 160,
                    color: '#DDDF0D' // yellow
                }, {
                    from: 101,
                    to: 500,
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
                max: 500,

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
                    to: 500,
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
                max: 500,

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
                    to: 500,
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

      <?php } ?>
      }); 
    </script> 
  </body>
</html>

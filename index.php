<!DOCTYPE html>
<html idmmzcc-ext-docid="381802496" class="csstransforms csstransforms3d csstransitions" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="Dinas Kependudukan dan Pencatatan Sipil Kota Bandung">
    <meta name="author" content="Dianyanzen">
    <meta name="keywords" content="Dinas Kependudukan dan Pencatatan Sipil KOTA BANDUNG, Dinas, Kependudukan, Pencatatan Sipil, KOTA BANDUNG, BANDUNG, KTP-el, Kartu Keluarga, KTP, e-KTP, Akta, Akta Kelahiran, Akta Perkawinan, Akta Perceraian, Akta Kematian, Penduduk">
        
    <!--<link rel="shortcut icon" href="http://disdukcapil.bandung.go.id/assets/img/favicon.jpg">-->

    <title>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA BANDUNG</title>

    <!-- Bootstrap core CSS -->
    <link rel="shortcut icon" href="./logo.png" />	
	
    <!-- Font Awesome -->

        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

        <link href="assets/css/css.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="assets/css/metro-bootstrap.css" type="text/css">
        <link rel="stylesheet" href="assets/css/bootstrap_002.css" type="text/css">
        <link rel="stylesheet" href="assets/css/font-awesome/css/font-awasome.css" type="text/css">
		 <!--<link href="assets/css/font-family.css:300,600" rel="stylesheet" type="text/css">-->
        
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
<style type="text/css">
body {
    overflow:hidden;
}
</style>
        <!-- Scripts are at the bottom of the page -->
 <?php
Include('config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
$nowdate = date("d/m/Y");
session_start();
?>
    </head>
    <body class="vertical">

        <!-- BACKGROUND -->
        <img src="assets/img/bg.jpg" width="100%" class="background bgwidth" alt="">
        <!-- /BACKGROUND -->
			<div align='left'class="header">
           
               <img src="assets/img/LOGO.png" class="header-logo" alt="" width="10%"/>
			</div>
        <!-- LOGO -->
        <div align='center 'class="header">
           
               <!--img src="assets/img/LOGO.png" height="10" width="10%" style="margin:10px 0px" class="header-logo" alt=""/-->
			   <h1>MONITORING AKTIFITAS PELAYANAN</h1>
			   <h1>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA BANDUNG</h1>
			   <!--<div class="example1">
<h3>Disduk Capil</h3>
</div>-->

<!-- Styles -->	


<!-- HTML -->	

            
			</div>

        <!-- /LOGO -->

        <!-- MAIN CONTENT SECTION -->
         <section id="content">

            <!-- SECTION -->
            <section class="clearfix section" id="home">

                <!-- SECTION TITLE -->
               <?php
					date_default_timezone_set("Asia/Jakarta");
					$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
					$hari = $array_hari[date("N")];
					//Format Tanggal
					$tanggal = date ("j");

					//Array Bulan
					$array_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
					$bulan = $array_bulan[date("n")];

					//Format Tahun
					$tahun = date("Y");
					
					//echo "The time is " . date("h:i:sa");
					
					//echo "Today is " . date("Y.m.d") . "<br>";
					//echo "Today is " . date("Y-m-d") . "<br>";
					//echo "Today is " . date("l");
					?>
                <h3 class="block-title" style="font-family:'Courier New'"><?PHP echo "<font color='white'>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</FONT>"; ?></h3>
                <!-- /SECTION TITLE -->

                <!-- SECTION TILES -->
				<div class="tile transparent w2 h1 title-horizontalcenter icon-featurefade">
                    <a class="link" href="pages/indexkktable.php">
                        <i class="icon-tasks icon-1x"> <span id='n_rkk'>0</span></i>
                        <p class="title">Kartu Keluarga</p>
                    </a>
                </div>
                <div class="tile transparent w2 h1 title-horizontalcenter icon-scaleuprotate360cw">
                    <a class="link" href="pages/indexbiodata.php">
                        <i class="icon-1x icon-edit"> <span id='n_rbio'>0</span></i>
                        <p class="title">Biodata</p>
						
                    </a>
                </div>

                <div class="tile transparent w2 h1 icon-featurecw title-fadeout">
                    <a href="pages/indexpindah.php" class="link">
                        <i class="icon-upload icon-1x"> <span id='n_rpindah'>0</span>(<span id='n_rpindahd'>0</span>)</i>
                        <p class="title">Surat Pindah</p>
                    </a>
                </div>

                <div class="tile transparent title-verticalcenter icon-flip w2 h1">
                     <a class="link" href="pages/indexdatang.php">
                        <i class="icon-download icon-1x"> <span id='n_rdatang'>0</span>(<span id='n_rdatangd'>0</span>)</i>
                        <p class="title">Surat Kedatangan</p>
                    </a>
                </div>
				<div class="tile transparent title-horizontalcenter icon-featurefade w2 h1">
                    <a class="link"  href="pages/indexlahir.php">
                        <i class="icon-plus-sign icon-1x"> <span id='n_rlahir'>0</span></i>
                        <p class="title">Akta Kelahiran</p>
                    </a>
                </div>
				<div class="tile transparent title-fadeout icon-scaleuprotate360cw w2 h1">
                    <a class="link"href="pages/indexmati.php">
                        <i class="icon-minus-sign icon-1x"> <span id='n_rmati'>0</span></i>
                        <p class="title">Akta Kematian</p>
                    </a>
                </div>
				<div class="tile transparent title-fadeout icon-scaleuprotate360cw w2 h1">
                    <a class="link" href="pages/indexcerai.php">
                        <i class="icon-heart-empty icon-1x"> <span id='n_rcerai'>0</span></i>
                        <p class="title">Akta Perceraian</p>
                    </a>
                </div>
				
				<div class="tile transparent w2 h1 icon-featurecw title-fadeout">
                    <a class="link" href="pages/indexkawin.php">
                        <i class="icon-heart icon-1x"> <span id='n_rkawin'>0</span></i>
                        <p class="title">Akta Perkawinan</p>
                    </a>
                </div>
				<div class="tile transparent title-horizontalcenter icon-featurefade w2 h1">
                    <a class="link"  href="pages/si_kependudukan/rekam.php">
                        <i class="icon-camera-retro icon-1x"> <span id='n_rrekam'>0</span></i>
                        <p class="title">Perekaman KTP-EL</p>
                    </a>
                </div>
				<div class="tile transparent title-fadeout icon-scaleuprotate360cw w2 h1">
                    <a class="link"href="pages/si_kependudukan/cetak.php">
                        <i class="icon-credit-card icon-1x"> <span id='n_rcetak'>0</span></i>
                        <p class="title">Pencetakan KTP-EL</p>
                    </a>
                </div>
				<div class="tile transparent title-fadeout icon-scaleuprotate360cw w2 h1">
                    <a class="link" href="pages/indexkia.php">
                        <i class="icon-pencil icon-1x"> <span id='n_rkia'>0</span></i>
                        <p class="title">KIA</p>
                    </a>
                </div>
				
				<div class="tile transparent w2 h1 icon-featurecw title-fadeout">
                    <a class="link" href="pages/indexoperator.php">
                        <i class="icon-group icon-1x"> <span id='n_ropr'>0</span></i>
                        <p class="title">Aktivitas Operator</p>
                    </a>
                </div>
		
				
                <!-- /SECTION TILES -->

            </section>
            <!-- /SECTION -->
        </section> 
        <!-- /MAIN CONTENT SECTION -->

        <!-- LOCKSCREEN -->
        <section class="mlightbox" id="lockscreen">
            <div id="lockscreen-content">
                <img src="img/logo.png" height="109" width="140" id="locklogo"  alt="Metromega"/>
                <br/><br/>
                <img src="img/preloader.gif" id="lockloader"  alt="Loading.."/>
            </div>
        </section>
        <!-- /LOCKSCREEN -->


        <!-- PRELOADER -->
        <section class="mlightbox" id="loader">
            <a href="#">
                <img src="img/preloader.gif" alt="Loading.."/>
            </a>
        </section>
        <!-- /PRELOADER -->

        <!-- GALLERY LIGHTBOX --
        <section class="mlightbox" id="galleryimage">
            <section class="mlightbox-content">
                <img src="#"  alt=""/>
            </section>
            <section class="mlightbox-details">
                <div class="mlightbox-description">
                    <h2 class='mlightbox-title'></h2>
                    <p class="mlightbox-subtitle muted">by Dianyanzen</p>
                </div>
                <ul class="mlist">
                    <li><a class="close-mlightbox" href="#"><i class="icon-arrow-left"></i> Kembali</a></li>
                    
                </ul>
            </section>
        </section>
        <!-- /GALLERY LIGHTBOX -->

        <!-- VIDEO LIGHTBOX --
        <section class="mlightbox" id="galleryvideo">
            <section class="mlightbox-content">
                <div class="fitvideo">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/z_VHMeJvIwA?modestbranding=1"></iframe>
                </div>
            </section>
            <section class="mlightbox-details">
                <div class="mlightbox-description">
                    <h2 class='mlightbox-title'></h2>
                    <p class="mlightbox-subtitle muted">by Dianyanzen</p>
                </div>
                <ul class="mlist">
                    <li><a href="index.php"><i class="icon-arrow-left"></i> Kembali</a></li>
                </ul>
            </section>
        </section>
        <!-- /VIDEO LIGHTBOX -->
   <!-- SIDEBAR -->
        <div id="opensidebar"><i class="icon-3x">+</i></div>
        <section id="sidebar" class="htmltile">
            <ul>
                <li></li>
                <li><a href="index.php" ><i class="icon-home icon-3x"></i></a></li>
				<li><a href="pages/index.php" ><i class="icon-info-sign icon-3x"></i></a></li>
				<li><a href="pages/stdisduk.php" ><i class="icon-bar-chart icon-3x"></i></a></li>
				<li><a href="pages/tbdisduk.php" ><i class="icon-table icon-3x"></i></a></li>
				<li><a href="../antrian" ><i class="icon-envelope icon-3x"></i></a></li>
            </ul>
        </section>
        <!-- BLOG LIGHTBOX -->
        <section class="mlightbox" id="blogpost">
            <section class="blogpost-content">
            </section>
            <section class="blogpost-details">
            </section>
        </section>
        <!-- /BLOG LIGHTBOX -->

        <div class="fit-vids-style" id="fit-vids-style" style="display: none;">­<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style></div><script src="assets/js/jquery-latest.js" type="text/javascript"></script> <!-- jQuery Library -->
        <script src="assets/js/respond.js" type="text/javascript"></script> <!-- Responsive Library -->
        <script src="assets/js/jquery.js" type="text/javascript"></script> <!-- Isotope Layout Plugin -->
        <script src="assets/js/jquery_004.js" type="text/javascript"></script> <!-- jQuery Mousewheel -->
        <script src="assets/js/jquery_002.js" type="text/javascript"></script> <!-- malihu Scrollbar -->
        <script src="assets/js/tileshow.js" type="text/javascript"></script> <!-- Metromega Custom Tileshow Plugin -->
        <script src="assets/js/jquery_005.js" type="text/javascript"></script> <!-- jQuery TouchSwipe Plugin -->
        <script src="assets/js/mlightbox.js" type="text/javascript"></script> <!-- Metromega Custom Lightbox Plugin -->
        <script src="assets/js/jquery_003.js" type="text/javascript"></script> <!-- jQuery fitVids Plugin -->
        <script src="assets/js/lockscreen.js" type="text/javascript"></script> <!-- Metromega Lockscreen -->
        <script src="assets/js/bootstrap.js" type="text/javascript"></script> <!-- Bootstrap Library -->

        <script src="assets/js/script.js" type="text/javascript"></script> <!-- Metromega Script -->
		<script src="js/canvasjs.min.js" type="text/javascript"></script> <!-- Metromega Script -->
		<script src="js/moment.min.js" type="text/javascript"></script> <!-- Metromega Script -->
		<script>
		$(document).ready(function() {
    var interval = setInterval(function() {
		var month = new Array();
		month[0] = "Januari";
		month[1] = "Februari";
		month[2] = "Maret";
		month[3] = "April";
		month[4] = "Mei";
		month[5] = "Juni";
		month[6] = "Juli";
		month[7] = "Agustus";
		month[8] = "September";
		month[9] = "Oktober";
		month[10] = "November";
		month[11] = "Desember";
		var weekday = new Array(7);
	    weekday[0] = "Minggu";
	    weekday[1] = "Senin";
	    weekday[2] = "Selasa";
	    weekday[3] = "Rabu";
	    weekday[4] = "Kamis";
	    weekday[5] = "Jumat";
	    weekday[6] = "Sabtu";
    var d = new Date();
	var x = weekday[d.getDay()];
    var n = month[d.getMonth()];
        var momentNow = moment();
        $('#date-part').html(' '
                            + momentNow.format('DD') + ' '
                            + n + momentNow.format('YYYY'));
        $('#time-part').html( ' '
                            + momentNow.format('hh:mm:ss'));
		 $('#day-part').html( ' '
                            + x );
    }, 100);
});
				</script>
		<!--script>
			// setTimeout(function(){
			// location = ''
			// },60000)
		</script-->
		<script>
	setInterval(function(){
	$("#n_rkk").load('count_kk.php'),
	$("#n_rbio").load('count_bio.php'),
	$("#n_rpindah").load('count_pndh.php'),
	$("#n_rpindahd").load('count_pndh_d.php'),
	$("#n_rdatang").load('count_dtg.php'),
	$("#n_rdatangd").load('count_dtg_d.php'),
	$("#n_rlahir").load('count_lahir.php'),
	$("#n_rmati").load('count_mati.php'),
	$("#n_rkawin").load('count_kawin.php'),
	$("#n_rcerai").load('count_cerai.php'),
	$("#n_rrekam").load('count_perekaman.php'),
	$("#n_rcetak").load('count_pencetakan.php'),
	$("#n_rkia").load('count_kia.php'),
	$("#n_ropr").load('count_opr.php')
	}, 10000);

	</script>		
    
</body></html>
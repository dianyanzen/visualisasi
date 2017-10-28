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
		 <link href="assets/css/font-family.css:300,600" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">

        <!-- Scripts are at the bottom of the page -->
 <?php
Include('subhtml/login/admin/config/connect223.php');
?>
    </head>
    <body class="vertical">

        <!-- BACKGROUND -->
        <img src="assets/img/bg.jpg" class="background bgwidth" alt="">
        <!-- /BACKGROUND -->

        <!-- LOGO -->
        <div align='center 'class="header">
           
               <img src="assets/img/head.png" height="120" width="1055" style="margin:10px 0px" class="header-logo" alt=""/>

            
			</div>
        <!-- /LOGO -->

        <!-- MAIN CONTENT SECTION -->
         <section id="content">

               <!-- SECTION -->
            <section class="clearfix section" id="data_disduk">

                <!-- SECTION TITLE -->
                <h3 class="block-title">Data</h3>
                <!-- /SECTION TITLE -->
				<div class="tile blue w2 h1 icon-featurecw title-fadeout">
                    <a class="link" href="subhtml/cek_nik">
                        <i class="icon-credit-card icon-1x"></i>
                        <p class="title">Cek NIK</p>
                    </a>
                </div>
				<div class="tile red w2 h1 icon-featurecw title-fadeout">
                    <a class="link" href="subhtml/cek_kk">
                        <i class="icon-credit-card icon-1x"></i>
                        <p class="title">Cek KK</p>
                    </a>
                </div>
				<div class="tile orange w2 h1 icon-featurecw title-fadeout">
                    <a class="link" href="subhtml/cek_ktp_el">
                        <i class="icon-credit-card icon-1x"></i>
                        <p class="title">Cek KTP-EL</p>
                    </a>
                </div>
                <!-- SECTION TILES -->
				<div class="tile blue htmltile w4 h3">
                    <div class="tilecontent">
                        <div class="content">
                            <div class="pull-right">
                                <a class="icon-bar-chart icon-4x"></a>
                            </div>
                            <h2>Data Penduduk</h2>
                            <h4>DisdukCapil Kota Bandung</h4>
                            <br/>

                            <div class="row-fluid">
                                <div class="span12">
                                   <?php
Include('subhtml/login/admin/config/connect223.php');
		$BULAN = date("m/Y");
		//$sql= "select * from tbpenduduk";
		$sql= "SELECT * FROM T5_STT_AGR_PENDUDUK WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0)
	   {
		query_stat_1();
        }
	  	   else
	   {
			echo "<table class='table table-bordered'>\n";
			echo "<tr class='success'><td colspan='3' align='center'>Terjadi Kesalahan Pada Server, Silahkan Muat Ulang</td><tr>";
			echo "</table>\n";
		}	
							
function query_stat_1() {
Include('subhtml/login/admin/config/connect223.php');
	date_default_timezone_set("Asia/Jakarta");
		$BULAN = date("m/Y");
	$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.DAK_LK) AS P3,SUM(b.DAK_LP) AS P4, SUM(b.DAK_LK) +SUM(b.DAK_LP) AS P5
									FROM SETUP_KEC a INNER JOIN T5_STT_AGR_PENDUDUK b
									ON a.NO_KEC=b.NO_KEC  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
	$stmt = oci_parse($conn, $sql);
	oci_execute($stmt);
echo "<table class='table table-bordered'>\n";
echo "<thead>";
echo "<tr class='success'>";
echo "<td align='center'><b>NO</b></td>";
echo "<td align='center'><b>KECAMATAN</b></td>";
echo "<td align='center'><b>JUMLAH</b></td>";                    
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$count = 1;
while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
echo "<tr>";
echo "<td align='center'>".$count.".</td>\n";
echo "<td>".htmlentities($row['P2'])."</td>\n";
echo "<td align='center'>".number_format(htmlentities($row['P5']),0,',','.')."</td>\n";
echo "</tr>";
$count=$count+1;
}
echo "</tbody>\n";
$sql= "SELECT  SUM(DAK_LK)+SUM(DAK_LP) AS P5 FROM T5_STT_AGR_PENDUDUK WHERE NO_PROP='32' AND NO_KAB ='73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
$row = oci_fetch_array($stmt);
echo "<tfoot>\n";
echo "<tr class='success'>\n";
echo "<td colspan='2' align='center'><b>JUMLAH</b></td>\n";
echo "<td align='center'>".number_format(htmlentities($row['P5']),0,',','.')."</td>\n";
echo "</tr>\n";
echo "</tfoot>\n";
echo "</table>\n";
				
                   

}
?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="tile blue htmltile w4 h3">
                    <div class="tilecontent">
                        <div class="content">
                            <div class="pull-right">
                                <a class="icon-bar-chart icon-4x"></a>
                            </div>
                            <h2>Data Keluarga</h2>
                            <h4>DisdukCapil Kota Bandung</h4>
                            <br/>

                            <div class="row-fluid">
                                <div class="span12">
                                     <?php
Include('subhtml/login/admin/config/connect223.php');
date_default_timezone_set("Asia/Jakarta");
		$BULAN = date("m/Y");
		$sql= "SELECT * FROM T5_KEPKEL_KELAMIN WHERE BLN >= TO_DATE('".$BULAN."','/MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy') +1 ";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	    $num_rows=oci_fetch($stmt);
	   if($num_rows>0)
	   {
		query_stat_2();
        }
	  	   else
	   {
			echo "<table class='table table-bordered'>\n";
			echo "<tr class='success'><td colspan='3' align='center'><b>Sangat Disayangkan Data Tidak Dapat Ditampilkan</b></td><tr>";
			echo "</table>\n";
		}	
							
function query_stat_2() {
	Include('subhtml/login/admin/config/connect223.php');
		date_default_timezone_set("Asia/Jakarta");
		$BULAN = date("m/Y");
	$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(b.LK) AS P3, SUM(b.LP) AS P4, SUM(b.LK)+SUM(b.LP) AS P5
									FROM SETUP_KEC a INNER JOIN T5_KEPKEL_KELAMIN b
									ON a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
	$stmt = oci_parse($conn, $sql);
	oci_execute($stmt);
echo "<table class='table table-bordered'>\n";
echo "<thead>";
echo "<tr class='success'>";
echo "<td align='center'><b>NO</b></td>";
echo "<td align='center'><b>KECAMATAN</b></td>";
echo "<td align='center'><b>JUMLAH</b></td>";                    
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$count = 1;
while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
echo "<tr>";
echo "<td align='center'>".$count.".</td>\n";
echo "<td>".htmlentities($row['P2'])."</td>\n";
echo "<td align='center'>".number_format(htmlentities($row['P5']),0,',','.')."</td>\n";
echo "</tr>";
$count=$count+1;
}
echo "</tbody>\n";
		$sql= "SELECT  SUM(LK)+SUM(LP) AS P5 FROM T5_KEPKEL_KELAMIN WHERE NO_PROP='32' AND NO_KAB ='73' and BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
$row = oci_fetch_array($stmt);
echo "<tfoot>\n";
echo "<tr class='success'>\n";
echo "<td colspan='2' align='center'><b>JUMLAH</b></td>\n";
echo "<td align='center'>".number_format(htmlentities($row['P5']),0,',','.')."</td>\n";
echo "</td>\n";
echo "</tr>\n";
echo "</tfoot>\n";
echo "</table>\n";
}
?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				
		</section>
		

            
            
        </section> 
        <!-- /MAIN CONTENT SECTION -->

        <!-- LOCKSCREEN 
        <section class="mlightbox" id="lockscreen">
            <div id="lockscreen-content">
                <img src="img/logo.png" height="109" width="140" id="locklogo"  alt="Metromega"/>
                <br/><br/>
                <img src="img/preloader.gif" id="lockloader"  alt="Loading.."/>
            </div>
        </section>
        <!-- /LOCKSCREEN -->

        <!-- SIDEBAR -->
        <div id="opensidebar"><i class="icon-3x">+</i></div>
        <section id="sidebar" class="htmltile">
            <ul>
                <li></li>
                <li><a href="index.php" ><i class="icon-arrow-left icon-1x"></i><B> KEMBALI</B></a></li>
            </ul>
        </section>
        <!-- /SIDEBAR -->

        <!-- PRELOADER -
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
                            + n );
        $('#time-part').html( ' '
                            + momentNow.format('hh:mm:ss'));
		 $('#day-part').html( ' '
                            + x );
    }, 100);
});
				</script>	
    
</body></html>
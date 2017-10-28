<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Dinas Kependudukan dan Pencatatan Sipil Kota Bandung">
    <meta name="author" content="Dianyanzen">
    <meta name="keywords" content="Dinas Kependudukan dan Pencatatan Sipil KOTA BANDUNG, Dinas, Kependudukan, Pencatatan Sipil, KOTA BANDUNG, BANDUNG, KTP-el, Kartu Keluarga, KTP, e-KTP, Akta, Akta Kelahiran, Akta Perkawinan, Akta Perceraian, Akta Kematian, Penduduk">
        
    <!--<link rel="shortcut icon" href="http://disdukcapil.bandung.go.id/assets/img/favicon.jpg">-->

    <title>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA BANDUNG</title>

    <!-- Le styles -->
	<link rel="shortcut icon" href="../../logo.png" />	
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/font-style.css" rel="stylesheet">
    <link href="assets/css/flexslider.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
	<script type="text/javascript" src="assets/js/jquery-latest.js"></script>
	

    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


  	<!-- Google Fonts call. Font Used Open Sans & Raleway -->

	<link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script>
	setInterval(function(){
	$("#n_rkk").load('../../count_kk.php'),
	$("#n_rbio").load('../../count_bio.php'),
	$("#n_rpindah").load('../../count_pndh.php'),
	$("#n_rpindahd").load('../../count_pndh_d.php'),
	$("#n_rdatang").load('../../count_dtg.php'),
	$("#n_rdatangd").load('../../count_dtg_d.php'),
	$("#n_rlahir").load('../../count_lahir.php'),
	$("#n_rmati").load('../../count_mati.php'),
	$("#n_rkawin").load('../../count_kawin.php'),
	$("#n_rcerai").load('../../count_cerai.php'),
	$("#n_rrekam").load('../../count_perekaman.php'),
	$("#n_rcetak").load('../../count_pencetakan.php'),
	$("#n_rkia").load('../../count_kia.php'),
	$("#n_ropr").load('../../count_opr.php'),
	$("#timeline").load('timeline.php')
	}, 10000);

	</script>
<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});

</script>


    
  </head>
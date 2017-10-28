<!DOCTYPE html>
<html lang="en">
<?php ob_start(); ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="@DianYanzen">

    <title>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA BANDUNG</title>

	<!-- Yanzen core Sc -->
    <link rel="shortcut icon" href="../logo.png" />	
	
    <!-- Bootstrap Core CSS -
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link rel="stylesheet" id="unitedthemes-style-css" href="style/style_003.css" type="text/css" media="all">
<style>

body {
    background-position: left top;
    background-image: url(../images/disduk.jpg);
    background-repeat: no-repeat;
	   background-size:cover;
}
</style>
<style>
a:link, a:visited {
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}


a:hover, a:active {
    background-color: red;
}
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 20%;
    border-radius: 25%;
}

.container {
    padding: 16px;
}

span.password {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}


</style>
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
.btn-merah {
	background-color: #f44336;
}


/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
	color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
}
.successbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #4CAF50;
	color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 20%;

}



span.password {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 40px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 2% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 90%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.closex {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.closex:hover,
.closex:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.password {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
	.successbtn {
       width: 100%;
    }
}
</style>
</head>

<body>

 <div id="id01" class="modal">
 
                <form class="modal-content animate" name="form_login" method="post" action="login.php" role="form" width='100%'>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="closex" title="Close Modal">&times;</span>
      <img src="avatar.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
	
       <fieldset>
                                <div class="form-group">
								<label> Masukan Nama Pengguna Anda </label>
                                    <input class="form-control" placeholder="Nama Pengguna" name="user" type="user" autofocus required x-moz-errormessage="Masukan Nama Pengguna">
                                </div>
                                <div class="form-group">
								<label> Masukan Kata Sandi Anda </label>
                                    <input class="form-control" placeholder="Kata Sandi" name="passcode" type="password" value="" required x-moz-errormessage="Masukan Kata Sandi">
                                </div>
								 <div class="form-group">
								<div class="col-lg-6">
                                <button type="submit" id="submit" name="submit" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">Login</button>
								</div>
								<div class="col-lg-6">
                                      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-success btn-lg btn-block btn-merah">Batal</button>
								</div>
								</div>
							
		</fieldset>
    </div>
	<hr>
  </form>
                </div>
                                
            </div>
        </div><!-- close hero-holder -->
    </div>		
<section id="ut-hero" class="hero ha-waypoint parallax-section parallax-background animated-undefined" data-animate-up="ha-header-hide" data-animate-down="ha-header-hide">
    
        
        <div class="parallax-scroll-container" style="transform: translate3d(0px, 0px, 0px);"></div>
        <canvas data-strokecolor="255,242,0" id="ut-animation-canvas" width="100%" height="500"></canvas>     
<div class="grid-container">
        <!-- hero holder -->
        <div class="hero-holder grid-100 mobile-grid-100 tablet-grid-100 ut-hero-style-1" style="opacity: 1;">
            <div class="hero-inner" style="text-align:center;">                
                                    <div class="hth"><h1 class="hero-title ut-glow"><span><font color="#FFF000">Login DisdukCapil Kota Bandung</font></span></h1></div>
                                
                                
                                    
                    <span class="hero-btn-holder">
                        <form action="../../../../index.php" >
                       <button onclick="document.getElementById('id01').style.display='block'" type="reset" class="successbtn">LOGIN</button>
						<button type="submit" class="cancelbtn">KEMBALI</button>
						</form>
						<!--<a href="../../../../index.php" class="cancelbtn">KEMBALI</a>-->
				 </span>
				 <?php     //start php tag
//include connect.php page for database connection

//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
{
// here check the submitted text box for null value by giving there name.
Include('../config/connectlogin.php');
$USR = $_REQUEST['user'];
$PASS = $_REQUEST['passcode'];
$PWD = md5($PASS);
$sql= "select USERNAME, PASSWORD, GRUP_ID from USER_ID WHERE USERNAME = '$USR' AND PASSWORD = '$PWD'";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
// $row = oci_fetch_array($stmt);
$num_rows=oci_fetch($stmt);
	   if($num_rows>0){
		$sql= "select GRUP_ID from USER_ID WHERE USERNAME = '$USR' AND PASSWORD = '$PWD'";
		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
		$row = oci_fetch_array($stmt);
	if($row['GRUP_ID'] == '1')
	{
	header("location: index.php");
	}
	else if($row['GRUP_ID'] == '5' || $row['GRUP_ID'] == '6' || $row['GRUP_ID'] == '7' || $row['GRUP_ID'] == '8' || $row['GRUP_ID'] == '9' || $row['GRUP_ID'] == '10')
	{
	header("location: ../../capil/index.php");
	}
	else if($row['GRUP_ID'] == '4')
	{
	header("location: ../../dafduk/index.php");
	}
	else if($row['GRUP_ID'] == '2' ||  $row['GRUP_ID'] == '3' ||  $row['GRUP_ID'] == '11')
	{
	header("location: ../../general/index.php");
	   
	}
	else
	{
		header("location: ../../general/index.php");
	   
	}
	}
	else
	{
		echo "<h1 class='hero-title ut-glow'><font color='red'>Username Atau Password Salah</font></h1>";
	   
	}
}	
?>
              
</section>
<!--
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
			<div align=right>

<button onclick="document.getElementById('id01').style.display='block'" class="successbtn">LOGIN</button>
<a href="../../../../index.php" class="cancelbtn">KEMBALI</a>
</div>
			<div id="id01" class="modal" >
                <form class="modal-content animate" name="form_login" method="post" action="login.php" role="form" >
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="closex" title="Close Modal">&times;</span>
      <img src="avatar.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
       <fieldset>
                                <div class="form-group">
								<label> Masukan Nama Pengguna Anda </label>
                                    <input class="form-control" placeholder="Nama Pengguna" name="user" type="user" autofocus required x-moz-errormessage="Masukan Nama Pengguna">
                                </div>
                                <div class="form-group">
								<label> Masukan Nama Pengguna Anda </label>
                                    <input class="form-control" placeholder="Kata Sandi" name="passcode" type="password" value="" required x-moz-errormessage="Masukan Kata Sandi">
                                </div>
								 <div class="form-group">
								<div class="col-lg-6">
                                <button type="submit" id="submit" name="submit" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal">Login</button>
								</div>
								<div class="col-lg-6">
                                      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-lg btn-danger btn-block">Batal</button>
								</div>
								</div>
								
                            </fieldset>
		</fieldset>
    </div>
	<hr>
    <div class="container">
      <B>Alamat :</B> Jl. Ambon No. 1B, Bandung, Jawa Barat, Indonesia<br>
	  <B>Email :</B> info@disdukcapil.bandung.go.id<br>
	<B>Telp :</B> 022.4209891<br>
	<B>Situs :</B> www.disdukcapil.bandung.go.id<br>
      </div>
  </form>
                </div>
				</div>
            </div>
        </div>
 -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

	<script src="../js/jquery.masked-input.js"></script>
	<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script type="text/javascript" src="style/jquery_011.js"></script>
<script type="text/javascript" src="style/jquery-migrate.js"></script>
<script type="text/javascript" src="style/flags.js"></script>
<script type="text/javascript" src="style/toolbar.js"></script>
<script type="text/javascript" src="style/load-toolbar.js"></script>
<script type="text/javascript" src="style/core.js"></script>
<script type="text/javascript" src="style/widget.js"></script>
<script type="text/javascript" src="style/mouse.js"></script>
<script type="text/javascript" src="style/button.js"></script>
<script type="text/javascript" src="style/jquery_018.js"></script>
<script type="text/javascript" src="style/jquery_010.js"></script>
<script type="text/javascript" src="style/jquery_012.js"></script>
<script type="text/javascript" src="style/jquery_013.js"></script>
<script type="text/javascript" src="style/modernizr.js"></script>
<script type="text/javascript" src="style/jquery_005.js"></script>
<script type="text/javascript" src="style/jquery_003.js"></script>
<script type="text/javascript" src="style/jquery_007.js"></script>
<script type="text/javascript" src="style/jquery_002.js"></script>
<script type="text/javascript" src="style/jquery_017.js"></script>
<script type="text/javascript" src="style/tabs.js"></script>
<script type="text/javascript" src="style/accordion.js"></script>
<script type="text/javascript" src="style/jquery-unselectable.js"></script>
<script type="text/javascript" src="style/slider.js"></script>
<script type="text/javascript" src="style/base.js"></script>
<script type="text/javascript" src="style/custom.js"></script>

<script type="text/javascript" src="style/scripts.js"></script>
<script type="text/javascript" src="style/jquery_009.js"></script>
<script type="text/javascript" src="style/jquery_019.js"></script>
<script type="text/javascript" src="style/tabs_002.js"></script>
<script type="text/javascript" src="style/jquery_008.js"></script>
<script type="text/javascript" src="style/jquery_016.js"></script>
<script type="text/javascript" src="style/jquery.js"></script>

<script type="text/javascript" src="style/ut.js"></script>
<script type="text/javascript" src="style/jquery_015.js"></script>
<script type="text/javascript" src="style/superfish.js"></script>
<script type="text/javascript" src="style/retina.js"></script>
<script type="text/javascript" src="style/TweenLite.js"></script>
<script type="text/javascript" src="style/EasePack.js"></script>
<script type="text/javascript" src="style/canvas.js"></script>
<script type="text/javascript" src="style/jquery_004.js"></script>
<script type="text/javascript" src="style/jquery_020.js"></script>


   
</body>

</html>

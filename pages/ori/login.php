<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="@DianYanzen">

    <title>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KOTA BANDUNG</title>

	<!-- Yanzen core Sc -->
    <link rel="shortcut icon" href="../logo.png" />	
	
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>

body {
    background-position: left top;
    background-image: url(../images/disduk.jpg);
    background-repeat: no-repeat;
	   background-size:cover;
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
}
</style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
			<div align=center>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">LOGIN</button>
</div>
			<div id="id01" class="modal">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Terlebih Dahulu, Mohon Maaf Bukan Untuk Umum</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
								<label> Masukan Nama Pengguna Anda </label>
                                    <input class="form-control" placeholder="Nama Pengguna" name="user" type="user" autofocus required x-moz-errormessage="Masukan User Name">
                                </div>
                                <div class="form-group">
								<label> Masukan Nama Pengguna Anda </label>
                                    <input class="form-control" placeholder="Kata Sandi" name="passcode" type="password" value="" required x-moz-errormessage="Masukan Kata Sandi">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<div class="col-lg-6">
                                <button type="submit" id="submit" name="submit" class="btn btn-success btn-lg btn-block">Login</button>
								</div>
								<div class="col-lg-6">
                                <a href="../../../../index.php" class="btn btn-lg btn-danger btn-block">Kembali</a>
								</div>
								<?php     //start php tag
//include connect.php page for database connection

//if submit is not blanked i.e. it is clicked.
if (isset($_REQUEST['submit'])) //here give the name of your button on which you would like    //to perform action.
{
// here check the submitted text box for null value by giving there name.
	if($_REQUEST['user']=="Admin" && $_REQUEST['passcode']=="Admin")
	{
	header("location: index.php");
	}
	else if($_REQUEST['user']=="Admincapil" && $_REQUEST['passcode']=="Admin")
	{
	header("location: ../../capil/index.php");
	}
	else if($_REQUEST['user']=="Admindafduk" && $_REQUEST['passcode']=="Admin")
	{
	header("location: ../../dafduk/index.php");
	}
	else if($_REQUEST['user']=="" || $_REQUEST['passcode']=="")
	{
	echo"<div class='col-lg-12'>
		<br>
	   <div class='alert alert-danger alert-dismissable'>
								
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Username Dan Password Tidak Boleh Kosong <a href='../../../../index.php' class='alert-link'>Klik Untuk Kembali</a>.
                            </div>
							</div>";
	   
	}
	else
	{
		echo"<div class='col-lg-12'>
		<br>
	   <div class='alert alert-danger alert-dismissable'>
								
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                Mohon Maaf Username Dan Password Anda Salah. <a href='../../../../index.php' class='alert-link'>Klik Untuk Kembali</a>.
                            </div>
							</div>";
	   
	}
}	
?>
                            </fieldset>
                        </form>
                    </div>
                </div>
				</div>
            </div>
        </div>
    </div>

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
</body>

</html>

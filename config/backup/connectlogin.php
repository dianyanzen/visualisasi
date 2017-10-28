<?php

$userdb="BMUSER";
$passdb="technicalbsl7";
$dbname="10.32.73.222:1522/orcl";

//require('../design.php');
// require(  base64_decode('XHN1Ymh0bWxcbG9naW5cYWRtaW5cY29uZmlnXHNjdXJpdHlcc3lzdGVtXHlhbnplblxzeXN0ZW1ca2V5LXVtdW0ucGhw') );
//error_reporting(E_ERROR | E_PARSE);
$conn = oci_connect($userdb,$passdb,$dbname);

if (!$conn){
	
			echo "<div id='wrapper'>

            <nav class='navbar navbar-default navbar-static-top' role='navigation' style='margin-bottom: 0'>
            
			<div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                </button>
                <a class='navbar-brand' href='index.php'>Disduk Capil Kota Bandung</a>
            </div>
			</nav>
			<div id='page-wrapper'>
            <div class='row'>
                <div class='col-lg-12'>
					                    <h1 class='page-header'>Connection Error<br><small>Sangat Disayangkan Website Tidak Dapat Kami Tampilkan  <i class='fa fa-frown-o fa-fw'></i> </small></h1>
				</div>
				</div>
				<div class='col-lg-12'>
				</div>
			</div>			
			</div>";
			exit;
		}
	
?>
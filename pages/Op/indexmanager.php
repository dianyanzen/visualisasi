<!doctype html>
<html><?php require_once('head.php'); 
error_reporting(E_ERROR | E_PARSE);
$_SESSION['USER_ID'] = $_GET['user'];
$USER_DEC = $_SESSION['USER_ID'];
$USER_ID = base64_decode($USER_DEC);

?> 
  	
  	<!-- ElFinder File Manager CSS. https://github.com/Studio-42/elFinder/ -->
	<script type="text/javascript" src="assets/manager/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="assets/manager/js/jquery-ui.css">
  	<link rel="stylesheet" type="text/css" media="screen" href="assets/manager/css/elfinder.min.css">
	<script type="text/javascript" src="assets/manager/js/elfinder.min.js"></script>	
  	
  	<!-- elFinder web manager init -->
	<script type="text/javascript" charset="utf-8">
		$().ready(function() {
			var elf = $('#elfinder').elfinder({
				// lang: 'ru',             // language (OPTIONAL)
				url : 'assets/manager/php/connector.php'  // connector URL (REQUIRED)
			}).elfinder('instance');			
		});
	</script>    
  
  <body>
  	<!-- NAVIGATION MENU -->
<!-- NAVIGATION MENU -->
	<?php require_once('nav3.php'); ?>
    
					<?PHP		
					Include('../../config/connect223.php');
					$sql = "SELECT * FROM SIAK_USER_PLUS WHERE USER_ID ='".$USER_ID."'";
					$result = oci_parse($conn222, $sql);
					oci_execute($result);
					$count = oci_fetch($result);
					if($count == 0){ ?>
					 <div class="container">
					 <div class="row">
						
						<div class="col-lg-12">
						<div class="panel panel-primary">
                        <div class="panel-heading">
                         <img src="../../images/404.jpg"  alt="Cinque Terre" width="100%" height="700">
                        </div>
                        
						</div>
						</div>
		
					 </div>
					 </div>
					<?php
					}else{
					?>
	
	<div class="container">

      <!-- CONTENT -->
		<div class="row">

      		<!-- File Manager -->
        	<div class="col-sm-12 col-lg-12">
				<div id="elfinder">finder</div>
				
				<br>
			</div><!-- /span9 -->
	      </div><!-- /row -->
	   </div> <!-- /container -->
					<?php } ?> 
    	<div id="footerwrap">
      	<footer class="clearfix"></footer>
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<p><img src="assets/img/logo.png" alt=""></p>
      			<p><?php $year=date('Y');?> <p id="footer">Copyright &copy; <?php echo $year;?> DianYanzen, DisdukCapil Kota Bandung</p>
      			</div>

      		</div><!-- /row -->
      	</div><!-- /container -->		
	</div><!-- /footerwrap -->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/admin.js"></script>
    

  
</body></html>
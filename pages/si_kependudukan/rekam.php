<!DOCTYPE html>
<html>

<?php require_once('head.php'); 
date_default_timezone_set("Asia/Jakarta");
$today = date('d/m/Y');
Include('../../config/connect223.php');
?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php require_once('header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php require_once('nav.php'); ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rekap Perekaman KTP-EL
        <small><?php echo $today; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Laporan Perekaman</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
	  <div class="col-xs-12">
        <div class="box">
         
		  </div>
		      </div>
      </div>
	  <div class="row">
         
        <!-- ./col -->
      
	  <div class="col-md-12">
		 <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Laporan Perekaman KTP-EL</h3>
            </div>
            <div class="box-body">
			<form action="rekam.php" role="form">
			<!-- Date range -->
              <div class="form-group">
                <label>Tanggal Yang Di Cari</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="reservation" class="form-control pull-right" id="reservation">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
			</div>
			<div class="box-footer">
                <button type="submit" name="cari" id="cari" class="btn btn-primary btn-block">Cari</button>
              </div>
			  </form>
		 </div>
		 <div class="row">
	 <div class="col-md-12">
	 <?php if (isset($_REQUEST['cari'])) //here give the name of your button on which you would like    //to perform action.
	 {
		 $TGL = $_REQUEST['reservation'];
		 $TGLAWAL = substr($TGL, 0, 10);
		 $TGLAKHIR = substr($TGL,13, 10);
		 ?>
			 
			<?php
			$sql ="SELECT NO_KEC, NAMA_KEC, COUNT(*) AS JUMLAH FROM DEMOGRAPHICS_ALL_X  WHERE CURRENT_STATUS_CODE NOT LIKE 'CARD%' AND NAMA_KAB = 'KOTA BANDUNG' AND CREATED >= TO_DATE('$TGLAWAL','dd/MM/yyyy') AND CREATED < TO_DATE('$TGLAKHIR','dd/MM/yyyy') +1 GROUP BY NO_KEC, NAMA_KEC ORDER BY NO_KEC";
			$result = oci_parse($conn222, $sql);
			oci_execute($result);
			$count = oci_fetch($result);
			if($count == 0){ 
			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Data Pada Tanggal <?PHP ECHO $TGLAWAL;?> Sampai Tanggal <?PHP ECHO $TGLAKHIR;?> Tidak Ada Atau Kosong</h4>
              </div>
			
			<?PHP }else{?>
		
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Perekaman</h3>

              <div class="box-tools">
                <b><?PHP ECHO $TGLAWAL;?> - <?PHP ECHO $TGLAKHIR;?></b>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th>No Kec</th>
                  <th>Nama Kec</th>
                  <th>Jumlah</th>
                </tr>
                <tr>
				<?php 
				$sql ="SELECT NO_KEC, NAMA_KEC, COUNT(*) AS JUMLAH FROM DEMOGRAPHICS_ALL_X  WHERE CURRENT_STATUS_CODE NOT LIKE 'CARD%' AND NAMA_KAB = 'KOTA BANDUNG' AND CREATED >= TO_DATE('$TGLAWAL','dd/MM/yyyy') AND CREATED < TO_DATE('$TGLAKHIR','dd/MM/yyyy') +1 GROUP BY NO_KEC, NAMA_KEC ORDER BY NO_KEC";
				$stmt = oci_parse($conn222, $sql);
						oci_execute($stmt);
						while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
				?>
                  <td><?php echo $row['NO_KEC']; ?></td>
                  <td><?php echo $row['NAMA_KEC']; ?></td>
                  <td><?php echo $row['JUMLAH']; ?></td>
               
                </tr>
                <?PHP }	?>
              </table>
            </div>
			<div class="box-footer">
			<form action="rekam.php">
                <button type="submit" class="btn btn-primary btn-block">Kembali</button>
				</form>
              </div>
            <!-- /.box-body -->
        
          <!-- /.box -->
			<?php
			}
	 }
			?>
			
			</div>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Form </b>Laporan
    </div>
    <strong>Disduk Capil <a href="#">Kota Bandung</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->

<?php require_once('foot.php'); ?> 

</body>
</html>

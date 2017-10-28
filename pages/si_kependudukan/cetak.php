<!DOCTYPE html>
<html>

<?php require_once('head.php'); 
date_default_timezone_set("Asia/Jakarta");
$today = date('d/m/Y');
Include('../../config/connect223.php');
?>
</head>
<body class="hold-transition skin-blue sidebar-mini" onload='loadCategories()'>
<div class="wrapper">

<?php require_once('header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php require_once('nav.php'); ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rekap Pencetakan KTP-EL
        <small><?php echo $today; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Laporan Pencetakan</a></li>
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
              <h3 class="box-title">Laporan Pencetakan KTP-EL</h3>
            </div>
            <div class="box-body">
			<form action="cetak.php" role="form">
			<!-- Date range -->
              <div class="form-group col-lg-12">
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
                      <div class="form-group col-lg-6">
                                            <label>Pilih Kecamatan</label>
                                            <select name="NO_KEC"  id="NO_KEC" class="form-control" >
                                               <option value="0" selected="selected">SELURUH KECAMATAN</option>
                        <?php
                  while (($rownokec = oci_fetch_array($stmtnokec, OCI_ASSOC)) != false) {
                  echo "<option value='".$rownokec['NO_KEC']."'>";
                  echo $rownokec['NAMA_KEC']." (".$rownokec['NO_KEC'].")";
                  echo "</option>";
                  }
                  ?>
                                            </select>
                                        </div>
                    <!-- Div -->
                    <div class="form-group col-lg-6">
                      <label>Pilih Kelurahan</label>
                                            <select name="NO_KEL" id="NO_KEL" class="form-control">
                        <option value="0" selected="selected">SELURUH KELURAHAN</option>
                      </select>
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
     $Getno_kec = $_REQUEST['NO_KEC'];
     $Getno_kel = $_REQUEST['NO_KEL'];
		 $TGLAWAL = substr($TGL, 0, 10);
		 $TGLAKHIR = substr($TGL,13, 10);
		 ?>
			 
			<?php
			/*
      $sql ="SELECT B.NO_KEC, B.NAMA_KEC, COUNT(*) AS JUMLAH FROM CARD_MANAGEMENT@DBL2 A INNER JOIN DEMOGRAPHICS_ALL_X B ON A.NIK = B.NIK WHERE B.NAMA_KAB = 'KOTA BANDUNG' AND A.CREATED >= TO_DATE('$TGLAWAL','dd/MM/yyyy') AND A.CREATED < TO_DATE('$TGLAKHIR','dd/MM/yyyy') +1 GROUP BY B.NO_KEC, B.NAMA_KEC ORDER BY B.NO_KEC";
      */
      $sql = "SELECT COUNT(*) AS JUMLAH 
          FROM CARD_MANAGEMENT@DBL2 A 
          INNER JOIN BIODATA_WNI@DB5 B ON A.NIK = B.NIK 
          INNER JOIN SETUP_KEC C ON B.NO_KEC = C.NO_KEC
          AND B.NO_KAB = C.NO_KAB
          AND B.NO_PROP = C.NO_PROP 
          WHERE B.NO_KAB = '73' AND B.NO_PROP = '32' ";
          
    if ($Getno_kec != '0')
    {
      $sql .=" AND B.NO_KEC = '$Getno_kec' ";
    }
    if ($Getno_kel != '0')
    {
     $sql .=" AND B.NO_KEL = '$Getno_kel' ";
    }
      $sql .="
          AND A.CREATED >= TO_DATE('$TGLAWAL','dd/MM/yyyy') 
          AND A.CREATED < TO_DATE('$TGLAKHIR','dd/MM/yyyy') +1 
          GROUP BY B.NO_KEC 
          ,C.NAMA_KEC 
          ORDER BY B.NO_KEC";
			$result = oci_parse($conn222, $sql);
			oci_execute($result);
			$count = oci_fetch($result);
			if($count == 0){ 
			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <!-- <h4><i class="icon fa fa-ban"></i> Data Pada Tanggal <?PHP ECHO $TGLAWAL;?> Sampai Tanggal <?PHP ECHO $TGLAKHIR;?> Tidak Ada Atau Kosong</h4> -->

                <h4><i class="icon fa fa-ban"></i> Data Pada Tanggal <?PHP ECHO $TGLAWAL;?> Sampai Tanggal <?PHP ECHO $TGLAKHIR;?> Tidak Ada Atau Kosong</h4>
              </div>
			
			<?PHP }else{?>
		
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pencetakan</h3>

              <div class="box-tools">
                <b><?PHP ECHO $TGLAWAL;?> - <?PHP ECHO $TGLAKHIR;?></b>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <?php 
    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
     echo "<th>No Kec</th>";
    }else{
    echo "<th>No Kel</th>";  
    }
    ?>
    <?php 
    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
     echo "<th>Nama Kec</th>";
    }else{
    echo "<th>Nama Kel</th>";  
    }?>
                  
                  <th>Jumlah</th>
                </tr>
                <tr>
				<?php 
			$sql = "SELECT";
    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
     $sql .=" B.NO_KEC
          , C.NAMA_KEC";
    }else{
      $sql .=" B.NO_KEL
          , C.NAMA_KEL";
    }
      $sql .=", COUNT(*) AS JUMLAH 
          FROM CARD_MANAGEMENT@DBL2 A 
          INNER JOIN BIODATA_WNI@DB5 B ON A.NIK = B.NIK";
    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
      $sql .=" INNER JOIN SETUP_KEC C ON B.NO_KEC = C.NO_KEC
          AND B.NO_KAB = C.NO_KAB
          AND B.NO_PROP = C.NO_PROP"; 
    }else{
      $sql .=" INNER JOIN SETUP_KEl C ON 
          B.NO_KEL = C.NO_KEL
          AND B.NO_KEC = C.NO_KEC
          AND B.NO_KAB = C.NO_KAB
          AND B.NO_PROP = C.NO_PROP"; 
    }
      $sql .=" 
          WHERE B.NO_KAB = '73' AND B.NO_PROP = '32' ";
          
    if ($Getno_kec != '0')
    {
      $sql .=" AND B.NO_KEC = '$Getno_kec' ";
    }
    if ($Getno_kel != '0')
    {
     $sql .=" AND B.NO_KEL = '$Getno_kel' ";
    }

      $sql .="
          AND A.CREATED >= TO_DATE('$TGLAWAL','dd/MM/yyyy') 
          AND A.CREATED < TO_DATE('$TGLAKHIR','dd/MM/yyyy') +1 ";
    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
      $sql .=" GROUP BY B.NO_KEC ,C.NAMA_KEC"; 
    }else{
    $sql .=" GROUP BY B.NO_KEL ,C.NAMA_KEL";   
    }
     

          $sql .=" ORDER BY B.NO_KEC";
    
   
				$stmt = oci_parse($conn222, $sql);
						oci_execute($stmt);
            
						while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
				?>
                  <tr>
                  <?php 
    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
    echo"<td>".$row['NO_KEC']."</td>
                  <td>".$row['NAMA_KEC']."</td>
                  <td>".$row['JUMLAH']."</td>";
    }else{
    echo"<td>".$row['NO_KEL']."</td>
                  <td>".$row['NAMA_KEL']."</td>
                  <td>".$row['JUMLAH']."</td>";  
    }
                  
                  ?>
                </tr>
                   <?PHP } 
                   if ($Getno_kel == '0')
                    { 
                    ?>

                <tr>
                  <?php
$sql = "SELECT";
      $sql .=" SUM(COUNT(*)) AS JUMLAH 
          FROM CARD_MANAGEMENT@DBL2 A 
          INNER JOIN BIODATA_WNI@DB5 B ON A.NIK = B.NIK";
    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
      $sql .=" INNER JOIN SETUP_KEC C ON B.NO_KEC = C.NO_KEC
          AND B.NO_KAB = C.NO_KAB
          AND B.NO_PROP = C.NO_PROP"; 
    } else{
      $sql .=" INNER JOIN SETUP_KEl C ON 
          B.NO_KEL = C.NO_KEL
          AND B.NO_KEC = C.NO_KEC
          AND B.NO_KAB = C.NO_KAB
          AND B.NO_PROP = C.NO_PROP"; 
    }
      $sql .=" 
          WHERE B.NO_KAB = '73' AND B.NO_PROP = '32' ";
          
    if ($Getno_kec != '0')
    {
      $sql .=" AND B.NO_KEC = '$Getno_kec' ";
    }
    if ($Getno_kel != '0')
    {
     $sql .=" AND B.NO_KEL = '$Getno_kel' ";
    }

      $sql .="
          AND A.CREATED >= TO_DATE('$TGLAWAL','dd/MM/yyyy') 
          AND A.CREATED < TO_DATE('$TGLAKHIR','dd/MM/yyyy') +1 ";

    if ($Getno_kec == '0' && $Getno_kel == '0')
    {
      $sql .=" GROUP BY B.NO_KEC ,C.NAMA_KEC"; 
    }else{
    $sql .=" GROUP BY B.NO_KEL ,C.NAMA_KEL";   
    }
      $sql .=" ORDER BY B.NO_KEC";
        $stmt = oci_parse($conn222, $sql);
            oci_execute($stmt);
            $row = oci_fetch_array($stmt); 
            echo " <td colspan='2' align='center'><b>Jumlah</b></td>
            <td><b>".$row['JUMLAH']."</b></td>";
      
          ?>
                 </tr> 
           <?php  } ?>  
              </table>
            </div>
			<div class="box-footer">
			<form action="cetak.php">
                <button type="submit" class="btn btn-primary btn-block">Kembali</button>
				</form>
              </div>

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

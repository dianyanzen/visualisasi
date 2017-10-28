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
    <link rel="shortcut icon" href="../../logo.png" />	
	
	<!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
	session_start();
	?>

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">DisdukCapil Kota Bandung</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                  
                        <li class="divider"></li>
                       <li><a href="../../index.php"><i class="fa fa-sign-out fa-fw"></i> Kembali</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <!--<input type="text" class="form-control" placeholder="">-->
                                <span class="input-group-btn">
                                <!--<button id='lada' class="btn btn-default" type="button">-->
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="../../../index.php"><i class="fa fa-home fa-fw"></i> Halaman Utama</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Statistik<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../stdisduk.php">Dafduk</a>
                                </li>
                                <li>
                                    <a href="../stcapil.php">Capil</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Tabel<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../tbdisduk.php">Dafduk</a>
                                </li>
                                <li>
                                    <a href="../tbcapil.php">Capil</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href="../gis/index.php"><i class="fa fa-map-marker fa-fw"></i> Informasi Geografis</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12"><?PHP

				$BULAN = $_SESSION['bulan'];
				$_SESSION['PKRJN'] = $_GET['PKRJN'];
				$PKRJN = $_SESSION['PKRJN'];
				
				//ECHO $NOKEC;
				//ECHO $SORT;
				Include('../../config/connect222.php');
					//AMBIL NAMA KECAMATAN DAN TOTAL PENJUMLAHAN NIK TIAP KELUARAHAN BERDASARKAN KECAMATAN YANG DI PILIH 
					$sql= "SELECT KODE_PEKERJAAN AS P3,
      CASE WHEN KODE_PEKERJAAN  = '1' THEN 'Belum/Tidak Bekerja'
         WHEN KODE_PEKERJAAN = '2' THEN 'Mengurus Rumah Tangga'
         WHEN KODE_PEKERJAAN = '3' THEN 'Pelajar/Mahasiswa'
         WHEN KODE_PEKERJAAN = '4' THEN 'Pensiunan'
         WHEN KODE_PEKERJAAN = '5' THEN 'Pegawai Negeri Sipil(PNS)'
         WHEN KODE_PEKERJAAN = '6' THEN 'Tentara Nasional Indonesia (TNI)'
         WHEN KODE_PEKERJAAN = '7' THEN 'Kepolisian RI (POLRI)'
         WHEN KODE_PEKERJAAN = '8' THEN 'Perdagangan'
         WHEN KODE_PEKERJAAN = '9' THEN 'Petani/Pekebun'
         WHEN KODE_PEKERJAAN = '10' THEN 'Peternak'
         WHEN KODE_PEKERJAAN = '11' THEN 'Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '12' THEN 'Industri'
         WHEN KODE_PEKERJAAN = '13' THEN 'Konstruksi'
         WHEN KODE_PEKERJAAN = '14' THEN 'Transportasi'
         WHEN KODE_PEKERJAAN = '15' THEN 'Karyawan Swasta'
         WHEN KODE_PEKERJAAN = '16' THEN 'Karyawan BUMN'
         WHEN KODE_PEKERJAAN = '17' THEN 'Karyawan BUMD'
         WHEN KODE_PEKERJAAN = '18' THEN 'Karyawan Honorer'
         WHEN KODE_PEKERJAAN = '19' THEN 'Buruh Harian Lepas'
         WHEN KODE_PEKERJAAN = '20' THEN 'Buruh Tani/Perkebunan'
         WHEN KODE_PEKERJAAN = '21' THEN 'Buruh Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '22' THEN 'Buruh Peternakan'
         WHEN KODE_PEKERJAAN = '23' THEN 'Pembantu Rumah Tangga'
         WHEN KODE_PEKERJAAN = '24' THEN 'Tukang Cukur'
         WHEN KODE_PEKERJAAN = '25' THEN 'Tukang Listrik'
         WHEN KODE_PEKERJAAN = '26' THEN 'Tukang Batu'
         WHEN KODE_PEKERJAAN = '27' THEN 'Tukang Kayu'
         WHEN KODE_PEKERJAAN = '28' THEN 'Tukang Sol Sepatu'
         WHEN KODE_PEKERJAAN = '29' THEN 'Tukang Las/Pandai Besi'
         WHEN KODE_PEKERJAAN = '30' THEN 'Tukang Jahit'
         WHEN KODE_PEKERJAAN = '31' THEN 'Tukang Gigi'
         WHEN KODE_PEKERJAAN = '32' THEN 'Penata Rias'
         WHEN KODE_PEKERJAAN = '33' THEN 'Penata Busana'
         WHEN KODE_PEKERJAAN = '34' THEN 'Penata Rambut'
         WHEN KODE_PEKERJAAN = '35' THEN 'Mekanik'
         WHEN KODE_PEKERJAAN = '36' THEN 'Seniman'
         WHEN KODE_PEKERJAAN = '37' THEN 'Tabib'
         WHEN KODE_PEKERJAAN = '38' THEN 'Paraji'
         WHEN KODE_PEKERJAAN = '39' THEN 'Perancang Busana'
         WHEN KODE_PEKERJAAN = '40' THEN 'Penterjemah'
         WHEN KODE_PEKERJAAN = '41' THEN 'Imam Masjid'
         WHEN KODE_PEKERJAAN = '42' THEN 'Pendeta'
         WHEN KODE_PEKERJAAN = '43' THEN 'Pastor'
         WHEN KODE_PEKERJAAN = '44' THEN 'Wartawan'
         WHEN KODE_PEKERJAAN = '45' THEN 'Uztadz/Mubaligh'
         WHEN KODE_PEKERJAAN = '46' THEN 'Juru Masak'
         WHEN KODE_PEKERJAAN = '47' THEN 'Promotor Acara'
         WHEN KODE_PEKERJAAN = '48' THEN 'Anggota DPR RI'
         WHEN KODE_PEKERJAAN = '49' THEN 'Anggota DPD RI'
         WHEN KODE_PEKERJAAN = '50' THEN 'Anggota BPK'
         WHEN KODE_PEKERJAAN = '51' THEN 'Presiden'
         WHEN KODE_PEKERJAAN = '52' THEN 'Wakil Presiden'
         WHEN KODE_PEKERJAAN = '53' THEN 'Anggota Mahkamah Konstitusi'
         WHEN KODE_PEKERJAAN = '54' THEN 'Anggota Kabinet Kementrian'
         WHEN KODE_PEKERJAAN = '55' THEN 'Duta Besar'
         WHEN KODE_PEKERJAAN = '56' THEN 'Gubernur'
         WHEN KODE_PEKERJAAN = '57' THEN 'Wakil Gubernur'
         WHEN KODE_PEKERJAAN = '58' THEN 'Bupati'
         WHEN KODE_PEKERJAAN = '59' THEN 'Wakil Bupati'
         WHEN KODE_PEKERJAAN = '60' THEN 'Walikota'
         WHEN KODE_PEKERJAAN = '61' THEN 'Wakil Walikota'
         WHEN KODE_PEKERJAAN = '62' THEN 'Anggota DPRD PROP'
         WHEN KODE_PEKERJAAN = '63' THEN 'Anggota DPRD Kota'
         WHEN KODE_PEKERJAAN = '64' THEN 'Dosen'
         WHEN KODE_PEKERJAAN = '65' THEN 'Guru'
         WHEN KODE_PEKERJAAN = '66' THEN 'Pilot'
         WHEN KODE_PEKERJAAN = '67' THEN 'Pengacara'
         WHEN KODE_PEKERJAAN = '68' THEN 'Notaris'
         WHEN KODE_PEKERJAAN = '69' THEN 'Arsitek'
         WHEN KODE_PEKERJAAN = '70' THEN 'Akuntan'
         WHEN KODE_PEKERJAAN = '71' THEN 'Konsultan'
         WHEN KODE_PEKERJAAN = '72' THEN 'Dokter'
         WHEN KODE_PEKERJAAN = '73' THEN 'Bidan'
         WHEN KODE_PEKERJAAN = '74' THEN 'Perawat'
         WHEN KODE_PEKERJAAN = '75' THEN 'Apoteker'
         WHEN KODE_PEKERJAAN = '76' THEN 'Psikiater/Psikolog'
         WHEN KODE_PEKERJAAN = '77' THEN 'Penyiar Televisi'
         WHEN KODE_PEKERJAAN = '78' THEN 'Penyiar Radio'
         WHEN KODE_PEKERJAAN = '79' THEN 'Pelaut'
         WHEN KODE_PEKERJAAN = '80' THEN 'Peneliti'
         WHEN KODE_PEKERJAAN = '81' THEN 'Sopir'
         WHEN KODE_PEKERJAAN = '82' THEN 'Pialang'
         WHEN KODE_PEKERJAAN = '83' THEN 'Paranormal'
         WHEN KODE_PEKERJAAN = '84' THEN 'Pedagang'
         WHEN KODE_PEKERJAAN = '85' THEN 'Perangkat Desa'
         WHEN KODE_PEKERJAAN = '86' THEN 'Kepala Desa'
         WHEN KODE_PEKERJAAN = '87' THEN 'Biarawan/Biarawati'
         WHEN KODE_PEKERJAAN = '88' THEN 'Wiraswasta'
         ELSE 'Pekerjaan Lainnya' END AS P1, 
SUM(VALUE) AS P2 FROM T5_STT_PEKERJAAN  WHERE NO_PROP='32' AND NO_KAB ='73' AND KODE_PEKERJAAN='".$PKRJN."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 GROUP BY KODE_PEKERJAAN ORDER BY KODE_PEKERJAAN";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					//echo "text: 'DIAGRAM KOLOM PENDUDUK MENURUT GOLONGAN DARAH KECAMATAN ".$row['NAMA_KEC']."'";
					
                    ECHO "<h1 class='page-header'>Data Penduduk Menurut Pekerjaan ".$row['P1']."<br>";
					?>
					<?php
					date_default_timezone_set("Asia/Jakarta");
					$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
					$hari = $array_hari[date("N")];
					//Format Tanggal
					$tanggal = date ("j");

					//Array Bulan
					$array_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
					$bulan = $array_bulan[date("n")];
					$nowdate = date("d/m/Y");
					$BLN = substr($nowdate,3,7);
					//echo $BLN;
					//Format Tahun
					$tahun = date("Y");
		
					//echo "The time is " . date("h:i:sa");
					echo "<small>Dinas Kependudukan Dan Pencatatan Sipil Kota Bandung</small></h1>";
					//echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
					//echo "Today is " . date("Y.m.d") . "<br>";
					//echo "Today is " . date("Y-m-d") . "<br>";
					//echo "Today is " . date("l");
					
					
					?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- Isi -->
			<div class="row">
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-table fa-fw"></i> Penduduk Menurut Jenis Pekerjaan <?php echo $row['P1']; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Kecamatan</th>
										<th>Jumlah</th>
										<th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?PHP
									Include('../../config/connect222.php');
									$sql= "SELECT a.NO_KEC as P1, a.NAMA_KEC AS P2, SUM(VALUE) AS P3
									FROM SETUP_KEC a INNER JOIN T5_STT_PEKERJAAN b
									ON a.NO_KEC=b.NO_KEC WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND b.KODE_PEKERJAAN ='".$PKRJN."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NAMA_KEC ORDER BY a.NO_KEC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									$i=1;
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
									echo "<td align='center'>".$i++."</td>";
                                    echo "<td class='center'>".htmlentities($row['P2'])."</div></td>";
                                    echo "<td align='right'>".htmlentities($row['P3'])."</td>";
									echo "<td class='center' align='center'><a target='_blank' href='kecamatan/index.php?NOKEC=".htmlentities($row['P1'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
									?>
								</tbody>
								</thead>
							</table>
						</div>
						<div class="panel-footer">
										 <a href="../tbdisduk.php" class="btn btn-primary btn-lg btn-block">Kembali</a>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
</body>

</html>

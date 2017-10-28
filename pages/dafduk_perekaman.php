<?php require_once ('fixheader.php');?>
<?php require_once ('fixsidebar.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Daftar Entri Kartu Keluarga Per Kecamatan<br>
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
					echo "<small>".$hari.", " . $tanggal ." ". $bulan ." ". $tahun. ", Update Terakhir <span id='time-part'>".date("H:i:s")."</span>.</small></h1>";
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-table fa-fw"></i> Kartu Keluarga
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>NOMOR KECAMATAN</th>
                                        <th>NAMA KECAMATAN</th>
                                        <th>JUMLAH ENTRI</th>
                                        <!--<th>Petugas</th>
                                        <th>Kelurahan</th>-->
                                    </tr>
                                </thead>
                                <tbody>
									<?PHP
									Include('../config/connect222.php');
									$nowdate = date("d/m/Y");
									$sql= "SELECT A.NO_KEC, B.NAMA_KEC, COUNT(A.NO_KK) AS JUMLAH FROM DATA_KELUARGA A INNER JOIN SETUP_KEC B ON B.NO_PROP = A.NO_PROP AND B.NO_KAB = A.NO_KAB AND B.NO_KEC = A.NO_KEC WHERE A.TIPE_KK='1' AND A.TGL_INSERTION >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND A.TGL_INSERTION < TO_DATE('".$nowdate."','dd/MM/yyyy') +1 GROUP BY B.NAMA_KEC, A.NO_KEC ORDER BY A.NO_KEC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td>".htmlentities($row['NO_KEC'])."</td>";
                                    echo "<td>".htmlentities($row['NAMA_KEC'])."</td>";
									echo "<td>".htmlentities($row['JUMLAH'])."</td>";
                                    // echo "<td>".htmlentities($row['TGL_INSERTION'])."</td>";
                                    // echo "<td class='center'>".htmlentities($row['CREATED_BY'])."</td>";
                                    // echo "<td class='center'>".htmlentities($row['NAMA_KEL'])."</td>";
                                    echo "</tr>";
									}
									?>
								</tbody>
								</thead>
							</table>
						</div>
				</div>
			</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php require_once ('fixfooter.php');?>
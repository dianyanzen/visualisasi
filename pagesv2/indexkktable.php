<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
<body>
    <div id="wrapper">

        <!-- Navigation -->
		<?php require_once('nav.php'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Daftar Entri Kartu Keluarga Baru<br>
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
                                        <th>NO KK</th>
                                        <th>Nama Kepala Keluarga</th>
                                        <th>Tanggal</th>
                                        <th>Petugas</th>
                                        <th>Kelurahan</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?PHP
									require_once('r_kk.php');
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr class='gradeA'>";
                                    echo "<td>".htmlentities($row['NO_KK'])."</td>";
                                    echo "<td>".htmlentities($row['NAMA_KEP'])."</td>";
                                    echo "<td>".htmlentities($row['TGL_INSERTION'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['CREATED_BY'])."</td>";
                                    echo "<td class='center'>".htmlentities($row['NAMA_KEL'])."</td>";
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

</body>
<?php require_once('footer.php'); ?>
</html>

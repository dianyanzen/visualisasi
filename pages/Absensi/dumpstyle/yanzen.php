
<html>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                               <thead>
                                    <tr>
							
                                        <th>ID User</th>
                                        <th>Nama Pengguna</th>
                                        <th>Tanggal</th>
										<th>Jam Masuk</th>
										<th>Jam Keluar</th>
										<th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id='opr_tab'>
								<?PHP
									Include('../../../config/connect223.php');
									date_default_timezone_set("Asia/Jakarta");
									$nowdate = date("d/m/Y");
									$sql= "SELECT TO_CHAR(TRUNC(SYSDATE, 'MM') + LEVEL - 1,'DD-MM-YYYY') AS DAY
											FROM DUAL
											CONNECT BY TRUNC(TRUNC(SYSDATE, 'MM') + LEVEL - 1, 'MM') = TRUNC(SYSDATE, 'MM')";
									$stmt = oci_parse($conn222, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
									$sql2= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='ADMIN'";
									$stmt2 = oci_parse($conn222, $sql2);
									oci_execute($stmt2);
									$row2 = oci_fetch_array($stmt2);
                                    echo "<tr>";
									echo "<td>".htmlentities($row2['USER_ID'])."</td>";
									echo "<td>".htmlentities($row2['NAMA_LGKP'])."</td>";
									echo "<td>".htmlentities($row['DAY'])."</td>";
									$sql3= "SELECT JAM_MASUK, JAM_KELUAR, KETERANGAN FROM SIAK_ABSENSI WHERE USER_ID ='ADMIN' AND TANGGAL = TO_DATE('".$row['DAY']."','DD-MM-YYYY')";
									$stmt3 = oci_parse($conn222, $sql3);
									oci_execute($stmt3);
									$row3 = oci_fetch_array($stmt3);
									$JMSK = htmlentities($row3['JAM_MASUK']);
									if ($JMSK =='')
									{
										echo "<td align='center' class='center gradeA'>-</td>";
										echo "<td align='center' class='center gradeA'>-</td>";
										echo "<td align='center' class='center gradeA'>-</td>";
									}ELSE{
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['JAM_MASUK'])."</td>";
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['JAM_KELUAR'])."</td>";
										echo "<td align='center' class='center gradeA'>".htmlentities($row3['KETERANGAN'])."</td>";
									}
                                    echo "</tr>";
									}
									
									?>
								</tbody>
								</thead>
							</table>

</html>

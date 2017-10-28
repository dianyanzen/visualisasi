<?PHP
									Include('../config/connect222.php');
									$sql= "SELECT B.USER_ID, B.NAMA_LGKP, C.LEVEL_NAME, B.NAMA_KANTOR, D.LEVEL_NAME AS GROUP_LEVEL, CASE WHEN A.IP_ADDRESS IS NULL THEN '-' ELSE A.IP_ADDRESS END AS IP_ADDRESS, CASE WHEN A.LAST_ACTIVITY IS NULL THEN '-' ELSE to_char(to_date('1970-01-01','YYYY-MM-DD') + numtodsinterval(TO_CHAR(A.LAST_ACTIVITY),'SECOND'),'DD-MM-YYYY HH24:MI:SS') END AS LAST_ACTIVITY FROM T5_SIAK_USER B  LEFT JOIN T5_SESSION A ON A.USER_ID = B.USER_ID INNER JOIN T5_SIAK_LEVEL C ON B.USER_LEVEL = C.USER_LEVEL INNER JOIN T5_GROUP_LEVEL D ON C.GROUP_LEVEL = D.LEVEL_CODE ORDER BY A.USER_ID";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr>";
									$ipadd = htmlentities($row['IP_ADDRESS']);
									if ($ipadd =='-')
									{
									echo "<td><i class='fa fa-desktop fa-fw' style='color:red'></i> Tidak Aktif</td>";
									} else
									{
									echo "<td><i class='fa fa-desktop fa-fw' style='color:green'></i> Aktif</td>";
									}
									echo "<td>".htmlentities($row['USER_ID'])."</td>";
                                    echo "<td>".htmlentities($row['NAMA_LGKP'])."</td>";
									echo "<td class='center'>".htmlentities($row['NAMA_KANTOR'])."</td>";
                                    // echo "<td>".htmlentities($row['LEVEL_NAME'])." <font color='blue'><b>(".htmlentities($row['GROUP_LEVEL']).")</b></font></td>";
                                    // echo "<td align='center' class='center'>".htmlentities($row['IP_ADDRESS'])."</td>";
                                    echo "<td align='center' class='center gradeA'>".htmlentities($row['LAST_ACTIVITY'])."</td>";
									echo "<td class='center' align='center'><a href='indexopactivity.php?UID=".htmlentities($row['USER_ID'])."'><i class='fa fa-paw  fa-fw' id=></i> Detail</a></td>";
                                    echo "</tr>";
									}
									
									?>
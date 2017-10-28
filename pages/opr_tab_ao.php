<?PHP
									Include('../config/connect222.php');
									date_default_timezone_set("Asia/Jakarta");
									$nowdate = date("d/m/Y");
									$sql= "SELECT TO_CHAR(A.ACTIVITY_DATE, 'MM/DD/YYYY HH24:MI:SS')AS ACTIVITY_DATE, B.ACTIVITY_NAME AS P1,C.ACTIVITY_NAME AS P2, A.ACTIVITY_DESC AS P3 FROM T5_HIST_ACTIVITY A INNER JOIN T5_HIST_ACTIVITY_REF B ON A.ACTIVITY_TYPE = B.ACTIVITY_ID INNER JOIN T5_HIST_ACTIVITY_REF C ON A.ACTIVITY_MOD = C.ACTIVITY_ID WHERE ACTIVITY_DATE >= TO_DATE('".$nowdate."','DD/MM/yyyy') AND ACTIVITY_DATE < TO_DATE('".$nowdate."','DD/MM/yyyy')+1 AND USER_ID ='".$USER_ID."' ORDER BY A.ACTIVITY_DATE DESC";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
                                    echo "<tr>";
									echo "<td>".htmlentities($row['ACTIVITY_DATE'])."</td>";
                                    echo "<td>".htmlentities($row['P1'])." ".htmlentities($row['P2'])."</td>";
									echo "<td class='center'>".$row['P3']."</td>";
                                    // echo "<td>".htmlentities($row['LEVEL_NAME'])." <font color='blue'><b>(".htmlentities($row['GROUP_LEVEL']).")</b></font></td>";
                                    // echo "<td align='center' class='center'>".htmlentities($row['IP_ADDRESS'])."</td>";
                                    // echo "<td align='center' class='center gradeA'>".htmlentities($row['LAST_ACTIVITY'])."</td>";
                                    echo "</tr>";
									}
									
									?>
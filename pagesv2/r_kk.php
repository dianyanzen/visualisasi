<?php
Include('../config/connect222.php');
$nowdate = date("d/m/Y");
$sql .= "SELECT DATA_KELUARGA.NO_KK, DATA_KELUARGA.NAMA_KEP, DATA_KELUARGA.TGL_INSERTION, DATA_KELUARGA.CREATED_BY, SETUP_KEL.NAMA_KEL FROM DATA_KELUARGA INNER JOIN SETUP_KEL ON DATA_KELUARGA.NO_PROP = SETUP_KEL.NO_PROP AND DATA_KELUARGA.NO_KAB = SETUP_KEL.NO_KAB AND DATA_KELUARGA.NO_KEC = SETUP_KEL.NO_KEC AND DATA_KELUARGA.NO_KEL = SETUP_KEL.NO_KEL";
$sql .= " WHERE TIPE_KK='1'";
$sql .= " AND TGL_INSERTION >= TO_DATE('".$nowdate."','dd/MM/yyyy') AND TGL_INSERTION < TO_DATE('".$nowdate."','dd/MM/yyyy') +1";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
?>
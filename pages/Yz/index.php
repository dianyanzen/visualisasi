
<?php
Include('../../config/connect223.php');
$query= "select FACE from faces where nik= '3273112909950002'";
$stid = oci_parse($conn222, $query);
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
// if($row>0){
// $img = $row['FACE']->load();

if (!$row) {
    ECHO "<img src='assets/img/default80x80.jpg' alt='Marcel Newman' class='img-circle' width='80px' height='80px'>";
} else {
    $img = $row['FACE']->load();
    // header("Content-type: image/jpeg");
    // print $img;
	ECHO "<img src='data:image/png;base64,".base64_encode($img)."' class='img-circle' width='80px' height='80px'>";
}
?>

<?php

$host = "localhost"; //your localhost name
$user = "root"; //your username
$pass = ""; //your password
$db="db_kependudukan";  //your database name

$conn = mysql_connect($host, $user, $pass);

if (!$conn) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
echo "Connection established\n"; 
}
echo "<br>";
echo mysql_get_server_info() . "\n"; 
$connect = mysql_select_db($db);
echo "<br>";
if (!$connect) {
echo "Cannot select database\n";
 trigger_error(mysql_error(), E_USER_ERROR);
} else {
echo "database selected\n"; 
}
echo "<br>";
$result=mysql_query("SELECT count(*) as total from kk");
$data=mysql_fetch_assoc($result);
echo $data['total'];
 mysql_close();
 ?>   
<?php
// $start = new DateTime("08:00");
// $end= new DateTime("19:00");
// $result = $end - $start;
// echo $result;

$first  = new DateTime( '11:35' );
$second = new DateTime( '12:00' );

$diff = $first->diff( $second );

echo $diff->format( '%H Jam %I Menit' ); // -> 00:25:25
?>
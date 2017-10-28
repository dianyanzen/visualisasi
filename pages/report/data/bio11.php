<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
Include('connect222.php');
session_start();
$BULAN = $_SESSION['bulan'];
$_SESSION['NOKEC'] = $_GET['NOKEC'];
$NOKEC = $_SESSION['NOKEC'];
$_SESSION['NOKEL'] = $_GET['NOKEL'];
$NOKEL = $_SESSION['NOKEL'];
$_SESSION['SORT'] = $_GET['SORT'];
$SORT = $_SESSION['SORT'];
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dian Septian');
$pdf->SetTitle('Statistik Penduduk'.$NOKEC.'-'.$NOKEL);
$pdf->SetSubject('Statistik');
$pdf->SetKeywords('Statistik, PDF, example, test, guide');
$sql= "SELECT NAMA_KEC FROM SETUP_KEC WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					$KECAMATAN = $row['NAMA_KEC'];
					$KECAMATAN = ucwords(strtolower($KECAMATAN));
$sql= "SELECT NAMA_KEL FROM SETUP_KEL WHERE NO_PROP='32' AND NO_KAB ='73' AND NO_KEC ='".$NOKEC."' AND NO_KEL ='".$NOKEL."'";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					$KELURAHAN = $row['NAMA_KEL'];
					$KELURAHAN = ucwords(strtolower($KELURAHAN));
					$sql= "SELECT
							CASE WHEN SORT  = '0' THEN '0-4'
        					WHEN SORT = '1' THEN '5-9'
         					WHEN SORT = '2' THEN '10-14'
         					WHEN SORT = '3' THEN '15-19'
         					WHEN SORT = '4' THEN '20-24'
         					WHEN SORT = '5' THEN '25-29'
         					WHEN SORT = '6' THEN '30-34'
         					WHEN SORT = '7' THEN '35-39'
         					WHEN SORT = '8' THEN '40-44'
         					WHEN SORT = '9' THEN '45-49'
         					WHEN SORT = '10' THEN '50-54'
         					WHEN SORT = '11' THEN '55-59'
         					WHEN SORT = '12' THEN '60-64'
         					WHEN SORT = '13' THEN '65-69'
         					WHEN SORT = '14' THEN '70-74'
         					ELSE '>75' END AS P1, 
         					SUM(LAKI_LAKI) AS P2, SUM(PEREMPUAN) AS P3, SUM(LAKI_LAKI)+SUM(PEREMPUAN) AS P4
					FROM T5_STT_STRUKTUR_UMUR WHERE NO_PROP='32' AND NO_KAB ='73' AND SORT='".$SORT."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
					GROUP BY SORT
					ORDER BY SORT";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					$SORT = $row['P1'];
					$SORT = ucwords(strtolower($SORT));
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Kepemilikan Akta Kecamatan '.$KECAMATAN.', Kelurahan '.$KELURAHAN.', Usia '.$SORT.' Tahun', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 8);


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// add a page
$pdf->AddPage();

// Set some content to print
$tbl_header = '<table width="100%" border="1" align="center">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Kelurahan</th>
                                        <th>Ada Akta</th>
                                        <th>Tidak Ada Akta</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>';
$tbl_footer = '</tbody></table>';
$tbl ='';
$sql= "SELECT a.NO_KEC as P10, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(ADA_AKTA) AS P3, SUM(TIDAK_ADA_AKTA) AS P4, SUM(ADA_AKTA)+SUM(TIDAK_ADA_AKTA) AS P5
									FROM SETUP_KEL a INNER JOIN T5_STT_STRUKTUR_UMUR b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' and a.NO_KEL ='".$NOKEL."' and sort='".$_GET['SORT']."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NO_KEL, a.NAMA_KEL, b.SORT ORDER BY b.SORT ";
									
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
										
										
  $P1 = $row['P1'];
  $P2 = $row['P2'];
  $P3 = $row['P3'];
  $P4 = $row['P4'];
  $P5 = $row['P5'];
  
  
$tbl = '<tr>
		<td>'.$P1.'</td>
		<td>'.$P2.'</td>		
		<td>'.$P3.'</td>
		<td>'.$P4.'</td>
		<td>'.$P5.'</td>
		
		
		</tr>';
}
// Print text using writeHTMLCell()
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
// ---------------------------------------------------------
// Print some HTML Cells


// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table


//Close and output PDF document
$pdf->Output('statistik_disduk.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

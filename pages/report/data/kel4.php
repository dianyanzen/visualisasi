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
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dian Septian');
$pdf->SetTitle('Statistik Kepala Keluarga'.$NOKEC.'-'.$NOKEL);
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
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Kepala Keluarga Kecamatan '.$KECAMATAN.', Kelurahan '.$KELURAHAN.'', PDF_HEADER_STRING);

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
                                        <th>A</th>
                                        <th>B</th>
                                        <th>AB</th>
										<th>O</th>
										<th>A+</th>
                                        <th>A-</th>
                                        <th>B+</th>
										<th>B-</th>
										<th>AB+</th>
                                        <th>AB-</th>
                                        <th>O+</th>
										<th>O-</th>
										<th>Tidak Tahu</th>
										<th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>';
$tbl_footer = '</tbody></table>';
$tbl ='';
$sql= "SELECT a.NO_KEC as P17, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(b.A) AS P3,SUM(b.B) AS P4,SUM(b.AB) AS P5,SUM(b.O) AS P6,SUM(b.A_POS) AS P7,SUM(b.A_MIN) AS P8,SUM(b.B_POS) AS P9,SUM(b.B_MIN) AS P10,SUM(b.AB_POS) AS P11,SUM(b.AB_MIN) AS P12,SUM(b.O_POS) AS P13,SUM(b.O_MIN) AS P14, SUM(b.TIDAK_TAHU) AS P15, SUM(A) +SUM(B) +SUM(AB) +SUM(O) +SUM(A_POS) +SUM(A_MIN) +SUM(B_POS)+SUM(B_MIN) +SUM(AB_POS)+SUM(AB_MIN) +SUM(O_POS) + SUM(O_MIN) + SUM(TIDAK_TAHU) as P16
									FROM SETUP_KEL a INNER JOIN T5_KEPKEL_GOLONGAN_DARAH b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND a.NO_KEL ='".$NOKEL."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NO_KEL, a.NAMA_KEL ORDER BY a.NO_KEL";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
										
										
  $P1 = $row['P1'];
  $P2 = $row['P2'];
  $P3 = $row['P3'];
  $P4 = $row['P4'];
  $P5 = $row['P5'];
  $P6 = $row['P6'];
  $P7 = $row['P7'];
  $P8 = $row['P8'];
  $P9 = $row['P9'];
  $P10 = $row['P10'];
  $P11 = $row['P11'];
  $P12 = $row['P12'];
  $P13 = $row['P13'];
  $P14 = $row['P14'];
  $P15 = $row['P15'];
  $P16 = $row['P16'];
$tbl = '<tr>
		<td>'.$P1.'</td>
		<td>'.$P2.'</td>		
		<td>'.$P3.'</td>
		<td>'.$P4.'</td>
		<td>'.$P5.'</td>
		<td>'.$P6.'</td>		
		<td>'.$P7.'</td>
		<td>'.$P8.'</td>
		<td>'.$P9.'</td>
		<td>'.$P10.'</td>
		<td>'.$P11.'</td>
		<td>'.$P12.'</td>		
		<td>'.$P13.'</td>
		<td>'.$P14.'</td>
		<td>'.$P15.'</td>		
		<td>'.$P16.'</td>
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

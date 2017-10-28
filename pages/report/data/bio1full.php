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

$NOKEC = $_GET['NOKEC'];
$NOKEL = $_GET['NOKEL'];
$NORW = $_GET['NORW'];
$NORT = $_GET['NORT'];
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
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Penduduk Kecamatan '.$KECAMATAN.', Kelurahan '.$KELURAHAN.'', 'RW  00'.$NORW.', RT 00'.$NORT.' '.PDF_HEADER_STRING);

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
									    <th bgcolor="#337ab7" color="white" width="7%"><span style="font-weight: bold;">Nomor</span></th>
                                        <th bgcolor="#337ab7" color="white" width="10%"><span style="font-weight: bold;">No Rw</span></th>
										<th bgcolor="#337ab7" color="white" width="10%"><span style="font-weight: bold;">No Rt</span></th>
										<th bgcolor="#337ab7" color="white" width="20%"><span style="font-weight: bold;">Nik</span></th>
										<th bgcolor="#337ab7" color="white" width="33%"><span style="font-weight: bold;">Nama Lengkap</span></th>
										<th bgcolor="#337ab7" color="white" width="20%"><span style="font-weight: bold;">Jenis Kelamin</span></th>
                                    </tr>
                                </thead>
                                <tbody>';
$tbl_footer = '</tbody></table>';
$tbl ='';
$urt = 0;
$sql= "SELECT TO_CHAR(B.NO_RW,'000') AS P1, TO_CHAR(B.NO_RT,'000') AS P2, A.NIK AS P3, A.NAMA_LGKP AS P4, 
CASE WHEN A.JENIS_KLMIN = 1 THEN 'LAKI-LAKI'
ELSE 'PEREMPUAN' END AS P5
FROM BIODATA_WNI A INNER JOIN DATA_KELUARGA B ON A.NO_KK = B.NO_KK WHERE 
A.NO_PROP=32 AND A.NO_KAB=73 AND A.NO_KEC = ".$NOKEC." AND A.NO_KEL =".$NOKEL." AND B.NO_RW = ".$NORW." AND B.NO_RT =".$NORT."  AND 
(A.FLAG_STATUS = '0' OR (A.FLAG_STATUS = '2' AND A.FLAG_PINDAH IN(1,2,3))) AND B.NO_RT <> 0 AND B.NO_RW <> 0 ORDER BY P1, P2, P5, P4";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
										
  $urt++;
  $P1 = $row['P1'];
  $P2 = $row['P2'];
  $P3 = $row['P3'];
  $P4 = $row['P4'];
  $P5 = $row['P5'];
  
$tbl.= '<tr>
		<td width="7%">'.$urt.'</td>
		<td width="10%">'.$P1.'</td>
		<td width="10%">'.$P2.'</td>		
		<td width="20%">'.$P3.'</td>
		<td width="33%">'.$P4.'</td>
		<td width="20%">'.$P5.'</td>
		
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

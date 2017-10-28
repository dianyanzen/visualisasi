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
Include('connect223.php');
session_start();
$BULAN = $_GET['BULAN'];
$USR = $_GET['USR'];

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dian Septian');
$pdf->SetTitle('Rekap Absensi'.$USR.'-'.$BULAN);
$pdf->SetSubject('Absensi');
$pdf->SetKeywords('Absensi, PDF, example, test, guide');
$sql= "SELECT NAMA_LGKP, NAMA_KANTOR FROM SIAK_USER_PLUS WHERE USER_ID = '".$USR."'";
					$stmt = oci_parse($conn222, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					$NAMA_LGKP = $row['NAMA_LGKP'];
					$NAMA_LGKP = ucwords(strtolower($NAMA_LGKP));
					$NAMA_KANTOR = $row['NAMA_KANTOR'];
					$NAMA_KANTOR = ucwords(strtolower($NAMA_KANTOR));

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Rekap Absensi Operator '.$NAMA_LGKP.', '.$NAMA_KANTOR.'', PDF_HEADER_STRING);

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
// $sql = "SELECT NIK FROM BIODATA_WNI where ROWNUM <= 5";

// Set some content to print
$tbl_header = '<table width="100%" border="1" align="center">
                                <thead>
                                    <tr>
									    <th bgcolor="#337ab7" color="white" width="5%"><span style="font-weight: bold;">No</span></th>
                                        <th bgcolor="#337ab7" color="white" width="15%"><span style="font-weight: bold;">Tanggal</span></th>
										<th bgcolor="#337ab7" color="white" width="20%"><span style="font-weight: bold;">Jam Masuk</span></th>
										<th bgcolor="#337ab7" color="white" width="20%"><span style="font-weight: bold;">Jam Keluar</span></th>
										<th bgcolor="#337ab7" color="white" width="20%"><span style="font-weight: bold;">Jam Kerja</span></th>
										<th bgcolor="#337ab7" color="white" width="20%"><span style="font-weight: bold;">Keterangan</span></th>
                                    </tr>
                                </thead>
                                <tbody>';
$tbl_footer = '</tbody></table>';
$tbl ='';
$urut = 0 ;
									$sql= "SELECT TO_CHAR(TRUNC(TO_DATE('$BULAN)','MM-yyyy'), 'MM') + LEVEL - 1,'DD-MM-YYYY') AS DAY
											FROM DUAL
											CONNECT BY TRUNC(TRUNC(TO_DATE('$BULAN)','MM-yyyy'), 'MM') + LEVEL - 1, 'MM') = TRUNC(TO_DATE('$BULAN)','MM-yyyy'), 'MM')";
									$stmt = oci_parse($conn222, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
										// $sql2= "SELECT USER_ID, NAMA_LGKP FROM SIAK_USER_PLUS WHERE USER_ID ='$USR'";
									// $stmt2 = oci_parse($conn222, $sql2);
									// oci_execute($stmt2);
									// $row2 = oci_fetch_array($stmt2);
                   
									
						
									
									
									$P1 = $row['DAY'];
									// $sql3= "SELECT JAM_MASUK, JAM_KELUAR, KETERANGAN FROM SIAK_ABSENSI WHERE USER_ID ='$USR' AND TANGGAL = TO_DATE('".$row['DAY']."','DD-MM-YYYY')";
									// $stmt3 = oci_parse($conn222, $sql3);
									// oci_execute($stmt3);
									// $row3 = oci_fetch_array($stmt3);
									// $JMSK = htmlentities($row3['JAM_MASUK']);
									// $urt++;
									// if ($JMSK =='')
									// {
										// $tbl.= '<tr>
										// <td width="7%">'.$urt.'</td>
										// <td width="10%">'.$P1.'</td>
										// <td width="10%">-</td>		
										// <td width="20%">-</td>
										// <td width="33%">-</td>
										// <td width="20%">-</td>
										// </tr>';
									// }ELSE{
										// $P2 = $row3['JAM_MASUK'];
										// $P3 = $row3['JAM_KELUAR'];
										// $first  = new DateTime( $row3['JAM_MASUK'] );
										// $second = new DateTime( $row3['JAM_KELUAR'] );
										// $diff = $first->diff( $second );
										// $P4 = $diff->format( '%H Jam %I Menit' );
										// $P5 = $row3['KETERANGAN'];
										// $tbl.= '<tr>
										// <td width="7%">'.$urt.'</td>
										// <td width="10%">'.$P1.'</td>
										// <td width="10%">'.$P2.'</td>		
										// <td width="20%">'.$P3.'</td>
										// <td width="33%">'.$P4.'</td>
										// <td width="20%">'.$P5.'</td>
										// </tr>';
									// }
                                    // echo "</tr>";
									
										
  
  $urt++;
  // $P1 = $row['P1'];
  // $P2 = $row['P2'];
  // $P3 = $row['P3'];
  // $P4 = $row['P4'];
  // $P5 = $row['P5'];
  $tbl.= '<tr>
										<td width="7%">'.$urt.'</td>
										<td width="10%">'.$P1.'</td>
										<td width="10%">'.$P1.'</td>		
										<td width="20%">'.$P1.'</td>
										<td width="33%">'.$P1.'</td>
										<td width="20%">'.$P1.'</td>
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

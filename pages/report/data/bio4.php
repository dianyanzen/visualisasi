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
$_SESSION['PKRJN'] = $_GET['PKRJN'];
$PKRJN = $_SESSION['PKRJN'];
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
					$sql= "SELECT KODE_PEKERJAAN AS P3,
      CASE WHEN KODE_PEKERJAAN  = '1' THEN 'Belum/Tidak Bekerja'
         WHEN KODE_PEKERJAAN = '2' THEN 'Mengurus Rumah Tangga'
         WHEN KODE_PEKERJAAN = '3' THEN 'Pelajar/Mahasiswa'
         WHEN KODE_PEKERJAAN = '4' THEN 'Pensiunan'
         WHEN KODE_PEKERJAAN = '5' THEN 'Pegawai Negeri Sipil(PNS)'
         WHEN KODE_PEKERJAAN = '6' THEN 'Tentara Nasional Indonesia (TNI)'
         WHEN KODE_PEKERJAAN = '7' THEN 'Kepolisian RI (POLRI)'
         WHEN KODE_PEKERJAAN = '8' THEN 'Perdagangan'
         WHEN KODE_PEKERJAAN = '9' THEN 'Petani/Pekebun'
         WHEN KODE_PEKERJAAN = '10' THEN 'Peternak'
         WHEN KODE_PEKERJAAN = '11' THEN 'Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '12' THEN 'Industri'
         WHEN KODE_PEKERJAAN = '13' THEN 'Konstruksi'
         WHEN KODE_PEKERJAAN = '14' THEN 'Transportasi'
         WHEN KODE_PEKERJAAN = '15' THEN 'Karyawan Swasta'
         WHEN KODE_PEKERJAAN = '16' THEN 'Karyawan BUMN'
         WHEN KODE_PEKERJAAN = '17' THEN 'Karyawan BUMD'
         WHEN KODE_PEKERJAAN = '18' THEN 'Karyawan Honorer'
         WHEN KODE_PEKERJAAN = '19' THEN 'Buruh Harian Lepas'
         WHEN KODE_PEKERJAAN = '20' THEN 'Buruh Tani/Perkebunan'
         WHEN KODE_PEKERJAAN = '21' THEN 'Buruh Nelayan/Perikanan'
         WHEN KODE_PEKERJAAN = '22' THEN 'Buruh Peternakan'
         WHEN KODE_PEKERJAAN = '23' THEN 'Pembantu Rumah Tangga'
         WHEN KODE_PEKERJAAN = '24' THEN 'Tukang Cukur'
         WHEN KODE_PEKERJAAN = '25' THEN 'Tukang Listrik'
         WHEN KODE_PEKERJAAN = '26' THEN 'Tukang Batu'
         WHEN KODE_PEKERJAAN = '27' THEN 'Tukang Kayu'
         WHEN KODE_PEKERJAAN = '28' THEN 'Tukang Sol Sepatu'
         WHEN KODE_PEKERJAAN = '29' THEN 'Tukang Las/Pandai Besi'
         WHEN KODE_PEKERJAAN = '30' THEN 'Tukang Jahit'
         WHEN KODE_PEKERJAAN = '31' THEN 'Tukang Gigi'
         WHEN KODE_PEKERJAAN = '32' THEN 'Penata Rias'
         WHEN KODE_PEKERJAAN = '33' THEN 'Penata Busana'
         WHEN KODE_PEKERJAAN = '34' THEN 'Penata Rambut'
         WHEN KODE_PEKERJAAN = '35' THEN 'Mekanik'
         WHEN KODE_PEKERJAAN = '36' THEN 'Seniman'
         WHEN KODE_PEKERJAAN = '37' THEN 'Tabib'
         WHEN KODE_PEKERJAAN = '38' THEN 'Paraji'
         WHEN KODE_PEKERJAAN = '39' THEN 'Perancang Busana'
         WHEN KODE_PEKERJAAN = '40' THEN 'Penterjemah'
         WHEN KODE_PEKERJAAN = '41' THEN 'Imam Masjid'
         WHEN KODE_PEKERJAAN = '42' THEN 'Pendeta'
         WHEN KODE_PEKERJAAN = '43' THEN 'Pastor'
         WHEN KODE_PEKERJAAN = '44' THEN 'Wartawan'
         WHEN KODE_PEKERJAAN = '45' THEN 'Uztadz/Mubaligh'
         WHEN KODE_PEKERJAAN = '46' THEN 'Juru Masak'
         WHEN KODE_PEKERJAAN = '47' THEN 'Promotor Acara'
         WHEN KODE_PEKERJAAN = '48' THEN 'Anggota DPR RI'
         WHEN KODE_PEKERJAAN = '49' THEN 'Anggota DPD RI'
         WHEN KODE_PEKERJAAN = '50' THEN 'Anggota BPK'
         WHEN KODE_PEKERJAAN = '51' THEN 'Presiden'
         WHEN KODE_PEKERJAAN = '52' THEN 'Wakil Presiden'
         WHEN KODE_PEKERJAAN = '53' THEN 'Anggota Mahkamah Konstitusi'
         WHEN KODE_PEKERJAAN = '54' THEN 'Anggota Kabinet Kementrian'
         WHEN KODE_PEKERJAAN = '55' THEN 'Duta Besar'
         WHEN KODE_PEKERJAAN = '56' THEN 'Gubernur'
         WHEN KODE_PEKERJAAN = '57' THEN 'Wakil Gubernur'
         WHEN KODE_PEKERJAAN = '58' THEN 'Bupati'
         WHEN KODE_PEKERJAAN = '59' THEN 'Wakil Bupati'
         WHEN KODE_PEKERJAAN = '60' THEN 'Walikota'
         WHEN KODE_PEKERJAAN = '61' THEN 'Wakil Walikota'
         WHEN KODE_PEKERJAAN = '62' THEN 'Anggota DPRD PROP'
         WHEN KODE_PEKERJAAN = '63' THEN 'Anggota DPRD Kota'
         WHEN KODE_PEKERJAAN = '64' THEN 'Dosen'
         WHEN KODE_PEKERJAAN = '65' THEN 'Guru'
         WHEN KODE_PEKERJAAN = '66' THEN 'Pilot'
         WHEN KODE_PEKERJAAN = '67' THEN 'Pengacara'
         WHEN KODE_PEKERJAAN = '68' THEN 'Notaris'
         WHEN KODE_PEKERJAAN = '69' THEN 'Arsitek'
         WHEN KODE_PEKERJAAN = '70' THEN 'Akuntan'
         WHEN KODE_PEKERJAAN = '71' THEN 'Konsultan'
         WHEN KODE_PEKERJAAN = '72' THEN 'Dokter'
         WHEN KODE_PEKERJAAN = '73' THEN 'Bidan'
         WHEN KODE_PEKERJAAN = '74' THEN 'Perawat'
         WHEN KODE_PEKERJAAN = '75' THEN 'Apoteker'
         WHEN KODE_PEKERJAAN = '76' THEN 'Psikiater/Psikolog'
         WHEN KODE_PEKERJAAN = '77' THEN 'Penyiar Televisi'
         WHEN KODE_PEKERJAAN = '78' THEN 'Penyiar Radio'
         WHEN KODE_PEKERJAAN = '79' THEN 'Pelaut'
         WHEN KODE_PEKERJAAN = '80' THEN 'Peneliti'
         WHEN KODE_PEKERJAAN = '81' THEN 'Sopir'
         WHEN KODE_PEKERJAAN = '82' THEN 'Pialang'
         WHEN KODE_PEKERJAAN = '83' THEN 'Paranormal'
         WHEN KODE_PEKERJAAN = '84' THEN 'Pedagang'
         WHEN KODE_PEKERJAAN = '85' THEN 'Perangkat Desa'
         WHEN KODE_PEKERJAAN = '86' THEN 'Kepala Desa'
         WHEN KODE_PEKERJAAN = '87' THEN 'Biarawan/Biarawati'
         WHEN KODE_PEKERJAAN = '88' THEN 'Wiraswasta'
         ELSE 'Pekerjaan Lainnya' END AS P1, 
SUM(VALUE) AS P2 FROM T5_STT_PEKERJAAN  WHERE NO_PROP='32' AND NO_KAB ='73' AND KODE_PEKERJAAN='".$PKRJN."' AND BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND BLN < TO_DATE('".$BULAN."','MM/yyyy')+1 GROUP BY KODE_PEKERJAAN ORDER BY KODE_PEKERJAAN";
					$stmt = oci_parse($conn, $sql);
					oci_execute($stmt);
					$row = oci_fetch_array($stmt);
					$PKRJN = $row['P1'];
					$PKRJN = ucwords(strtolower($PKRJN));
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Penduduk '.$KECAMATAN.', '.$KELURAHAN.', Pekerjaan '.$PKRJN.'', PDF_HEADER_STRING);

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
                                        <th>Pekerjaan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>';
$tbl_footer = '</tbody></table>';
$tbl ='';
$sql= "SELECT a.NO_KEC as P99, a.NO_KEL as P1, a.NAMA_KEL AS P2, SUM(VALUE) AS P3
									FROM SETUP_KEL a INNER JOIN T5_STT_PEKERJAAN b
									ON a.NO_KEC=b.NO_KEC and a.NO_KEL=b.NO_KEL  WHERE a.NO_PROP='32' AND a.NO_KAB ='73' AND a.NO_KEC ='".$NOKEC."' AND a.NO_KEL='".$NOKEL."' AND b.KODE_PEKERJAAN ='".$_GET['PKRJN']."' and b.BLN  >= TO_DATE('".$BULAN."','MM/yyyy') AND b.BLN < TO_DATE('".$BULAN."','MM/yyyy')+1
									GROUP BY a.NO_KEC, a.NO_KEL, a.NAMA_KEL ORDER BY a.NO_KEL";
									$stmt = oci_parse($conn, $sql);
									oci_execute($stmt);
									while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
										
										
  $P1 = $row['P1'];
  $P2 = $row['P2'];
  $P3 = $row['P3'];

  
$tbl = '<tr>
		<td>'.$P1.'</td>
		<td>'.$P2.'</td>		
		<td>'.$PKRJN.'</td>		
		<td>'.$P3.'</td>
		
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

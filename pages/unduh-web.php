<?php

						$file_url = '../../../../config/subhtml/login/admin/config/scurity/system/yanzen/system/key-umum.php';
						header('Content-Type: application/octet-stream');
						header("Content-Transfer-Encoding: Binary"); 
						header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
						readfile($file_url); // do the double-download-dance (dirty but worky)
?>
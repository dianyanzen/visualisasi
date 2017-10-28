
		<?php
Include('../config/connect223.php');

//COUNT OPERATOR
$sqlopr= "SELECT COUNT(USER_ID) AS COUNT FROM T5_SESSION";
$stmtopr = oci_parse($conn, $sqlopr);
oci_execute($stmtopr);
$ropr = oci_fetch_array($stmtopr);

//COUNT TOTAL OPERATOR
$sqloprt= "SELECT COUNT(USER_ID) AS COUNT FROM T5_SIAK_USER";
$stmtoprt = oci_parse($conn, $sqloprt);
oci_execute($stmtoprt);
$roprt = oci_fetch_array($stmtoprt);
//TAMPILKAN OPERATOR
$opr = number_format(htmlentities($ropr['COUNT']));
$oprt = number_format(htmlentities($roprt['COUNT']));
$toprt = $oprt - $opr;
$persen = ($opr / $oprt) * 100;
$tpersen = 100 - $persen;
?>
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Status Operator
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<div>
                                    <p>
                                        <strong>Operator Aktiv</strong>
                                        <span class="pull-right text-muted"><?php echo $opr?> Pengguna</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $persen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen?>%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
								<div>
                                    <p>
                                        <strong>Operator Tidak Aktiv</strong>
                                        <span class="pull-right text-muted"><?php echo $toprt?> Pengguna</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $tpersen?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $tpersen?>%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
						</div>
<?php
if ($_GET['MODESORTI']!=='') {
require('PAT.php');
$pdf = new DNR( 'p', 'mm', 'A4' );$pdf->AliasNbPages();
$pdf->RSS($_GET['id'],$_GET['IDDNR']);
}
else
{
header('location: ../Pat/view/'.$_GET['IDDNR']);
}
?>
<?php
require('DNR.php');
$pdf = new DNR( 'p', 'mm', 'A4' );$pdf->AliasNbPages();
$pdf->FDNRPDF($_GET["uc"]);
?>
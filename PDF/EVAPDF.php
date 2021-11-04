<?php

if (!ISSET($_POST['annee'])||!ISSET($_POST['mois'])||!ISSET($_POST['jour'])||!ISSET($_POST['annee1'])||!ISSET($_POST['mois1'])||!ISSET($_POST['jour1']))
{
$datejour1 =date("Y-m-d");
$datejour2 =date("Y-m-d");
}
else
{
 if(empty($_POST['annee'])||empty($_POST['mois'])||empty($_POST['jour'])||empty($_POST['annee1'])||empty($_POST['mois1'])||empty($_POST['jour1']))
 {
 $datejour1 =date("Y-m-d");
 $datejour2 =date("Y-m-d");
 }
 else
 {
 $datejour1 = $_POST['annee'] .'-'.$_POST['mois'] .'-'.$_POST['jour'];
 $datejour2 = $_POST['annee1'].'-'.$_POST['mois1'].'-'.$_POST['jour1'];
 }
}
$datejour11 = $_POST['jour'].'-'.$_POST['mois'] .'-'.$_POST['annee'];
$datejour22 = $_POST['jour1'].'-'.$_POST['mois1'].'-'.$_POST['annee1'];
if ($datejour1>$datejour2)
{
header("Location: ../eva/") ;
}
require('EVA.php');

if ($_POST['PTS']=='ANS') 
{	
    $pdf = new EVA( 'P', 'mm', 'A4' );$pdf->AliasNbPages();//importatant pour metre en fonction  le totale nombre de page avec "/{nb}" 	
	$pdf->SetAutoPagebreak(False);
	$pdf->SetMargins(0,0,0);
	$pdf->enteteeva($datejour1,$datejour2); 	
	$pdf->corpscollecte($datejour1,$datejour2);//1/UNITE COLLECTE 	
	$pdf-> corpspreparation($datejour1,$datejour2);//2/ UNITE PREPARATION 	
	$pdf->Immuno($datejour1,$datejour2);//3/ UNITE QUALIFICATIONS BIOLOGIQUES//*******IMMUNOLOGIE*******//
	$pdf->enteteserologie($datejour1,$datejour2);//*******SEROLOGIE*******//	
	$pdf->enteteeva($datejour1,$datejour2);//4/ UNITE DISTRIBUTION
	$pdf->corpsdistribution1($datejour1,$datejour2);
	$pdf->piedeva();//$pdf->incidenttrans(232,'Nombre d accidents transfusionnels','Types d accidents transfusionnels');// $pdf->RAPPORT($datejour1,$datejour2); 
	$pdf->Output();
	
}
if ($_POST['PTS']=='EPH') 
{
	$pdf = new EVA( 'L', 'mm', 'A4' );$pdf->AliasNbPages();//importatant pour metre en fonction  le totale nombre de page avec "/{nb}" //
	$pdf->SetFillColor(230);    //fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$pdf->SetTextColor(0,0,0);//text noire
	$pdf->SetFont('Times', '', 13);
	$pdf->AddPage();
	$pdf->Text(80,10,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE");
	$pdf->Text(60,15,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE");
	$pdf->Text(60.5,20,"DIRECTION DE LA SANTE ET DE LA POPULAION DE LA WILAYA DE DJELFA");
	$pdf->Text(5,30,"ETABLISSEMENT PUBLIC HOSPITALIER AIN OUSSERA ");
	$pdf->Text(5,35,"POSTE DE TRANSFUSION SANGUINE ");
	$pdf->Text(4,40," N°:......./".date("Y"));
	$pdf->SetXY(5,50);
	$pdf->Cell(282,10,'ACTIVITE DU PTS  :   du  '.$datejour11."  au  ".$datejour22,0,1,'C');
	$h=70;
	$pdf->SetFont('Times', '', 7.5);
	$pdf->SetXY(05,$h); 	  
	$pdf->cell(30,15,"Type d'examen",1,0,'C',1,0);
	$pdf->SetXY(35,$h); 	  
	$pdf->cell(10,7.5,"",1,0,'C',1,0);
	$pdf->SetXY(35,$h+7.5); 	  
	$pdf->cell(10,7.5,"code",1,0,'C',1,0);
	$pdf->entete(45+(22*0),$h,"M.H","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*1),$h,"M.F","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*2),$h,"CH.H","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*3),$h,"CH.F","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*4),$h,"GYN","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*5),$h,"MAT","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*6),$h,"PED","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*7),$h,"HD","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*8),$h,"EXT","Nbr.Exam","Nbr.B");
	$pdf->entete(45+(22*9),$h,"U.BLOC","Nbr.Exam","Nbr.B");
	$x=45+(22*10);
	$pdf->SetXY($x,$h); 	  
	$pdf->cell(22,15,"Nbr.Don",1,0,'C',1,0);
	$pdf->ligne($h+20+(7.5*0),"Ac HIV","1630",45,45,45,45,45,45,45,45,45,45,"","HIV",$datejour1,$datejour2);
	$pdf->ligne($h+20+(7.5*1),"Ag HBS","1634",70,70,70,70,70,70,70,70,70,70,"","HVB",$datejour1,$datejour2);
	$pdf->ligne($h+20+(7.5*2),"Ac HCV","1630",40,40,40,40,40,40,40,40,40,40,"","HVC",$datejour1,$datejour2);
	$pdf->ligne($h+20+(7.5*3),"VDRL","1639",40,40,40,40,40,40,40,40,40,40,"","TPHA",$datejour1,$datejour2);
	$pdf->ligne($h+20+(7.5*4),"Groupage","1524",30,30,30,30,30,30,30,30,30,30,"","GRABO",$datejour1,$datejour2);
	$pdf->lignedis($h+20+(7.5*5),"Test de C","1531",40,40,40,40,40,40,40,40,40,40,"***",$datejour1,$datejour2);
	$pdf->SetFont('Times', '', 13);
	$pdf->SetXY(230,$pdf->GetY()+20); 	  
	$pdf->cell(6,0.5,"Ain oussera le  ".date("d-m-Y"),0,0,'C',0);
	$pdf->SetXY(230,$pdf->GetY()+10); 	  
	$pdf->cell(6,0.5,"Le chef de service ",0,0,'C',0);$pdf->Output();	
}

?>

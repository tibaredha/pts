<?php
$t=$_GET['DATEDON'];
$id=$_GET['id'];
require('DNR.php');
$pdf = new DNR( 'L', 'mm', 'A4' );
$pdf->AliasNbPages();//importatant pour metre en fonction  le totale nombre de page avec "/{nb}" 
$date=date("d-m-y");
$pdf->SetFillColor(230);//fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
$pdf->SetTextColor(0,0,0);//text noire
$pdf->SetFont('Times', 'B', 11);
$pdf->AliasNbPages();//prise encharge du nbr de page 

$pdf->entetepage1('Dons compagne  du '.$t);
//I  Repartition des dons par groupage rhesus
$ap=$pdf->compagne('A','Positif',$t);
$an=$pdf->compagne('A','negatif',$t);
$bp=$pdf->compagne('B','Positif',$t);
$bn=$pdf->compagne('B','negatif',$t);
$abp=$pdf->compagne('AB','Positif',$t);
$abn=$pdf->compagne('AB','negatif',$t);
$op=$pdf->compagne('O','Positif',$t);
$on=$pdf->compagne('O','negatif',$t);
$T4F2=array(
		"xt" => 5,
		"yt" => 40,
		"wc" => "",
		"hc" => "",
		"tt" => "I  Repartition des dons par groupage rhesus",
		"tc" => "Groupage",
		"tc1" =>"A",
		"tc2" =>"B",
		"tc3" =>"AB",
		"tc4" =>"O",
		"tc5" =>"Total",
		"l1c1" =>$ap,
		"l1c2" =>$bp,
		"l1c3" =>$abp,
		"l1c4" =>$op,
		"l1c5" =>$ap+$bp+$abp+$op,
		"l2c1" =>$an,
		"l2c2" =>$bn,
		"l2c3" =>$abn,
		"l2c4" =>$on,
		"l2c5" =>$an+$bn+$abn+$on,
		"l3c1" =>$ap+$an,
		"l3c2" =>$bp+$bn,
		"l3c3" =>$abp+$abn,
		"l3c4" =>$op+$on,
		"l3c5" =>$ap+$an+$bp+$bn+$abp+$abn+$op+$on,
		"tl" =>"Rhesus",
		"tl1" =>"Rh+",
		"tl2" =>"Rh-",
		"tl3" =>"Total"
		);
$pdf-> T4F2($T4F2);
$pie4 = array(
		"x" => 200, "y" => 65, 
		"r" => 17,
		"v1" => $ap+$an,
		"v2" => $bp+$bn,
		"v3" => $abp+$abn,
		"v4" => $op+$on,
		"t0" => "1 - Dons par groupage ABO ",
		"t1" => "A",
		"t2" => "B",
		"t3" => "AB",
		"t4" => "O"
		);
$pdf->pie4($pie4);
//II  Repartition des dons par  groupage sexe
$am=$pdf->compagnesexe('A','M',$t);
$af=$pdf->compagnesexe('A','F',$t);
$bm=$pdf->compagnesexe('B','M',$t);
$bf=$pdf->compagnesexe('B','F',$t);
$abm=$pdf->compagnesexe('AB','M',$t);
$abf=$pdf->compagnesexe('AB','F',$t);
$om=$pdf->compagnesexe('O','M',$t);
$of=$pdf->compagnesexe('O','F',$t);
$T4F2=array(
		"xt" => 5,
		"yt" => 100,
		"wc" => "",
		"hc" => "",
		"tt" => "II  Repartition des dons par  groupage sexe",
		"tc" => "Groupage",
		"tc1" =>"A",
		"tc2" =>"B",
		"tc3" =>"AB",
		"tc4" =>"O",
		"tc5" =>"Total",
		"l1c1" =>$am,
		"l1c2" =>$bm,
		"l1c3" =>$abm,
		"l1c4" =>$om,
		"l1c5" =>$am+$bm+$abm+$om,
		"l2c1" =>$af,
		"l2c2" =>$bf,
		"l2c3" =>$abf,
		"l2c4" =>$of,
		"l2c5" =>$af+$bf+$abf+$of,
		"l3c1" =>$am+$af,
		"l3c2" =>$bm+$bf,
		"l3c3" =>$abm+$abf,
		"l3c4" =>$om+$of,
		"l3c5" =>$am+$af+$bm+$bf+$abm+$abf+$om+$of,
		"tl" =>"Sexe",
		"tl1" =>"M",
		"tl2" =>"F",
		"tl3" =>"Total"
		);
$pdf-> T4F2($T4F2);
$pie2 = array(
"x" => 200, 
"y" => 125, 
"r" => 17,
"v1" => $am+$bm+$abm+$om,
"v2" => $af+$bf+$abf+$of,
"t0" => "1 - Dons par sexe  MF  ",
"t1" => "M",
"t2" => "F");
$pdf->pie2($pie2);


$pdf->entetepage1('Dons compagne  du '.$t);
//IV  Repartition des dons par tranche d'age
$ta=$pdf->AGEDON(18,19,$t);
$tb=$pdf->AGEDON(20,29,$t);
$tc=$pdf->AGEDON(30,39,$t);
$td=$pdf->AGEDON(40,49,$t);
$te=$pdf->AGEDON(50,59,$t);
$tf=$pdf->AGEDON(60,69,$t);
$tg=$pdf->AGEDON(70,79,$t);
$pdf->bar(200,150,$ta,$tb,$tc,$td,$te,$tf,$tg,utf8_decode('1 - Dons par tranche d\'age en année'));

$tta1=$pdf->AGEDON1(18,19,$t,'A');
$tta2=$pdf->AGEDON1(20,29,$t,'A');
$tta3=$pdf->AGEDON1(30,39,$t,'A');
$tta4=$pdf->AGEDON1(40,49,$t,'A');
$tta5=$pdf->AGEDON1(50,59,$t,'A');
$tta6=$pdf->AGEDON1(60,69,$t,'A');
$tta7=$pdf->AGEDON1(70,79,$t,'A');


$ttb1=$pdf->AGEDON1(18,19,$t,'B');
$ttb2=$pdf->AGEDON1(20,29,$t,'B');
$ttb3=$pdf->AGEDON1(30,39,$t,'B');
$ttb4=$pdf->AGEDON1(40,49,$t,'B');
$ttb5=$pdf->AGEDON1(50,59,$t,'B');
$ttb6=$pdf->AGEDON1(60,69,$t,'B');
$ttb7=$pdf->AGEDON1(70,79,$t,'B');


$ttab1=$pdf->AGEDON1(18,19,$t,'AB');
$ttab2=$pdf->AGEDON1(20,29,$t,'AB');
$ttab3=$pdf->AGEDON1(30,39,$t,'AB');
$ttab4=$pdf->AGEDON1(40,49,$t,'AB');
$ttab5=$pdf->AGEDON1(50,59,$t,'AB');
$ttab6=$pdf->AGEDON1(60,69,$t,'AB');
$ttab7=$pdf->AGEDON1(70,79,$t,'AB');


$tto1=$pdf->AGEDON1(18,19,$t,'O');
$tto2=$pdf->AGEDON1(20,29,$t,'O');
$tto3=$pdf->AGEDON1(30,39,$t,'O');
$tto4=$pdf->AGEDON1(40,49,$t,'O');
$tto5=$pdf->AGEDON1(50,59,$t,'O');
$tto6=$pdf->AGEDON1(60,69,$t,'O');
$tto7=$pdf->AGEDON1(70,79,$t,'O');

$T4F7=array(
		"xt" => 5,
		"yt" => 42,
		"wc" => "",
		"hc" => "",
		"tt" => "III  Repartition des dons par tranche d'age",
		"tc" => "Groupage",
		"tc1" =>"A",
		"tc2" =>"B",
		"tc3" =>"AB",
		"tc4" =>"O",
		"tc5" =>"Total",
		"l1c1" =>$tta1,
		"l1c2" =>$ttb1,
		"l1c3" =>$ttab1,
		"l1c4" =>$tto1,
		"l1c5" =>$tta1+$ttb1+$ttab1+$tto1,
		"l2c1" =>$tta2,
		"l2c2" =>$ttb2,
		"l2c3" =>$ttab2,
		"l2c4" =>$tto2,
		"l2c5" =>$tta2+$ttb2+$ttab2+$tto2,
		"l3c1" =>$tta3,
		"l3c2" =>$ttb3,
		"l3c3" =>$ttab3,
		"l3c4" =>$tto3,
		"l3c5" =>$tta3+$ttb3+$ttab3+$tto3,
		"l4c1" =>$tta4,
		"l4c2" =>$ttb4,
		"l4c3" =>$ttab4,
		"l4c4" =>$tto4,
		"l4c5" =>$tta4+$ttb4+$ttab4+$tto4,
		"l5c1" =>$tta5,
		"l5c2" =>$ttb5,
		"l5c3" =>$ttab5,
		"l5c4" =>$tto5,
		"l5c5" =>$tta5+$ttb5+$ttab5+$tto5,
		"l6c1" =>$tta6,
		"l6c2" =>$ttb6,
		"l6c3" =>$ttab6,
		"l6c4" =>$tto6,
		"l6c5" =>$tta6+$ttb6+$ttab6+$tto6,
		"l7c1" =>$tta7,
		"l7c2" =>$ttb7,
		"l7c3" =>$ttab7,
		"l7c4" =>$tto7,
		"l7c5" =>$tta7+$ttb7+$ttab7+$tto7,
		"l8c1" =>$tta1+$tta2+$tta3+$tta4+$tta5+$tta6+$tta7,
		"l8c2" =>$ttb1+$ttb2+$ttb3+$ttb4+$ttb5+$ttb6+$ttb7,
		"l8c3" =>$ttab1+$ttab2+$ttab3+$ttab4+$ttab5+$ttab6+$ttab7,
		"l8c4" =>$tto1+$tto2+$tto3+$tto4+$tto5+$tto6+$tto7,
		"l8c5" =>$tta1+$tta2+$tta3+$tta4+$tta5+$tta6+$tta7+$ttb1+$ttb2+$ttb3+$ttb4+$ttb5+$ttb6+$ttb7+$ttab1+$ttab2+$ttab3+$ttab4+$ttab5+$ttab6+$ttab7+$tto1+$tto2+$tto3+$tto4+$tto5+$tto6+$tto7,
		"tl" =>"Age",
		"tl1" =>"18-19",
		"tl2" =>"20-29",
		"tl3" =>"30-39",
		"tl4" =>"40-49",
		"tl5" =>"50-59",
		"tl6" =>"60-69",
		"tl7" =>"70-79",
		"tl8" =>"Total"
		);
$pdf-> T4F7($T4F7);

//IV  Repartition des donneurs par indication
$pdf->SetXY(5,150);$pdf->cell(90,5,'III  Repartition des donneurs par indication',1,0,'L',1,0);
$pdf->SetXY(5,155);$pdf->cell(20,5,'IND',1,0,'C',1,0);                        $pdf->SetXY(25,155);$pdf->cell(20,5,'CIT',1,0,'C',1,0);                       $pdf->SetXY(45,155);$pdf->cell(20,5,'CID',1,0,'C',1,0);                       $pdf->SetXY(65,155);$pdf->cell(30,5,'TOTAL',1,0,'C',1,0);
$pdf->SetXY(5,160);$pdf->cell(20,5,$pdf->compagneind('IND',$t),1,0,'C',0,0);  $pdf->SetXY(25,160);$pdf->cell(20,5,$pdf->compagneind('CIDT',$t),1,0,'C',0,0);$pdf->SetXY(45,160);$pdf->cell(20,5,$pdf->compagneind('CIDD',$t),1,0,'C',0,0);$pdf->SetXY(65,160);$pdf->cell(30,5,$pdf->compagneind('IND',$t)+$pdf->compagneind('CIDT',$t)+$pdf->compagneind('CIDD',$t),1,0,'C',0,0);
$pdf->SetXY(130,$pdf->GetY()+10);$pdf->cell(60,5,'DR '.strtoupper($pdf->USER()).' : '.trim($pdf->nbrtostring('mvc','cts','IDCTS',$pdf->STRUCTURE(),'CTS')),0,0,'C',0);		






$pdf->entetepage1('Liste nominative des dons compagne  du '.$t);//N:'.$id.'
$h=40;
$pdf->SetXY(5,$h);$pdf->cell(15,5,"IDP",1,0,'C',1,0);
$pdf->SetXY(20,$h);$pdf->cell(130,5,"NOM ET PRENOM ",1,0,'C',1,0);
$pdf->SetXY(150,$h);$pdf->cell(30,5,"NAISSANCE",1,0,'C',1,0);
$pdf->SetXY(180,$h);$pdf->cell(15,5,"AGE",1,0,'C',1,0);
$pdf->SetXY(195,$h);$pdf->cell(35,5,"GROUPAGE",1,0,'C',1,0);
$pdf->SetXY(195+35,$h);$pdf->cell(32,5,"TELEPHONE",1,0,'C',1,0);
$pdf->SetXY(195+67,$h);$pdf->cell(28,5,"SEXE",1,0,'C',1,0);
$pdf->SetXY(5,45); 
$pdf->mysqlconnect();
$query="SELECT * FROM don where DATEDON='$t' order by IDP "; //    % %will search form 0-9,a-z            
$resultat=mysql_query($query);
$totalmbr1=mysql_num_rows($resultat);
while($row=mysql_fetch_object($resultat))
{
$pdf->SetFont('Times', '', 11);
$pdf->cell(15,8,trim($row->IDP),1,0,'C',0);
$pdf->cell(130,8,trim($pdf->nbrtostring('mvc','dnr','id',$row->IDDNR,'NOM'))."_".trim($pdf->nbrtostring('mvc','dnr','id',$row->IDDNR,'PRENOM')),1,0,'L',0);
$pdf->cell(30,8,trim($pdf->nbrtostring('mvc','dnr','id',$row->IDDNR,'DATENAISSANCE')),1,0,'C',0);
$pdf->cell(15,8,$row->AGEDNR,1,0,'C',0);    
$pdf->cell(35,8,trim($row->GROUPAGE.'_'.$row->RHESUS),1,0,'C',0);
$pdf->cell(32,8,trim($pdf->nbrtostring('mvc','dnr','id',$row->IDDNR,'TELEPHONE')),1,0,'C',0);
$pdf->cell(28,8,trim($row->SEXEDNR),1,0,'C',0);
$pdf->SetXY(5,$pdf->GetY()+8); 
}
$pdf->SetXY(5,$pdf->GetY());$pdf->cell(15,5,"Total",1,0,'C',1,0);	  
$pdf->SetXY(20,$pdf->GetY());$pdf->cell(270,5,$totalmbr1."  "."Dons ",1,0,'C',1,0);				 
$pdf->SetXY(130,$pdf->GetY()+20);$pdf->cell(60,5,'DR '.strtoupper($pdf->USER()).' : '.trim($pdf->nbrtostring('mvc','cts','IDCTS',$pdf->STRUCTURE(),'CTS')),0,0,'C',0);	

// $pdf->AddPage();
// $pdf->SetFont('Arial','',10);
// $data = array(
	// 'Group 1' => array(
		// '08-02' => 2,
		// '08-23' => 4,
		// '09-13' => 2,
		// '10-04' => 4,
		// '10-25' => 2
	// ),
	// 'Group 2' => array(
		// '08-02' =>0,
		// '08-23' => 0,
		// '09-13' => 0,
		// '10-04' => 0,
		// '10-25' => 0
	// )
// );
// $colors = array(
	// 'Group 1' => array(114,171,237),
	// 'Group 2' => array(163,36,153)
// );
// $pdf->LineGraph(190,100,$data,'VHkBvBgBdB',$colors,100,6);


// $pdf->entetepage1('Dons compagne  du '.$t);
$pdf->AddPage('L','A4');
$x=1.5;//zoom
$y=0;//vertica
$z=0;//horizental
$pdf->SetLineWidth(0.51);
$pdf->SetFont('Times', 'B', 11);
$pdf->Polygon(array((11/$x)+$z,(64/$x)+$y,(48/$x)+$z,(60/$x)+$y,(50/$x)+$z,(80/$x)+$y,(68/$x)+$z,(78/$x)+$y,(69/$x)+$z,(91/$x)+$y,(59/$x)+$z,(106/$x)+$y,(44/$x)+$z,(102/$x)+$y,(11/$x)+$z,(76/$x)+$y,(11/$x)+$z,(64/$x)+$y),'FD');
// $pdf->color(1);
$pdf->Polygon(array(68/$x,78/$x,69/$x,91/$x,59/$x,106/$x,70/$x,120/$x,89/$x,103/$x,101/$x,81/$x,87/$x,70/$x,68/$x,78/$x),'FD');
//$pdf->color(10);
$pdf->Polygon(array(101/$x,81/$x, 89/$x,103/$x, 97/$x,110/$x, 98/$x,119/$x, 111/$x,123/$x, 122/$x,111/$x, 133/$x,93/$x, 138/$x,90/$x, 139/$x,82/$x, 126/$x,82/$x, 123/$x,86/$x ,119/$x,85/$x, 119/$x,80/$x, 127/$x,76/$x, 135/$x,62/$x, 130/$x,58/$x, 120/$x,70/$x, 119/$x,77/$x, 114/$x,77/$x, 109/$x,82/$x, 101/$x,81/$x),'FD');
//$pdf->color(100);
$pdf->Polygon(array(130/$x,58 /$x,135/$x,62 /$x,127/$x,76 /$x,119/$x,80 /$x,119/$x,85 /$x,123/$x,86 /$x,126/$x,82 /$x,139/$x,82 /$x,138/$x,90 /$x,133/$x,93 /$x,122/$x,111 /$x,154/$x,136 /$x,162/$x,127 /$x,161/$x,123 /$x,164/$x,117 /$x,158/$x,116 /$x,155/$x,87 /$x,160/$x,83 /$x,160/$x,78 /$x,155/$x,78 /$x,150/$x,82 /$x,150/$x,11 /$x,145/$x,8 /$x,143/$x,14 /$x,145/$x,22 /$x,143/$x,28 /$x,147/$x,33 /$x,147/$x,44 /$x,142/$x,48 /$x,137/$x,53 /$x,130/$x,58/$x),'FD');
//$pdf->color(1000);
$pdf->Polygon(array(150/$x,11 /$x,150/$x,82 /$x,155/$x,78 /$x,160/$x,78 /$x,160/$x,83 /$x,155/$x,87 /$x,158/$x,116 /$x,164/$x,117 /$x,161/$x,123 /$x,162/$x,127 /$x,172/$x,123 /$x,179/$x,119 /$x,191/$x,105 /$x,200/$x,98 /$x,194/$x,78 /$x,193/$x,64 /$x,188/$x,64 /$x,173/$x,50 /$x,172/$x,38 /$x,170/$x,25 /$x,165/$x,23 /$x,161/$x,6 /$x,150/$x,11/$x),'FD');
//$pdf->color(10000);
$pdf->Polygon(array(173/$x,50 /$x,188/$x,64 /$x,193/$x,64 /$x,194/$x,78 /$x,204/$x,75 /$x,224/$x,68 /$x,243/$x,53 /$x,221/$x,30 /$x,220/$x,22 /$x,212/$x,22 /$x,207/$x,14 /$x,205/$x,9 /$x,198/$x,14 /$x,197/$x,25 /$x,191/$x,36 /$x,185/$x,36 /$x,181/$x,38 /$x,173/$x,50/$x),'FD');
//$pdf->color(1);
$pdf->Polygon(array(243/$x,53/$x, 224/$x,68/$x, 237/$x,100/$x, 248/$x,105/$x, 256/$x,118/$x, 266/$x,108/$x, 263/$x,92/$x, 269/$x,89/$x, 270/$x,74/$x, 243/$x,53),'FD');
//$pdf->color(1);
$pdf->Polygon(array(191/$x,105/$x, 198/$x,112/$x, 200/$x,133/$x, 207/$x,130/$x, 216/$x,132/$x, 228/$x,132/$x, 234/$x,137/$x, 254/$x,117/$x, 256/$x,118/$x, 248/$x,105/$x, 237/$x,100/$x, 224/$x,68/$x, 204/$x,75/$x, 194/$x,78/$x, 194/$x,78/$x, 200/$x,98/$x, 191/$x,105/$x),'FD');
//$pdf->color(1);
$pdf->Polygon(array(154/$x,136/$x, 154/$x,144/$x, 163/$x,145/$x, 170/$x,149/$x, 177/$x,150/$x, 200/$x,133/$x, 198/$x,112/$x, 191/$x,105/$x, 179/$x,119/$x, 172/$x,123/$x, 162/$x,127/$x, 154/$x,136/$x),'FD');
//$pdf->color(1);
$pdf->Polygon(array(111/$x,123/$x, 109/$x,131/$x, 113/$x,135/$x, 107/$x,136/$x, 98/$x,153/$x, 108/$x,163/$x, 132/$x,155/$x, 141/$x,148/$x, 154/$x,144/$x, 154/$x,136/$x, 122/$x,111/$x, 111/$x,123/$x),'FD');
$pdf->Output();
<?php
require('TCPDF.php');
class PDF0 extends TCPDF
{ 
     public $nomprenom ="tibaredha";
	 public $db_host="localhost";
	 public $db_name="mvc"; //probleme avec base de donnes  il faut change  gpts avec mvc   
     public $db_user="root";
     public $db_pass="";
	 public $utf8 = "" ;
	
	function mysqlconnect()
	{
	$this->db_host;
	$this->db_name;
	$this->db_user;
	$this->db_pass;
    $cnx = mysql_connect($this->db_host,$this->db_user,$this->db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    $db  = mysql_select_db($this->db_name,$cnx) ;
	mysql_query("SET NAMES 'UTF8' ");
	return $db;
	}
    function REGION()
    {
	$REGION=$_SESSION["REGION"];
	return $REGION;
	}
	function WILAYA()
    {
	$WILAYA=$_SESSION["WILAYA"];
	return $WILAYA;
	}
	function STRUCTURE()
    {
	$STRUCTURE=$_SESSION["STRUCTURE"];
	return $STRUCTURE;
	}
	function USER()
    {
	$USER=$_SESSION["login"];
	return $USER;
	}
	function dateUS2FR($date)//2013-01-01
    {
	$J      = substr($date,8,2);
    $M      = substr($date,5,2);
    $A      = substr($date,0,4);
	$dateUS2FR =  $J."/".$M."/".$A ;
    return $dateUS2FR;//01/01/2013
    }
	function dateFR2US($date)//01/01/2013
	{
	$J      = substr($date,0,2);
    $M      = substr($date,3,2);
    $A      = substr($date,6,4);
	$dateFR2US =  $A."-".$M."-".$J ;
    return $dateFR2US;//2013-01-01
	}
	function datePlus($dateDo,$nbrJours)
	{
	$timeStamp = strtotime($dateDo); 
	$timeStamp += 24 * 60 * 60 * $nbrJours;
	$newDate = date("Y-m-d", $timeStamp);
	return  $newDate;
	}
	function nbrtostring($db_name,$tb_name,$colonename,$colonevalue,$resultatstring) 
	{
	if (is_numeric($colonevalue) and $colonevalue!=='0') 
	{ 
	$db_host="localhost"; 
    $db_user="root";
    $db_pass="";
    $cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    $db  = mysql_select_db($db_name,$cnx) ;
    mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name where $colonename=$colonevalue" );
    $row=mysql_fetch_object($result);
	$resultat=$row->$resultatstring;
	return $resultat;
	} 
	return $resultat2='??????';
	}
	
	
	function ENTETETCPDF()
	{
	$this->SetCreator(PDF_CREATOR);
	$this->SetAuthor('tibaredha');
	$this->SetTitle('TCPDF Example 001');
	$this->SetSubject('TCPDF Tutorial');
	$this->SetKeywords('TCPDF, PDF, example, test, guide');
	$this->SetHeaderData(PDF_HEADER_LOGO, 15, 'Poste De Transfusion Sanguine', 'Dr tiba', array(0,64,255), array(0,64,128));
	$this->setFooterData(array(0,64,0), array(0,64,128));
	$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$this->SetHeaderMargin(PDF_MARGIN_HEADER);
	$this->SetFooterMargin(PDF_MARGIN_FOOTER);
	$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$this->setFontSubsetting(true);
	$this->SetFont('dejavusans', '', 14, '', true);
	$this->AddPage();
	$this->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
	$this->writeHTMLCell(0, 0, '', '', '??????????????????????', 0, 1, 0, true, '', true);
	}
	
	
	function PROSDNRARA($idon)
	{
	$this->mysqlconnect();
	// $this->SetCreator(PDF_CREATOR);
	// $this->SetAuthor('tibaredha');
	// $this->SetTitle('TCPDF Example 001');
	// $this->SetSubject('TCPDF Tutorial');
	// $this->SetKeywords('TCPDF, PDF, example, test, guide');
	// $this->SetHeaderData(PDF_HEADER_LOGO, 15, 'Poste De Transfusion Sanguine', 'Dr tiba', array(0,64,255), array(0,64,128));
	// $this->setFooterData(array(0,64,0), array(0,64,128));
	// $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	// $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	// $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	// $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	// $this->SetHeaderMargin(PDF_MARGIN_HEADER);
	// $this->SetFooterMargin(PDF_MARGIN_FOOTER);
	// $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	// $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
	// $this->setFontSubsetting(true);
	// $this->SetFont('dejavusans', '', 14, '', true);
	$this->setPrintHeader(false);
	$this->setPrintFooter(false);
	$this->setRTL(true);
	$this->SetDisplayMode('fullpage','single');//mode d affichage 
	$this->SetFillColor(255,255,255);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(230);    //fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	$this->SetTextColor(0,0,0);  //text noire
	$query = "select * from DNR WHERE  ID = '$idon'    ";
	$resultat=mysql_query($query);
	$totalmbr1=mysql_num_rows($resultat);
	while($result=mysql_fetch_object($resultat))
	{
	//1ere page
	$this->AddPage();
	$this->SetFont('aefurat', '', 12);                 
	$this->RoundedRect(2, 2, 95, 205, 2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
	$this->SetTextColor(225,0,0);
	$this->Text(5,10,"???? ?????????? ???????????? ?????????? ");
	$this->SetTextColor(0,0,0);
	$this->Text(5,15,"???????????? ???? ?????????? ???? ?????????? ???????? ?????????????? ???? ???????? ???????? ???????? ");
	$this->Text(5,20,"?????????? ???? ?????????????? ?????? ?????????????? ?????????????? ?????????????? ???? ?????? ???? ");
	$this->Text(5,25,"???????? ???? ?????? ?????????????? ???? ???????? ???????? ???? ???? ?????? ????????  ????????  ");
	$this->Text(5,30,"???????? ?????????? , ?????????? ???????? ??????????????????  ");
	$this->SetTextColor(225,0,0);
	$this->Text(5,50,"???? ?????????? ???????????? ?????????? ");
	$this->SetTextColor(0,0,0);
	$this->Text(5,55,"???? ?????? ?????????? ???????? ???????? ?? ???????????? ???????? ???? ?????? 18 ?? 65 ");
	$this->Text(5,60,"?????? , ?????????? ???? ?????????? ???????? ?????????? 4 ???????? ???? ?????????? ?????????????? ");
	$this->Text(5,65,"???????????? ?? 3 ???????? ?????????????? ???????????? ???? ?????????? ???????????? ??????  ");
	$this->Text(5,70,"?????????? ?????? ?????????? ?????? ???????????? ???????????????? ");
	$this->SetTextColor(225,0,0);
	$this->Text(5+20,184,"???????? ???????? ???????????? ???????? ???? ??????????????");
	$this->SetTextColor(0,0,0);
	$this->RoundedRect(2+95+3, 2, 95, 205, 2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
	$this->SetTextColor(225,0,0);
	$this->Text(103,10,"?????? ???????? ???????????? ??????????  ");
	$this->SetTextColor(0,0,0);
	$this->Text(103,15,"???????? ???????????? ?????????? ?????? ?????????? ?????????? ?????? ???????? ???????????????? ???????? ");
	$this->Text(103,20,"?????????????????????? .");
	$this->Text(103,25,"???????????? ?????????? ???????????????? ?????????????? ???????? ???????? ");
	$this->SetTextColor(225,0,0);
	$this->Text(103,85,".?????? ???????? ???????????? ?????????? ");
	$this->SetTextColor(0,0,0);
	$this->Image('../public/images/photos/1.JPG',123+51, 34, 50, 50, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Text(103,90,"?????? ???? ???????? ?????????? ???????????? ?????????? ???????? ?????????? ???????? ??????  ");
	$this->Text(103,95,"???????? ???????????? ???? ?????????? ???? ?????? ?????? ?????? ???????????? ???????? ?????? ???????????? ");
	$this->Text(103,100,"????????");
	$this->Image('../public/images/photos/4.JPG',115+27, 105, 25, 25, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Image('../public/images/photos/3.JPG',155+27, 105, 25, 25, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Text(103,130,"?????? ?????? ?????????????? ?????? ?????????? ?????????? ?????? ???????? ???????????? ?????????????? ?? ");
	$this->Text(103,135,"?????????? ???????????????? ???????? ????????");
	$this->Text(103,140,"?????? ???????????? ???? ?????????????? ???????????? ???????? ???????? ????  ???? ?????????????? ?????????? ");
	$this->Text(103,145,"450 ?????? ?? ???????? ?????? ???????????? ?????? ?????? ???????? ???? ???????????? ????????????  ");
	$this->Text(103,150,"?????????? ???????? ?????????? ");
	$this->Image('../public/images/photos/6.JPG',115+27, 158, 25, 25, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Image('../public/images/photos/5.JPG',155+27, 158, 25, 25, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->SetTextColor(225,0,0);
	$this->Text(103+20,184,"???????? ???????? ???????????? ???????? ???? ??????????????");
	$this->SetTextColor(0,0,0);
	$this->RoundedRect(2+95+95+6, 2, 95, 205, 2,$round_corner='1111', $style='', $border_style=array(), $fill_color=array());
	$this->SetTextColor(225,0,0);
	$this->Text(200,10,"???? ???????? ???????????? ???????????? ?????????????????? ?????????? ?????????? ????????????");
	$this->SetTextColor(0,0,0);
	$this->Text(200,15,"?????? ???????? ???? ???????????? ?????????????? ?????????????? ?????? ?????????? ???????????? ????  ");
	$this->Text(200,20,"???????????? ?????????? ?????????? ?????????? ???????????? ?? ?????? ?????? ?????????????? ?????????????????? ");
	$this->Text(200,25,"?????????? ?? ?????? ?????????????? ????????");
	$this->Text(200,30," (???? ???????? ?????? ?????????? )");
	$this->Image('../public/images/photos/4.JPG',25+17, 40, 25, 25, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Image('../public/images/photos/3.JPG',65+17, 40, 25, 25, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->SetTextColor(225,0,0);
	$this->Text(200,90,"???? ?????? ?????????? ???? ???????? ?????????? ?????? ???? ?????????? ???????? . ");
	$this->SetTextColor(0,0,0);
	$this->Text(200,95,"?????? ???? ?????????????? ???? ???????? ?????????????? ?????????? ??????  ???? ?????????? ????????  ");
	$this->Text(200,100,"???? ?????? ?????????? ???????? ???????????? ???????? ?????????? ?????? ?????? ???? ???????? ");
	$this->Text(200,105,"?????????????? ???????? ????????  ");
	$this->SetTextColor(225,0,0);
	$this->Text(200+20,184,"???????? ???????? ???????????? ???????? ???? ??????????????");
	$this->SetTextColor(0,0,0);
	//2eme page
	$this->AddPage();
	$this->SetFont('aefurat', '', 12);
	$this->RoundedRect(2, 2, 95, 205, 2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
	$this->SetTextColor(225,0,0);
	$this->Text(5,10,"?????????? ?????? ???????????? ?????????? ???????? ???????????? ");
	$this->SetTextColor(0,0,0);
	$this->Text(5,15,"???? ???????????? ???????? ???????????? ?? ???????????????? ???? ?????????? ?????? ?????????? ????  ");
	$this->Text(5,20,"?????????? ?????????? ???? ?????????? ???????????? ???????????? ???????? ???????????? ?? ?????? ");
	$this->Text(5,25,"???????? ???? ?????????????? ?????????????? ???? ?????????????????????? ???? ?????????? ???? ???????? ?? ");
	$this->Text(5,30,"?????????????? ?????? ???????????? ???????????? (35 ?????? 45 ?????? ?????????????? ??????????????  ");
	$this->Text(5,35,"?????????????? ?? 05 ???????? ?????????????? ?????????????? )");
	$this->Image('../public/images/photos/DIS.JPG',272, 50, 50, 50, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Text(5,115,"???????????? ?????????? ?? ???????? ?????????? ??????????:");
	$this->Text(5,120,"(  ?? ???? ???????????? ???????????? ???????? ?????????? ??????????...)");
	$this->Text(5,125,"?? ???????? ?????? ???????? ???????? ?? ?????? : ");
	$this->Text(5,130,"( ?????? ?????????? ?????? ???????? ???????????? ?????????? .?? ?????? ?????????????? ");
	$this->Text(5,135,"?????? ???????? ???????? ?????????? ?????? ???????? .???? ???????? ??????  ");
	$this->Text(5,140,"????????......) ");
	$this->SetTextColor(225,0,0);
	$this->Text(5+20,184,"???????? ???????? ???????????? ???????? ???? ??????????????");
	$this->SetTextColor(0,0,0);
	$this->RoundedRect(2+95+3, 2, 95, 205, 2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
	$this->Text(103,10,"???????? ?????? ???? ???????? ?????? ???? ?????? ?????????? ???????????? ?????????? ???????? ???? ????   ");
	$this->Text(103,15,"???????? ???? ??????????  ");
	$this->Text(103,20,"?????????? ???? ?????????????????? ???????????? ?????????????? ?????????? ???????? ???????? ????????");
	$this->Text(103,25,"???? ?????????????? ?????????????? ????????");
	$this->SetTextColor(225,0,0);
	$this->Text(103,60,"?????? ??????");
	$this->Text(103,70,"?????????? ???????????? ???????????? ?????????? ".DATE('Y-10-25'));//
	$this->Text(103,80,"?????????? ???????????????? ???????????? ?????????? ".DATE('Y-03-30'));
	$this->Text(103,90,"?????????? ?????????????? ???????????? ??????????  ".DATE('Y-06-14'));
	$this->Text(126,120,trim($result->NOM)."_".trim($result->PRENOM));
	$this->SetTextColor(0,0,0);
	$this->Image('../public/images/photos/LOGOAO.GIF',145+17, 130, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Text(113,165,"?????????????? ???????????????? ?????????????????????? ???????? ??????????");
	$this->Text(133,170,"???????? ?????? ???????? ");
	$this->Text(123,175,"???????????? 88/32/82/027  ???????? 34 ");
	$this->Text(130,180,"???????????? 80/12/82/027");
	$this->SetTextColor(225,0,0);
	$this->Text(103+20,184,"???????? ???????? ???????????? ???????? ???? ??????????????");
	$this->SetTextColor(0,0,0);
	$this->RoundedRect(2+95+95+6, 2, 95, 205, 2, $round_corner='1111', $style='', $border_style=array(), $fill_color=array());
	$this->Text(215,10,"?????????????????? ?????????????????? ?????????????????????? ??????????????");
	$this->Text(210,15,"?????????? ?????????? ?? ???????????? ?? ?????????? ???????????????????? ");
	$this->Text(212,20,"?????????????? ???????????????? ?????????????????????? ???????? ?????????? ");
	$this->Text(232,25,"???????? ?????? ????????");
	$this->Image('../public/images/photos/gs.jpg',40+17, 35, 10, 10, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Image('../public/images/photos/1.JPG',60+17, 50, 50, 50, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->SetFont('aefurat', 'B', 16);
	$this->Text(210,108," ???? ?????? ???????????? ???? ???????????? ??????????");
	$this->Text(205,113,"?? ???? ?????????? ???????????? ?????????? ???????? ????????????");
	$this->SetFont('aefurat', '', 12);
	$this->Image('../public/images/photos/LOGOAO.GIF',50+17, 130, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
	$this->Text(235,163,DATE('Y-m-d'));
	$this->Text(205,170,"???????????? ?????????? ???? ?????????????????? ???????????? ???????????????? ?????????????????? ");
	$this->SetTextColor(225,0,0);
	$this->Text(200+20,184,"???????? ???????? ???????????? ???????? ???? ??????????????");
	$this->SetTextColor(0,0,0);
	}
	$this->Output(); 
	}
	function deces($id)
	{
		$this->setPrintHeader(false);
		$this->setPrintFooter(false);
		$this->AddPage();
		$this->SetFont('aefurat','B',10);
		$this->Rect(4,4,202,10,"d");
		$this->Text(50,5,"CERTIFICAT MEDICAL DE CONSTAT DE DECES");
		$this->SetFont('aefurat','B',8);
		$this->Text(51,10,"REMPLIR PAR LE MEDECIN adresser AU SEMEP DSP et INSP");
		$this->SetFont('aefurat','B',10);
		$this->Rect(4,14,202,240,"d");
		$this->SetFont('aefurat','B',8);
		$this->Text(160,15,"le docteur en m??decine");
		$this->Text(160,20,"sous-sign??.certifie que ");
		$this->Text(160,25,"la mort de la personne");
		$this->Text(160,30,"d??sign??e ci-contre survenue");
		$this->Text(160,35,"le:");
		$this->Text(179,35,"a");
		$this->Text(190,35,"heure");
		$this->Text(160,40,"est r??elle et constante de ");
		$this->Text(160,45,"Cause naturelle ");
		$this->Text(160,50,"Cause violente ");
		$this->Text(160,55,"Cause ind??termin??e");
		$this->Text(164,65,"A Ain oussera le ".date('d/m/Y'));
		$this->Text(161,70,"Signature et cachet du m??decin ");
		$this->Text(168,75,"Dr TIBA");
		$this->SetFont('aefurat','B',10);
		$this->Line(159 ,14,159 ,254 );
		$this->Text(5,15,"Commune de d??c??s Ain oussera ");
		$this->Text(115,15,"Wilaya de d??c??s Djelfa ");
		$this->Text(5,20,"Nom :");
		$this->Text(50,20,"Pr??nom :");
		$this->Text(115,20,"Sexe :");
		$this->Text(5,25,"Date de naissance :");
		$this->Text(115,25,"Age :");
		$this->Text(5,30,"Commune de naissance :");
		$this->Text(80,30,"Wilaya de naissance :");
		$this->SetFont('aefurat','B',8);
		$this->Text(5,35,"(si enfant moins de 1 an preciser l'age en mois si moins d'un mois preciser l'age en jours ) ");
		$this->SetFont('aefurat','B',10);
		$this->Text(5,40,"Commune de r??sidence :");
		$this->Text(80,40,"Wilaya de r??sidence :");
		$this->Text(5,45,"Fils(fille) de :");
		$this->Text(80,45,"et de :");
		$this->Text(5,50,"Lieu du d??c??s :");
		$this->Text(5,55,"Domicile");
		$this->Text(80,55,"Structure de sant?? publique ");
		$this->Text(5,60,"Structure de sant?? priv??e");
		$this->Text(80,60,"Voie publique");
		$this->Text(5,65,"Autres (?? preciser).......................................................................................");
		//*****************************************************************************//
		$this->Line(5 ,73 ,159 ,73 );
		$this->Text(5,75,"R??serv?? a la commune N??.......................");
		$this->Text(5,80,"N?? d'ordre d'acte de d??c??s inscrit sur le registre des actes de l'??tat civil ");
		$this->Text(5,85,"Ce N??doit etre reproduit sur le certificat m??dical de cause de d??c??s ");
		$this->Text(5,90,"partie a d??couper , adresser la partie m??dicale a la DSP et INSP");
		$this->Line(5 ,100 ,206 ,100 );
		$this->SetFont('aefurat','B',8);
		//****************************************************************************//
		$this->Text(160,100," PARTIE RESERVEE A LA ");
		$this->Text(160,105,"CODIFICATION DE LA CAUSE ");
		$this->Text(160,110,"DU DECES(ne rien inscrire)");
		$this->Text(177,150,"CODE");
		$this->Text(178,155,"CIM");
		$this->Text(173,160,"I___I___I___I");
		//****************************************************************************//
		$this->Text(5,100,"A remplir et a clore par le m??decin(confidentiel):partie a separer de celle de l'etat civil et ");
		$this->Text(5,105,"adresser a la tutelle car annonyme");
		$this->SetFont('aefurat','B',10);
		$this->Text(5,115,"Commune de d??c??s: Ain oussera");
		$this->Text(80,115,"Wilaya de d??c??s: Djelfa");
		$this->Text(5,120,"Date de naissance:");
		$this->Text(80,120,"Date de d??c??s:");
		$this->Text(127,120,"Age:");
		$this->Text(142,120,"Sexe:");
		$this->Text(5,125,"Commune de r??sidence:");
		$this->Text(80,125,"Wilaya de r??sidence:");
		$this->SetFont('aefurat','B',8);
		$this->Text(5,130,"(si enfant moins de 1an preciser lage en mois si moins d un mois preciser l age en jours ) ");
		$this->SetFont('aefurat','B',10);
		$this->Text(5,135,"lieu du d??c??s:");
		$this->Text(5,140,"Causes du d??c??s : mentionner tous les ??v??nements morbides ayant pr??ceder le d??c??s ");
		$this->Text(5,145,"partie I ");
		$this->Text(5,150,"Maladie(s) ou affection(s) ayant directement provoqu??e d??c??s");
		$this->Text(5,155,"la derni??re ligne remplie doit correspondre a la cause initiale");
		$this->Text(5,160,"Due ou consecutive ");
		$this->Text(50,160,"a):");
		$this->Text(5,165,"Due ou consecutive ");
		$this->Text(50,165,"b):");
		$this->Text(5,170,"Due ou consecutive ");
		$this->Text(50,170,"c):");
		$this->Text(5,175,"Due ou consecutive");
		$this->Text(50,175,"d):");
		$this->Text(5,180,"Il ne s'agit pas ici du mode de d??c??s par exemple: d??faillance cardiaque ,syncope");
		$this->Text(5,185,"mais de la maladie , traumatisme ou de la complication qui a entrain?? la mort");
		$this->Text(5,190,"partie II");
		$this->Text(5,195,"Autres *** morbides facteurs ou *** physiologiques (grossese..)ayant");
		$this->Text(5,200,"Contribu??s mais non mentionn??es en partie I");
		$this->Text(5,205,".");
		$this->Text(5,210,"");
		$this->SetFont('aefurat','B',8);
		$this->Text(5,215,"Si d??c??s maternel: femme d??c??d?? durant une grossesse ,un avortement,un accouchement");
		$this->Text(5,220,"ou dans les 42 jours apres un accouchement ou un avortement ,donner plus de precisions dans la partie I");
		$this->Text(5,225,"Exemple de certification de d??c??s");
		$this->Text(5,230,"I.a)Septic??mie");
		$this->Text(5,235,"I.b)P??ritonite");
		$this->Text(5,240,"I.c)Perforation d'ulc??re");
		$this->Text(5,245,"I.d)Ulc??re duod??nal");
		$this->Text(5,250,"II.Alcolisme");
		$this->Text(40,230,"I.a)Accident vasculaire CB ");
		$this->Text(40,235,"I.b)Art??roscl??rose et  ");
		$this->Text(40,240,"I.c)Cardiopathie Hypertensive");
		$this->Text(40,245,"I.d)................");
		$this->Text(40,250,"II...................");
		$this->Text(80,230,"I.a)D??tresse respiratoire ");
		$this->Text(80,235,"I.b)Embolie pulmonaire");
		$this->Text(80,240,"I.c)Phl??bite ");
		$this->Text(80,245,"I.d)Accouchement compliqu");
		$this->Text(80,250,"II.Varices");
		$this->Text(120,230,"I.a)Coma");
		$this->Text(120,235,"I.b)Oed??me c??r??brale");
		$this->Text(120,240,"I.c)Traumatisme cranien");
		$this->Text(120,245,"I.d)Accident de la route ");
		$this->Text(120,250,"II....................");
		$this->SetFont('aefurat','B',10);
		//*******************************************************************************//
		 $this->Text(20,260,"A Ain oussera le".date('d/m/Y'));
		$this->Text(20,265,"Signature et cacher du m??decin");
		$this->Text(25,270,"Dr TIBA");
		$this->mysqlconnect();
		$query = "select * from pat WHERE  id = '$id'    ";
		$resultat=mysql_query($query);
		while($result=mysql_fetch_object($resultat))
		{
		//******************************donnes*************************************************//
		$this->SetTextColor(225,0,0);
		$this->Text(15,20,trim($result->NOM));
		$this->Text(64,20,trim($result->PRENOM));
		$this->Text(125,20,trim($result->SEX));
		$this->Text(33,25,$result->DATENAISSANCE);
		$A = substr($result->DATENAISSANCE,6,4);$AGE    = date("Y")-$A;
		$this->Text(124,25,$AGE.' ans');
		$this->Text(41,30,$this->nbrtostring("mvc","com","IDCOM",$result->COMMUNE,"COMMUNE"));
		$this->Text(111,30,$this->nbrtostring("mvc","wil","IDWIL",$result->WILAYA,"WILAYAS"));
		$this->Text(41,40,$this->nbrtostring("mvc","com","IDCOM",$result->COMMUNER,"COMMUNE"));
		$this->Text(111,40,$this->nbrtostring("mvc","wil","IDWIL",$result->WILAYAR,"WILAYAS"));
		$this->Text(25,45,$result->FILSDE);
		$this->Text(90,45,$_POST["ETDE"]);
		$this->SetFont('aefurat','B',8);
		$this->Text(164,35,$this->dateUS2FR($_POST["DD"]));
		$this->Text(182,35,$_POST["HD"]);
	    $this->SetFont('aefurat','B',10);
		switch($_POST["CD"])  
		{
			case 'CN':
				{
				$this->SetXY(188,45);$this->Cell(3,3,"X",1,1,'C');
				break;
				}
			case 'CV':
				{
				$this->SetXY(188,50);$this->Cell(3,3,"X",1,1,'C');
				break;
				}
			case 'CI':
				{
				$this->SetXY(188,55);$this->Cell(3,3,"X",1,1,'C'); 
				break;
				}			
		}
		$this->SetXY(188,45).$this->Cell(3,3,"",1,1,'C');
		$this->SetXY(188,50).$this->Cell(3,3,"",1,1,'C');
		$this->SetXY(188,55).$this->Cell(3,3,"",1,1,'C'); 
		switch($_POST["LD"])  
		{
			case 'DOM':
				{
				$this->SetXY(60,55);
				$this->Cell(3,3,"X",1,1,'C');
				$this->Text(30,136,"Domicile");
				break;
				}
			case 'VP':
				{
				$this->SetXY(140,60);
				$this->Cell(3,3,"X",1,1,'C');
				$this->Text(30,136,"Voie publique");
				break;
				}
			case 'AAP':
				{
				$this->SetXY(140,65);
				$this->Cell(3,3,"X",1,1,'C');
				$this->SetXY(40,65);
				$this->Cell(3,3,$_POST["AUTRES"],0,1,'C');
				$this->Text(30,136,$_POST["AUTRES"]);
				
				break;
				}
			case 'SSP':
				{
				$this->SetXY(140,55);
				$this->Cell(3,3,"X",1,1,'C');
				$this->Text(30,136,"Structure de sante public");
				break;
				}
			case 'SSPV':
				{
				$this->SetXY(60,60);
				$this->Cell(3,3,"X",1,1,'C');
				$this->Text(30,136,"Structure de sante prive");
				break;
				}		
		}
		$this->SetXY(140,65).
		$this->Cell(3,3,"",1,1,'C');
		$this->SetXY(60,55);
		$this->Cell(3,3,"",1,1,'C');
		$this->SetXY(140,60).
		$this->Cell(3,3,"",1,1,'C');
		$this->SetXY(140,55).
		$this->Cell(3,3,"",1,1,'C');
		$this->SetXY(60,60).
		$this->Cell(3,3,"",1,1,'C');
		$this->Text(37,120,$result->DATENAISSANCE);
		$this->Text(105,120,$this->dateUS2FR($_POST["DD"]));
		$this->Text(135,120,$AGE);
		$this->Text(152,120,$result->SEX);
		$this->Text(47,125,$this->nbrtostring("grh","com","IDCOM",$result->COMMUNER,"COMMUNE"));
		$this->Text(116,125,$this->nbrtostring("grh","wil","IDWIL",$result->WILAYAR,"WILAYAS"));
		$this->Text(55,160,$_POST["CIM1"]);
		$this->Text(55,165,$_POST["CIM2"]);
		$this->Text(55,170,$_POST["CIM3"]);
		$this->Text(55,175,$_POST["CIM4"]);
		$this->Text(5,205,".".$_POST["CIM5"].".");
		$this->Rect(4,254,202,35,"d");
		
		//METTRE AJOUR LA TABLE PAT
        //INSERER DANS TABLE DECES 		
			
	}
	$this->Output();
	}
	function P0($y)//entete fiche navette
	{
	$this->SetXY(10,$y); 	  
	$this->cell(40,6,"",1,0,'C',0);
	$this->SetXY(50,$y); 	  
	$this->cell(40,6,"",1,0,'C',0);
	$this->SetXY(90,$y); 	  
	$this->cell(40,6,"",1,0,'C',0);
	$this->SetXY(90+40,$y); 	  
	$this->cell(30,6,"",1,0,'C',0);
	$this->SetXY(90+40+30,$y); 	  
	$this->cell(40,6,"",1,0,'C',0);
	}
	function P2($y)//entete fiche navette
		{
		$this->SetXY(10,$y); 	  
        $this->cell(40,10,"",1,0,'C',0);
		$this->SetXY(50,$y); 	  
        $this->cell(40,10,"",1,0,'C',0);
		$this->SetXY(90,$y); 	  
        $this->cell(20,10,"",1,0,'C',0);
		$this->SetXY(90+20,$y); 	  
        $this->cell(90,10,"",1,0,'C',0);
		$this->SetXY(90+20+90,$y); 	  
        $this->cell(30,10,"",1,0,'C',0);
		$this->SetXY(90+20+90+30,$y); 
		$this->cell(60,10,"",1,0,'C',0);
		}
		function P4($y)//entete fiche navette
		{
		$this->SetXY(10,$y); 	  
        $this->cell(20,10,"",1,0,'C',0);
		$this->SetXY(30,$y); 	  
        $this->cell(30,10,"",1,0,'C',0);
		$this->SetXY(60,$y); 	  
        $this->cell(20,10,"",1,0,'C',0);
		$this->SetXY(60+20,$y); 	  
        $this->cell(60,10,"",1,0,'C',0);
		$this->SetXY(60+20+60,$y); 	  
        $this->cell(20,10,"",1,0,'C',0);
		$this->SetXY(160,$y); 
		$this->cell(40,10," ",1,0,'C',0);
		}
		function P44($y,$d,$c,$n,$co,$p)//entete fiche navette
		{
		$this->SetXY(10,$y); 	  
        $this->cell(20,5,$d,1,0,'C',0);
		$this->SetXY(30,$y); 	  
        $this->cell(30,5,"HEMODIALYSE",1,0,'C',0);
		$this->SetXY(60,$y); 	  
        $this->cell(20,5,$c,1,0,'C',0);
		$this->SetXY(60+20,$y); 	  
        $this->cell(60,5,$n,1,0,'L',0);
		$this->SetXY(60+20+60,$y); 	  
        $this->cell(20,5,$co,1,0,'C',0);
		$this->SetXY(160,$y); 
		$this->cell(40,5,$p,1,0,'C',0);
		}
		function P444($y,$d,$c,$dci,$pre,$four,$pra)//entete fiche navette
		{
		$this->SetXY(10,$y); 	  
        $this->cell(20,5,$d,1,0,'C',0);
		
		$this->SetXY(30,$y); 	  
        $this->cell(30,5,$c,1,0,'C',0);
		
		$this->SetXY(60,$y); 	  
        $this->cell(60,5,$dci,1,0,'L',0);
		
		$this->SetXY(120,$y); 	  
        $this->cell(20,5,$pre,1,0,'C',0);
		
		$this->SetXY(60+20+60,$y); 	  
        $this->cell(20,5,$four,1,0,'C',0);
		
		$this->SetXY(160,$y); 
		$this->cell(40,5,$pra,1,0,'C',0);
		}
		
		
		function P5($y)//entete fiche navette
		{
		$this->SetXY(10,$y); 	  
        $this->cell(20,10,"",1,0,'C',0);
		$this->SetXY(30,$y); 	  
        $this->cell(30,10,"",1,0,'C',0);
		$this->SetXY(60,$y); 	  
        $this->cell(20,10,"",1,0,'C',0);
		$this->SetXY(60+20,$y); 	  
        $this->cell(90,10,"",1,0,'C',0);
		$this->SetXY(60+20+90,$y); 	  
        $this->cell(30,10,"",1,0,'C',0);
		$this->SetXY(60+20+90+30,$y); 
		$this->cell(40,10,"",1,0,'C',0);
		$this->SetXY(60+180,$y); 
		$this->cell(40,10," ",1,0,'C',0);
		}
		function P6($y)//entete fiche navette
		{
		$this->SetXY(10,$y); 	  
        $this->cell(55,10,"",1,0,'C',0);
		$this->SetXY(65,$y); 	  
        $this->cell(30,10," ",1,0,'C',0);
		$this->SetXY(95,$y); 	  
        $this->cell(90,10," ",1,0,'C',0);
		$this->SetXY(185,$y); 	  
        $this->cell(25,10,"",1,0,'C',0);
		$this->SetXY(185+25,$y); 	  
        $this->cell(25,10,"",1,0,'C',0);
		$this->SetXY(190+45,$y); 
		$this->cell(50,10,"",1,0,'C',0);
		}
		
	
	function fichenavette($ID,$IDDNR)
	{
	$this->mysqlconnect();
	$this->setPrintHeader(false);
	$this->setPrintFooter(false);
	$this->SetFont('aefurat', '', 10);
    $this->SetDisplayMode('fullpage','single');
    $query = "select * from pat WHERE  id = '$IDDNR'    ";
	$resultat=mysql_query($query);
	while($result=mysql_fetch_object($resultat))
	{
    //P1 FICHE NAVETTE
		$this->AddPage();
		$this->Text(55,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE");
		$this->Text(35,10,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE");
		$this->Text(40.5,15,"DIRECTION DE LA SANTE ET DE LA POPULAION DE LA WILAYA DE DJELFA");
		$this->Text(60,20,"ETABLISSEMENT PUBLIC HOSPITALIER AIN OUSSERA");$this->Text(185,28," PAGE 1");
		$this->SetFont('aefurat', '', 24);
		$this->Text(65,28," FICHE NAVETTE");
		$this->SetFont('aefurat', '', 10);
		$this->Rect(10, 40, 190, 15 ,'D');
        $this->Text(10,40,"IDENTIFICATION DE L'ASSURE:");
		$this->Text(15,45,"Nom:".$result->NOM);$this->Text(105,45,"Pr??nom:".$result->PRENOM);
		$this->Text(15,50,"Date de Naissance:".$result->DATENAISSANCE);$this->Text(105,50,"N??Immatriculation:");
		$this->Rect(10, 40+18, 190, 15 ,'D');                                                          
		$this->Text(10,40+18,"IDENTIFICATION DU DEMUNI:");
        $this->Text(15,45+18,"Nom:");$this->Text(105,45+18,"Pr??nom:");
        $this->Text(15,50+18,"Date de Naissance:");$this->Text(105,50+18,"N??Immatriculation:");
		$this->Text(10,40+18+18+12,"IDENTIFICATION DU PATIENT:");$this->Rect(140, 40+18+18, 60, 15 ,'D');$this->Text(140,40+18+23,"N??SS:"); 
		$this->Rect(10, 40+18+18+18, 190, 20 ,'D'); 
		$this->Text(15,45+18+18+15,"1.N?? D'ADMISSION:");$this->Text(80,45+18+18+15,"2.GROUPAGE SANGUIN:");$this->Text(150,45+18+18+15,"3.AGE:");
        $this->SetXY(15,45+18+18+20);$this->cell(60,6,"",1,0,'L',0);
	    $this->SetXY(80,45+18+18+20);$this->cell(60,6,"".$result->GRABO.'_'.$result->GRRH,1,0,'C',0);
	    $this->SetXY(150,45+18+18+20); $A = substr($result->DATENAISSANCE,6,4);$AGE= date("Y")-$A;$this->cell(40,6,"".$AGE,1,0,'C',0);
		$this->Rect(10,40+18+18+18+20, 190, 14 ,'D'); 
		$this->Text(15,40+18+18+18+23,"4.Nom:".$result->NOM);$this->Text(80,40+18+18+18+23,"5.Nom de jeune fille:");$this->Text(150,40+18+18+18+23,"6.Pr??nom:".$result->PRENOM);
		$this->Rect(10,40+18+18+18+38, 190, 48 ,'D');
		$query1 = "select * from hosp WHERE  id = '$ID'    ";
		$resultat1=mysql_query($query1);
		while($result1=mysql_fetch_object($resultat1))
		{
		$this->Text(10,133,"7.Service:".$this->nbrtostring("mvc","service","ids",$result1->SERVICE,"servicefr"));$this->Text(100,133,"8.Nom et qualit?? du chef de Service:");
		$this->Text(10,133+10,"9.Date d'entree: ".$result1->DATEDON);$this->Text(100,133+10,"10.Heure d'entree:".$result1->HEUREDON);
		$this->Text(10,133+20,"11.Nom de la Salle:".$this->nbrtostring("mvc","service","ids",$result1->SERVICE,"servicefr"));$this->Text(100,133+20,"12.N??lit:".$this->nbrtostring("mvc","lit","idlit",$result1->NLIT,"nlit"));
		$this->Text(10,133+30,"13.Nom Pr??nom et Qualite du medecin traitant: Dr tiba");
		}
		$this->Text(10,133+40,"14.Mode d'entree: NORMAL");$this->Text(100,133+40,"15.Code entr??e:");
		$this->Text(10,133+55,"HOSPITALISATION DANS UN AUTRE SERVICE (Mouvement du malade):");
		$this->Rect(10,133+65, 190, 60 ,'D');
		$this->SetXY(10,133+65); $this->cell(40,6,"16.SERVICE",1,0,'L',0); 	  
		$this->SetXY(50,133+65); $this->cell(40,6,"17.DATE D'ENTREE",1,0,'L',0); 	  
		$this->SetXY(90,133+65); $this->cell(40,6,"18.HEURE D'ENTREE",1,0,'L',0); 	  
		$this->SetXY(90+40,133+65);$this->cell(30,6,"19.N?? DU LIT",1,0,'L',0); 	  
		$this->SetXY(90+40+30,133+65);$this->cell(40,6,"20.M??decin Traitant ",1,0,'L',0);
		for($i=204; $i<=252; $i += 6) 
		{
		$this->P0($i);
		} 
		//P3
		$this->AddPage('L', 'mm', 'A4', true, 'UTF-8', false);
		$this->Text(10,10,"1.ACTES MEDICAUX CHIRURGICAUX ET EXAMENTS  PRATIQUES DANS L'ETABLISSEMENT D'HOSPITALISATION :");
		$this->Text(10,15,"Y COMPRIS LES CONSULTATION EFFECTUEES PAR LES PRATICIENS EXTERNE AU SERVICE");$this->Text(265,10," PAGE 3");
		$this->SetXY(10,20);$this->cell(40,10,"1.1 DATE",1,0,'C',0);
		$this->SetXY(50,20);$this->cell(40,10,"1.2 SERVICE",1,0,'C',0); 	  
		$this->SetXY(90,20); $this->cell(140,5,"ACTE ET EXAMENS ",1,0,'C',0); 	  
		$this->SetXY(90,25); $this->cell(20,5,"1.3 Code",1,0,'C',0); 	  
		$this->SetXY(110,25);$this->cell(90,5,"1.4 Nature",1,0,'C',0); 	  
		$this->SetXY(200,25);$this->cell(30,5,"1.5 Cotation",1,0,'C',0); 	  
		$this->SetXY(230,20);$this->cell(60,10,"1.6.Nom Prenom et Qualite du Praticien ",1,0,'C',0);
		for($i=30; $i<=170; $i += 10) 
		{
		$this->P2($i);
		} 
		//P5
		$this->AddPage('L', 'mm', 'A4', true, 'UTF-8', false);
		$this->Text(10,10,"3.ACTES MEDICAUX CHIRURGICAUX ET EXAMENTS EFFECTUES DANS UNE STRUCTURE EXTERNE  :");
		$this->Text(10,15,"PUBLIC OU PRIVEE");$this->Text(265,10," PAGE 5");
		$this->SetXY(10,20);$this->cell(20,10,"3.1 DATE",1,0,'C',0); 	  
		$this->SetXY(30,20);$this->cell(30,10,"3.2 SERVICE",1,0,'C',0); 	  
		$this->SetXY(60,20); $this->cell(140,5,"ACTE ET EXAMENS ",1,0,'C',0); 	  
		$this->SetXY(60,25); $this->cell(20,5,"3.3 Code",1,0,'C',0); 	  
		$this->SetXY(60+20,25);$this->cell(90,5,"3.4 Nature",1,0,'C',0); 	  
		$this->SetXY(60+20+90,25); $this->cell(30,5,"3.5 Cotation",1,0,'C',0); 	  
		$this->SetXY(60+20+90+30,20);$this->cell(40,5,"3.6.Nom Prenom  ",1,0,'C',0); 
		$this->SetXY(60+20+90+30,25);$this->cell(40,5,"et Qualite du paramedical ",1,0,'C',0); 
		$this->SetXY(60+180,20);$this->cell(40,10,"3.7 N??Prise En Charge ",1,0,'C',0); 
		for($i=30; $i<=170; $i += 10) 
		{
		$this->P5($i);
		} 
		//P7 MEDICAMENTS
		$this->AddPage('L', 'mm', 'A4', true, 'UTF-8', false);
		$this->Text(130,10,"4.MEDICAMENTS :");$this->Text(265,10," PAGE 7");
		$this->SetXY(10,20);$this->cell(55,5,"4.1 DATE ",1,0,'C',0); 	  
		$this->SetXY(10,25);$this->cell(55,5," DE LA PRESCRIPTION",1,0,'C',0); 	  
		$this->SetXY(65,20); $this->cell(30,5,"4.2 CODE ",1,0,'C',0); 	  
		$this->SetXY(65,25); $this->cell(30,5," DCI",1,0,'C',0); 	  
		$this->SetXY(95,20); $this->cell(90,5,"4.3 LIBELLE DCI   ",1,0,'C',0); 	  
		$this->SetXY(95,25);$this->cell(90,5," FORME ET DOSAGE  ",1,0,'C',0); 	  
		$this->SetXY(185,20); $this->cell(25,5,"4.4 QUANTITE ",1,0,'C',0); 	  
		$this->SetXY(185,25);  $this->cell(25,5," PRESCRITE",1,0,'C',0);	  
		$this->SetXY(185+25,20); $this->cell(25,5,"4.5 QUANTITE ",1,0,'C',0);	  
		$this->SetXY(185+25,25);  $this->cell(25,5," FOURNIE",1,0,'C',0);	  
		$this->SetXY(190+45,20); $this->cell(50,5,"4.6.Nom Prenom  ",1,0,'C',0);
		$this->SetXY(190+45,25);$this->cell(50,5,"Qualite du Praticien ",1,0,'C',0); 
		$this->SetXY(10,30); // marge sup 13
		//prevoir  entre deux date  pour ne prendre en chage que les medicaments pris entre deux date   
		$this->mysqlconnect();
		$querym = "SELECT * FROM medfn where idp='".$IDDNR."' limit  15,15";
		$resultatm=mysql_query($querym);
		$totalm=mysql_num_rows($resultatm);
		while($rowm=mysql_fetch_object($resultatm))
		  {
		   $this->cell(55,10,$this->dateUS2FR($rowm->DATE),1,0,'C',0);
		   $this->cell(30,10,$this->nbrtostring("mvc","pha","ID",$rowm->MED1,"code"),1,0,'C',0);
		   $this->cell(90,10,$this->nbrtostring("mvc","pha","ID",$rowm->MED1,"mecicament"),1,0,'L',0);
		   $this->cell(25,10,$rowm->QUT1,1,0,'C',0);
		   $this->cell(25,10,$rowm->QUT1,1,0,'C',0);
		   $this->cell(50,10,"Dr ".$rowm->USER,1,0,'C',0);
		   $this->SetXY(10,$this->GetY()+10); 
		  }
		for($i=30; $i<=170; $i += 10) 
		{
		$this->P6($i);
		} 
		//P8 SORTIE
		$this->AddPage('P', 'mm', 'A4', true, 'UTF-8', false);
		$this->SetFont('aefurat', '', 24);
		$this->Text(90,8,"SORTIE");
		$this->SetFont('aefurat', '', 10);
		$this->Rect(10, 25, 190, 55 ,'D');
        $this->Text(10,20,"CADRE RESERVE AU PRATICIEN");
	    $query1 = "select * from hosp WHERE  id = '$ID'    ";
		$resultat1=mysql_query($query1);
		while($result1=mysql_fetch_object($resultat1))
		{
		$this->Text(10,30,"1.Date de sortie: ".$this->dateUS2FR($result1->DATESORTI));$this->Text(100,30,"2.Heure de Sortie: ".$result1->HEURESORTI);
        $this->Text(10,40,"3.Mode de Sortie: ".$this->nbrtostring("grh","mods","IDMODS",$result1->MODESORTI,"MODS"));$this->Text(100,40,"4.Code de Sortie:".$result1->MODESORTI	);
		$this->Text(10,50,"5.Diagnostic ou Motif d'entr??e : ".$result1->DGC);
		$this->Text(10,60,"6.Diagnostic de Sortie: ".$result1->DGC);$this->Text(30,107,$this->dateUS2FR($result1->DATESORTI));
		}
		$this->Text(10,70,"7.code CIM:***");$this->Text(100,70,"8.Code GHM:***");
		$this->Text(10,85,"NOM PRENOM ET GRADE DU PRATICIEN");$this->Text(150,85,"VISA DU CHEF DE SERVICE");//.$session
		$this->Text(30,92,"Dr tiba");
		$this->Text(25,100,"DATE ET CACHET");
		$this->Text(29,120,"SIGNATURE");
		$this->Text(10,145,"CADRE RESERVE A L ADMINISTRATION DE LETABLISSEMENT");$this->Text(185,10," PAGE 8");
		$this->Rect(10,150, 190, 55 ,'D'); 
		$this->Text(10,155,"9.N?? Facture:");$this->Text(70,155,"10.Date:");$this->Text(120,155,"11.Montant Total De La Prestation:");
        $this->Text(10,165,"12.N?? quitance:");$this->Text(70,165,"13.part ss:");$this->Text(120,165,"14.Part Patient:");
		$this->Text(10,175,"15.Nature Du Document De Sortie:");$this->Text(120,175,"16.Document:");
		$this->Text(10,185,"17.Etablissement d'acceuil:");$this->Text(120,185,"18.N??Prise En Charge:");
		$this->Text(10,195,"19.Mineur Accopagne A Sa Sortie Par");
		$this->Text(10,215,"NOM PRENOM ET FONCTION DU SIGNATAIRE");$this->Text(150,215,"DATE ET CACHET");$this->Text(155,225,"SIGNATURE");
		//P6 MEDICAMENTS
		$this->AddPage('L', 'mm', 'A4', true, 'UTF-8', false);
		$this->Text(130,10,"4.MEDICAMENTS :");$this->Text(265,10," PAGE 6");
		$this->SetXY(10,20);$this->cell(55,5,"4.1 DATE ",1,0,'C',0);
		$this->SetXY(10,25);$this->cell(55,5," DE LA PRESCRIPTION",1,0,'C',0);
		$this->SetXY(65,20);$this->cell(30,5,"4.2 CODE ",1,0,'C',0);
		$this->SetXY(65,25);$this->cell(30,5," DCI",1,0,'C',0);
		$this->SetXY(95,20);$this->cell(90,5,"4.3 LIBELLE DCI   ",1,0,'C',0);
		$this->SetXY(95,25);$this->cell(90,5," FORME ET DOSAGE  ",1,0,'C',0);
		$this->SetXY(185,20);$this->cell(25,5,"4.4 QUANTITE ",1,0,'C',0);
		$this->SetXY(185,25);$this->cell(25,5," PRESCRITE",1,0,'C',0);
		$this->SetXY(185+25,20); $this->cell(25,5,"4.5 QUANTITE ",1,0,'C',0);
		$this->SetXY(185+25,25);$this->cell(25,5," FOURNIE",1,0,'C',0);
		$this->SetXY(190+45,20);$this->cell(50,5,"4.6.Nom Prenom  ",1,0,'C',0);
		$this->SetXY(190+45,25); $this->cell(50,5,"Qualite du Praticien ",1,0,'C',0);
		$this->SetXY(10,30); // marge sup 13
        //prevoir  entre deux date  pour ne prendre en chage que les medicaments pris entre deux date 
		$this->mysqlconnect();
		$querym = "SELECT * FROM medfn where idp='".$IDDNR."' limit  0,15";
		$resultatm=mysql_query($querym);
		$totalm=mysql_num_rows($resultatm);
		while($rowm=mysql_fetch_object($resultatm))
		  {
		   $this->cell(55,10,$this->dateUS2FR($rowm->DATE),1,0,'C',0);
		   $this->cell(30,10,$this->nbrtostring("mvc","pha","ID",$rowm->MED1,"code"),1,0,'C',0);
		   $this->cell(90,10,$this->nbrtostring("mvc","pha","ID",$rowm->MED1,"mecicament"),1,0,'L',0);
		   $this->cell(25,10,$rowm->QUT1,1,0,'C',0);
		   $this->cell(25,10,$rowm->QUT1,1,0,'C',0);
		   $this->cell(50,10,"Dr ".$rowm->USER,1,0,'C',0);
		   $this->SetXY(10,$this->GetY()+10); 
		  }
		for($i=30; $i<=170; $i += 10) 
		{
		$this->P6($i);
		}  
		//P4
		$this->AddPage('P', 'mm', 'A4', true, 'UTF-8', false);
		$this->Text(10,10,"2.SOINS INFIRMIERS ACTES PARAMEDICAUX :");
		$this->Text(10,15,"EFFECTUES DANS L'ETABLISSEMENT D'HOSPITALISATION");$this->Text(185,10," PAGE 4");
		$this->SetXY(10,20);$this->cell(20,10,"2.1 DATE",1,0,'C',0);
		$this->SetXY(30,20);$this->cell(30,10,"2.2 SERVICE",1,0,'C',0);
		$this->SetXY(60,20);$this->cell(100,5,"ACTE ET EXAMENS ",1,0,'C',0);
		$this->SetXY(60,25);$this->cell(20,5,"2.3 Code",1,0,'C',0);
		$this->SetXY(60+20,25);$this->cell(60,5,"2.4 Nature",1,0,'C',0);
		$this->SetXY(60+20+60,25);$this->cell(20,5,"2.5 Cotation",1,0,'C',0);
		$this->SetXY(160,20);$this->cell(40,5,"2.6.Nom Prenom  ",1,0,'C',0);
		$this->SetXY(160,25);$this->cell(40,5,"et Qualite du paramedical ",1,0,'C',0);
		for($i=30; $i<=260; $i += 10) 
		{
		$this->P4($i);
		}
		//P2
		$this->AddPage('L', 'mm', 'A4', true, 'UTF-8', false);
		$this->Text(10,10,"1.ACTES MEDICAUX CHIRURGICAUX ET EXAMENTS  PRATIQUES DANS L'ETABLISSEMENT D'HOSPITALISATION :");
		$this->Text(10,15,"Y COMPRIS LES CONSULTATION EFFECTUEES PAR LES PRATICIENS EXTERNE AU SERVICE");
		$this->SetXY(10,20); $this->cell(40,10,"1.1 DATE",1,0,'C',0);
		$this->SetXY(50,20);$this->cell(40,10,"1.2 SERVICE",1,0,'C',0);
		$this->SetXY(90,20); $this->cell(140,5,"ACTE ET EXAMENS ",1,0,'C',0);
		$this->SetXY(90,25);$this->cell(20,5,"1.3 Code",1,0,'C',0);
		$this->SetXY(90+20,25);$this->cell(90,5,"1.4 Nature",1,0,'C',0);
		$this->SetXY(90+20+90,25);$this->cell(30,5,"1.5 Cotation",1,0,'C',0);
		$this->SetXY(90+20+90+30,20);$this->cell(60,10,"1.6.Nom Prenom et Qualite du Praticien ",1,0,'C',0);
		for($i=30; $i<=170; $i += 10) 
		{
		$this->P2($i);
		}	
	}
	}
	
	
	
	
	function HOSPOBS($id,$IDDNR)
	{
	$this->mysqlconnect();
	$this->setPrintHeader(false);
	$this->setPrintFooter(false);
	// $this->setRTL(true);
	//$this->SetDisplayMode('fullpage','single');//mode d affichage 
	// $this->SetFillColor(255,255,255);
	// $this->SetTextColor(0,0,0);
	// $this->SetFillColor(230);    //fond gris il faut ajouter au cell un autre parametre pour qui accepte la coloration
	// $this->SetTextColor(0,0,0);  //text noire
	$query = "select * from pat WHERE  id = '$IDDNR'    ";
	$resultat=mysql_query($query);
	// $totalmbr1=mysql_num_rows($resultat);
	while($result=mysql_fetch_object($resultat))
	{
	$this->AddPage();
	$this->SetDisplayMode('fullpage','single');//mode d affichage 
	$this->SetFont('aefurat','I', 10);
	$this->Text(50,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE ");
	$this->Text(35,10,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE");
	$this->Text(55,15,"ETABLISSEMENT PUBLIC HOSPITALIER AIN OUSSERA");
	$this->SetFont('aefurat','I', 22);
	$this->Text(50,35,"DEMANDE D'HOSPITALISATION  ");
	$this->SetFont('aefurat','I', 14);
	$this->Rect(4, 55, 202, 35,"d");
	
	$query1 = "select * from hosp WHERE  id = '$id'    ";
	$resultat1=mysql_query($query1);
	while($result1=mysql_fetch_object($resultat1))
	{
	$this->Text(5,56,"SERVICE : ".$this->nbrtostring("MVC","service","ids",$result1->SERVICE,"servicefr"));
	$this->Text(5,125,"Nom De La Salle : ".$this->nbrtostring("MVC","service","ids",$result1->SERVICE,"servicefr"));
	$this->Text(100,125,"N??Du Lit D'Hospitalisation : ".$this->nbrtostring("grh","lit","idlit",$result1->NLIT,"nlit"));
	$this->Text(175,115,"Age : ".$result1->AGEDNR );
	$this->Text(5,135,"Date Admission Hopital : ".$result1->DATEDON); 
	$this->Text(100,135,"Heure Hospitalisation : ".$result1->HEUREDON);
	}
	$this->Text(100,56,"SPECIALITE :");
	$this->Text(5,66,"Non Du Praticien Ayant Accord?? L'hospitalisation : DR ");
	$this->Text(5,76,"Grade : ");
	$this->Rect(4, 94, 202, 50,"d");
	$this->SetFont('aefurat','I', 18);
	$this->Text(90,95,"PATIENT");
	$this->SetFont('aefurat','I', 14);
	$this->Text(5,105,"Nom : ".trim($result->NOM));
	$this->Text(100,105,"Nom De Jeune Fille:"); 
	$this->Text(175,105,"Sexe : ".trim($result->SEX)); 
	$this->Text(5,115,"Pr??nom : ".trim($result->PRENOM));
	$this->Text(100,115,"Date  De Naissance : ".trim($result->DATENAISSANCE));$A = substr($result->DATENAISSANCE,6,4);$AGE    = date("Y")-$A;
	
	$this->Rect(4, 147, 202, 40,"d");
	$this->SetFont('aefurat','I', 18);
	$this->Text(45,148,"MALADE ORIENTE OU ADRESSE PAR :");
	$this->SetFont('aefurat','I', 14);
	$this->Text(5,158,"Nom et Pr??mom Du M??decin : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ");
	$this->Text(5,168,"Grade : - - - - - - - - - - - - - - - - - - - - - - -"); 
	$this->Text(100,168,"Etablissement : - - - - - - - - - - - - - - - - - - - - - - -"); 
	$this->Text(5,178,"Etablissement / Unite / Service : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -");
	$this->Rect(4, 190, 202, 50,"d");
	$this->SetFont('aefurat','I', 18);
	$this->Text(75,190,"GARDE MALADE "); 
	$this->SetFont('aefurat','I', 14);
	$this->Text(5,200,"Nom et Pr??nom Du Garde Malade : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -"); 
	$this->Text(5,210,"Pi??ce D'identit?? N??: - - - - - - - - - - - - - - - - - -"); 
	$this->Text(100,210,"D??livr??e Le : - - - - - - - - - - - - - - - - - - - - - - - - - ");
	$this->Text(5,220,"Par : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ");
	//$this->EAN13(15,250,$DNSENA);
	$this->Text(120,250,"Date : ".date("d-m-Y"));
	$this->Text(120,250+8,"Signature et Visa Du Praticien");
	$this->Text(120,250+16,"Dr ");
	$this->SetFont('aefurat','I', 8);
	$this->SetFillColor(250); 
	$this->setxy(10,10);
	
	$this->AddPage();
	$this->SetDisplayMode('fullpage','single');//mode d affichage
	$this->SetFont('aefurat','I', 10);
	$this->Text(50,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE ");
	$this->Text(35,10,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE");
	$this->Text(55,15,"ETABLISSEMENT PUBLIC HOSPITALIER AIN OUSSERA");
	$this->Text(5,20,"MATRICULE : ...................................");$this->Text(130,20,"DOSSIER N?? : ...................................");
	$this->Text(5,25,"SERVICE : " );
	$this->SetFont('aefurat','I', 20);
	$this->Text(60,30,"FEUILLE D'OBSERVATION");
	$this->SetFont('aefurat','I', 12);
	$this->Rect(5, 40, 125, 32,"d");$this->Rect(130, 40, 77, 32,"d");
	$this->Text(5,40,"Service Du docteur :");        $this->Text(130,40,"Salle : "); 
	$this->Text(5,45,"Nom : ".trim($result->NOM));   $this->Text(70,45,"Pr??nom : ".trim($result->PRENOM)); $this->Text(130,45,"N??Du Lit : ");
	$this->Text(5,50,"Nom De Jeune Fille : ");       $this->Text(70,50,"Sexe : ".trim($result->SEX));
	$this->Text(5,55,"Date  De Naissance : ".trim($result->NOM));  $this->Text(70,55,"Age : ".$AGE);      $this->Text(130,55,"Entree le : ".date("d-m-Y")); $this->Text(180,55,"Heure : ".date("H:i")); 
	$this->Text(5,60,"Lieu  De Naissance : ");                                               $this->Text(130,60,"Sortie le : "); $this->Text(180,60,"Heure :"); 
	$this->Text(5,65,"Etat Civil : ");                                                       $this->Text(130,65,"diagnostic : ");                                             
	$this->Rect(5, 72, 202, 30,"d");
	$this->Text(5,72,"Sommaire de l'Observation:");//
	$this->Rect(5,50+38+14, 30, 10,"d");$this->Rect(35,50+38+14, 172, 10,"d");
	$this->Text(15,105,"Dates:");$this->Text(90,105,"Observations Medicales");
	$this->Rect(5,50+38+14, 30, 170+15,"d");$this->Rect(35,50+38+14, 172,170+15,"d");
	$this->SetFont('aefurat','I', 11);
    $this->Text(6,115,date("d-m-Y"));
	// $this->Rect(35,112, 172,34-14, 2,"d");
    // $this->Text(35,115,"Il s'agit de M.".trim($result->NOM)."_".trim($result->PRENOM)." ??g?? de ".$AGE." ans de sexe : ".trim($result->SEX));
	// $this->Text(35,120,"R??sidant a : /_/ ".trim($result->ADRESSE)." /_/ ".$this->nbrtostring("grh","com","IDCOM",$result->COMMUNER,"COMMUNE")." /_/ ".$this->nbrtostring("grh","wil","idwil",$result->WILAYAR,"WILAYAS"));
	// $this->Rect(35,146-14, 172,14, 2,"d");
	// $this->Text(35,146-14,"MOTIF D'HOSPITALISATION ");
	// $this->Text(35,152-14,"Bilan Dgc et Th??rapeutique : "); //sf signe fonctionnel sphsigne physique srsigne radiologique sbsigne g??n??ral
	// $this->Rect(35,160-14, 172,25, 2,"d");
	// $this->Text(35,160-14,"ANTECEDENTS ");
	// $this->Text(45,165-14,"Personnels * M??dicaux :       ------------------------------------------------------------------");
	// $this->Text(45,170-14,"                  * Chirurgicaux :  ------------------------------------------------------------------");
	// $this->Text(45,175-14,"                  * Obstetricaux :  ------------------------------------------------------------------");
	// $this->Text(40,180-14,"     Familiaux :  --------------------------------------------------------------------------------------");
	// $this->Rect(35,185-14, 172,25, 2,"d");
	// $this->Text(35,185-14,"HISTOIRE DE LA MALADIE ");
    // $this->Rect(35,185+25-14, 172,30, 2,"d"); 
    // $this->Text(35,185+25-14,"EXAMEN PHYSIQUE ");
	// $this->Text(35,215-14,"Score Glasgow : _ _ /15 ");$this->Text(80,215-14,"Coloration Cutaneo-muqueuse : B/P");  $this->Text(145,215-14,"Poids: _ _ Kg");       $this->Text(176,215-14,"Taille : _ _ _ Cm");
	// $this->Text(35,220-14,"TA : _ _ _ / _ _ _ mmhg ");$this->Text(80,220-14,"FC : _ _ _ batt/m : ");          $this->Text(145,220-14,"FR : _ _  cycles/m");$this->Text(176,220-14,"T?? :  _ _ ??C");
	// $this->Text(35,225-14,"_ ");
	// $this->Text(35,230-14,"_ ");
	// $this->Text(35,235-14,"Le reste de l'examen somatique est sans particularit??.");
	// $this->Rect(35,240-14, 172,5, 2,"d"); 
	// $this->Text(35,240-14,"LE DIAGNOSTIC A EVOQUER : ");
	// $this->Rect(35,231, 172,42+14, 2,"d"); 
    // $this->Text(35,245-14,"Hospitalisation,Mise en condition,Abord veineux P??ripherique avec : SSI9% / SGI5% / plasmagel /manitol");
    // $this->Text(35,250-14,"Bilan biologique standard :  / FNS  / GROUPAGE  / UREE  / CREAT  / GLYCEMIE  / TP");
	// $this->Text(35,255-14,"Bilan radiologique : / CRANE / THORAX / ASP / BASSIN /");
	// $this->Text(35,260-14,"Traitement M??dical Initiale:");
    $this->AddPage();
	$this->Rect(5,5, 30, 10, 2,"d");$this->Rect(35,5, 172, 10, 2,"d");
	$this->Text(15,8,"Dates:");$this->Text(80,8,"Evolution M??dicales Du Patient : ".trim($result->NOM)."_".trim($result->NOM));
	$this->Rect(5,5, 30, 280, 2,"d");$this->Rect(35,5, 172,280, 2,"d");
	}
	$this->Output();
	}
	function DEMHOS($MEDECIN,$SERVICE,$NOM,$PRENOM,$SEXE,$DATENAISSANCE,$dgc,$NLIT,$WILAYAR,$COMMUNER,$ADRESSE)
	{
	//$session=$_SESSION["USER"];
	$this->AddPage();
	$this->SetDisplayMode('fullpage','single');//mode d affichage
	$J      = substr($DATENAISSANCE,8,2);
	$M      = substr($DATENAISSANCE,5,2);
	$A      = substr($DATENAISSANCE,0,4);
	$DNS    =  $J."-".$M."-".$A ;
	$DNSENA =  $J.$M.$A ;
	$AGE    = date("Y")-$A;
	$this->SetFont('aefurat','I', 10);
	$this->Text(50,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE ");
	$this->Text(35,10,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE");
	$this->Text(55,15,"ETABLISSEMENT PUBLIC HOSPITALIER AIN OUSSERA");
	$this->SetFont('aefurat','I', 22);
	$this->Text(50,35,"DEMANDE D'HOSPITALISATION  ");
	$this->SetFont('aefurat','I', 14);
	//$this->RoundedRect(4, 55, 202, 35, 2, $style = ''); 
	$this->Rect(4,50,202,35,"d");
	$this->Text(5,56,"SERVICE : ".$this->nbrtostring("grh","service","ids",$SERVICE,"servicefr") );
	$this->Text(100,56,"SPECIALITE :".$this->nbrtostring("grh","service","ids",$SERVICE,"serspecia"));
	$this->Text(5,66,"Non Du Praticien Ayant Accord?? L'hospitalisation : DR ".$MEDECIN);
	//$this->Text(5,76,"Grade : ".$this->nbrtostring("grh","grade","idg",$this->nbrtostring("grh","grh","idp",$_SESSION["IDP"],"rnvgradear"),"gradefr"));
	//$this->RoundedRect(4, 94, 202, 50, 2, $style = '');//
	$this->Rect(4,94,202,50,"d");
	$this->SetFont('aefurat','I', 18);
	$this->Text(90,95,"PATIENT");
	$this->SetFont('aefurat','I', 14);
	$this->Text(5,105,"Nom : ".$NOM);
	$this->Text(100,105,"Nom De Jeune Fille:"); 
	$this->Text(175,105,"Sexe : ".$SEXE); 
	$this->Text(5,115,"Pr??nom : ".$PRENOM);
	$this->Text(100,115,"Date  De Naissance : ".$DNS);
	$this->Text(175,115,"Age : ".$AGE );
	$this->Text(5,125,"Nom De La Salle : ".$this->nbrtostring("grh","service","ids",$SERVICE,"servicefr"));   
	$this->Text(100,125,"N??Du Lit D'Hospitalisation : ".$this->nbrtostring("grh","lit","idlit",$NLIT,"nlit"));
	$this->Text(5,135,"Date Admission Hopital : ".date("d-m-Y")); 
	$this->Text(100,135,"Heure Hospitalisation : ".date("H:i"));
	// $this->RoundedRect(4, 147, 202, 40, 2, $style = '');//
	$this->Rect(4,147,202,40,"d");
	$this->SetFont('aefurat','I', 18);
	$this->Text(45,148,"MALADE ORIENTE OU ADRESSE PAR :");
	$this->SetFont('aefurat','I', 14);
	$this->Text(5,158,"Nom et Pr??mom Du M??decin : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ");
	$this->Text(5,168,"Grade : - - - - - - - - - - - - - - - - - - - - - - -"); 
	$this->Text(100,168,"Etablissement : - - - - - - - - - - - - - - - - - - - - - - -"); 
	$this->Text(5,178,"Etablissement / Unite / Service : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -");
	// $this->RoundedRect(4, 190, 202, 50, 2, $style = '');//
	$this->Rect(4,190,202,50,"d");
	$this->SetFont('aefurat','I', 18);
	$this->Text(75,190,"GARDE MALADE "); 
	$this->SetFont('aefurat','I', 14);
	$this->Text(5,200,"Nom et Pr??nom Du Garde Malade : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -"); 
	$this->Text(5,210,"Pi??ce D'identit?? N??: - - - - - - - - - - - - - - - - - -"); 
	$this->Text(100,210,"D??livr??e Le : - - - - - - - - - - - - - - - - - - - - - - - - - ");
	$this->Text(5,220,"Par : - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ");
	// $this->EAN13(15,250,$DNSENA);
	$this->Text(120,250,"Date : ".date("d-m-Y"));
	$this->Text(120,250+8,"Signature et Visa Du Praticien");
	$this->Text(120,250+16,"Dr ".$MEDECIN);
	$this->SetFont('aefurat','I', 8);
	$this->SetFillColor(250); 
	$this->setxy(10,10);
	//********************bultin d admission *********************//
	// $this->AddPage();
	// $this->SetDisplayMode('fullpage','single');//mode d affichage
	// $this->SetFont('aefurat','I', 10);
	// $this->Text(50,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE ");
	// $this->Text(55,10,"ETABLISSEMENT PUBLIC HOSPITALIER AIN OUSSERA");
	// $this->Text(80,15,"BULTIN D ADMISSION");
	// $this->SetFont('aefurat','I', 12); 
	// $this->Text(5,20,"IDENTIFICATION DU PATIENT");
	// $this->RoundedRect(5, 25, 202, 115, 2, $style = '');
	// $this->Text(5,30-5,"N?? D'ADMISSION");        $this->Text(80,30-5,$this->nbrtostring("grh","service","ids",$SERVICE,"servicefr")); $this->Text(170,30-5,"DATE ");                                                                            
	// $this->Text(5,45,"Qualite du patient vis a vis de l'assurance");             $this->Text(120,45,"Age: ".$AGE." Ans");
	// $this->Text(5,55,"Nom: ".$NOM);      $this->Text(50,55,"Pr??nom: ".$PRENOM);    $this->Text(120,55,"Sexe: ".$SEXE);
	// $this->Text(5,65,"Date De Naissance: ".$DNS);                                 $this->Text(120,65,"Lieu De Naissance");
	// $this->Text(5,75,"Fils De ");                                                $this->Text(120,75,"Et De ");
	// $this->Text(5,85,"Nationalite ");                                            $this->Text(120,85,"Profession");
	// $this->Text(5,95,"Situation Familiale ");                                    $this->Text(120,95,"Epouse De ");
	// $this->Text(5,105,"Situation Familiale ");                                   $this->Text(120,105,"Epouse De ");
	// $this->Text(5,115,"Adresse De Residence ");
	// $this->Text(5,125,"Nom Et Prenom De La Personne A Contacter ");              $this->Text(120,125,"N?? Telphone ");
	// $this->Text(5,135,"Adresse De Contact ");                                   
	// $this->Text(5,140,"IDENTIFICATION DE ASSURER");
	// $this->RoundedRect(5, 145, 202, 45, 2, $style = ''); 
	// $this->Text(5,145,"Immatriculation");                      $this->Text(50,145,"N?? De Prise Encharge SS");
	// $this->Text(5,155,"Nom");                                  $this->Text(50,155,"Prenom");
	// $this->Text(5,165,"Date De Naissance");
	// $this->Text(5,175,"Caisse D Affiliation");
	// $this->Text(5,185,"Employeur");
	// $this->Text(5,190,"HOSPITALISATION");
	// $this->RoundedRect(5, 195, 202, 35, 2, $style = ''); 
	// $this->Text(5,195,"Service D Hospitalisation:".$this->nbrtostring("grh","service","ids",$SERVICE,"servicefr"));$this->Text(100,195,"Date Entree: ".date("d-m-Y")); $this->Text(150,195,"Heure : ".date("H:i"));
	// $this->Text(5,205,"Nom unite ");                                        $this->Text(50,205,"N?? De Lit: ".$this->nbrtostring("grh","lit","idlit",$NLIT,"nlit"));$this->Text(100,205,"Medecin Traitant : Dr ".$MEDECIN);
	// $this->Text(5,215,"Mode  D Entree ");                                   $this->Text(50,215,"N?? Prise En Charge Sante ");
	// $this->Text(5,225,"Etablissemnet D origine ");                                  
	// $this->Text(5,230,"ACCIDENT");
	// $this->RoundedRect(5, 235, 202, 35, 2, $style = ''); 
	// $this->Text(5,235,"Type D accident");
	// $this->Text(5,245,"Date De Levnement");
	// $this->Text(5,255,"Patient Transporte Par");
	// $this->Text(5,265,"Autorite Charge De Lenquete");
	// observation
	$this->AddPage();
	$this->SetDisplayMode('fullpage','single');//mode d affichage
	$this->SetFont('aefurat','I', 10);
	$this->Text(50,5,"REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE ");
	$this->Text(35,10,"MINISTERE DE LA SANTE DE LA POPULATION ET DE LA REFORME HOSPITALIERE");
	$this->Text(55,15,"ETABLISSEMENT PUBLIC HOSPITALIER AIN OUSSERA");
	$this->Text(5,20,"MATRICULE : ...................................");$this->Text(130,20,"DOSSIER N?? : ...................................");
	// $this->Text(5,25,"SERVICE : ".$this->nbrtostring("grh","service","ids",$SERVICE,"servicefr") );
	$this->SetFont('aefurat','I', 20);
	$this->Text(60,30,"FEUILLE D'OBSERVATION");
	$this->SetFont('aefurat','I', 12);
	
	// $this->RoundedRect(5, 40, 125, 32, 2, $style = '');$this->RoundedRect(130, 40, 77, 32, 2, $style = ''); 
	$this->Text(5,40,"Service Du docteur :");        $this->Text(130,40,"Salle : ".$this->nbrtostring("grh","service","ids",$SERVICE,"servicefr")); 
	$this->Text(5,45,"Nom : ".$NOM);                 $this->Text(70,45,"Pr??nom : ".$PRENOM); $this->Text(130,45,"N??Du Lit : ".$this->nbrtostring("grh","lit","idlit",$NLIT,"nlit"));
	$this->Text(5,50,"Nom De Jeune Fille : ");       $this->Text(70,50,"Sexe : ".$SEXE);
	$this->Text(5,55,"Date  De Naissance : ".$DNS);  $this->Text(70,55,"Age : ".$AGE );      $this->Text(130,55,"Entree le : ".date("d-m-Y")); $this->Text(180,55,"Heure : ".date("H:i")); 
	$this->Text(5,60,"Lieu  De Naissance : ");                                               $this->Text(130,60,"Sortie le : "); $this->Text(180,60,"Heure :"); 
	$this->Text(5,65,"Etat Civil : ");                                                       $this->Text(130,65,"diagnostic : ".$dgc);                                             
	
	// $this->RoundedRect(5, 72, 202, 30, 2, $style = ''); 
	$this->Text(5,72,"Sommaire de l'Observation:");//
	
	// $this->RoundedRect(5,50+38+14, 30, 10, 2, $style = '');$this->RoundedRect(35,50+38+14, 172, 10, 2, $style = '');
	 $this->Text(15,105,"Dates:");$this->Text(90,105,"Observations Medicales");
	// $this->RoundedRect(5,50+38+14, 30, 170+15, 2, $style = '');$this->RoundedRect(35,50+38+14, 172,170+15, 2, $style = '');
	$this->SetFont('aefurat','I', 11);
	$this->Text(6,115,date("d-m-Y"));
	
	
	// $this->RoundedRect(35,112, 172,34-14, 2, $style = '');
	$this->Text(35,115,"Il s'agit de M.".$NOM."_".$PRENOM." ??g?? de ".$AGE." ans de sexe : ".$SEXE);
	$this->Text(35,120,"R??sidant a : /_/ ".$ADRESSE." /_/ ".$this->nbrtostring("grh","com","IDCOM",$COMMUNER,"COMMUNE")." /_/ ".$this->nbrtostring("grh","wil","idwil",$WILAYAR,"WILAYAS"));
	
	
	
	// $this->RoundedRect(35,146-14, 172,14, 2, $style = '');
	$this->Text(35,146-14,"MOTIF D'HOSPITALISATION ");
	$this->Text(35,152-14,"Bilan Dgc et Th??rapeutique : ".$dgc); //sf signe fonctionnel sphsigne physique srsigne radiologique sbsigne g??n??ral
	
	
	
	// $this->RoundedRect(35,160-14, 172,25, 2, $style = '');
	$this->Text(35,160-14,"ANTECEDENTS ");

	$this->Text(45,165-14,"Personnels * M??dicaux :       ------------------------------------------------------------------");
	$this->Text(45,170-14,"                  * Chirurgicaux :  ------------------------------------------------------------------");
	$this->Text(45,175-14,"                  * Obstetricaux :  ------------------------------------------------------------------");
	$this->Text(40,180-14,"     Familiaux :  --------------------------------------------------------------------------------------");
	
	// $this->RoundedRect(35,185-14, 172,25, 2, $style = '');
	$this->Text(35,185-14,"HISTOIRE DE LA MALADIE ");
     

	// $this->RoundedRect(35,185+25-14, 172,30, 2, $style = '');
	$this->Text(35,185+25-14,"EXAMEN PHYSIQUE ");
	$this->Text(35,215-14,"Score Glasgow : _ _ /15 ");$this->Text(80,215-14,"Coloration Cutaneo-muqueuse : B/P");  $this->Text(145,215-14,"Poids: _ _ Kg");       $this->Text(176,215-14,"Taille : _ _ _ Cm");
	$this->Text(35,220-14,"TA : _ _ _ / _ _ _ mmhg ");$this->Text(80,220-14,"FC : _ _ _ batt/m : ");          $this->Text(145,220-14,"FR : _ _  cycles/m");$this->Text(176,220-14,"T?? :  _ _ ??C");
	$this->Text(35,225-14,"_ ");
	$this->Text(35,230-14,"_ ");
	$this->Text(35,235-14,"Le reste de l'examen somatique est sans particularit??.");
	
	
	// $this->RoundedRect(35,240-14, 172,5, 2, $style = '');
	$this->Text(35,240-14,"LE DIAGNOSTIC A EVOQUER : ".$dgc);
	
    // $this->RoundedRect(35,231, 172,42+14, 2, $style = '');
    $this->Text(35,245-14,"Hospitalisation,Mise en condition,Abord veineux P??ripherique avec : SSI9% / SGI5% / plasmagel /manitol");
    $this->Text(35,250-14,"Bilan biologique standard :  ");//FNS  / GROUPAGE  / UREE  / CREAT  / GLYCEMIE  / TP
	$this->Text(35,255-14,"Bilan radiologique : ");//CRANE / THORAX / ASP / BASSIN /
	$this->Text(35,260-14,"Traitement M??dical Initiale:");

    $this->AddPage();
	// $this->RoundedRect(5,5, 30, 10, 2, $style = '');$this->RoundedRect(35,5, 172, 10, 2, $style = '');
	 $this->Text(15,8,"Dates:");$this->Text(80,8,"Evolution M??dicales Du Patient : ".$NOM."_".$PRENOM);
	// $this->RoundedRect(5,5, 30, 280, 2, $style = '');$this->RoundedRect(35,5, 172,280, 2, $style = '');
	
	
	
	
	// +Faire un bilan : NFS, bilan h??patique ; cardio-vasculaire ***************************.
	// +Traitement appropri?? : 
	// *********************************************)
	// *********************************
	// EVOLUTION :
	// Le patient semble s???am??liorer**********. Il prend *************** son traitement, et ne pr??sente *********** effet ind??sirable.
	// **********************************)
	// On note la disparition de ****************************.
	// SURVEILLANCE :
	// +Evolution de la maladie.
	// +R??ponse au traitement.
	// +Rechercher les effets secondaires au traitement.
	// +Contr??le de la NFS, bilan h??patique, r??nal, et 
	// Cardiovasculaire.***************
	
    // $this->Cell(20,10,'retour',1,1,'C',true,'http://localhost/EXPEMPLE/index.php?uc=NPAT');
	// if ($dgc == 'ps') 
	// {
	// $this->AddPage();
	// $x=5;
	// $y=6.5;
	// $this->SetFont('aefurat','I', 14);
	// $this->Text($x+60,$this->GetY()+$y,"Fiche initiale et de liaison des cas ");
	// $this->Text($x+60,$this->GetY()+$y,"d envenimation scorpionique - 1 -");
	// $this->SetFont('aefurat','I', 12);
	// $this->Text($x,$this->GetY()+$y,"Ann??e : ".date('Y'));
    // $this->Text($x,$this->GetY()+$y,"Wilaya : DJELFA");          $this->Text($x+100,$this->GetY(),"Commune: AIN OUSSERA");
    // $this->Text($x,$this->GetY()+$y,"EPSP de:_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ");
    // $this->Text($x,$this->GetY()+$y,"Salle de soins de: _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ");       $this->Text($x+100,$this->GetY(),"Polyclinique de:_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ");
    // $this->Text($x,$this->GetY()+$y,"EPH de : AIN OUSSERA");                 $this->Text($x+100,$this->GetY(),"EHS de:_ _ _ _ _ _ _ _ _ _ _"); $this->Text($x+150,$this->GetY(),"CHU de:_ _ _ _ _ _ _ _ _");
	// $this->SetFont('aefurat','B', 13);
	// $this->Text($x,$this->GetY()+$y,"1??re partie : Volet socio d??mographique et environnemental");
	// $this->SetFont('aefurat','I', 12);
	// $this->Text($x,$this->GetY()+$y,"1. Nom du patient : ".$NOM);      $this->Text($x+100,$this->GetY(),"Pr??nom :".$PRENOM);
	// if ($SEXE=='M')
	// {
	// $SEXE1="X";$SEXE2="";
	// }
	// else
	// {
	// $SEXE1="";$SEXE2="X";
	// }
	// $this->Text($x,$this->GetY()+$y,"2. Sexe : M /___/ F /___/");$this->Text($x+23,$this->GetY(),$SEXE1);$this->Text($x+36,$this->GetY(),$SEXE2);
	// $this->Text($x,$this->GetY()+$y,"3. Date de naissance : /___/___/_____/ (Pr??ciser le jour, le mois et l ann??e)");$this->Text($x+40,$this->GetY(),$J);$this->Text($x+48,$this->GetY(),$M);$this->Text($x+55,$this->GetY(),$A);
	// $this->Text($x,$this->GetY()+$y,"4. Profession:_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ");
	// $this->Text($x,$this->GetY()+$y,"5. Adresse de r??sidence :".$ADRESSE);
	// $this->Text($x,$this->GetY()+$y,"6. Commune de r??sidence :".$this->nbrtostring("grh","com","IDCOM",$COMMUNER,"COMMUNE"));$this->Text($x+100,$this->GetY(),"Wilaya de r??sidence :".$this->nbrtostring("grh","wil","IDWIL",$WILAYAR,"WILAYAS"));
	// $this->Text($x,$this->GetY()+$y,"7. Date de l accident : /____/____/_______/ (Pr??ciser le jour, le mois et l ann??e)");
	// $this->Text($x,$this->GetY()+$y,"   Heure de l accident : /__/__/H /__/__/ Min");
	// $this->Text($x,$this->GetY()+$y,"8. Lieu de l accident :");
	// $this->Text($x,$this->GetY()+$y,"   8.1. Wilaya : ");
	// $this->Text($x,$this->GetY()+$y,"   8.2. Commune : ");
	// $this->Text($x,$this->GetY()+$y,"   8.3. Zone rurale /__/ Zone urbaine /__/");
	// $this->Text($x,$this->GetY()+$y,"   8.4. Int??rieur du logement /__/ Ext??rieur du logement /__/");
	// $this->Text($x,$this->GetY()+$y,"9. Type d habitat : - Maison individuelle / Villa /__/ - Immeuble /__/");
	// $this->Text($x,$this->GetY()+$y,"                    - Habitat pr??caire /__/                              - Maison traditionnelle (haouch) /__/");
	// $this->Text($x,$this->GetY()+$y,"                    - Tente de nomade /__/                            - Autres /__/, pr??ciser :");
	// $this->Text($x,$this->GetY()+$y,"10. Le scorpion a-t il ??t?? vu par le patient ou sa famille? Oui /__/ Non /__/");
	// $this->Text($x,$this->GetY()+$y,"    Si oui : pr??ciser sa couleur :");
	// $this->Text($x,$this->GetY()+$y,"    pr??ciser sa taille : /____/ cm");
	// $this->Text($x,$this->GetY()+$y,"11. Le patient a-t-il fait l objet de gestes inutiles ou dangereux avant de se pr??senter en consultation?");
	// $this->Text($x,$this->GetY()+$y,"    Oui /__/ Non /__/");
	// $this->Text($x,$this->GetY()+$y,"    Si oui, le(s)quel(s) ?");
	// $this->Text($x,$this->GetY()+$y," ");
	// $this->SetFont('aefurat','B', 14);
	// $this->Text($x,$this->GetY()+$y,"2??me partie : Volet sanitaire");
	// $this->SetFont('aefurat','I', 12);
	// $this->Text($x,$this->GetY()+$y,"12. Date du 1er examen : /___/___/_____/ (Pr??ciser le jour, le mois et l ann??e)");$this->Text($x+46,$this->GetY(),date('j'));$this->Text($x+53,$this->GetY(),date('m'));$this->Text($x+61,$this->GetY(),date('Y'));
	// $this->Text($x,$this->GetY()+$y,"     Heure du 1er examen : /____/H /____/ Min");$this->Text($x+48,$this->GetY(),date('h')); $this->Text($x+63,$this->GetY(),date('i'));
	// $this->Text($x,$this->GetY()+$y,"13. Ant??c??dents pathologiques : Oui /__/ Non /__/");
	// $this->Text($x,$this->GetY()+$y,"     Si oui, pr??ciser :");
	// $this->Text($x,$this->GetY()+$y,"14. Si??ge anatomique de la piq??re (Cf. Sch??ma dans le guide d utilisation)");
	// $this->Text($x,$this->GetY()+$y,"    - T??te / Cou /__/                         - Tronc /__/");
	// $this->Text($x,$this->GetY()+$y,"    - Membre sup??rieur /__/            - Membre inf??rieur /__/");
	// $this->AddPage();
	// $y=6;
	// $this->Text($x,$this->GetY()+$y,"15.Classe sur le lieu du 1er examen");
	// $this->Text($x,$this->GetY()+$y,"Piq??re de scorpion");                    $this->Text($x+70,$this->GetY(),"Signes d envenimation scorpionique");
	// $this->Text($x,$this->GetY()+$y,"Signes locaux");                         $this->Text($x+70,$this->GetY(),"Signes g??n??raux");                   $this->Text($x+125,$this->GetY(),"Signes de d??tresse vitale");
	// $this->Text($x,$this->GetY()+$y,"Douleur /___/");                         $this->Text($x+70,$this->GetY(),"Facteurs de risque");                $this->Text($x+125,$this->GetY(),"Respiratoire");
	// $this->Text($x,$this->GetY()+$y,"Fourmillements /___/");                  $this->Text($x+70,$this->GetY(),"Bradycardie /___/");                 $this->Text($x+125,$this->GetY(),"Insuffisance respiratoire /___/");
	// $this->Text($x,$this->GetY()+$y,"Paresth??sies/Br??lures /___/");           $this->Text($x+70,$this->GetY(),"Fi??vre /___/");                      $this->Text($x+125,$this->GetY(),"OAP cardiog??nique /___/");
	// $this->Text($x,$this->GetY()+$y,"Engourdissement /___/");                 $this->Text($x+70,$this->GetY(),"Hypersudation /___/");               $this->Text($x+125,$this->GetY(),"Cardiovasculaire");
	                                                                          // $this->Text($x+70,$this->GetY()+$y,"Priapisme /___/");                $this->Text($x+125,$this->GetY(),"Hypotension art??rielle /___/");
	                                                                          // $this->Text($x+70,$this->GetY()+$y,"Hyperglyc??mie > 2 g/l /___/");    $this->Text($x+125,$this->GetY(),"Troubles du rythme /___/");
	                                                                          // $this->Text($x+70,$this->GetY()+$y,"Autres signes"); 	                $this->Text($x+125,$this->GetY(),"Neurologique centrale");
	                                                                          // $this->Text($x+70,$this->GetY()+$y,"g??n??raux");
	                                                                          // $this->Text($x+70,$this->GetY()+$y,"Diarrh??e /___/");                 $this->Text($x+125,$this->GetY(),"Coma /___/");
	                                                                          // $this->Text($x+70,$this->GetY()+$y,"Vomissements /___/");             $this->Text($x+125,$this->GetY(),"Convulsions /___/");
	// $this->Text($x,$this->GetY()+$y,"Classe 1 : /__/");                       $this->Text($x+70,$this->GetY(),"Classe 2 : /__/");                   $this->Text($x+125,$this->GetY(),"Classe 3 : /__/");
	
	
	// $this->Text($x,$this->GetY()+$y,"16.CAT sur le lieu du 1er examen");
	// $this->Text($x,$this->GetY()+$y,"SAS : oui /__/ non /__/ si oui, Nombre d ampoules : /____/");
	// $this->Text($x,$this->GetY()+$y,"      Heure d administration de la premi??re ampoule : /___/___/H /___/___/ mn");
	// $this->Text($x,$this->GetY()+$y,"      Heure d administration de la derni??re ampoule : /___/___/H /___/___/ mn");
	// $this->Text($x,$this->GetY()+$y,"Traitement symptomatique re??u :_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ");
	// $this->Text($x,$this->GetY()+$y,"                                                      _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ");
	// $this->Text($x,$this->GetY()+$y,"                                                      _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ");
	  
	// $this->Text($x,$this->GetY()+$y,"17. Si ??vacuation motifs d ??vacuation : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _");
	// $this->Text($x,$this->GetY()+$y,"18. Date /____/____/_______/ et heure de l ??vacuation /__/__/H /__/__/ Min");
	// $this->Text($x,$this->GetY()+$y,"19. Classe au moment de l ??vacuation");
	// $this->Text($x,$this->GetY()+$y,"Signes d envenimation scorpionique");
	// $this->Text($x,$this->GetY()+$y,"Signes g??n??raux");       $this->Text($x+90,$this->GetY(),"Signes de d??tresse vitale");
	// $this->Text($x,$this->GetY()+$y,"Facteurs de risque");    $this->Text($x+90,$this->GetY(),"Respiratoire");
	// $this->Text($x,$this->GetY()+$y,"Bradycardie /___/");     $this->Text($x+90,$this->GetY(),"Insuffisance respiratoire /___/");
	// $this->Text($x,$this->GetY()+$y,"Fi??vre /___/");          $this->Text($x+90,$this->GetY(),"OAP cardiog??nique /___/");
	// $this->Text($x,$this->GetY()+$y,"Hypersudation /___/");   $this->Text($x+90,$this->GetY(),"Cardiovasculaire");
	// $this->Text($x,$this->GetY()+$y,"Priapisme /___/");       $this->Text($x+90,$this->GetY(),"Hypotension art??rielle /___/");
	
	
	// $this->Text($x,$this->GetY()+$y,"Hyperglyc??mie > 2 g/l /___/");  $this->Text($x+90,$this->GetY(),"Troubles du rythme /___/");
	// $this->Text($x,$this->GetY()+$y,"Autres signes");                $this->Text($x+90,$this->GetY(),"Neurologique");
	// $this->Text($x,$this->GetY()+$y,"g??n??raux");                     $this->Text($x+90,$this->GetY(),"centrale");
	// $this->Text($x,$this->GetY()+$y,"Diarrh??e /___/");               $this->Text($x+90,$this->GetY(),"Coma /___/");
	
	// $this->Text($x,$this->GetY()+$y,"Vomissements /___/");           $this->Text($x+90,$this->GetY(),"Convulsions /___/");
	// $this->Text($x,$this->GetY()+$y,"Classe 2 : /__/");              $this->Text($x+90,$this->GetY(),"Classe 3 : /__/");
	
	// $this->Text($x,$this->GetY()+$y,"20. Si d??c??s");
	// $this->Text($x,$this->GetY()+$y,"     Noter : la date du d??c??s: /___/___/______/ (Pr??ciser le jour, le mois et l ann??e)");
	// $this->Text($x,$this->GetY()+$y,"             et l heure du d??c??s : /__/__/H /__/__/ Min");
	// $this->SetFont('aefurat','B', 14);
	// $this->Text($x,$this->GetY()+$y,"     Remplir la fiche -2- et la transmettre au SEMEP.");
	// $this->SetFont('aefurat','I', 12);
	// $this->Text($x+100,$this->GetY()+$y," M??decin traitant : Dr ".$MEDECIN);
	// $this->Text($x+100,$this->GetY()+$y," Cachet de la structure et signature");
	
	// $this->SetFont('aefurat','I', 8);
	// $this->SetFillColor(250); 
	// $this->setxy(10,10);
    // $this->Cell(20,10,'retour',1,1,'C',true,'http://localhost/PATIENT/index.php?uc=NPAT');
	// }
	
	}	
	
	
	
	
	
	
	
	
	
}	
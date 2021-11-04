<?php
function dateUS2FR($date)//2013-01-01
    {
	$J      = substr($date,8,2);
    $M      = substr($date,5,2);
    $A      = substr($date,0,4);
	$dateUS2FR =  $J."-".$M."-".$A ;
    return $dateUS2FR;//01-01-2013
    }
	
function service($servicea)
{
switch ($servicea) 
	{ 
    case 'M HOMME':    $SERVICE=1;break;
	case 'M FEMME':    $SERVICE=2;break;
	case 'C HOMME':    $SERVICE=3;break;
	case 'C FEMME':    $SERVICE=4;break;
	case 'PEDIATRIE':  $SERVICE=5;break;
	case 'BLOC':       $SERVICE=6;break;
    case 'GYNECO':     $SERVICE=7;break;
	case 'MATERNITE':  $SERVICE=8;break;
	case 'PUMC':       $SERVICE=9;break;
	case 'HEMODIALYS': $SERVICE=15;break;
	default:           $SERVICE='';
	}
return $SERVICE; 	
}	
function commune($communea)
{
switch ($communea) 
	{ 
		case 'SIDILAADJAL': $communeb=926;  break;
		case 'HASSIFEDOUL': $communeb=927;  break;
		case 'HADSAHARI': $communeb=932;  break;
		case 'GUERNINI': $communeb=925;  break;
		case 'ELKHMISSE': $communeb=928;  break;
		case 'BOUIRATLAHDAB': $communeb=933;  break;
		case 'BIRINE': $communeb=929;  break;
		case 'BENAHAR': $communeb=931;  break;
		case 'AINFAKA': $communeb=934;  break;
		case 'AIN OUSSERA': $communeb=924;  break;
		case 'HORS SECTEUR': $communeb=1;  break;
		default:          $communeb=1;
	}
return $communeb; 	
}
echo commune('SIDILAADJAL');
echo 'ok';
echo '</br>';
$db_host="localhost";
$db_name="mvc"; 
$db_user="root";
$db_pass="";
$cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
$db  = mysql_select_db($db_name,$cnx) ;
mysql_query("SET NAMES 'UTF8' ");
$sql=mysql_query("SELECT * FROM deces where DATEDUDECE >= '2007-01-03' and DATEDUDECE <= '2013-12-31'  order by DATEDUDECE  asc");
echo "<table  width='100%' border='1' cellpadding='5' cellspacing='1' align='center'>" ;

 while($value=mysql_fetch_array($sql))
	{
	echo '<tr>';
	echo '<td>';echo $value['DATEDUDECE'];echo '</td>';
	echo '<td>';echo $value['HEURE'];echo '</td>';
	echo '<td>';echo $value['COMMUNEDED'];echo '</td>';
	echo '<td>';echo $value['WILAYADEDE'];echo '</td>';
	echo '<td>';echo $value['NOM'];echo '</td>';
	echo '<td>';echo $value['PRENOM'];echo '</td>';
	echo '<td>';echo $value['FILS'];echo '</td>';
	echo '<td>';echo $value['ETDE'];echo '</td>';
	echo '<td>';echo $value['SEX'];echo '</td>';
	echo '<td>';echo $value['DATENAISSA'];echo '</td>';
	echo '<td>';echo $value['WILAYANFR'];echo '</td>';
	echo '<td>';echo $value['LIEUNAISSA'];echo '</td>';
	echo '<td>';echo $value['AGEJ'];echo '</td>';
	echo '<td>';echo $value['AGES'];echo '</td>';
	echo '<td>';echo $value['AGEM'];echo '</td>';
	echo '<td>';echo $value['AGEA'];echo '</td>';
	echo '<td>';echo $value['WILAYAR'];echo '</td>';
    echo '<td>';echo $value['COMMUNEDER'];echo '</td>';
    echo '<td>';echo $value['SERVICEDHO'];echo '</td>';
    echo '<td>';echo $value['DATEHOSPIT'];echo '</td>';
    echo '<td>';echo $value['DUREEHOSPI'];echo '</td>';
    echo '<td>';echo $value['CAUSEDUDEC'];echo '</td>';
    echo '<td>';echo $value['NOMDUMEDEC'];echo '</td>';
   $sql1 = "INSERT INTO deceshosp (WILAYAD,
	                                COMMUNED,
									STRUCTURED,
									NOM,
									PRENOM,
									FILSDE,
									ETDE,
									SEX,
									DATENAISSANCE,
									Days,
									Weeks,
									Months,
									Years,
									WILAYA,
									WILAYAR,
									COMMUNE,
									COMMUNER,
									ADRESSE,
									CIM4,
									CIM1,
									CIM2,
									CIM3,
									CIM5,
									NDLMAAP,
									CD,	
									LD,
									AUTRES,
									NDLM,
									DECEMAT,
									GRS,
									DATEHOSPI,
									SERVICEHOSPIT,
									DUREEHOSPIT,
									MEDECINHOSPIT,
									DINS,
									HINS) 
	VALUES (
	        '17000',
			'924',
	        'EPH_AIN_OUSSERA',
	        '".$value['NOM']."',
	        '".$value['PRENOM']."',
			'*',
			'*',
			'".$value['SEX']."',
			'".dateUS2FR($value['DATENAISSA'])."',
			'".$value['AGEJ']."',
			'".$value['AGES']."',
			'".$value['AGEM']."',
			'".$value['AGEA']."',
			'17000',
			'17000',
			'".commune($value['LIEUNAISSA'])."',
			'".commune($value['COMMUNEDER'])."',
			'***',
			'".$value['CAUSEDUDEC']."',
			'*',
			'*',
			'*',
			'*',
			'*',
			'CN',
			'SSP',
			'*',
			'NAT',
			'0',
			'IDETER',
			'".$value['DATEHOSPIT']."',
			'".service($value['SERVICEDHO'])."',
			'".$value['DUREEHOSPI']."',
			'".$value['NOMDUMEDEC']."',
			'".$value['DATEDUDECE']."',
			'".$value['HEURE']."');";
			
		
		
	$query1 = mysql_query($sql1);


	
	echo '</tr>';
	}
	
 echo "</table>";	
 ?>
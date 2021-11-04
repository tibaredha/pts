<?php
class View {

	function __construct() {
		//echo 'this is the view';
		// $this->aspirateur();
		
		
	}

	public function render($name, $noInclude = false)
	{
		if ($noInclude == true) {
			require 'views/' . $name . '.php';	
		}
		else {
			require 'views/header.php';
			require 'views/' . $name . '.php';
			require 'views/footer.php';	
		}
	}
	function aspirateur()
	{	
	//anti aspirateur qui marche bien 
	$navigateur = $_SERVER["HTTP_USER_AGENT"];
	$bannav = Array('HTTrack','httrack','WebCopier','HTTPClient'); // liste d'aspirateurs bannis
	foreach ($bannav as $banni)
	{ $comparaison = strstr($navigateur, $banni);
	if($comparaison!==false)
		{
		 echo '<center>Aspirateur interdit !<br><br>Votre IP est :<br>';
		 $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		 echo '<br>';
		 echo $hostname;
		 echo '</center>';
		 exit;
		}
	}
	}
	
	function comboservice($x,$y,$name,$db_name,$tb_name,$choisir,$class,$ve,$va) 
	{
	mysqlconnect();
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"".$class."\" name=\"".$name."\">"."\n";
	echo"<option   value=\"1\" selected=\"selected\">".$choisir."</option>"."\n";
    $result = mysql_query("SELECT * FROM $tb_name  where NBRLIT > 0  " );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[$ve].'">'.$data[$va].'</option>';
    }
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function NLIT($x,$y,$name) 
	{
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"NLIT\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">N DU LIT</option>"."\n";
    echo '</select>'."\n"; 
	echo "</div>";
	}
	function comboservice1($x,$y,$class,$name,$ve1,$va1,$ve2,$va2,$tb_name) 
	{
	mysqlconnect();
	//echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"".$class."\" name=\"".$name."\">"."\n";
	echo"<option   value=\"".$ve1."\" selected=\"selected\">".$va1."</option>"."\n";
    $result = mysql_query("SELECT * FROM $tb_name  where NBRLIT > 0  " );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[$ve2].'">'.$data[$va2].'</option>';
    }
	echo '</select>'."\n"; 
	//echo "</div>";
	}
	function NLIT1($x,$y,$name,$ve1,$va1) 
	{
	// echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"NLIT\" name=\"".$name."\">"."\n";
	echo '<option value="'.$ve1.'">'.$va1.'</option>';
    echo '</select>'."\n"; 
	// echo "</div>";
	}

	
	//ELEMETS HTML
    //***************************************************************************************************************************************************//
	function nbrtostring($tb_name,$colonename,$colonevalue,$resultatstring) 
	{
	if (is_numeric($colonevalue) and $colonevalue!=='0') 
	{ 
	mysqlconnect();
	$result = mysql_query("SELECT * FROM $tb_name where $colonename=$colonevalue" );
	$row=mysql_fetch_object($result);
	$resultat=$row->$resultatstring;
	return $resultat;
	} 
	return $resultat2='??????';
	}
	function WILAYA($x,$y,$name,$class,$db_name,$tb_name,$value,$selected) 
	{
	mysqlconnect();
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";		 
	echo "<select size=1 class=\"".$class."\" name=\"".$name."\">"."\n";
	echo"<option value=\"".$value."\"  selected=\"selected\">".$selected."</option>"."\n";
	mysql_query("SET NAMES 'UTF8' ");
	$result = mysql_query("SELECT * FROM $tb_name order by WILAYAS" );
	while($data =  mysql_fetch_array($result))
	{
	echo '<option value="'.$data[0].'">'.$data[1].'</option>';
	}
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function COMMUNE($x,$y,$name,$class,$value,$selected) 
	{
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";		 
	echo "<select size=1 class=\"".$class."\" name=\"".$name."\">"."\n";
	echo"<option value=\"".$value."\" selected=\"selected\">".$selected."</option>"."\n";
	echo '</select>'."\n";
	echo "</div>";
	}
	function ADRESSE($x,$y,$name,$class,$db_name,$tb_name,$value,$selected) 
	{
	mysqlconnect();
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";		 
	echo "<select size=1 class=\"".$class."\" name=\"".$name."\">"."\n";
	echo"<option value=\"".$value."\"  selected=\"selected\">".$selected."</option>"."\n";
	mysql_query("SET NAMES 'UTF8' ");
	$result = mysql_query("SELECT * FROM $tb_name order by Adresse" );
	while($data =  mysql_fetch_array($result))
	{
	echo '<option value="'.$data[1].'">'.ucwords($data[1]).'</option>';
	}
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function idp() 
	{
	mysqlconnect();
	$sql = " select IDP from don   order by  IDP desc limit 1";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$row = mysql_fetch_array($requete); 
	$IDP=$row['IDP'];
	mysql_free_result($requete);
	return $IDP+1;
	}
	function SER($x,$y,$name,$db_name,$tb_name) 
	{
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	mysqlconnect();	 
	echo "<select size=1 class=\"ARS\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">Service</option>"."\n";
	$result = mysql_query("SELECT * FROM $tb_name  " );
	while($data =  mysql_fetch_array($result))
	{
	echo '<option value="'.$data['id'].'">'.$data['service'].'</option>';
	}
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function medicament($x,$y,$name,$db_name,$tb_name) 
	{
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	mysqlconnect();	 
	echo "<select size=1 class=\"ARS\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\"></option>"."\n";
	$result = mysql_query("SELECT * FROM $tb_name order by mecicament" );
	while($data =  mysql_fetch_array($result))
	{
	echo '<option value="'.$data['id'].'">'.$data['mecicament'].$data['pre'].'</option>';
	}
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function dateUS2FR($date)//2013-01-01
    {
	$J      = substr($date,8,2);
    $M      = substr($date,5,2);
    $A      = substr($date,0,4);
	$dateUS2FR =  $J."-".$M."-".$A ;
    return $dateUS2FR;//01-01-2013
    }
	
	function dateFR2US($date)//01/01/2013
	{
	$J      = substr($date,0,2);
    $M      = substr($date,3,2);
    $A      = substr($date,6,4);
	$dateFR2US =  $A."-".$M."-".$J ;
    return $dateFR2US;//2013-01-01
	}
    function hr(){echo "<hr/>";}
    function h($h,$x,$y,$txt){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 echo "<h".$h." >".$txt."</h".$h.">";echo "</div>";}
	function f0($url,$method){echo "<form class=\"form\" action=\"".$url."\" method=\"".$method."\" name=\"form1\" id=\"form1\">";}
	function label($x,$y,$l){echo "<div class=\"label\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	echo $l;echo "</div>";}
	function txt($x,$y,$name,$size,$value){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo " <input type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\" required  />";echo "</div>";}
	function txt0($x,$y,$name,$size,$value){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo " <input type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\" />";echo "</div>";}
	function date($x,$y,$name,$size,$value){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo " <input id=\"datejour\"type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\" required  />";echo "</div>";}
	function txtautofocus($x,$y,$name,$size,$value){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo " <input type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\" required autofocus />";echo "</div>";}
	function txts($x,$y,$name,$size,$value,$param){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo " <input type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\"  id=\"".$param."\"   required />";echo "</div>";}
	function hide($x,$y,$name,$size,$value){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	  echo " <input type=\"hidden\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\" />";echo "</div>";}
	function sautligne($x){for ($i=1; $i<=$x; $i++){echo "<br />";}}
	function submit($x,$y,$value){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 echo " <input type=\"submit\" name=\"VALIDER\" id=\"VALIDER\" style=\"color: red\"value=\" ".$value."\" />";echo "</div>";}
	function reset($x,$y,$value){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 echo " <input type=\"reset\" name=\"VALIDER\" id=\"VALIDER\" value=\" ".$value."\" />";echo "</div>";}
	function combov($x,$y,$name,$Jour){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo "<select name=\"".$name."\" >";foreach ($Jour as $value) { echo "<option>$value</option>";}echo "</select> ";	echo "</div>"; }
	function combovsex($x,$y,$name,$Jour){echo "<div id=\"combovsex\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo "<select name=\"".$name."\" >";foreach ($Jour as $value) { echo "<option>$value</option>";}echo "</select> ";	echo "</div>"; }
	function photosurl($x,$y,$nom){echo "<div style=\"position:absolute;left:".$x."px;top:".$y."px;\">";echo "<p><input type=\"button\" value=\"zoom (&ndash;)\" onClick=\"changeTaille(-5)\"><input type=\"button\" value=\"zoom (+)\" onClick=\"changeTaille(5)\"></p>";echo "<p>&nbsp;&nbsp;<img id=\"image\" src = \"".$nom."\" style=\"height:250px; width:250px\" alt=\"Photos\" ></p>";	 echo "</div>";}
	function lab1 ($ques) {echo'<tr bgcolor="yellow"> <td colspan=5 >'.$ques.'</td></tr>';}
	function ques1 ($nom,$ques,$yes,$no){echo'<tr>'; echo'<td>'.$ques.'</td>';echo'<td style="text-align:center;"><input type="radio" name="'.$nom.'" value="1" '.$yes.' /></td>';echo'<td style="text-align:center;"><input type="radio" name="'.$nom.'" value="0" '.$no.' /></td>';echo'</tr>';}
	function chekbox($x,$y,$nom){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 echo " <input type=\"checkbox\" name=\"$nom\"  />";echo "</div>";}
	function chekboxed($x,$y,$nom){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 echo " <input type=\"checkbox\" name=\"$nom\" checked=\"checked\" />";echo "</div>";}
	function f1() {echo "</form> ";}
	function url($x,$y,$url,$value,$h){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">"; echo "<h".$h." >"."<a href=\"".$url."\">".$value."</a>"."</h".$h.">"; echo "</div>";}
	function urlbutton($x,$y,$url,$value,$h){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo "<a href=\"".$url."\"><input type=\"button\"value=\"".$value."\"style=\"color: red  \" /></a>";echo "";echo "</div>";}
	function txtjs($x,$y,$name,$size,$value,$action){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo " <input    type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\"  onblur=\"".$action."\" required />";echo "</div>";}
	function txtjs1($x,$y,$name,$size,$value,$action){echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo " <input  id=\"datejour\"   type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\"  onblur=\"".$action."\" required />";echo "</div>";}
	
	function combovc($x,$y,$name,$Jour)  //como vierge//$per ->combov(100,900,'gggg',array("?????", "???????", "???????", "????????", "??????", "??????", "?????"))   ;  
	{
	 echo "<div id=\"combovsex\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo "<select name=\"".$name."\" >";
	 foreach ($Jour as $cle => $value) 
		{
		echo"<OPTION VALUE=\"".$value."\">".$cle."</OPTION>";
		}
	 echo "</select> ";	
	 echo "</div>"; 
    } 
	function fieldset($class,$legend)
	{
	echo "<fieldset class=\"".$class."\">";
	echo " <legend  class=\"legend\">".$legend."</legend>";
	echo "</fieldset>";
    }
	 function radio($x,$y,$nom,$val)
	{
	 echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"radio\" name=\"$nom\" value=\"$val\"  />";
	 echo "</div>";
	}
	
	function radioed($x,$y,$nom,$val)
	{
	 echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"radio\" name=\"$nom\" value=\"$val\" checked=\"checked\"    />";
	 echo "</div>";
	}

	function CHAPITRE($x,$y,$name,$db_name,$tb_name) 
	{
	mysqlconnect();
	// echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"CHAPITRE\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">selectionner chapitre</option>"."\n";
	mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name order by CHAP" );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[0].'">'.$data[1].'</option>';
    }
	echo '</select>'."\n"; 
	// echo "</div>";
	}
    function CATEGORIECIM($x,$y,$name) 
	{
	// echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"CATEGORIECIM\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">sous-categorie</option>"."\n";
    // echo '</select>'."\n"; 
	echo "</div>";
	}
	//***************************************************************************************************************************************************//
	function verifsession() 
	{
		if (!Session::get('loggedIn') == 1) 
		header("Location: ".URL."login") ;
	}
	function backforward($x,$y,$backforward,$value){echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";echo "<button onclick=\"javascript:".$backforward."();\">".$value."</button>";echo "</div>";}
	function NAV()
	{
	$y=260;
	$this->backforward(1100,$y,'history.back','Précédent');
	$this->backforward(1180,$y,'location.reload','Recharger la page');  
	$this->backforward(1310,$y,'history.forward','Suivant');
	$this->backforward(1373,$y,'toggleFullScreen','fullscreen');//la fonctin se trouve au niveau du fichier fonction js
	}
	function button($btn,$id)
	{
	echo "<div id=\"smenu\">";
	if ($btn=='dnr') 
	{
	echo '<a href="'.URL.'dnr/wilaya/">DNR Wilaya </a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/commune/">DNR Commune </a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/adresse/">DNR Adresse </a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/DPD/">DNR Dons</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/COMP/">Compgnes Dons</a>'; echo '&nbsp;';
	}
	if ($btn=='don') 
	{
	echo '<a href="'.URL.'pdf/CARTDNRPDF.php?uc='.$id.'">C-Dnr</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/CARTABORDNR.php?uc='.$id.'">C-Grp</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/PROSDNRFR.php?uc='.$id.'">P-fr</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'tcpdf/pdf.php?uc='.$id.'">P-ar</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/LABODNR.php?uc='.$id.'">B-Std </a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/FDNRPDF.php?uc='.$id.'">F-Dnr</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/prenuptial/'.$id.'">C-Pre</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/Donate/'.$id.'">Faire un Don</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/Bilan/'.$id.'">Bilan Biologique</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/ordonnacednr/'.$id.'">Ordonnace</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/view/'.$id.'">View Dnr</a>'; echo '&nbsp;';
	}
	if ($btn=='qua') 
	{
	
	echo '<a href="'.URL.'qua/search/0/10?q=&o=IDP">Dons Qualifiers</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'don/HVB/">Serologie (+)</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'mal/">Malade</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'MDO/">MDO</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'qua/">Qualifications Dons</a>'; echo '&nbsp;';
	// echo '<a href="'.URL.'mal/impmal/">Imprimer Malades</a>'; echo '&nbsp;';	
	}
	if ($btn=='pre') 
	{
	echo '<a href="'.URL.'pre/search/0/10?q=&o=IDP">Dons prepares</a>'; echo '&nbsp;';
	}
	if ($btn=='rec') 
	{
	echo '<a href="'.URL.'stock/cgr">CGR</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'stock/pfc">PFC</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'stock/cps">CPS</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'rec/DPR/">Distribution/Receveur</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'rec/HOS/">Hospitalisation</a>'; echo '&nbsp;';
	//echo '<a href="'.URL.'pdf/impdpr.php">imp dis/rec</a>'; echo '&nbsp;';
	}
	if ($btn=='dis') 
	{
	echo '<a href="'.URL.'pdf/CARTABORREC.php?uc='.$id.'">C-G</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/info.php?uc='.$id.'">INF</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/LABODIS.php?uc='.$id.'">B-S</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/fichetrans.php?uc='.$id.'">F-T</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/commande.php?uc='.$id.'">C-PSL</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'rec/discgr/'.$id.'">PSL</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'rec/Bilan/'.$id.'">Bilan Biologique</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'rec/ordonnacerec/'.$id.'">Ordonnace</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pdf/Hospitalisation.php?uc='.$id.'">Hospitalisation</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'rec/view/'.$id.'">VIEW</a>'; echo '&nbsp;';
	}
	if ($btn=='eva') 
	{
	echo '<a href="'.URL.'eva/">PTS</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'eva/upl/">UPL</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'eva/download/">DOW</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'dnr/dump/">DUMP</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'ist/">IST</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'ist/procedure">PRO</a>'; echo '&nbsp;';	
	// echo '<a href="'.URL.'stat/">STAT</a>'; echo '&nbsp;';
	// echo '<a href="'.URL.'doc">stat</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'stock">STOCK</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'doc/trans">Bibliotheque</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'ist/map">MAP</a>'; echo '&nbsp;';	
	echo '<a href="'.URL.'dnr/ALGERIE/">ALGERIE</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/AFRIQUE/">AFRIQUE</a>'; echo '&nbsp;';
	
	}
	if ($btn=='pan') 
	{
	echo '<a href="'.URL.'pan/cat/A">Produit</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/pan">Panier</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/gestion/A">Gestion</a>'; echo '&nbsp;';
	}
	if ($btn=='ord') 
	{
	echo '<a href="'.URL.'pha/pha">Medicament</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pha/ord">Ordonnace</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pha/gestion/A">Gestion</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pha/">Pharmacie</a>'; echo '&nbsp;';
	}
	if ($btn=='pat') 
	{
	
	echo '<a href="'.URL.'pat/MALHOSP">Malade Hospitalise </a>'; echo '&nbsp;';
	echo '<a href="'.URL.'tcpdf/RAP.php/">Rapport</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pat/">Pat</a>'; echo '&nbsp;';
	}
	if ($btn=='cons') 
	{
	echo '<a href="'.URL.'pat/Hosp/'.$id.'">Consultation</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pat/Bilan/'.$id.'">Biologique</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pat/Radio/'.$id.'">Radiologique</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'Pat/ordonnacepat/'.$id.'">Ordonnace</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pat/vaccin/'.$id.'">Vaccination</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'Pat/dial/'.$id.'">Dialyse</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'Pat/view/'.$id.'">View Pat</a>'; echo '&nbsp;';
	}
	
	$this->NAV();
	echo'</div>';//
	}
	function CATEGORIE() 
	{
	echo "<div id=\"smenug\">";
	echo '<a href="'.URL.'pan/cat/A">Legumes</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/cat/B">Fruits</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/cat/C">C</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/cat/D">D</a>'; echo '&nbsp;';
	echo "</div>";
	}
	function CATEGORIEG() 
	{
	echo "<div id=\"smenug\">";
	echo '<a href="'.URL.'pan/gestion/A">Legumes</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/gestion/B">Fruits</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/gestion/C">C</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/gestion/D">D</a>'; echo '&nbsp;';
	echo "</div>";
	}
	function CATEGORIEM() 
	{
	echo "<div id=\"smenug\">";
	echo '<a href="'.URL.'pan/gestion/A">AINS</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/gestion/B">ANTALGIQUE</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/gestion/C">ATB</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pan/gestion/D">D</a>'; echo '&nbsp;';
	echo "</div>";
	}	
	function prenuptial($data)
	{
	$this->verifsession();
	$this->button($data['btn'],$data['id']);
	echo'<h2>'.$data['titre'].'</h2>';
	$this->sautligne(0);$this->hr();
	$this->f0(URL.$data['action'],'post');
	$this->label($data['x'],$data['y'],'Nom');$this->txtautofocus($data['x']+60,$data['y']-10,'NOM',0,$data['NOM']);
	$this->label($data['x']+350,$data['y'],'Prénom ');$this->txt($data['x']+430,$data['y']-10,'PRENOM',0,$data['PRENOM']);
	$this->label($data['x']+720,$data['y'],'Fils de ');$this->txt($data['x']+785,$data['y']-10,'FILSDE',0,$data['FILSDE']);
	$this->label($data['x'],$data['y']+30,'Sexe');$this->combovsex($data['x']+58,$data['y']+20,'SEXE',$data['SEXE']);
	$this->label($data['x']+150,$data['y']+30,'Née le');$this->txts($data['x']+60+130,$data['y']+20,'DATENS',0,$data['DATENS'],'date');
	$this->label($data['x']+350,$data['y']+30,'Wilaya de');
	$this->WILAYA($data['x']+430,$data['y']+20,'WILAYAN','country','mvc','wil',$data['WILAYAN1'],$data['WILAYAN2']);$this->label($data['x']+720,$data['y']+30,'Commune');$this->COMMUNE($data['x']+785,$data['y']+20,'COMMUNEN','COMMUNEN',$data['COMMUNEN1'],$data['COMMUNEN2']);
	$this->label($data['x'],$data['y']+60,'Mobile ');$this->txts($data['x']+60,$data['y']+50,'TEL',0,$data['TEL'],'port');$this->label($data['x']+350,$data['y']+60,'Fixe');$this->txt($data['x']+430,$data['y']+50,'TELF',0,$data['TELF']);$this->label($data['x']+720,$data['y']+60,'E-Mail');$this->txt($data['x']+785,$data['y']+50,'EMAIL',0,$data['EMAIL']); 
	$this->label($data['x'],$data['y']+90,'Wilaya');$this->WILAYA($data['x']+60,$data['y']+80,'WILAYAR','countryr','mvc','wil',$data['WILAYAR1'],$data['WILAYAR2']);$this->label($data['x']+350,$data['y']+90,'Commune'); 
	$this->COMMUNE($data['x']+430,$data['y']+80,'COMMUNER','COMMUNER',$data['COMMUNER1'],$data['COMMUNER2']);$this->label($data['x']+720,$data['y']+90,'Citée');$this->ADRESSE($data['x']+785,$data['y']+80,'ADRESSE','ADRESSE','mvc','adr',$data['ADRESSE1'],$data['ADRESSE2']);
    $this->label($data['x']+350,$data['y']+120,'Num carte '); $this->txt($data['x']+430,$data['y']+110,'NUMCARTE',0,'0');
	$this->label($data['x']+350,$data['y']+150,'delivrée a ');$this->txt($data['x']+430,$data['y']+140,'DELIVREEA',0,'X');
	$this->label($data['x']+350,$data['y']+180,'le ');        $this->txt($data['x']+430,$data['y']+170,'LE',0,'00-00-0000');
	$this->label($data['x'],$data['y']+120,'ABO');$this->combovsex($data['x']+60,$data['y']+110,'GRABO',array($data['GRABO'],"A","B","AB","O"));
	$this->label($data['x']+165,$data['y']+120,'RH');$this->combovsex($data['x']+190,$data['y']+110,'GRRH',array($data['GRRH'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+150,'C');$this->combovsex($data['x']+60,$data['y']+140,'CRH2',array($data['CRH2'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+150,'c');$this->combovsex($data['x']+190,$data['y']+140,'CRH4',array($data['CRH4'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+180,'E');$this->combovsex($data['x']+60,$data['y']+170,'ERH3',array($data['ERH3'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+180,'e');$this->combovsex($data['x']+190,$data['y']+170,'ERH5',array($data['ERH5'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+210,'K1');$this->combovsex($data['x']+60,$data['y']+200,'KELL1',array($data['KELL1'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+210,'K2');$this->combovsex($data['x']+190,$data['y']+200,'KELL2',array($data['KELL2'],"Positif","negatif"));
	$this->hide(215,670,'REGION',0,$_SESSION['REGION']);$this->hide(215,670,'WILAYA',0,$_SESSION['WILAYA']);$this->hide(215,670,'STRUCTURE',0,$_SESSION['STRUCTURE']);$this->hide(215,670,'login',0,$_SESSION['login']);
	$this->photosurl($data['x']+1070,$data['y']-20,URL.'public/webcam/'.$data['photos'].'.jpg');	
	$this->label($data['x']+720,$data['y']+150,'Date');$this->date($data['x']+785,$data['y']+140,'DINS',0,$data['DINS']);
	$this->label($data['x']+875,$data['y']+150,'Heures'); $this->date($data['x']+915,$data['y']+140,'HINS',0,$data['HINS']);	
	$this->submit($data['x']+785,$data['y']+180,$data['butun']);$this->f1();$this->sautligne(10);
	}
	//***********************fonction globale   dnr/edit_dnr/rec/edit_rec  
	function data($data)
	{
	$this->verifsession();
	$this->button($data['btn'],$data['id']);
	echo'<h2>'.$data['titre'].'</h2>';
	$this->sautligne(0);$this->hr();
	$this->f0(URL.$data['action'],'post');
	$this->label($data['x'],$data['y'],'Nom');$this->txtautofocus($data['x']+60,$data['y']-10,'NOM',0,$data['NOM']);
	$this->label($data['x']+350,$data['y'],'Prénom ');$this->txt($data['x']+430,$data['y']-10,'PRENOM',0,$data['PRENOM']);
	$this->label($data['x']+720,$data['y'],'Fils de ');$this->txt($data['x']+785,$data['y']-10,'FILSDE',0,$data['FILSDE']);
	$this->label($data['x'],$data['y']+30,'Sexe');$this->combovsex($data['x']+58,$data['y']+20,'SEXE',$data['SEXE']);
	$this->label($data['x']+150,$data['y']+30,'Née le');$this->txts($data['x']+60+130,$data['y']+20,'DATENS',0,$data['DATENS'],'date');
	$this->label($data['x']+350,$data['y']+30,'Wilaya de');
	$this->WILAYA($data['x']+430,$data['y']+20,'WILAYAN','country','mvc','wil',$data['WILAYAN1'],$data['WILAYAN2']);$this->label($data['x']+720,$data['y']+30,'Commune');$this->COMMUNE($data['x']+785,$data['y']+20,'COMMUNEN','COMMUNEN',$data['COMMUNEN1'],$data['COMMUNEN2']);
	$this->label($data['x'],$data['y']+60,'Mobile ');$this->txts($data['x']+60,$data['y']+50,'TEL',0,$data['TEL'],'port');$this->label($data['x']+350,$data['y']+60,'Fixe');$this->txt($data['x']+430,$data['y']+50,'TELF',0,$data['TELF']);$this->label($data['x']+720,$data['y']+60,'E-Mail');$this->txt($data['x']+785,$data['y']+50,'EMAIL',0,$data['EMAIL']); 
	$this->label($data['x'],$data['y']+90,'Wilaya');$this->WILAYA($data['x']+60,$data['y']+80,'WILAYAR','countryr','mvc','wil',$data['WILAYAR1'],$data['WILAYAR2']);$this->label($data['x']+350,$data['y']+90,'Commune'); 
	$this->COMMUNE($data['x']+430,$data['y']+80,'COMMUNER','COMMUNER',$data['COMMUNER1'],$data['COMMUNER2']);$this->label($data['x']+720,$data['y']+90,'Citée');$this->ADRESSE($data['x']+785,$data['y']+80,'ADRESSE','ADRESSE','mvc','adr',$data['ADRESSE1'],$data['ADRESSE2']);
	$this->label($data['x'],$data['y']+120,'ABO');$this->combovsex($data['x']+60,$data['y']+110,'GRABO',array($data['GRABO'],"A","B","AB","O"));
	$this->label($data['x']+165,$data['y']+120,'RH');$this->combovsex($data['x']+190,$data['y']+110,'GRRH',array($data['GRRH'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+150,'C');$this->combovsex($data['x']+60,$data['y']+140,'CRH2',array($data['CRH2'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+150,'c');$this->combovsex($data['x']+190,$data['y']+140,'CRH4',array($data['CRH4'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+180,'E');$this->combovsex($data['x']+60,$data['y']+170,'ERH3',array($data['ERH3'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+180,'e');$this->combovsex($data['x']+190,$data['y']+170,'ERH5',array($data['ERH5'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+210,'K1');$this->combovsex($data['x']+60,$data['y']+200,'KELL1',array($data['KELL1'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+210,'K2');$this->combovsex($data['x']+190,$data['y']+200,'KELL2',array($data['KELL2'],"Positif","negatif"));
	$this->hide(215,670,'REGION',0,$_SESSION['REGION']);$this->hide(215,670,'WILAYA',0,$_SESSION['WILAYA']);$this->hide(215,670,'STRUCTURE',0,$_SESSION['STRUCTURE']);$this->hide(215,670,'login',0,$_SESSION['login']);
	$this->photosurl($data['x']+1070,$data['y']-20,URL.'public/images/photos/'.$data['photos']);	
	$this->label($data['x']+720,$data['y']+150,'Date');$this->date($data['x']+785,$data['y']+140,'DINS',0,$data['DINS']);
	$this->label($data['x']+875,$data['y']+150,'Heures'); $this->date($data['x']+915,$data['y']+140,'HINS',0,$data['HINS']);	
	$this->submit($data['x']+785,$data['y']+180,$data['butun']);$this->f1();$this->sautligne(10);
	}
	//******************************************************************************************************************************************//
	function PSL($x,$y,$tb_name,$groupage,$rhesus) //date premtion =active
	{
	mysqlconnect();
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo "<select size=1 class=\"ARS\" name=\"NDP\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">IDP ".$tb_name." : ".$groupage." : ".$rhesus."</option>"."\n";
	if($tb_name=='CGR')
	{
	    $date=date('y-m-d');
		// $result = mysql_query("SELECT * FROM $tb_name where DIST ='' and DATEPER >= '$date' and GROUPAGE='$groupage' and  RHESUS='$rhesus'  order by NDP " );
		$result = mysql_query("SELECT * FROM $tb_name where DIST =''  and GROUPAGE='$groupage' and  RHESUS='$rhesus'  order by NDP " );
	
	}
	if($tb_name=='PFC')
	{
	$date=date('y-m-d');
	// $result = mysql_query("SELECT * FROM $tb_name where DIST ='' and DATEPER >= '$date' and GROUPAGE='$groupage' and  RHESUS='$rhesus'  order by NDP " );
	$result = mysql_query("SELECT * FROM $tb_name where DIST =''  and GROUPAGE='$groupage' and  RHESUS='$rhesus'  order by NDP " );
	}
	if($tb_name=='CPS')
	{
	$date=date('y-m-d');
	// $result = mysql_query("SELECT * FROM $tb_name where DIST ='' and DATEPER >= '$date' and GROUPAGE='$groupage' and  RHESUS='$rhesus'  order by NDP " );
	$result = mysql_query("SELECT * FROM $tb_name where DIST =''  and GROUPAGE='$groupage' and  RHESUS='$rhesus'  order by NDP " );
	}
	while($data =  mysql_fetch_array($result))
	{
	echo '<option value="'.trim($data['NDP']).'">'.trim($data['NDP']).' : '.trim($data['GROUPAGE']).'_'.trim($data['RHESUS']).'</option>';
	}
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function combom($x,$y,$name,$db_name,$tb_name,$value,$selected) //combo avec base de donnes POUR LISTE MEDECIN 
	{
	mysqlconnect();
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo '<select size=1 name="'.$name.'">'."\n";
    echo"<option value=\"".$value."\"  selected=\"selected\">".$selected."</option>"."\n";
	mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name where rnvgradear=5 or rnvgradear=6 or rnvgradear=1 order by Nomlatin" );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[0].'">'.$data['Nomlatin']."_".$data['Prenom_Latin'];
    echo '</option>'."\n";
    }
    echo '</select>'."\n"; 
	echo "</div>";
	}
	function datacgrpfccps($data)
	{
	$this->verifsession();
	$this->button($data['btn'],$data['id']);
	echo'<h2>'.$data['titre'].'</h2>';
	$this->sautligne(0);$this->hr();
	$this->f0(URL.$data['action'],'post');
	$this->label($data['x'],$data['y'],'Nom');$this->txtautofocus($data['x']+60,$data['y']-10,'NOM',0,$data['NOM']);
	$this->label($data['x']+350,$data['y'],'Prénom ');$this->txt($data['x']+430,$data['y']-10,'PRENOM',0,$data['PRENOM']);
	$this->label($data['x']+720,$data['y'],'Fils de ');$this->txt($data['x']+785,$data['y']-10,'FILSDE',0,$data['FILSDE']);
	$this->label($data['x'],$data['y']+30,'Sexe');$this->combovsex($data['x']+58,$data['y']+20,'SEXE',$data['SEXE']);
	$this->label($data['x']+150,$data['y']+30,'Née le');$this->txts($data['x']+60+130,$data['y']+20,'DATENS',0,$data['DATENS'],'date');
	$this->label($data['x']+350,$data['y']+30,'Wilaya de');
	$this->WILAYA($data['x']+430,$data['y']+20,'WILAYAN','country','mvc','wil',$data['WILAYAN1'],$data['WILAYAN2']);$this->label($data['x']+720,$data['y']+30,'Commune');$this->COMMUNE($data['x']+785,$data['y']+20,'COMMUNEN','COMMUNEN',$data['COMMUNEN1'],$data['COMMUNEN2']);
	$this->label($data['x'],$data['y']+60,'Mobile ');$this->txts($data['x']+60,$data['y']+50,'TEL',0,$data['TEL'],'port');$this->label($data['x']+350,$data['y']+60,'Fixe');$this->txt($data['x']+430,$data['y']+50,'TELF',0,$data['TELF']);$this->label($data['x']+720,$data['y']+60,'E-Mail');$this->txt($data['x']+785,$data['y']+50,'EMAIL',0,$data['EMAIL']); 
	$this->label($data['x'],$data['y']+90,'Wilaya');$this->WILAYA($data['x']+60,$data['y']+80,'WILAYAR','countryr','mvc','wil',$data['WILAYAR1'],$data['WILAYAR2']);$this->label($data['x']+350,$data['y']+90,'Commune'); 
	$this->COMMUNE($data['x']+430,$data['y']+80,'COMMUNER','COMMUNER',$data['COMMUNER1'],$data['COMMUNER2']);$this->label($data['x']+720,$data['y']+90,'Citée');$this->ADRESSE($data['x']+785,$data['y']+80,'ADRESSE','ADRESSE','mvc','adr',$data['ADRESSE1'],$data['ADRESSE2']);
		
	$this->label($data['x'],$data['y']+120,'ABO');$this->combovsex($data['x']+60,$data['y']+110,'GRABO',array($data['GRABO'],"A","B","AB","O"));
	$this->label($data['x']+165,$data['y']+120,'RH');$this->combovsex($data['x']+190,$data['y']+110,'GRRH',array($data['GRRH'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+150,'C');$this->combovsex($data['x']+60,$data['y']+140,'CRH2',array($data['CRH2'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+150,'c');$this->combovsex($data['x']+190,$data['y']+140,'CRH4',array($data['CRH4'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+180,'E');$this->combovsex($data['x']+60,$data['y']+170,'ERH3',array($data['ERH3'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+180,'e');$this->combovsex($data['x']+190,$data['y']+170,'ERH5',array($data['ERH5'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+210,'K1');$this->combovsex($data['x']+60,$data['y']+200,'KELL1',array($data['KELL1'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+210,'K2');$this->combovsex($data['x']+190,$data['y']+200,'KELL2',array($data['KELL2'],"Positif","negatif"));
	
	$this->label($data['x']+350,$data['y']+120,'Poly trans');$this->combovsex($data['x']+430,$data['y']+110,'POLYT',array($data['POLYT'],"YES","NO"));
	$this->label($data['x']+530,$data['y']+120,'DDT');$this->date($data['x']+560,$data['y']+110,'DDT',0,$data['DDT']);
    $this->label($data['x']+350,$data['y']+150,'RTA');$this->combovsex($data['x']+430,$data['y']+140,'RTA',array($data['RTA'],"YES","NO"));
	$this->label($data['x']+530,$data['y']+150,'TYPE');$this->combovsex($data['x']+560,$data['y']+140,'TYPERTA',array($data['TYPERTA'],"IMM","INF","AUTRES"));
	$this->label($data['x']+350,$data['y']+180,'RAI');$this->combovsex($data['x']+430,$data['y']+170,'RAI',array($data['RAI'],"YES","NO"));
	$this->label($data['x']+530,$data['y']+180,'DRAI');$this->date($data['x']+560,$data['y']+170,'DRAI',0,$data['DRAI']);
	$this->label($data['x']+350,$data['y']+210,'Resultat');$this->combov($data['x']+430,$data['y']+200,'RESULTAT',array($data['RESULTAT'],"Positif","negatif"));
	$this->label($data['x']+350,$data['y']+240,'Diagnostic');$this->combov($data['x']+430,$data['y']+230,'DGC',$data['DGC']);
	$this->hide(215,670,'REGION',0,$_SESSION['REGION']);$this->hide(215,670,'WILAYA',0,$_SESSION['WILAYA']);$this->hide(215,670,'STRUCTURE',0,$_SESSION['STRUCTURE']);$this->hide(215,670,'login',0,$_SESSION['login']);
	$this->hide(215,670,'id',0,$data['id']);
	$this->hide(215,670,'AGE',0,$data['AGE']);
	$this->hide(215,670,'PSL',0,$data['PSL']);
	
	$this->photosurl($data['x']+1070,$data['y']-20,URL.'public/images/photos/'.$data['photos']);	
	
	$this->urlbutton(828,$data['y']+118,URL.'rec/discgr/'.$data['id'],'CGR',10);
	$this->urlbutton(880,$data['y']+118,URL.'rec/dispfc/'.$data['id'],'PFC',10);
	$this->urlbutton(930,$data['y']+118,URL.'rec/discps/'.$data['id'],'CPS',10);
	
	$this->urlbutton(930+62,$data['y']+118,URL.'rec/','NEW',10);
	
	$this->label($data['x']+720,$data['y']+120+30,'Psl');$this->PSL($data['x']+785,$data['y']+110+30,$data['PSL'],$data['GRABO'],$data['GRRH']);
	$this->label($data['x']+720,$data['y']+150+30,'Service');$this->SER($data['x']+785,$data['y']+140+30,'SERVICE','mvc','ser');
	$this->label($data['x']+720,$data['y']+180+30,'Medecin');$this->combom($data['x']+785,$data['y']+170+30,'MED','mvc','grh',$data['valuemed'],$data['selectedmed']) ;
	
	$this->label($data['x']+720,$data['y']+240,'Date');$this->date($data['x']+785,$data['y']+230,'DINS',0,$data['DINS']);
	$this->label($data['x']+875,$data['y']+240,'Heures'); $this->date($data['x']+915,$data['y']+230,'HINS',0,$data['HINS']);	
	$this->submit($data['x']+785,$data['y']+260,$data['butun']);$this->f1();$this->sautligne(10);
	}
	
	//*malade*//
	function datamalade($data)
	{
	$this->verifsession();
	$this->button($data['btn'],$data['id']);
	echo'<h2>'.$data['titre'].'</h2>';
	$this->sautligne(0);$this->hr();
	$this->f0(URL.$data['action'],'post');
	$this->label($data['x'],$data['y'],'Nom');$this->txtautofocus($data['x']+60,$data['y']-10,'NOM',0,$data['NOM']);
	$this->label($data['x']+350,$data['y'],'Prénom ');$this->txt($data['x']+430,$data['y']-10,'PRENOM',0,$data['PRENOM']);
	$this->label($data['x']+720,$data['y'],'Fils de ');$this->txt($data['x']+785,$data['y']-10,'FILSDE',0,$data['FILSDE']);
	$this->label($data['x'],$data['y']+30,'Sexe');$this->combovsex($data['x']+58,$data['y']+20,'SEXE',$data['SEXE']);
	$this->label($data['x']+150,$data['y']+30,'Née le');$this->txts($data['x']+60+130,$data['y']+20,'DATENS',0,$data['DATENS'],'date');
	$this->label($data['x']+350,$data['y']+30,'Wilaya de');
	$this->WILAYA($data['x']+430,$data['y']+20,'WILAYAN','country','mvc','wil',$data['WILAYAN1'],$data['WILAYAN2']);$this->label($data['x']+720,$data['y']+30,'Commune');$this->COMMUNE($data['x']+785,$data['y']+20,'COMMUNEN','COMMUNEN',$data['COMMUNEN1'],$data['COMMUNEN2']);
	$this->label($data['x'],$data['y']+60,'Mobile ');$this->txts($data['x']+60,$data['y']+50,'TEL',0,$data['TEL'],'port');$this->label($data['x']+350,$data['y']+60,'Fixe');$this->txt($data['x']+430,$data['y']+50,'TELF',0,$data['TELF']);$this->label($data['x']+720,$data['y']+60,'E-Mail');$this->txt($data['x']+785,$data['y']+50,'EMAIL',0,$data['EMAIL']); 
	$this->label($data['x'],$data['y']+90,'Wilaya');$this->WILAYA($data['x']+60,$data['y']+80,'WILAYAR','countryr','mvc','wil',$data['WILAYAR1'],$data['WILAYAR2']);$this->label($data['x']+350,$data['y']+90,'Commune'); 
	$this->COMMUNE($data['x']+430,$data['y']+80,'COMMUNER','COMMUNER',$data['COMMUNER1'],$data['COMMUNER2']);$this->label($data['x']+720,$data['y']+90,'Citée');$this->ADRESSE($data['x']+785,$data['y']+80,'ADRESSE','ADRESSE','mvc','adr',$data['ADRESSE1'],$data['ADRESSE2']);
	$this->label($data['x'],$data['y']+120,'ABO');$this->combovsex($data['x']+60,$data['y']+110,'GRABO',array($data['GRABO'],"A","B","AB","O"));
	$this->label($data['x']+165,$data['y']+120,'RH');$this->combovsex($data['x']+190,$data['y']+110,'GRRH',array($data['GRRH'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+150,'C');$this->combovsex($data['x']+60,$data['y']+140,'CRH2',array($data['CRH2'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+150,'c');$this->combovsex($data['x']+190,$data['y']+140,'CRH4',array($data['CRH4'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+180,'E');$this->combovsex($data['x']+60,$data['y']+170,'ERH3',array($data['ERH3'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+180,'e');$this->combovsex($data['x']+190,$data['y']+170,'ERH5',array($data['ERH5'],"Positif","negatif"));
	$this->label($data['x'],$data['y']+210,'K1');$this->combovsex($data['x']+60,$data['y']+200,'KELL1',array($data['KELL1'],"Positif","negatif"));
	$this->label($data['x']+165,$data['y']+210,'K2');$this->combovsex($data['x']+190,$data['y']+200,'KELL2',array($data['KELL2'],"Positif","negatif"));
	$this->hide(215,670,'REGION',0,$_SESSION['REGION']);$this->hide(215,670,'WILAYA',0,$_SESSION['WILAYA']);$this->hide(215,670,'STRUCTURE',0,$_SESSION['STRUCTURE']);$this->hide(215,670,'login',0,$_SESSION['login']);
	$this->photosurl($data['x']+1070,$data['y']-20,URL.'public/images/photos/'.$data['photos']);	
	$this->label($data['x']+350,$data['y']+120,'HVB');   $this->combov($data['x']+430,$data['y']+110,'HVB',array($data['HVB'],"negatif","douteux","Positif"));
	$this->label($data['x']+350,$data['y']+120+30,'HVC');$this->combov($data['x']+430,$data['y']+110+30,'HVC',array($data['HVC'],"negatif","douteux","Positif"));
	$this->label($data['x']+350,$data['y']+120+60,'HIV');$this->combov($data['x']+430,$data['y']+110+60,'HIV',array($data['HIV'],"negatif","douteux","Positif"));
	$this->label($data['x']+350,$data['y']+120+90,'TPHA');$this->combov($data['x']+430,$data['y']+110+90,'TPHA',array($data['TPHA'],"negatif","douteux","Positif"));
	$this->label($data['x']+720,$data['y']+120,'Num');$this->txt($data['x']+785,$data['y']+110,'NUM',0,$data['NUM']);//$this->PSL($data['x']+785,$data['y']+110,$data['PSL'],$data['GRABO'],$data['GRRH']);
	$this->label($data['x']+720,$data['y']+150,'Service');$this->SER($data['x']+785,$data['y']+140,'SERVICE','mvc','ser');
	$this->label($data['x']+720,$data['y']+180,'Medecin');$this->combom($data['x']+785,$data['y']+170,'MED','mvc','grh',$data['valuemed'],$data['selectedmed']) ;
	$this->label($data['x']+720,$data['y']+210,'Date');$this->date($data['x']+785,$data['y']+200,'DINS',0,$data['DINS']);
	$this->label($data['x']+875,$data['y']+210,'Heures'); $this->date($data['x']+915,$data['y']+200,'HINS',0,$data['HINS']);	
	$this->submit($data['x']+785,$data['y']+240,$data['butun']);$this->f1();$this->sautligne(10);
	}
	
	/*graphemois*/
	function valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$DATEJOUR1,$DATEJOUR2,$VALEUR2,$STR) 
	{
	mysqlconnect();
	$sql = " select $COLONE1,$COLONE2,SRS,STR,TDNR from $TBL where (SRS='$SRS' and $STR and $COLONE2='$VALEUR2') and ($COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2') ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function graphemoisf($data) 
	{
	$this->verifsession();
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$dataSet->addPoint(new Point("JAN", $data['JAN']));
	$dataSet->addPoint(new Point("FEV", $data['FEV']));
	$dataSet->addPoint(new Point("MAR", $data['MAR']));
	$dataSet->addPoint(new Point("AVR", $data['AVR']));
	$dataSet->addPoint(new Point("MAI", $data['MAI']));
	$dataSet->addPoint(new Point("JUIN",$data['JUIN']));
	$dataSet->addPoint(new Point("JUIL",$data['JUIL']));
	$dataSet->addPoint(new Point("AOUT",$data['AOUT']));
	$dataSet->addPoint(new Point("SEP", $data['SEP']));
	$dataSet->addPoint(new Point("OCT", $data['OCT']));
	$dataSet->addPoint(new Point("NOV", $data['NOV']));
	$dataSet->addPoint(new Point("DEC", $data['DEC']));
	$chart->setDataSet($dataSet);
	$chart->setTitle($data['TITRE']);
	$chart->render($fichier);	
	$this->button($data['btn'],$data['id']);
	echo '<h2>'.$data['TITRE'].'</h2>';
	echo '<hr /><br />';
	echo '<div align="center"  > ';
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";echo "<br />";
	BOUTONGRAPHE() ;
	}
	

	//***//
	function txtauto($x,$y,$name,$size,$value)
	{
	 echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"text\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\" id=\"langages\"  />";
	 echo "</div>";
	}
	
	
	function datetime ($x,$y,$name)
	{
	 echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"date\" name=\"".$name."\"   />";
	 echo "</div>";
	}
	
	function nbr ($x,$y,$name,$size) //poids 
	{
	 echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"number\" name=\"".$name."\" size=\"".$size."\" min=\"60\" max=\"100\" />";
	 echo "</div>";
	}
	
	function nbr1 ($x,$y,$name,$size) //taille
	{
	 echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"number\" name=\"".$name."\" size=\"".$size."\" min=\"150\" max=\"200\" />";
	 echo "</div>";
	}
	function tas ($x,$y,$name,$size) //ta systolique 
	{
	 echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"number\" name=\"".$name."\" size=\"".$size."\" min=\"100\" max=\"200\" />";
	 echo "</div>";
	}
	function tad ($x,$y,$name,$size) //ta diastolique
	{
	 echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"number\" name=\"".$name."\" size=\"".$size."\" min=\"50\" max=\"100\" />";
	 echo "</div>";
	}
	function combo($x,$y,$name,$db_name,$tb_name) //combo avec base de donnes
	{
	$db_host="localhost"; 
    $db_user="root";
    $db_pass="";
    //la connection a la base de donnes par le biais de la commande mysql_connect qui a pour parametre (serveur, login, mdp)
    $cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    //s�lection de la base de donn�es par le biais de la commande mysql_select_db qui a pour parametre (nom de la base, la chaine de connection) 
    $db  = mysql_select_db($db_name,$cnx) ;
    mysql_query("SET NAMES 'UTF8' ");
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo '<select size=1 name="'.$name.'">'."\n";
    echo '<option   value="-1">choisir</option>'."\n";
	mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name   " );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[1].'">'.$data['0']."/".$data['1'];
    echo '</option>'."\n";
    }
    echo '</select>'."\n"; 
	echo "</div>";
	}
	function comboupdate($x,$y,$name,$db_name,$tb_name,$choisir) //combo avec base de donnes $per ->comboupdate(600,370,'COMMUNE','gpts2012','com',$result->str);
	{
	$db_host="localhost"; 
    $db_user="root";
    $db_pass="";
    //la connection a la base de donnes par le biais de la commande mysql_connect qui a pour parametre (serveur, login, mdp)
    $cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    //s�lection de la base de donn�es par le biais de la commande mysql_select_db qui a pour parametre (nom de la base, la chaine de connection) 
    $db  = mysql_select_db($db_name,$cnx) ;
    mysql_query("SET NAMES 'UTF8' ");
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo '<select size=1 name="'.$name.'">'."\n";
    echo '<option   value="-1">'.$choisir.'</option>'."\n";
	mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name   " );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[1].'">'.$data['0']."/".$data['1'];
    echo '</option>'."\n";
    }
    echo '</select>'."\n"; 
	echo "</div>";
	}
	function combodyn($x,$y,$name,$db_name,$tb_name) 
	{
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select name=\"".$name."\" onchange=\"showUser(this.value)\"> ";             
	echo "<option value=\"\">selectionner wilaya:</option> ";          
	$con = mysql_connect('localhost','root','');
	mysql_select_db($db_name, $con);			
	$sql="SELECT * FROM $tb_name order by WILAYAS "; 
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
	echo "<option value=\"".$row["IDWIL"]."\">".$row["WILAYAS"]."</option>";
	}
	echo"</select>";
	echo "</div>";
	}
	function combodyn1($x,$y) 
	{
	echo "<div id=\"txtHint\" class=\"label\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">Commune de naissance</div>";	 
	}
	function combodyn2($x,$y,$name,$db_name,$tb_name) 
	{
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select name=\"".$name."\" onchange=\"showUser1(this.value)\"> ";             
	echo "<option value=\"\">selectionner wilaya:</option> ";          
	$con = mysql_connect('localhost','root','');
	mysql_select_db($db_name, $con);			
	$sql="SELECT * FROM $tb_name order by WILAYAS "; 
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
	echo "<option value=\"".$row["IDWIL"]."\">".$row["WILAYAS"]."</option>";
	}
	echo"</select>";
	echo "</div>";
	}
	function combodyn12($x,$y) 
	{
	echo "<div id=\"txtHint1\" class=\"label\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">Commune de residence</div>";	 
	}
	
	function photos($x,$y)
	{
	 echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <img   src=\"./IMAGES/5.jpg\" width=\"250\" height=\"250\" alt=\"1\" />";
	 echo "</div>";
	}
	//
	function photosx($x,$y,$nom)
	{
	 echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <img   src=\"./IMAGES/$nom\" width=\"250\" height=\"250\" alt=\"1\" />";
	 echo "</div>";
	}
	function photosuser($x,$y,$nom)
	{
	 echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <img   src=\"./IMAGES/photos/$nom\" width=\"250\" height=\"250\" alt=\"1\" />";
	 echo "</div>";
	}
	function photoscaptacha($x,$y)
	{
	 echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <img   src=\"./connec/captcha.php\"  />";
	 echo "</div>";
	}
	
	
   
	
   
	
	function ARS($x,$y,$name,$db_name,$tb_name) 
	{
	$db_host="localhost"; 
    $db_user="root";
    $db_pass="";
    //la connection a la base de donnes par le biais de la commande mysql_connect qui a pour parametre (serveur, login, mdp)
    $cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    //s�lection de la base de donn�es par le biais de la commande mysql_select_db qui a pour parametre (nom de la base, la chaine de connection) 
    $db  = mysql_select_db($db_name,$cnx) ;
    mysql_query("SET NAMES 'UTF8' ");
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"ARS\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">AGENCE REGIONAL DU SANG</option>"."\n";
	mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name order by WILAYAS" );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[0].'">'.$data[1].'</option>';
    }
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function WRS($x,$y,$name) 
	{
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"WRS\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">WILAYA</option>"."\n";
    echo '</select>'."\n"; 
	echo "</div>";
	}
	function STR($x,$y,$name) 
	{
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"STR\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">STRUCTURE</option>"."\n";
    echo '</select>'."\n"; 
	echo "</div>";
	}
	/////////////////////specialite chapitre diagnostique 
	function SPC($x,$y,$name,$db_name,$tb_name) 
	{
	$db_host="localhost"; 
    $db_user="root";
    $db_pass="";
    $cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
    $db  = mysql_select_db($db_name,$cnx) ;
    mysql_query("SET NAMES 'UTF8' ");
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"SPESC\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">choisir une specialite</option>"."\n";
	mysql_query("SET NAMES 'UTF8' ");
    $result = mysql_query("SELECT * FROM $tb_name order by IDS" );
    while($data =  mysql_fetch_array($result))
    {
    echo '<option value="'.$data[0].'">'.$data[3].'</option>';
    }
	echo '</select>'."\n"; 
	echo "</div>";
	}
	function CHA($x,$y,$name) 
	{
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"CHA\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">choisir un chapitre</option>"."\n";
    echo '</select>'."\n"; 
	echo "</div>";
	}
	function DGC($x,$y,$name) 
	{
	echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo "<select size=1 class=\"DGC\" name=\"".$name."\">"."\n";
	echo"<option value=\"1\" selected=\"selected\">choisir un diagnostique</option>"."\n";
    echo '</select>'."\n"; 
	echo "</div>";
	}
	//////////////////////////////////////////////
	function NOMUTILISATEUR($x,$y,$name) 
	{
	    echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	    echo "<select size=1 name=\"".$name."\">"."\n";
		echo "<option   value=\"-1\">user</option>"."\n";
		mysql_query("SET NAMES 'UTF8' ");
		$result = mysql_query("SELECT * FROM USERS " );
		while($data =  mysql_fetch_array($result))
		{
		echo '<option value="'.$data[5].'">'.$data['USER'];
		echo '</option>'."\n";
		}
		echo '</select>'."\n"; 
		echo "</div>";
	}
	function PSW($x,$y,$name,$size,$value)
	{
	 echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	 echo " <input type=\"password\" name=\"".$name."\" size=\"".$size."\" value=\"".$value."\" />";
	 echo "</div>";
	}
	//graphe dons
	function valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$DATEJOUR1,$DATEJOUR2,$VALEUR2,$STR) 
	{
	mysqlconnect();
	$sql = " select $COLONE1,$COLONE2,SRS from $TBL where (SRS='$SRS' and $STR and $COLONE2='$VALEUR2') and ($COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2') ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
    function graphemoisdnr($x,$y,$TITRE,$SRS,$TBL,$COLONE1,$COLONE2,$ANNEE,$IND,$STR) 
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$dataSet->addPoint(new Point("JAN", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-01-01",$ANNEE."-01-31",$IND,$STR)));
	$dataSet->addPoint(new Point("FEV", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-02-01",$ANNEE."-02-28",$IND,$STR)));
	$dataSet->addPoint(new Point("MAR", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-03-01",$ANNEE."-03-31",$IND,$STR)));
	$dataSet->addPoint(new Point("AVR", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-04-01",$ANNEE."-04-30",$IND,$STR)));
	$dataSet->addPoint(new Point("MAI", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-05-01",$ANNEE."-05-31",$IND,$STR)));
	$dataSet->addPoint(new Point("JUIN",valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-06-01",$ANNEE."-06-30",$IND,$STR)));
	$dataSet->addPoint(new Point("JUIL",valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-07-01",$ANNEE."-07-31",$IND,$STR)));
	$dataSet->addPoint(new Point("AOUT",valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-08-01",$ANNEE."-08-31",$IND,$STR)));
	$dataSet->addPoint(new Point("SEP", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-09-01",$ANNEE."-09-30",$IND,$STR)));
	$dataSet->addPoint(new Point("OCT", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-10-01",$ANNEE."-10-31",$IND,$STR)));
	$dataSet->addPoint(new Point("NOV", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-11-01",$ANNEE."-11-30",$IND,$STR)));
	$dataSet->addPoint(new Point("DEC", valeurmoisdnr($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-12-01",$ANNEE."-12-31",$IND,$STR)));
	$chart->setDataSet($dataSet);
	$DATE=date("d-m-Y");
	$chart->setTitle($TITRE.$DATE);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	
	function graphemois($x,$y,$TITRE,$SRS,$TBL,$COLONE1,$COLONE2,$ANNEE,$IND,$STR) 
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$dataSet->addPoint(new Point("JAN", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-01-01",$ANNEE."-01-31",$IND,$STR)));
	$dataSet->addPoint(new Point("FEV", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-02-01",$ANNEE."-02-28",$IND,$STR)));
	$dataSet->addPoint(new Point("MAR", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-03-01",$ANNEE."-03-31",$IND,$STR)));
	$dataSet->addPoint(new Point("AVR", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-04-01",$ANNEE."-04-30",$IND,$STR)));
	$dataSet->addPoint(new Point("MAI", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-05-01",$ANNEE."-05-31",$IND,$STR)));
	$dataSet->addPoint(new Point("JUIN",valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-06-01",$ANNEE."-06-30",$IND,$STR)));
	$dataSet->addPoint(new Point("JUIL",valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-07-01",$ANNEE."-07-31",$IND,$STR)));
	$dataSet->addPoint(new Point("AOUT",valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-08-01",$ANNEE."-08-31",$IND,$STR)));
	$dataSet->addPoint(new Point("SEP", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-09-01",$ANNEE."-09-30",$IND,$STR)));
	$dataSet->addPoint(new Point("OCT", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-10-01",$ANNEE."-10-31",$IND,$STR)));
	$dataSet->addPoint(new Point("NOV", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-11-01",$ANNEE."-11-30",$IND,$STR)));
	$dataSet->addPoint(new Point("DEC", valeurmois($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-12-01",$ANNEE."-12-31",$IND,$STR)));
	$chart->setDataSet($dataSet);
	$DATE=date("d-m-Y");
	$chart->setTitle($TITRE.$DATE);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	
	function BOUTONGRAPHE($x,$y) 
	{
	echo "<div id=\"smenug\" class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<a href="'.URL.'don/IND/">IND</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/CIDT/">CIT</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/CIDD/">CID</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/F/">FIX</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/M/">MOB</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/DFM/">DFM</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/OCC/">OCC</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/REG/">REG</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/DOR/">DOR</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/A/">A</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/B/">B</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/AB/">AB</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/O/">O</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/ABO/">ABO</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/RHP/">RHP</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/RHN/">RHN</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/RHNP/">RHNP</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/SM/">M</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/SF/">F</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/SMF/">MF</a>'; echo '&nbsp;';
	// echo '<a href="'.URL.'don/ST/">ST</a>'; echo '&nbsp;';
	// echo '<a href="'.URL.'don/AP/">AP</a>'; echo '&nbsp;';
	// echo '<a href="'.URL.'don/STA/">STA</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/AGE/">AGE</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/HIVP/">HIV</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/HVBP/">HVB</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/HVCP/">HVC</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'don/TPHAP/">TPHA</a>'; echo '&nbsp;';
	echo "</div>";
	}
	function BOUTONGRAPHE1($x,$y) 
	{
	echo "<div id=\"smenug\" class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<a href="'.URL.'dnr/">DNR MOIS</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/dnranne">DNR ANNEE</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/donanne">DON ANNEE IND</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/donanne1">DON ANNEE SEXE</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/donanne2">STR ANNEE STR</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/donanne3">STR ANNEE TDNR</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'dnr/donaborh">DON ABO RH</a>'; echo '&nbsp;';
	echo "</div>";
	}
	function BOUTONGRAPHE2($x,$y) 
	{
	echo "<div id=\"smenug\" class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<a href="'.URL.'rec/">REC</a>'; echo '&nbsp;';
	
	echo "</div>";
	}
	function BOUTONGRAPHE3($x,$y) 
	{
	echo "<div id=\"smenug\" class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	// echo '<a href="'.URL.'dis/PSLCGR/">PSL M</a>'; echo '&nbsp;';//ok
	// echo '<a href="'.URL.'dis/PSLSERVICE/">PSL S</a>'; echo '&nbsp;';//ok
	// echo '<a href="'.URL.'dis/PSLSTOK1/">PSL G</a>'; echo '&nbsp;';//ok
	// echo '<a href="'.URL.'dis/PSLSTOK/">PSL ST</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/CGR/">CGR M</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/SERVICECGR/">CGR S</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/STOKCGR1/">CGR G</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/STOKCGR/">CGR ST</a>'; echo '&nbsp;';//ok
	
	echo '<a href="'.URL.'dis/PFC/">PFC M</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/SERVICEPFC/">PFC S</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/STOKPFC1/">PFC G</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/STOKPFC/">PFC ST</a>'; echo '&nbsp;';//ok
	
	echo '<a href="'.URL.'dis/CPS/">CPS M</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/SERVICECPS/">CPS S</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/STOKCPS1/">CPS G</a>'; echo '&nbsp;';//ok
	echo '<a href="'.URL.'dis/STOKCPS/">CPS ST</a>'; echo '&nbsp;';//ok
	
	echo "</div>";
	}
	function BOUTONGRAPHE4($x,$y) 
	{
	echo "<div id=\"smenug\" class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<a href="'.URL.'/mal/">Malade MOIS</a>'; echo '&nbsp;';
	
	echo "</div>";
	}
	
	function valeurbi($SRS,$TBL,$COLONE1,$COLONE2,$DATEJOUR1,$DATEJOUR2,$VALEUR2,$STR) 
	{
	mysqlconnect();
	$sql = " select $COLONE1,$COLONE2,SRS,STR,TDNR from $TBL where (SRS='$SRS' and $STR and $COLONE2='$VALEUR2') and ($COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2') ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function graphebi($x,$y,$TITRE,$SRS,$TBL,$COLONE1,$COLONE2,$ANNEE,$IND,$val1,$val2,$TI1,$TI2) 
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new PieChart();
	$fichier='./CHART/demo/generated/demo3.png';
	$dataSet = new XYDataSet();
	$datem=valeurbi($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE.'-01-01',$ANNEE.'-12-31',$IND,$val1);
	$datef=valeurbi($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE.'-01-01',$ANNEE.'-12-31',$IND,$val2);
	$dataSet->addPoint(new Point($TI1,$datef));
	$dataSet->addPoint(new Point($TI2,$datem));
	$chart->setDataSet($dataSet);
	$DATE=date("d-m-Y");
	$chart->setTitle($TITRE.$DATE);
	$chart->render("./CHART/demo/generated/demo3.png");	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	
	function valeurbibi($SRS,$TBL,$COLONE1,$COLONE2,$DATEJOUR1,$DATEJOUR2,$VALEUR2,$STR) 
	{
	mysqlconnect();
	$sql = " select $COLONE1,$COLONE2,SRS,STR,TDNR from $TBL where (SRS='$SRS' and $STR and $COLONE2='$VALEUR2') and ($COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2') ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function graphebibi($x,$y,$TITRE,$SRS,$TBL,$COLONE1,$COLONE2,$ANNEE,$IND,$val1,$val2,$val3,$val4,$TI1,$TI2,$TI3,$TI4) 
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new PieChart();
	$fichier='./CHART/demo/generated/demo3.png';
	$dataSet = new XYDataSet();
	$GA=valeurbibi($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE.'-01-01',$ANNEE.'-12-31',$IND,$val1);
	$GB=valeurbibi($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE.'-01-01',$ANNEE.'-12-31',$IND,$val2);
	$GAB=valeurbibi($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE.'-01-01',$ANNEE.'-12-31',$IND,$val3);
	$GO=valeurbibi($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE.'-01-01',$ANNEE.'-12-31',$IND,$val4);
	$dataSet->addPoint(new Point($TI1,$GA));
	$dataSet->addPoint(new Point($TI2,$GB));
	$dataSet->addPoint(new Point($TI3,$GAB));
	$dataSet->addPoint(new Point($TI4,$GO));
	$chart->setDataSet($dataSet);
	$DATE=date("d-m-Y");
	$chart->setTitle($TITRE.$DATE);
	$chart->render("./CHART/demo/generated/demo3.png");	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	
	function AGEDON($colone2,$colone3,$datejour1,$datejour2)
	{
	mysqlconnect();
	$sql = " select SEXEDNR,AGEDNR,DATEDON,IND from don where IND='IND'and  AGEDNR >=$colone2 and AGEDNR <=$colone3  and DATEDON >='$datejour1'and DATEDON <='$datejour2'";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$collecte=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $collecte;
	}
	function GRAPHEAGEDON($x,$y,$TITRE,$datejour1,$datejour2) 
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("18-19",  AGEDON(18,19,$datejour1.'-01-01',$datejour2)));
	$dataSet->addPoint(new Point("20-29",  AGEDON(20,29,$datejour1.'-01-01',$datejour2)));
	$dataSet->addPoint(new Point("30-39",  AGEDON(30,39,$datejour1.'-01-01',$datejour2)));
	$dataSet->addPoint(new Point("40-49",  AGEDON(40,49,$datejour1.'-01-01',$datejour2)));
	$dataSet->addPoint(new Point("50-59",  AGEDON(50,59,$datejour1.'-01-01',$datejour2)));
	$dataSet->addPoint(new Point("60-69",  AGEDON(60,69,$datejour1.'-01-01',$datejour2)));
	$dataSet->addPoint(new Point("70-79",  AGEDON(70,79,$datejour1.'-01-01',$datejour2)));
	$chart->setDataSet($dataSet);
	$DATE=date("d-m-Y");
	$chart->setTitle($TITRE.$DATE);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	function dnrparadresse($ADRESSE) 
	{
	mysqlconnect();
	$sql = " select * from dnr where ADRESSE='$ADRESSE' ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function dnrparcommune($WILAYAR,$COMMUNER) 
	{
	mysqlconnect();
	$sql = " select * from dnr where WILAYAR=$WILAYAR and  COMMUNER=$COMMUNER   ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
		
	function dnrparwilaya($WILAYAR) 
	{
	mysqlconnect();
	$sql = " select * from dnr where WILAYAR=$WILAYAR ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	
	function valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$DATEJOUR1,$DATEJOUR2,$VALEUR2,$STR) 
	{
	mysqlconnect();
	$sql = " select $COLONE1,$COLONE2,SRS,SERVICE,MED from $TBL where (SRS='$SRS' and $STR and $COLONE2='$VALEUR2') and ($COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2') ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function graphemoisd($x,$y,$TITRE,$SRS,$TBL,$COLONE1,$COLONE2,$ANNEE,$IND,$STR) 
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$dataSet->addPoint(new Point("JAN", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-01-01",$ANNEE."-01-31",$IND,$STR)));
	$dataSet->addPoint(new Point("FEV", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-02-01",$ANNEE."-02-28",$IND,$STR)));
	$dataSet->addPoint(new Point("MAR", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-03-01",$ANNEE."-03-31",$IND,$STR)));
	$dataSet->addPoint(new Point("AVR", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-04-01",$ANNEE."-04-30",$IND,$STR)));
	$dataSet->addPoint(new Point("MAI", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-05-01",$ANNEE."-05-31",$IND,$STR)));
	$dataSet->addPoint(new Point("JUIN",valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-06-01",$ANNEE."-06-30",$IND,$STR)));
	$dataSet->addPoint(new Point("JUIL",valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-07-01",$ANNEE."-07-31",$IND,$STR)));
	$dataSet->addPoint(new Point("AOUT",valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-08-01",$ANNEE."-08-31",$IND,$STR)));
	$dataSet->addPoint(new Point("SEP", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-09-01",$ANNEE."-09-30",$IND,$STR)));
	$dataSet->addPoint(new Point("OCT", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-10-01",$ANNEE."-10-31",$IND,$STR)));
	$dataSet->addPoint(new Point("NOV", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-11-01",$ANNEE."-11-30",$IND,$STR)));
	$dataSet->addPoint(new Point("DEC", valeurmoisd($SRS,$TBL,$COLONE1,$COLONE2,$ANNEE."-12-01",$ANNEE."-12-31",$IND,$STR)));
	$chart->setDataSet($dataSet);
	$DATE=date("d-m-Y");
	$chart->setTitle($TITRE.$DATE);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	function DISSERV($datejour1,$datejour2,$service,$PSL) 
	{
	mysqlconnect();
	$sql = " select * from dis where DATEDIS >='$datejour1'and DATEDIS <='$datejour2'  and  SERVICE='$service' and PSL='$PSL' ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function SERVICECGR($x,$y,$PSL,$titre)
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$DATEMOIS=date("Y");
	$pts=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','1',$PSL);
	$MEDECINEHOMME=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','2',$PSL);
	$MEDECINEFEMME=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','3',$PSL);
	$CHIRURGIEHOMME=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','4',$PSL);
	$CHIRURGIEFEMME=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','5',$PSL);
	$GYNECO=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','6',$PSL);
	$MATERNITE=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','7',$PSL);
	$PEDIATRIE=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','8',$PSL);
	$BLOCOPPA=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','9',$PSL);
	$BLOCOPPB=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','10',$PSL);
	$UMC=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','11',$PSL);
	$HEMODIALYSE=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','12',$PSL);
	$public=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','13',$PSL);
	$prive=DISSERV($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','14',$PSL);
	$dataSet->addPoint(new Point("Med H",$MEDECINEHOMME));
	$dataSet->addPoint(new Point("Med F",$MEDECINEFEMME));
	$dataSet->addPoint(new Point("Chr H",$CHIRURGIEHOMME));
	$dataSet->addPoint(new Point("Chr F",$CHIRURGIEFEMME));
	$dataSet->addPoint(new Point("GYN",$GYNECO));
	$dataSet->addPoint(new Point("MAT",$MATERNITE));
	$dataSet->addPoint(new Point("PED",$PEDIATRIE));
	$dataSet->addPoint(new Point("BLOCA",$BLOCOPPA));
	$dataSet->addPoint(new Point("BLOCB",$BLOCOPPB));
	$dataSet->addPoint(new Point("UMC",$UMC));
	$dataSet->addPoint(new Point("HEM",$HEMODIALYSE));
	$dataSet->addPoint(new Point("pub",$public));
	$dataSet->addPoint(new Point("pri",$prive));
	$dataSet->addPoint(new Point("total",$prive+$public+$HEMODIALYSE+$UMC+$BLOCOPPB+$BLOCOPPA+$PEDIATRIE+$MATERNITE+$GYNECO+$CHIRURGIEFEMME+$CHIRURGIEHOMME+$MEDECINEFEMME+$MEDECINEHOMME));
	$chart->setDataSet($dataSet);
	$chart->setTitle($titre);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
//************************************* la base du graphique  *******************************************//
    function DISSERVX($DATEJOUR1,$DATEJOUR2,$SERVICE,$TBL) 
	{
	mysqlconnect();
	$sql = " select * from $TBL where (DIST='1'  and  SERVICE='$SERVICE') and (DATEDIS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2') ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function SERVICECGRX($x,$y,$titre,$TBL)
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$DATEMOIS=date("Y");
	$pts=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','1',$TBL);
	$MEDECINEHOMME=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','2',$TBL);
	$MEDECINEFEMME=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','3',$TBL);
	$CHIRURGIEHOMME=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','4',$TBL);
	$CHIRURGIEFEMME=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','5',$TBL);
	$GYNECO=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','6',$TBL);
	$MATERNITE=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','7',$TBL);
	$PEDIATRIE=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','8',$TBL);
	$BLOCOPPA=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','9',$TBL);
	$BLOCOPPB=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','10',$TBL);
	$UMC=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','11',$TBL);
	$HEMODIALYSE=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','12',$TBL);
	$public=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','13',$TBL);
	$prive=$this->DISSERVX($DATEMOIS.'-01-01',$DATEMOIS.'-12-31','14',$TBL);
	$dataSet->addPoint(new Point("Med H",$MEDECINEHOMME));
	$dataSet->addPoint(new Point("Med F",$MEDECINEFEMME));
	$dataSet->addPoint(new Point("Chr H",$CHIRURGIEHOMME));
	$dataSet->addPoint(new Point("Chr F",$CHIRURGIEFEMME));
	$dataSet->addPoint(new Point("GYN",$GYNECO));
	$dataSet->addPoint(new Point("MAT",$MATERNITE));
	$dataSet->addPoint(new Point("PED",$PEDIATRIE));
	$dataSet->addPoint(new Point("BLOCA",$BLOCOPPA));
	$dataSet->addPoint(new Point("BLOCB",$BLOCOPPB));
	$dataSet->addPoint(new Point("UMC",$UMC));
	$dataSet->addPoint(new Point("HEM",$HEMODIALYSE));
	$dataSet->addPoint(new Point("pub",$public));
	$dataSet->addPoint(new Point("pri",$prive));
	$dataSet->addPoint(new Point("total",$prive+$public+$HEMODIALYSE+$UMC+$BLOCOPPB+$BLOCOPPA+$PEDIATRIE+$MATERNITE+$GYNECO+$CHIRURGIEFEMME+$CHIRURGIEHOMME+$MEDECINEFEMME+$MEDECINEHOMME));
	$chart->setDataSet($dataSet);
	$chart->setTitle($titre);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
    function valeurmoisdx($TBL,$DIST,$DATEJOUR1,$DATEJOUR2) 
	{
	mysqlconnect();
	$sql = " select * from $TBL where (DIST='$DIST')  and (DATEDIS BETWEEN '$DATEJOUR1' AND '$DATEJOUR2') ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function graphemoisdx($x,$y,$TITRE,$TBL,$DIST) 
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); $ANNEE=date("Y");
	$dataSet->addPoint(new Point("JAN", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-01-01",$ANNEE."-01-31")));
	$dataSet->addPoint(new Point("FEV", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-02-01",$ANNEE."-02-28")));
	$dataSet->addPoint(new Point("MAR", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-03-01",$ANNEE."-03-31")));
	$dataSet->addPoint(new Point("AVR", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-04-01",$ANNEE."-04-30")));
	$dataSet->addPoint(new Point("MAI", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-05-01",$ANNEE."-05-31")));
	$dataSet->addPoint(new Point("JUIN",$this->valeurmoisdx($TBL,$DIST,$ANNEE."-06-01",$ANNEE."-06-30")));
	$dataSet->addPoint(new Point("JUIL",$this->valeurmoisdx($TBL,$DIST,$ANNEE."-07-01",$ANNEE."-07-31")));
	$dataSet->addPoint(new Point("AOUT",$this->valeurmoisdx($TBL,$DIST,$ANNEE."-08-01",$ANNEE."-08-31")));
	$dataSet->addPoint(new Point("SEP", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-09-01",$ANNEE."-09-30")));
	$dataSet->addPoint(new Point("OCT", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-10-01",$ANNEE."-10-31")));
	$dataSet->addPoint(new Point("NOV", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-11-01",$ANNEE."-11-30")));
	$dataSet->addPoint(new Point("DEC", $this->valeurmoisdx($TBL,$DIST,$ANNEE."-12-01",$ANNEE."-12-31")));
	$chart->setDataSet($dataSet);
	$DATE=date("d-m-Y");
	$chart->setTitle($TITRE.$DATE);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	function nbrpsl($PSL,$GROUPAGE,$RHESUS,$DIST) 
	{
	mysqlconnect();
	$date=date('Y-01-01');
	$sql = " select * from $PSL where (DATEDIS >='$date' and DIST='$DIST') and (GROUPAGE='$GROUPAGE' and  RHESUS='$RHESUS') "; 
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function NBRPSL0($x,$y,$PSL,$titre,$DIST)
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$DATEMOIS=date("Y");
	///$dataSet->addPoint(new Point("DON TOTAL", $this ->PSL()));
	$dataSet->addPoint(new Point("O+", $this->nbrpsl($PSL,'O','Positif',$DIST)));
	$dataSet->addPoint(new Point("O-", $this->nbrpsl($PSL,'O','negatif',$DIST)));
	$dataSet->addPoint(new Point("A+", $this->nbrpsl($PSL,'A','Positif',$DIST)));
	$dataSet->addPoint(new Point("A-", $this->nbrpsl($PSL,'A','negatif',$DIST)));
	$dataSet->addPoint(new Point("B+", $this->nbrpsl($PSL,'B','Positif',$DIST)));
	$dataSet->addPoint(new Point("B-", $this->nbrpsl($PSL,'B','negatif',$DIST)));
	$dataSet->addPoint(new Point("AB+",$this->nbrpsl($PSL,'AB','Positif',$DIST)));
	$dataSet->addPoint(new Point("AB-",$this->nbrpsl($PSL,'AB','negatif',$DIST)));
	$chart->setDataSet($dataSet);
	$chart->setTitle($titre);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	function nbrpsls($PSL,$GROUPAGE,$RHESUS,$DIST) 
	{
	mysqlconnect();
	$date=date('Y-m-d');
	$sql = " select * from $PSL where (DATEPER >='$date' and DIST='$DIST') and (GROUPAGE='$GROUPAGE' and  RHESUS='$RHESUS') "; 
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function NBRPSL0S($x,$y,$PSL,$titre,$DIST)
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$DATEMOIS=date("Y");
	///$dataSet->addPoint(new Point("DON TOTAL", $this ->PSL()));
	$dataSet->addPoint(new Point("O+", $this->nbrpsls($PSL,'O','Positif',$DIST)));
	$dataSet->addPoint(new Point("O-", $this->nbrpsls($PSL,'O','negatif',$DIST)));
	$dataSet->addPoint(new Point("A+", $this->nbrpsls($PSL,'A','Positif',$DIST)));
	$dataSet->addPoint(new Point("A-", $this->nbrpsls($PSL,'A','negatif',$DIST)));
	$dataSet->addPoint(new Point("B+", $this->nbrpsls($PSL,'B','Positif',$DIST)));
	$dataSet->addPoint(new Point("B-", $this->nbrpsls($PSL,'B','negatif',$DIST)));
	$dataSet->addPoint(new Point("AB+",$this->nbrpsls($PSL,'AB','Positif',$DIST)));
	$dataSet->addPoint(new Point("AB-",$this->nbrpsls($PSL,'AB','negatif',$DIST)));
	$chart->setDataSet($dataSet);
	$chart->setTitle($titre);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	
	
//************************************************************************************************//
	
	function stockpsl($PSL,$GROUPAGE,$RHESUS) 
	{
	mysqlconnect();
	$date=date('Y-01-01');
	$sql = " select * from $PSL where (DATEDON >='$date' and DIST='') and (GROUPAGE='$GROUPAGE' and  RHESUS='$RHESUS') "; 
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function STOKCGR($x,$y,$PSL,$titre)
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$fichier='./CHART/demo/generated/demo1.png';
	$dataSet = new XYDataSet(); 
	$DATEMOIS=date("Y");
	///$dataSet->addPoint(new Point("DON TOTAL", $this ->PSL()));
	$dataSet->addPoint(new Point("O+", $this->stockpsl($PSL,'O','Positif')));
	$dataSet->addPoint(new Point("O-", $this->stockpsl($PSL,'O','negatif')));
	$dataSet->addPoint(new Point("A+", $this->stockpsl($PSL,'A','Positif')));
	$dataSet->addPoint(new Point("A-", $this->stockpsl($PSL,'A','negatif')));
	$dataSet->addPoint(new Point("B+", $this->stockpsl($PSL,'B','Positif')));
	$dataSet->addPoint(new Point("B-", $this->stockpsl($PSL,'B','negatif')));
	$dataSet->addPoint(new Point("AB+",$this->stockpsl($PSL,'AB','Positif')));
	$dataSet->addPoint(new Point("AB-",$this->stockpsl($PSL,'AB','negatif')));
	$chart->setDataSet($dataSet);
	$chart->setTitle($titre);
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	
	function valeurmultigraphe($TBL,$COLONE1,$DATEJOUR1,$DATEJOUR2,$COLONE2,$VALEUR2) 
	{
	mysqlconnect();
	$sql = " select $COLONE1,$COLONE2 from $TBL where $COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2'  AND $COLONE2='$VALEUR2' ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function multigraphe($x,$y,$TITRE,$TBL,$COL,$COLONE,$VALEUR1,$VALEUR2) //,$data$data[$DATE-4]
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$dataSet = new XYSeriesDataSet();
	$fichier='./CHART/demo/generated/demo7.png';
	$DATE=date("Y");
	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point($DATE-4,$this->valeurmultigraphe($TBL,$COL,($DATE-4)."-01-01",($DATE-4)."-12-31",$COLONE,$VALEUR1)));
	$serie1->addPoint(new Point($DATE-3,$this->valeurmultigraphe($TBL,$COL,($DATE-3)."-01-01",($DATE-3)."-12-31",$COLONE,$VALEUR1)));
	$serie1->addPoint(new Point($DATE-2,$this->valeurmultigraphe($TBL,$COL,($DATE-2)."-01-01",($DATE-2)."-12-31",$COLONE,$VALEUR1)));
	$serie1->addPoint(new Point($DATE-1,$this->valeurmultigraphe($TBL,$COL,($DATE-1)."-01-01",($DATE-1)."-12-31",$COLONE,$VALEUR1)));
	$serie1->addPoint(new Point($DATE-0,$this->valeurmultigraphe($TBL,$COL,($DATE-0)."-01-01",($DATE-0)."-12-31",$COLONE,$VALEUR1)));
	$dataSet->addSerie($VALEUR1, $serie1);
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point($DATE-4, $this->valeurmultigraphe($TBL,$COL,($DATE-4)."-01-01",($DATE-4)."-12-31",$COLONE,$VALEUR2)));
	$serie2->addPoint(new Point($DATE-3, $this->valeurmultigraphe($TBL,$COL,($DATE-3)."-01-01",($DATE-3)."-12-31",$COLONE,$VALEUR2)));
	$serie2->addPoint(new Point($DATE-2, $this->valeurmultigraphe($TBL,$COL,($DATE-2)."-01-01",($DATE-2)."-12-31",$COLONE,$VALEUR2)));
	$serie2->addPoint(new Point($DATE-1, $this->valeurmultigraphe($TBL,$COL,($DATE-1)."-01-01",($DATE-1)."-12-31",$COLONE,$VALEUR2)));
	$serie2->addPoint(new Point($DATE-0, $this->valeurmultigraphe($TBL,$COL,($DATE-0)."-01-01",($DATE-0)."-12-31",$COLONE,$VALEUR2)));
	$dataSet->addSerie($VALEUR2, $serie2);
	
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.65);

	$chart->setTitle($TITRE.date("d-m-Y"));
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}
	
	
	
	//GRAPHE ABO RH
	function valeurmultigraphe1($TBL,$COLONE1,$DATEJOUR1,$DATEJOUR2,$COLONE2,$VALEUR2,$COLONE3,$VALEUR3) 
	{
	mysqlconnect();
	$sql = " select $COLONE1,$COLONE2 from $TBL where $COLONE1 BETWEEN '$DATEJOUR1' AND '$DATEJOUR2'  AND $COLONE2='$VALEUR2'  AND $COLONE3='$VALEUR3'  ";
	$requete = @mysql_query($sql) or die($sql."<br>".mysql_error());
	$OP=mysql_num_rows($requete);
	mysql_free_result($requete);
	return $OP;
	}
	function multigraphe1($x,$y,$TITRE,$VALEUR1,$VALEUR2) //,$data$data[$DATE-4]
	{
	include "./CHART/libchart/classes/libchart.php";
	$chart = new VerticalBarChart();
	$dataSet = new XYSeriesDataSet();
	$fichier='./CHART/demo/generated/demo7.png';
	
	
	$DATE=date("Y");
	$serie1 = new XYDataSet();//rh+
	$serie1->addPoint(new Point('A',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','A','RHESUS',$VALEUR1)));
	$serie1->addPoint(new Point('B',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','B','RHESUS',$VALEUR1)));
	$serie1->addPoint(new Point('AB',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','AB','RHESUS',$VALEUR1)));
	$serie1->addPoint(new Point('O',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','O','RHESUS',$VALEUR1)));
	$dataSet->addSerie('RH '.$VALEUR1, $serie1);
	
	$serie2 = new XYDataSet();//rh-
	$serie2->addPoint(new Point('A',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','A','RHESUS',$VALEUR2)));
	$serie2->addPoint(new Point('B',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','B','RHESUS',$VALEUR2)));
	$serie2->addPoint(new Point('AB',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','AB','RHESUS',$VALEUR2)));
	$serie2->addPoint(new Point('O',$this->valeurmultigraphe1('don','DATEDON',($DATE)."-01-01",($DATE)."-12-31",'GROUPAGE','O','RHESUS',$VALEUR2)));
	$dataSet->addSerie('RH '.$VALEUR2, $serie2);
	
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.65);

	$chart->setTitle($TITRE.date("d-m-Y"));
	$chart->render($fichier);	
	echo "<div class=\"data\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	
	echo '<img alt="Pie chart"  src="'.URL.$fichier.'" style="border: 2px solid red;"/>';
	echo "</div>";
	}










	
	
}
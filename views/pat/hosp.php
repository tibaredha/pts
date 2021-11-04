<script>
$(document).ready(function(){
/*     $("#hide").click(function(){
        $("p").hide();
    });
    $("#show").click(function(){
        $("p").show();
    }); */
	$(".h").hide();
	 $("#button").click(function(){
        $(".h").toggle();
    });
});
</script>
<?php 
verifsession();
view::button('cons',$this->user[0]['id']);
function dateFR2US($date)//01/01/2013
{
$J      = substr($date,0,2);
$M      = substr($date,3,2);
$A      = substr($date,6,4);
$dateFR2US =  $A."-".$M."-".$J ;
return $dateFR2US;//2013-01-01
}
$diff    = abs(time() - strtotime(dateFR2US(trim($this->user[0]['DATENAISSANCE'])))); 
$years   = floor($diff / (365*60*60*24));        
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
View::h('2',25,290,'Patient : Hospitalisation [ '.$this->user[0]['NOM']."_".$this->user[0]['PRENOM']." ]");
View::sautligne(2);
View::hr();

View::f0(URL.'pat/HOSPOK/','post');View::fieldset("btn","--");
View::label(25,360,'MOTIF');View::txt(100,350,'MOTIF',60,'MOTIF');
View::label(25,390,'DGC');View::txt(100,380,'DGC',60,'DGC');


View::label(1100,360,'HOSP');View::combov(1200,350,'HOSP',array("NON","OUI")); 
View::label(1100,390,'DATE');View::date(1200,380,'DATEDON',0,date ('Y-m-d'));View::label(1290,390,'HEURE');View::date(1330,380,'HEUREDON',0,date ("H:i"));
if (hospparpat($this->user[0]['id'])>=2)
{
View::label(1100,420,'TYPE PAT');View::combov(1200,410,'TYPEDONNEUR',array("REGULIER","OCCASIONNEL"));
}
else
{
View::label(1100,420,'TYPE PAT');View::combov(1200,410,'TYPEDONNEUR',array("OCCASIONNEL","REGULIER"));
} 
View::label(1100,450,'TEMP');View::date(1200,440,'TEMP',0,'37');View::label(1290,450,'PULSE');View::date(1330,440,'PULSE',0,'70');
View::label(1100,480,'TAS');View::date(1200,470,'TA',0,'120');View::label(1290,480,'TAD');View::date(1330,470,'TA1',0,'80');
View::label(1100,510,'POIDS');View::date(1200,500,'POIDS',0,'75');View::label(1290,510,'Taille');View::date(1330,500,'Taille',0,'170');
View::label(1100,540,'HB');View::date(1200,530,'HEMOGLOBIN',0,'12');View::label(1290,540,'HT');View::date(1330,530,'HEMATOCRIT',0,'34');
View::label(1100,570,'IND');View::combovsex(1200,560,'IND',array("IND","CIDT","CIDD"));  View::label(1290,570,'IDP');View::date(1330,560,'IDP',0,View::idp());
View::label(1100,600,'SERVICE');View::comboservice(1200,590,"SERVICE","mvc","service","SERVICE","SERVICE","ids","servicefr") ;//View::combov(1200,590,'TYPEPOCHE',array("DOUBLE","TRIPLE"));  
View::label(1100,630,'N LIT');View::NLIT(1200,620,"NLIT");//View::combov(1200,620,'TYPEDON',array("NORMAL","APHERESE"));   
View::hide(215,670,'id',0,$this->user[0]['id']);
View::hide(215,670,'NOM',0,$this->user[0]['NOM']);
View::hide(215,670,'PRENOM',0,$this->user[0]['PRENOM']);
View::hide(215,670,'SEXEDNR',0,$this->user[0]['SEX']);
View::hide(215,670,'BIRTHDAY',0,$this->user[0]['DATENAISSANCE']);
View::hide(215,670,'AGEDNR',0,$years);
View::hide(215,670,'GRABO',0,$this->user[0]['GRABO']);
View::hide(215,670,'GRRH',0,$this->user[0]['GRRH']);
View::hide(215,670,'CRH2',0,$this->user[0]['CRH2']);
View::hide(215,670,'ERH3',0,$this->user[0]['ERH3']);
View::hide(215,670,'CRH4',0,$this->user[0]['CRH4']);
View::hide(215,670,'ERH5',0,$this->user[0]['ERH5']);
View::hide(215,670,'KELL1',0,$this->user[0]['KELL1']);
View::hide(215,670,'KELL2',0,$this->user[0]['KELL2']);
View::hide(215,670,'REGION',0,$_SESSION['REGION']);
View::hide(215,670,'WILAYA',0,$_SESSION['WILAYA']);
View::hide(215,670,'STRUCTURE',0,$_SESSION['STRUCTURE']);
View::hide(215,670,'login',0,$_SESSION['login']);
View::submit(1200,650,'Enregistrer Hospitalisation');									
View::f1();	
View::sautligne(15);
?>








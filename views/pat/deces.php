<?php 
verifsession();
// view::button('cons',$this->user[0]['id']);
View::h('2',25,290,'Patient : Certificat De Deces [ '.$this->user[0]['NOM']."_".$this->user[0]['PRENOM']." ]");
View::sautligne(2);
View::hr();
View::f0(URL.'tcpdf/deces.php','post');
$x=250;
View::label(50,$x+145,'Lieu du décés du malade ');
View::label(50,$x+145+30,'Domicile ');                    View::radio(200,$x+145+30,"LD","DOM");    
View::label(50,$x+145+60,'Voie publique ');               View::radio(200,$x+145+60,"LD","VP");     
View::label(50,$x+145+90,'Autres (a préciser). ');        View::radio(200,$x+145+90,"LD","AAP"); View::txt(240,$x+140+90,'AUTRES',24,'*');   
View::label(250,$x+145+30,'Structure de sante public ');  View::radioed(430,$x+145+30,"LD","SSP");  
View::label(250,$x+145+60,'Structure de sante privé ');   View::radio(430,$x+145+60,"LD","SSPV");  
View::label(650,$x+145,'Causes du décés CIM 10 ');  
View::label(650,$x+145+30,'CIM1');                        View::txt(750,$x+140+30,'CIM1',20,"***");          
View::label(650,$x+145+60,'CIM2');                        View::txt(750,$x+140+60,'CIM2',20,"***");       
View::label(650,$x+145+90,'CIM3');                        View::txt(750,$x+140+90,'CIM3',20,"***");        
View::label(650,$x+145+120,'CIM4');                       View::txt(750,$x+140+120,'CIM4',20,"***");       
View::label(650,$x+145+150,'autres etats');               View::txt(750,$x+140+150,'CIM5',20,"***");      
View::label(650,$x+145+180,'la mere');                    View::txt(750,$x+140+180,'ETDE',20,"***");      



View::label(1000,$x+145,'Date du décés');                 View::txt(1150,$x+140,'DD',20,date("Y-m-d")); //$per ->datetime (800,$x+24,'DD');                 
View::label(1000,$x+145+30,'Heure du décés');             View::txt(1150,$x+140+30,'HD',4,date("H:i"));
View::label(1000,$x+145+60,'Cause de décés'); 
View::label(1000,$x+145+90,'Cause naturelle');                View::radioed(1150,$x+145+90,"CD","CN");    
View::label(1000,$x+145+120,'Cause viollente');                View::radio(1150,$x+145+120,"CD","CV");      
View::label(1000,$x+145+150,'Cause idetermine');               View::radio(1150,$x+145+150,"CD","CI");     
View::hide(215,670,'id',0,$this->user[0]['id']);
View::submit(1150,600,'Imprimer Certificat');
View::f1();		
View::sautligne(10);
?>
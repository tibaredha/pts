<?php 
verifsession();
// view::button('cons',$this->user[0]['id']);
View::h('2',25,260,'Hospitalisation : Envenimation Scorpionique [ '.$this->user[0]['NOM']."_".$this->user[0]['PRENOM']." ]");
// View::sautligne(2);
View::hr();
View::f0(URL.'pdf/SAS.PHP','post');
View::label(100,340,'Date de l\'accident ');      View::txt(260,340,'DATE',6,date('d-m-Y')); 
View::label(500,340,'Heure de l\'accident ');     View::txt(670,340,'HDA',6,date("H:i")); 
View::label(100,370,'Wilaya de l\'accident ');    View::WILAYA(260,370,'WILAYAN','country','mvc','wil','17000','wilaya de l\'accident    ');    //WILAYAN(260,370,'WILAYAN','gpts2012','wil') 
View::label(500,370,'Commune de l\'accident ');   View::COMMUNE(670,370,'COMMUNEN','COMMUNEN','924','COMMUNE');           
View::label(860+50,370,'Zone de l\'accident');     View::combov(1090,370,'ZONE',array("rurale", "urbaine")); 
View::label(100,372+30,'Type d\'habitat ');        View::combov(260,370+30,'TYPEHABITA',array("Maison individuelle/Villa","Habitat précaire","Tente de nomade","Immeuble","Maison traditionnelle","Autres")); //BASE DE DONNEES
View::label(500,372+30,'Logement');                View::combov(670,370+30,'INTEXT',array("INT", "EXT")); 
View::label(860+50,372+30,'Scorpion_vu');          View::combov(1090,370+30,'SCORVU',array("OUI", "NON"));  
View::label(100,372+60,'ATCD');                    View::combov(260,370+60,'ATCD',array("NON", "OUI")); 
View::label(500,372+60,'Siège');                   View::combov(670,370+60,'SIEGE',array("Tête Cou", "Tronc","Membre supérieur","Membre inférieur")); 
View::label(860+50,372+60,'Gestes_inutiles');      View::combov(1090,370+60,'GINUT',array("NON","OUI")); 
View::label(100,372+60+30,'Classe');               View::combov(260,370+60+30,'CLASSE',array("1","2","3")); 
View::label(500,372+60+30,'SAS');                  View::combov(670,370+60+30,'SAS',array("OUI", "NON")); 
View::label(860+50,372+60+30,'NBR AMP');           View::combov(1090,370+60+30,'NBRAMP',array("1","2","3","4","5","6","7","8","9","10")); 
View::label(100,372+60+30+30,'Evacuation');        View::combov(260,370+60+60,'EVACUATION',array("NON","OUI")); 
View::label(500,372+60+30+30,'Dateeva');           View::txt(670,370+60+60,'DATEEVACUATION',6,date('d-m-Y'));  
View::label(860+50,372+60+30+30,'Classeeva');      View::combov(1090,370+60+60,'CLASSEEVA',array("2","3")); 
View::label(860+50,372+60+30+30+30,'Deces');       View::combov(1090,370+60+60+30,'DECES',array("NON", "OUI")); 
View::hide(215,670,'id',0,$this->user[0]['id']);
View::submit(1090,550,'Imprimer Envenimation Scorpionique');
View::f1();		
View::sautligne(15);
?>



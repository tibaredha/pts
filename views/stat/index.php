<?php verifsession();view::button('eva','');?>
<h2>PTS: STAT LOIS NORMALES</h2 ><br/><br/><hr/><br/>
<body onload="remplir1(); remplir2(); remplir3();">

<p>On considère une variable aléatoire X normale d'espérance <input type="number" id="entmu" value=0 onChange="maj();"> et d'écart-type <input type="number" id="entsigma" value=1 onChange="maj();">.</p>
<canvas id="can1" width="400" height="240"></canvas><br/><br/>

<br/><br/><p>La probabilité qu'elle soit comprise entre <input type="number" id="enta" value=-1.96 onChange="maj();"> et <input type="number"  id="entb" value=1.96 onChange="maj();"> est <span id="sorPab">0.95</span> (à 0,0001 près):</p>

<?php 
$x=500;
$y=480;
echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
?>
<canvas id="can2" width="400" height="240"></canvas>
<p>La probabilité qu'elle soit inférieure à <span id="sorb">1.96</span>est <span id="sorPb">0.975</span> : </p>
<?php echo "</div>"; ?>



<?php 
$x=1000;
$y=480;
echo "<div style=\" position:absolute;left:".$x."px;top:".$y."px;\">";
?>	 
<canvas id="can3" width="400" height="240"></canvas>
<p>La probabilité qu'elle soit supérieure à <span id="sora">-1.96</span> est <span id="sorPa">0.975</span> :</p>
<?php echo "</div>"; ?>



<?php echo "<br/>Moyenne d age  des dons ";echo avg ('don','AGEDNR');echo "<br/>"; ?>
<?php echo "<br/>ecart type ";echo std ('don','AGEDNR');echo "<br/>"; ?>
<?php echo "<br/>min ";echo min2 ('don','AGEDNR');echo "<br/>"; ?>
<?php echo "<br/>max ";echo max2 ('don','AGEDNR');echo "<br/>"; ?>
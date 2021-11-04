<?php
if(!empty($_POST["keyword"])) {
	$db_host="localhost";
	$db_name="mvc"; 
	$db_user="root";
	$db_pass="";
	$cnx = mysql_connect($db_host,$db_user,$db_pass)or die ('I cannot connect to the database because: ' . mysql_error());
	$db  = mysql_select_db($db_name,$cnx) ;
	mysql_query("SET NAMES 'UTF8' ");
	$sql=mysql_query("SELECT * FROM dnr WHERE NOM like '" . $_POST["keyword"] . "%' ORDER BY NOM LIMIT 0,10");
	echo "<table  width='100%' border='1' cellpadding='5' cellspacing='1' align='center'>" ;
	echo "<tr>" ;
	echo "<th style=\"width:50px;\">photos</th>" ;
	echo "<th style=\"width:50px;\">View</th>" ;
	echo "<th style=\"width:50px;\">Donate</th>" ;
	echo "<th>Last_First_Name</th>" ;
	echo "<th style=\"width:100px;\">Birthday</th> " ;
	echo "<th style=\"width:80px;\">Gender</th> " ;
	echo "<th style=\"width:80px;\">Blood Type</th>" ;
	echo "<th style=\"width:110px;\">Telephone</th>" ;
	echo "<th style=\"width:100px;\">Last Donated</th>" ;
	echo "<th style=\"width:50px;\">Update </th>" ;
	echo "<th style=\"width:50px;\">Delete</th>" ;
	echo "<th style=\"width:50px;\">Print</th>" ;
	echo "</tr>" ;
	while($value=mysql_fetch_array($sql))
	{
	echo "<tr>" ;
	?>	
	<td align="center" >  <?php echo $value['DDD'];?></td>
    <td align="center" >  <?php echo $value['DDD'];?></td>
	<td align="center" >  <?php echo $value['DDD'];?></td>
	
	<td align="left" >  <?php echo $value['NOM'].'_'.$value['PRENOM'].'_'.$value['FILSDE'];?></td>
	<td align="center" >  <?php echo $value['DATENAISSANCE'];?></td>
	<td align="center" >  <?php echo $value['SEX'];?></td>
	<td align="center" >  <?php echo $value['GRABO'].'_'.$value['GRRH'];?></td>
	<td align="center" >  <?php echo $value['TELEPHONE'];?></td>
	<td align="center" >  <?php echo $value['DDD'];?></td>
	
	<td align="center" >  <?php echo $value['DDD'];?></td>
	<td align="center" >  <?php echo $value['DDD'];?></td>
	<td align="center" >  <?php echo $value['DDD'];?></td>	
	<?php
	echo '</tr>';		
	}
    echo "</table>";
 
}

?>


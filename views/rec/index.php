<?php 
verifsession();
view::button('rec','');
?>
<hr /><br />
<table  width='100%' border='1' cellpadding='5' cellspacing='1' align='center'>
            <form  onsubmit="return validateForm11(this);"   name="form1" action="<?php echo URL; ?>rec/search/0/10" method="GET">
           <tr bgcolor='#EDF7FF' >
                <td align="left"  >
					<select name="o" style="width: 100px;">
							<option value="NOM" >Recever</option>
							<option value="GRABO" >Blood Type</option>
							<option value="SEX" >Gender</option>
					</select>
                    <input type="text" name="q"  value=""  AUTOFOCUS  />  <!-- onfocus = "tooltip.pop(this,'Donors: <br />Search Keyword.');"   -->
					<img src="<?php echo URL.'public/images/icons/search.PNG';?>" width='20' height='20' border='0' alt=''/>	                
					<input type="submit" name="" value="Search Recever" />
				</form> 					
                <button onclick=" document.location='<?php echo URL.'rec/newrec/';?>'  "   title="New Recever"><img src="<?php echo URL.'public/images/icons/add.PNG';?>" width='20' height='20' border='0' alt=''/>&nbsp;New Recever </button>
				</td>   
				<td align="right"> 
				 <button onclick=" document.location='<?php echo URL.'rec/imp/';?>'  "      title="Print Recever"><img src="<?php echo URL.'public/images/icons/print.PNG';?>" width='20' height='20' border='0' alt=''/>&nbsp;Print Recever </button>
			     <button onclick=" document.location='<?php echo URL.'rec/';?>'  "     title="Graphe Recever"><img src="<?php echo URL.'public/images/icons/graph.PNG';?>" width='20' height='20' border='0' alt=''/>&nbsp;Graphe Recever </button>
				 <button onclick=" document.location='<?php echo URL.'dis/';?>'  "          title="Search dis"><img src="<?php echo URL.'public/images/icons/search.PNG';?>" width='20' height='20' border='0' alt=''/>&nbsp;Search dis </button></td>
			</tr>
</table>
<?php
$colspan=13;				
if (isset($this->userListview)) 
{
?>
<table  width='100%' border='1' cellpadding='5' cellspacing='1' align='center'>
<tr>
<th style="width:50px;">Photos</th> 
<th style="width:50px;">View</th> 
<th style="width:50px;">PSL</th>
<th>First_Last_Name</th>
<th style="width:100px;">Birthday</th> 
<th style="width:80px;">Gender</th> 
<th style="width:80px;">Blood Type</th>
<th style="width:110px;">Telephone</th> 
<th style="width:100px;">nbr dis</th>
<th style="width:100px;">Last reception</th>
<th style="width:50px;">Update </th>
<th style="width:50px;">Delete</th>
<th style="width:50px;">Print</th>
</tr>
<?php
	
		foreach($this->userListview as $key => $value)
		{ 
		$allow_donate = allow_donate($value['DDT']);
		$bgcolor_donate ='#EDF7FF';
        $fichier = photosmfx('rec',$value['id'].'.jpg',$value['SEX']) ;
            echo "<tr bgcolor=\"".$bgcolor_donate."\"  onmouseover=\"this.style.backgroundColor='#9FF781';\"   onmouseout=\"this.style.backgroundColor='".$bgcolor_donate."';\"  >" ;
		    echo "<td align=\"center\"><a title=\"Modifier Photos\" href=\"".URL."rec/upl/".$value['id']."\" ><img  src=\"".URL."public/webcam/rec/".$fichier."\"  width='25' height='25' border='1' alt='photos'></td> " ;
		?>
			
			<td align="center" class="bg-gray" style="padding: 5px 5px;"><button onclick="document.location='<?php echo URL.'rec/view/'.$value['id'];?>'"   title="View <?php   echo trim($value['NOM']).', '.trim($value['PRENOM'])?>'s Record">&nbsp;&nbsp;<img src="<?php echo URL.'public/images/icons/open.PNG';?>" width='16' height='16' border='0' alt=''/>&nbsp;&nbsp;</button></td>
			<td align="center" class="bg-gray" style="padding: 5px 5px;"><button onclick="document.location='<?php echo URL.'rec/discgr/'.$value['id'];?>'" title="Distribution CGR <?php echo trim($value['NOM']).', '.trim($value['PRENOM'])?>'s Record" <?php //echo ($allow_donate==FALSE)?'disabled':'';?> >&nbsp;&nbsp;<img src="<?php echo URL.'public/images/icons/gs.jpg';?>" width='16' height='16' border='0' alt=''/>&nbsp;&nbsp;</button></td>
			
			<td align="left"><a title="view" href="<?php echo URL.'rec/view/'.$value['id'];?>"><strong><?php echo $value['NOM']."_". strtolower($value['PRENOM']).' ['.strtolower(trim($value['FILSDE'])).'] '; ?></strong></a></td>
			<td align="center" >  <?php echo $value['DATENAISSANCE'];    ?></td>
			<td align="center" >  <?php echo $value['SEX'];    ?></td>
			<td <?php echo bgcolor_ABO($value['GRABO'])  ;?> align="center" >  <?php echo $value['GRABO']."_[".$value['GRRH']."]";   ?></td>
			<td align="center" >  <?php echo $value['TELEPHONE'];    ?></td>
			<td align="center" >  <?php echo disparrec($value['id']);?></td>
			<td align="center" >  <?php echo $value['DDT'];    ?></td>
			<td align="center"><a title="editer <?php echo trim($value['NOM']).', '.trim($value['PRENOM'])?>'s Record" href="<?php echo URL.'rec/edit/'.$value['id'];?>"><img src="<?php echo URL.'public/images/icons/edit.PNG';?>" width='16' height='16' border='0' alt=''/></a></td>
			<td align="center"><a title="supprimer dabord les distribution  <?php echo trim($value['NOM']).', '.trim($value['PRENOM'])?>'s Record"  class="delete"   href="<?php echo URL.'rec/delete/'.$value['id'];?>"><img src="<?php echo URL.'public/images/icons/delete.PNG';?>" width='16' height='16' border='0' alt=''/></a></td>
			<td align="center"><a title="fiche transfusionnelle   <?php echo trim($value['NOM']).', '.trim($value['PRENOM'])?>'s Record" href="<?php echo URL.'pdf/fichetrans.php?uc='.$value['id'];?>"><img src="<?php echo URL.'public/images/icons/print.PNG';?>" width='16' height='16' border='0' alt=''/></a></td>
			</tr>
        <?php 
		}
		$total_count=count($this->userListview1);
		$total_count1=count($this->userListview);
		if ($total_count <= 0 )
		{
		echo '<tr><td align="center" colspan="'.$colspan.'" ><span> No record found for receveur </span></td> </tr>';
		header('location: ' . URL . 'rec/newrec/'.$this->userListviewq);
		echo '<tr bgcolor="#00CED1"  ><td align="left"   colspan="'.$colspan.'" ><span>' .$total_count1.'/'.$total_count.' Record(s) found.</span></td></tr>';					
		}
        else
		{		
		echo '<tr bgcolor=""><td align="center" colspan="'.$colspan.'" >'. barre_navigation ($total_count,$this->userListviewl,$this->userListviewo,$this->userListviewq,$this->userListviewp,$this->userListviewb,'rec').'</td></tr>';	
		echo '<tr bgcolor="#00CED1"  ><td align="left"   colspan="'.$colspan.'" ><span>' .$total_count1.'/'.$total_count.' Record(s) found.</span></td></tr>';					
		$limit=$this->userListviewl;		
		$page=$this->userListviewp;
		if ($page <= 0){$prev_page =$this->userListviewp;}else{$prev_page = $page-$limit;}
		$total_page = ceil($total_count/$limit); echo "<br>" ;  
		$prev_url = URL.'rec/search/'.$prev_page.'/'.$limit.'?q='.$this->userListviewq.'&o='.$this->userListviewo.'';   
		$next_url = URL.'rec/search/'.($page+$limit).'/'.$limit.'?q='.$this->userListviewq.'&o='.$this->userListviewo.'';    
		echo '<tr bgcolor=""  ><td align="center" colspan="'.$colspan.'" >';	
		?> 
		<button <?php echo ($page<=0)?'disabled':'';?>           onclick="document.location='<?php echo $prev_url; ?>'"> Previews</button>&nbsp;&nbsp;&nbsp;<?php //echo $page. ' / ' . $total_page; ?>&nbsp;&nbsp;&nbsp;                              
		<button <?php echo ($page>=$total_page*$limit)?'disabled':'';?> onclick="document.location='<?php echo $next_url; ?>'">Next</button>
		<?php 
		echo '</td></tr>';	     
	   }
}
else 
{
echo '</br>';
echo '</br>';
echo '</br>';
echo '</br>';
echo '</br>';
echo '</br>';
echo '</br>';
echo '</br>';
$y=395;
view::graphemoisdnr(30,$y,'Receveurs Par Mois Arret Au  : ','4','rec','DINS','SRS',date("Y"),'4',"SRS IS NOT NULL");	
view::BOUTONGRAPHE2(30,660);
$x=1120;
echo "<div class=\"mydiv\" style=\" position:absolute;left:".$x."px;top:".$y."px;\">";	 
echo "<marquee behavior=\"scroll\" direction=\"up\" scrollamount=\"3\" scrolldelay=\"80\" onmouseover=\"this.stop()\"onmouseout=\"this.start()\" height=\"252\" width=\"350\" bgcolor=\"GREEN\">";
echo "<H2 align=\"center\">Bienvenue sur G-PTS 4.0 </H2>";
echo "<p align=\"center\"><img  id=\"mydiv2\"   align=\"center\"  src=\"".URL.'public/images/photos/1.JPG'."\" width=\"300\" height=\"300\" alt=\"1\" /></p>";
echo "<H3 align=\"center\">1. l PTS  ain oussera </H3>";
echo "<p align=\"center\"><img  id=\"mydiv2\"   align=\"center\"  src=\"".URL.'public/images/photos/3.JPG'."\" width=\"300\" height=\"300\" alt=\"1\" /></p>";
echo "</marquee>";
echo "</div>";
// echo '<tr><td align="center" colspan="'.$colspan.'" ><span> Click search button to start searching a receveur.</span></td></tr>';
// echo '<tr bgcolor="#00CED1"  ><td align="center"  colspan="'.$colspan.'" ><span>&nbsp;</span></td></tr>';					      
}				
echo "</table>";
?>


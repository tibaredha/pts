<!doctype html>
<html lang="en"  >
<head>
    <meta charset="utf-8">
	<title><?php if (isset ($this->title)){echo $this->title; }else {echo MVC ;}?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="icon" type="image/png" href="<?PHP echo URL; ?>public/images/gs.jpg" />
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/tooltip.css" />
	
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/style.css" />
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/table.css" />
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/calendar.css" />
	
	<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.maskedinput.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/tooltip.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/function.js"></script>
	
	<script type="text/javascript" src="<?php echo URL; ?>public/js/calendar_db.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/webcam/webcam.js"></script>
</head>
<body>
<?php Session::init(); 

function getmicrotime()
{
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}
$temps = getmicrotime();

?>
<div id="header">
	<div id="logod"> 
	    <img src=" <?php echo  URL.'public/images/photos/LOGOAO.GIF'; ?>"   width="90" height="90" border="0" alt="" >
	</div>
	<div id="logog"> 
		<img src=" <?php echo  URL.'public/images/photos/LOGOAO.GIF'; ?>"   width="90" height="90" border="0" alt="" >
	</div>
	<div id="titre">
	<!-- <ul>    -->
		
	<!-- <li>    --> <h2><a  href="<?php echo URL.'ist/map';?>"> EPH <span> Ain-oussera </span> : Poste De Transfusion Sanguine</a></h2><!--     </li>-->
			
	<!--</ul>    -->	
	</div>
	<div id="titre1">
		<h3>Welcome <b><?php echo Session::get('login');?> ! </b> Today is : <?php print(Date("F j, Y"))   ; ?>     <?php //lang :echo Session::get('lang');?>
		<?php
		if(Session::get('loggedIn') == false){
		?>
		<a href="<?php echo URL;?>Login">Login</a>
		<?php
		}
		else{
		?>
		<a href="<?php echo URL;?>dashboard/Logout">Logout</a>
		<?php
		}
		?>
		</h3>
	</div>
</div>
</br>	
<div id="menu">
<?php
if(Session::get('loggedIn') == false)
{
	echo '<a href="'.URL.'pub/AboutUs">About Us</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pub/VisionMission">Vision & Mission</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pub/PeopleBehind">People Behind</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pub/Facts">Blood Donation Facts</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pub/can">Who can/ Can\'t Donate</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pub/help">Projects</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pub/help">Contributions</a>'; echo '&nbsp;';
	echo '<a href="'.URL.'pub/help">collectes </a>'; echo '&nbsp;';
	
}
else
{ 
	echo '<a href="'.URL.'dnr/">Donor&nbsp;&nbsp;<img src="'.URL.'public/images/icons/gs.jpg'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href="'.URL.'qua/">Qualification&nbsp;&nbsp;<img src="'.URL.'public/images/icons/lab1.jpg'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
    echo '<a href="'.URL.'pre/">Préparation&nbsp;&nbsp;<img src="'.URL.'public/images/icons/s_process.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href="'.URL.'rec/">Distribution&nbsp;&nbsp;<img src="'.URL.'public/images/icons/b_sbrowse.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href="'.URL.'eva/">Evaluation&nbsp;&nbsp;<img src="'.URL.'public/images/icons/b_pdfdoc.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	// echo '<a href="'.URL.'pan/pan">Panier&nbsp;&nbsp;<img src="'.URL.'public/images/icons/pan.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	// echo '<a href="'.URL.'pha/pha">Pharmacie&nbsp;&nbsp;<img src="'.URL.'public/images/icons/pha.jpg'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	
	echo '<a href="'.URL.'pat/">Patient&nbsp;&nbsp;<img src="'.URL.'public/images/icons/med.jpg'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	
	if(Session::get('role') == 'owner')
	{
		echo '<a href="'.URL.'user">Users&nbsp;&nbsp;<img src="'.URL.'public/images/icons/md_user.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
		// echo '<a href="'.URL.'sip">SIP</a>'; echo '&nbsp;';
	    // echo '<a href="'.URL.'dnr/wilaya">WILAYA</a>'; echo '&nbsp;';
	}
	
	echo '<div  id="sn" >';
	echo '<a href="">Follow us:</a>'; echo '&nbsp;';
	echo '<a href="https://www.facebook.com/"><img src="'.URL.'public/images/icons/fb.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href="https://twitter.com/"><img src="'.URL.'public/images/icons/tw.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href="https://www.youtube.com/"><img src="'.URL.'public/images/icons/yt.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href=""><img src="'.URL.'public/images/icons/rss.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href=""><img src="'.URL.'public/images/icons/linkedin.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '<a href=""><img src="'.URL.'public/images/icons/sk.png'.'" width=\'20\' height=\'20\' border=\'0\' alt=\'\'/></a>'; echo '&nbsp;';
	echo '</div>';	
}
?>	
</div>	
<div id="content">


	
	
<?php 
View::photosurl(1100,250,URL.'public/images/photos/LOGOAO.GIF');
if (isset($_SESSION['errorlogin'])) {
$sError = '<h1><span id="errorlogin">' . $_SESSION['errorlogin'] . '</span></h1>';		
echo $sError;			
}
else
{
$sError="<h1>Would you like to Login</h1>";
echo $sError;
}
echo '<form action="login/run" method="post">';
echo '<label>Login</label>    <input type="text"     name="login" />       <br />';
echo '<label>Password</label> <input type="password" name="password" /><br />';
echo '<label></label>         <input type="submit" />';
echo '</form>';
	

view::url(290,400,URL."Register",'Register',4);
view::url(430,400,URL."login/ForgotPassword",'Forgot Password',4);
?>



				 
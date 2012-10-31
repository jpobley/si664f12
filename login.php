<?php
require_once "db.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{

$myusername=addslashes($_POST['uniqname']); 
$mypassword=addslashes($_POST['password']); 

$sql="SELECT id FROM contributors WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$active=$row['active'];
$count=mysql_num_rows($result);


if($count==1)
{
session_register("myusername");
$_SESSION['login_user']=$myusername;

//need to create a homepage so this directs somewhere
header("location: home.php");
}
else 
{
$error="Your Login Name or Password is invalid";
}
}
?>



<form id='login' action='login.php' method='post'>
<fieldset >
<legend>Login</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<label for='username' >UserName:</label>
<input type='text' name='username' id='username' />
<label for='password' >Password:</label>
<input type='password' name='password' id='password'  />
<input type='submit' name='Submit' value='Submit' />
</fieldset>
</form>
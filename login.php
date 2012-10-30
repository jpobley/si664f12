<?php
require_once "db.php";
session_start();

$host="localhost"; // Host name 
$username="uniqname"; // Mysql username 
$password="password"; // Mysql password 
$db_name="sicourserate"; // Database name 
$tbl_name="contributors"; // Table name 

// username and password sent from form 
$username=$_POST['uniqname']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($myusername);
$password = stripslashes($mypassword);
$username = mysql_real_escape_string($myusername);
$password = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM contributors WHERE username='uniqname' and password='password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("uniqname");
session_register("password"); 
header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}
?>



<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
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
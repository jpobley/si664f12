<?php //check username against LDAP MCommunity

function verify($name){

	$lc = ldap_connect("ldap.umich.edu" , 389);
	
	ldap_set_option($lc, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	echo "<h1>LDAP query results</h1>";
	
	ldap_bind($lc);
	
	// Search users
	$base = "dc=umich, dc=edu";
	$filt = "uid=$name"; // This is the filter to check in ldap.
	$sr = ldap_search($lc, $base, $filt);
	$info = ldap_get_entries($lc, $sr);
	
	for ($i = 0; $i < $info["count"]; $i++) {
	  echo "Yup. You're a student!<br>";
	  echo "Match " . $i . ": " . $info[$i]["cn"][0];
	  echo " (e-mail: " . $info[$i]["mail"][0] . ")<br>";
	}
	
	if ($i == 0) {
	  echo "No matches found!";
	}
	
	ldap_close($lc);
	return $info;
    unset($_POST['uniq']);
	}
	
if (isset($_POST['uniq'])){
	$email = $_POST['uniq'];
	$results = verify($email);
	}
?>

<p>Check Name</p>
<form method="post">
<p>Uniqname:
<input type="text" name="uniq"></p>
<p><input type="submit" value="Check"/>
</form>

<?php

if (isset($results)) { 
	print("<pre>".print_r($results,true)."</pre>"); 
	}?>

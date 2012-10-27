<?php
require_once "db.php";
session_start();

if ( isset($_POST['course']) && isset($_POST['plays']) && isset($_POST['rating'])) {
   if (!is_numeric($_POST['plays']) || !is_numeric($_POST['rating'])){
		$_SESSION['error'] = 'Error, values for play and rating must be numeric';
		header( 'Location: index.php' ) ;    		
   		}
   else {
	    $t = mysql_real_escape_string($_POST['title']);
	    $p = mysql_real_escape_string($_POST['plays']);
	    $r = mysql_real_escape_string($_POST['rating']);
	    $sql = "INSERT INTO tracks (title, plays, rating) 
	 			  VALUES ('$t', '$p', '$r')";
	    mysql_query($sql);
	    $_SESSION['success'] = 'Record Added';
   		header( 'Location: index.php' ) ;
	    return;
	    }
}
?>

<p>Contribute an evaluation!</p>
<form method="post">
<p>Select the course<br />
	<select name="course">
		<?php
			$result = mysql_query("SELECT si_number, title, id FROM courses");
			while ( $row = mysql_fetch_row($result) ) {
				echo "<option value=\"" . (htmlentities($row[2])) . "\">";
				echo (htmlentities($row[0])) . " - " . (htmlentities($row[1]));
				echo "</option>\n\t\t";
			}
		?>
	</select>
</p>
<p>Write a comment (2,000 characters max)<br />
<textarea type="text" name="text" rows="20" cols="70"></textarea>
</p>
<p>Rating (1 - 5):<br />
<input type="text" name="rating"></p>
<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
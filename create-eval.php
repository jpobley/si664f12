<?php
require_once "db.php";
session_start();

if ( isset($_POST['course']) && isset($_POST['yr']) && isset($_POST['semester'])
	&& isset($_POST['prof']) && isset($_POST['comment']) && isset($_POST['workload'])
	&& isset($_POST['group']) && isset($_POST['practical']) && isset($_POST['anon'])) {

	    $c = mysql_real_escape_string($_POST['course']);
	    $y = mysql_real_escape_string($_POST['yr']);
	    $s = mysql_real_escape_string($_POST['semester']);
	    $p = mysql_real_escape_string($_POST['prof']);
	    $t = mysql_real_escape_string($_POST['comment']);
	    $w = mysql_real_escape_string($_POST['workload']);
	    $g = mysql_real_escape_string($_POST['group']);
	    $pr = mysql_real_escape_string($_POST['practical']);
	    $a = mysql_real_escape_string($_POST['anon']);
	    $sql = "INSERT INTO comments (comment, course_id, yr_id, semester, 
	    		professor_id, workload, groupwork, pract_theory, anonymous) 
	 			VALUES ('$t', '$c', '$y', '$s', '$p', '$w', '$g', '$pr', '$a')";
	    mysql_query($sql);
	    $_SESSION['success'] = 'Record Added';
   		header( 'Location: index.php' ) ;
	    return;
       }
?>

<p>Contribute an evaluation!</p>
<form method="post">

<!--Build course list from database-->
<h4>Select the course</h4>
	<select name="course">
		<?php
			$result = mysql_query("SELECT si_number, title, id FROM courses ORDER BY si_number ASC");
			while ( $row = mysql_fetch_row($result) ) {
				echo "<option value=\"" . (htmlentities($row[2])) . "\">";
				echo (htmlentities($row[0])) . " - " . (htmlentities($row[1]));
				echo "</option>\n\t\t";
			}
		?>
	</select>

<!--Year-->
<h4>Select the year and semester</h4>
<select name="yr">
		<?php
			$result = mysql_query("SELECT id, yr FROM yr ORDER BY yr ASC");
			while ( $row = mysql_fetch_row($result) ) {
				echo "<option value=\"" . (htmlentities($row[0])) . "\">";
				echo (htmlentities($row[1]));
				echo "</option>\n\t\t";
			}
		?>
</select>

<!--Semester-->
	<input type="radio" name="semester" value="fall">Fall</input>
	<input type="radio" name="semester" value="winter">Winter</input>

<!--Build professor list from database-->
<h4>Select the professor</h4>
	<select name="prof">
		<?php
			echo "<option value =\"-1\">Not listed</option>";
			$result = mysql_query("SELECT id, firstname, lastname FROM professors ORDER BY lastname ASC");
			while ( $row = mysql_fetch_row($result) ) {
				echo "<option value=\"" . (htmlentities($row[0])) . "\">";
				echo (htmlentities($row[1])) . " " . (htmlentities($row[2]));
				echo "</option>\n\t\t";
			}
		?>
	</select>

<!--Comment box-->
<h4>Write a comment (2,000 characters max)</h4>
<textarea type="text" name="comment" rows="20" cols="70"></textarea>

<!--Workload rating-->
<h4>Rating the workload:</h4>
	<span>Not a lot</span>
		<input type="radio" name="workload" value="1" />
		<input type="radio" name="workload" value="2" />
		<input type="radio" name="workload" value="3" />
		<input type="radio" name="workload" value="4" />
		<input type="radio" name="workload" value="5" />
	<span>All of the work</span>

<!--Groupwork-->	
<h4>Is there group work?:</h4>
	<input type="radio" name="group" value="1">Yes</input>
	<input type="radio" name="group" value="0">No</input>

<!--Practical vs Theory rating-->
<h4>Was the coures more practical or theoretical?</h4>
	<span>Super practical</span>
		<input type="radio" name="practical" value="1" />
		<input type="radio" name="practical" value="2" />
		<input type="radio" name="practical" value="3" />
		<input type="radio" name="practical" value="4" />
		<input type="radio" name="practical" value="5" />
	<span>Super theoretical</span>
	
<!--Anonymous-->
<h4>Check this box if you would like this to be an anonymous comment.</h4>
	<input type="checkbox" name="anon" value="1">Yes, make this an anonymous comment</input>
	
<p><input type="submit" value="Add New"/>
</form>
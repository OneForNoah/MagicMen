<!DOCTYPE html>
<html>
<body>
	<h2>Airplane Tables</h2>

	<?php
	    try
	    {
	        //open the sqlite database file
	        $db = new PDO('sqlite:./database/airport.db');

	        // Set errormode to exceptions
	        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	        //select all passengers
		$query = "SELECT * FROM planes";
	        $result = $db->query($query);

		echo '<table>';
		//loop through each tuple in result set
	        foreach($result as $tuple)
	        {
			echo '<tr><td>';
			echo "<font color='blue'>$tuple[tail_no]</font> $tuple[make] $tuple[model] $tuple[capacity] $tuple[mph]";
			echo '</td><td>';
			echo '<form action="/delete.php" method="POST">';
			echo '<input type="hidden" name="tail_no" value="'.$tuple['tail_no'].'">';
			echo '<input type="submit" value="Delete"></form>';
			echo '</td><td>';
			echo '<form action="/update.php" method="POST">';
                        echo '<input type="hidden" name="tail_no" value="'.$tuple['tail_no'].'">';
			echo '<input type="submit" value="Edit"></form>';
			echo '</td></tr>';
			echo '<br>';
	        }
		echo '</table>';

	        $db = null;	//disconnect from db
	    }
	    catch(PDOException $e)
	    {
	        die('Exception : '.$e->getMessage());
	    }
	?>


	<p>
	<form action="insertAirplane.html"/>
	<input type="submit" value="Insert another plane"/>
	</form>
	</p>

</body>
</html>

<!DOCTYPE html>
<html>
<body>
	<h2>Update A Tuple</h2>
<?php
        try
        {
                //open the sqlite database file
                $db = new PDO('sqlite:./database/airport.db');

                // Set errormode to exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $tail = $_POST['tail_no'];

                $query = "SELECT * FROM planes WHERE tail_no='$tail'";
                $result = $db->query($query);


                //loop through each tuple in result set
                foreach($result as $tuple)
                {
                        echo "<font color='blue'>$tuple[tail_no]</font> $tuple[make] $tuple[model] $tuple[capacity] $tuple[mph]";
                        //echo '<form action="/update.php" method="POST">';
                        //echo '<input type="hidden" name="tail_no" value="'.$tuple['tail_no'].'">';
                        //echo '<input type="submit" value="Edit"></form>';
                }


                //$db->exec($stmt);

                //disconnect from database
                $db = null;
        }
        catch(PDOException $e)
        {
            die('Exception : '.$e->getMessage());
        }

        //redirect user to another page now
        header("Location: displayTables.php");
?>

</body>
</html>

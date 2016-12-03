<?php
        try
        {
                //open the sqlite database file
                $db = new PDO('sqlite:./database/airport.db');

                // Set errormode to exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $tail = $_POST['tail_no'];

		$stmt = "DELETE FROM planes WHERE tail_no = '$tail'";

		$db->exec($stmt);

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






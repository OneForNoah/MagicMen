<?php
        try
        {
                //open the sqlite database file
                $db = new PDO('sqlite:./database/airport.db');

                // Set errormode to exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$ssn = $_POST['ssnToDelete']; 

		//$stmt= db->prepare("DELETE FROM passenger WHERE ssn='$ssnToDelete'");

		//$stmt->execute();

		$stmt = "DELETE FROM passengers WHERE ssn = '$ssn'";
		$db->exec($stmt);

                //disconnect from database
                $db = null;
        }
        catch(PDOException $e)
        {
            die('Exception : '.$e->getMessage());
        }

        //redirect user to another page now
        header("Location: successfulDeletion.html");
?>


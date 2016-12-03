<?php
        try
        {
                $required = array('tail_no');
                $error = false;
                foreach($required as $field) {
                        if (empty($_POST[$field])) {
                                $error = true;
                        }
                }
                if ($error) {
                        echo "Tail Number is required.";
                        header("Location:insertAirplane.html");
                }

                //open the sqlite database file
                $db = new PDO('sqlite:./database/airport.db');

                // Set errormode to exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                //safely insert values into passengers table
                //order matters (look at your schema) -- fname, mname, lname, ssn
                $stmt = $db->prepare("INSERT INTO planes (tail_no, make, model, capacity, mph) VALUES (:tail, :make, :model, :capacity, :mph)");
                $stmt->bindParam(':tail', $tail);
                $stmt->bindParam(':make', $make);
                $stmt->bindParam(':model', $model);
                $stmt->bindParam(':capacity', $capacity);
		$stmt->bindParam(':mph', $mph);

                $tail = $_POST[tail_no];
                $make = $_POST[make];
                $model = $_POST[model];
                $capacity = $_POST[capacity];
                $mph = $_POST[mph];

                $stmt->execute();

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

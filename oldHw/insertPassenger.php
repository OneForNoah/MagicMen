<?php
        try
        {
                $required = array('fname', 'lname', 'ssn');
                $error = false;
                foreach($required as $field) {
                        if (empty($_POST[$field])) {
                                $error = true;
                        }
                }
                if ($error) {
                        echo "First name, last name, and ssn are required.";
                        header("Location:insertPassenger.html");
		}

		//open the sqlite database file
	        $db = new PDO('sqlite:./database/airport.db');

	        // Set errormode to exceptions
	        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	        //safely insert values into passengers table
		//order matters (look at your schema) -- fname, mname, lname, ssn
		$stmt = $db->prepare("INSERT INTO passengers (f_name, m_name, l_name, ssn) VALUES (:f_name, :m_name, :l_name, :ssn)");
		$stmt->bindParam(':f_name', $fname);
		$stmt->bindParam(':m_name', $mname);
		$stmt->bindParam(':l_name', $lname);
		$stmt->bindParam(':ssn', $ssnreal);

		$notrequired = 'mname';
		if(empty($_POST[$notrequired])) {
			$fname = $_POST[fname];
			$mname = null;
			$lname = $_POST[lname];
			$ssnreal = $_POST[ssn];
	        } else {
                        $fname = $_POST[fname];
                        $mname = $_POST[mname];
                        $lname = $_POST[lname];
                        $ssnreal = $_POST[ssn];
	        }
		//echo($stmt);
		//$db->exec($stmt);
	        $stmt->execute();

	        //disconnect from database
	        $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	header("Location: successfulInsert.html");
?>

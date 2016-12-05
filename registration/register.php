<?php
        try
        {
                $required = array('name', 'usern', 'pw');
                $error = false;
                foreach($required as $field) {
                        if (empty($_POST[$field])) {
                                $error = true;
                        }
                }
                if ($error) {
                        echo "Name, Username, and Password are required.";
                        header("Location:register.html");
		}

		//open the sqlite database file
	    $db = new PDO('sqlite:../database/users.db');

	    // Set errormode to exceptions
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	    $sql = 'SELECT * FROM users ORDER BY id_user';
		foreach ($db->query($sql) as $row) {
			print $row['id_user'] . "\t";
			print $row['name'] . "\t";
			print $row['username'] . "\t";
			print $row['password'] . "\n";
		}
		$db->query('TRUNCATE TABLE Users.users');
		 $sql = 'SELECT * FROM users ORDER BY id_user';
		foreach ($db->query($sql) as $row) {
			print $row['id_user'] . "\t";
			print $row['name'] . "\t";
			print $row['username'] . "\t";
			print $row['password'] . "\n";
		}
	    //safely insert values into passengers table
		//order matters (look at your schema) -- fname, mname, lname, ssn
		$stmt = $db->prepare('INSERT INTO users (id_user, name, username, password) VALUES (:id, :name, :usern, :pw);');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':usern', $usern);
		$stmt->bindParam(':pw', $pw);

		$query = $db->query('SELECT max(id_user) AS maxval FROM users');
		$idrow = $query->fetch(PDO::FETCH_ASSOC);
		$max = 1;
		echo($max);
		$max++;
		echo($max);
		$id=$max ;
		$name = $_POST['name'];
		$usern = $_POST['usern'];
		$pw = $_POST['pw'];
		//echo($stmt);
		//$db->exec($stmt);
	    $stmt->execute();
	    echo($stmt);
	        //disconnect from database
	    $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	//header("Location: ../index.html");
?>
<?php

		//open the sqlite database file
	    $db = new PDO('sqlite:./database/mtgcard.db');

	    // Set errormode to exceptions
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    //safely insert values into passengers table
		//order matters (look at your schema) -- fname, mname, lname, ssn
		$stmt = $db->prepare('SELECT FROM users (id_user, name, username, password) VALUES (:id, :name, :usern, :pw);');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':usern', $usern);
		$stmt->bindParam(':pw', $pw);

		


	    $stmt->execute();
	    
	        //disconnect from database
	    $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	header("Location: login.html");
?>
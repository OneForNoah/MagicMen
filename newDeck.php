<?php
      /*  try
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
		}*/

    $db = new PDO('sqlite:../database/user.db');
	    // Set errormode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $db->query('SELECT COUNT(id_user) FROM users');


	  //safely insert values into passengers table
		//order matters (look at your schema) -- fname, mname, lname, ssn
    $user = $db->query('SELECT max(id_user) FROM users')
    $db->close();
    $db = new PDO('sqlite:../database/mtgcard.db');
    $deck = $db->query('SELECT max(deckID)')
    $deck = $db->
    $stmt = $db->prepare("INSERT INTO users (id_user, name, username, password) VALUES (:id, :name, :usern, :pw)");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':usern', $usern);
		$stmt->bindParam(':pw', $pw);

		$idnum = $db->query("SELECT max(id_user) FROM users");
		$id = echo($idnum);
		$name = $_POST['name'];
		$usern = $_POST['usern'];
		$pw = $_POST['pw'];
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
	header("Location: index.html");
?>

<?php
        try
        {
                $required = array('deckTitle', 'usern');
                $error = false;
                foreach($required as $field) {
                        if (empty($_POST[$field])) {
                                $error = true;
                        }
                }
                if ($error) {
                        echo "Deck Title and Username are required";
                        header("Location:newDeck.html");
		}

    echo 'test0';
    $db = new PDO('sqlite:./database/users.db');
    echo 'test1';
	    // Set errormode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $un = $_POST['usern'];
    $userID = $db->query("SELECT id_user FROM users WHERE username = '$un'");
    $db = null;

    echo 'test2';
    $db = new PDO('sqlite:./database/mtgcard.db');
    echo 'test3';
    $deckID = rand();
    $stmt = $db->prepare('INSERT INTO DeckInfo (deckID, playerID, deckName, deckSize) VALUES (:deckID, :playerID, :deckName, :deckSize);');
    $stmt->bindParam(':deckID', $deckID);
    $stmt->bindParam(':playerID', $userID);
    $stmt->bindParam(':deckName', $_POST['deckTitle']);
    $stmt->bindParam(':deckSize', 60);
    $sdeckID = $deckID;
    $
    $db = null;
	/*  //safely insert values into passengers table
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
*/
	        //disconnect from database
	    $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	header("Location: deckBuilder.html");
?>

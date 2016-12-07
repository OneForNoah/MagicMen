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

    $db = new PDO('sqlite:./database/users.db');

    // Set errormode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $un = $_POST['usern'];
    $id = $db->query("SELECT id_user FROM users WHERE username = '$un';");
    $user_id = $id->fetchColumn(0);
    if(empty($user_id)) {
        die('Exception : need real user name');
    }
    $db = null;

    $db = new PDO('sqlite:./database/mtgcard.db');

    $stmt = $db->prepare('INSERT INTO DeckInfo (deckID, playerID, deckName, deckSize) VALUES (:deckID, :playerID, :deckName, :deckSize);');
    $stmt->bindParam(':deckID', $deckID);
    $stmt->bindParam(':playerID', $playerID);
    $stmt->bindParam(':deckName', $deckName);
    $stmt->bindParam(':deckSize', $deckSize);

    $idquery = $db->query("SELECT max(deckId) FROM DeckInfo");
    $id =  $idquery->fetchColumn(0);
    $id++;

    $deckID=$id;
    $playerID=$user_id;
    $deckName=$_POST['deckTitle'];
    $deckSize=60;
    $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	header("Location: deckBuilder.php");
?>

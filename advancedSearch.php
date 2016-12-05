<?php

		//open the sqlite database file
	    $db = new PDO('sqlite:./database/mtgcard.db');

	    // Set errormode to exceptions
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    //safely insert values into passengers table
		if(empty($_POST['power']) && empty($_POST['tough'])) {
			$resultC = $db->query("SELECT * FROM creatures, nonCreatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%'");
			//$resultN = $db->query("SELECT FROM nonCreatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%'");

			//RETURN OUTPUT
			echo $resultC;
		} else if(empty($_POST['power'])) {
			$resultC = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND power=$_POST[power]");
			//RETURN OUTPUT
		} else if(empty($_POST['tough'])) {
			$resultC = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND tough=$_POST[tough]");
			//RETURN OUTPUT
		} else {
			$resultC = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND power=$_POST[power] AND tough=$_POST[tough]");
			//RETURN OUTPUT
		}

	    //disconnect from database
	    $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	//header("Location: login.html");
?>

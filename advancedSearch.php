<!DOCTYPE html>
<html>
<title>Magic: the UnGathering</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="normal.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
.w3-sidenav a,.w3-sidenav h4 {padding: 12px;}
.w3-navbar li a {
	padding-top: 12px;
	padding-bottom: 12px;
}
</style>
<body>

	<!-- Navbar -->
	<div class="w3-top">
		<ul class="w3-navbar w3-theme w3-top w3-left-align w3-large">
			<li class="w3-opennav w3-right w3-hide-large">
			</li>
			<li><a href="indexLoggedIn.html"><div id="header">MagicMen</div></a></li>
			<!-- <div class="w3-left"> -->
			<div>
				<li><a href=deckBuilder.html><div id="navbar">Deck Builder</div></a></li>
				<li><a href="playgame.html"><div id="navbar">Play a Game</div></a></li>
				<li><a href="search.html"><div id="navbar">Search</div></a></li>
			</div>
		</ul>
	</div>
	<div class="w3-row w3-padding-64">
		<div class="w3-twothird w3-container">
			<h2>Search Results</h2>
			<script>
			<?php
			try
			{
				//open the sqlite database file
				$db = new PDO('sqlite:./database/mtgcard.db');

	    		// Set errormode to exceptions
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    		//safely insert values into passengers table
				if(empty($_POST['power']) && empty($_POST['tough'])) {
					$result = $db->prepare("SELECT * FROM creatures NATURAL JOIN nonCreatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%'");
					$result->execute();
					//$resultN = $db->query("SELECT FROM nonCreatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%'");
					$cards = $result->fetchAll();

					echo "<table>";
					echo "<tr><th>Name</th><th>Manacost</th><th>Type</th><th>Rules Text</th><th>Power</th><th>Toughness</th></tr>";


					foreach( $cards as $row) {
						echo "<tr>";
						echo "<td>".$row['cardName']."</td>";
						echo "<td>".$row['manacost']."</td>";
						echo "<td>".$row['cardType']."</td>";
						echo "<td>".$row['cardText']."</td>";
						echo "<td>".$row['power']."</td>";
						echo "<td>".$row['toughness']."</td>";
						echo "</tr>";
					}

					echo "</table>";

				} else if(empty($_POST['power'])) {
					$result = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND tough=$_POST[tough]");
				//RETURN OUTPUt

				} else if(empty($_POST['tough'])) {
					$result = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND power=$_POST[power]");
				//RETURN OUTPUT

				} else {
					$result = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND power=$_POST[power] AND tough=$_POST[tough]");
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
			</script>
		</div>
	</div>
</body>
</html>

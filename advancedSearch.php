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
<body style="background-image:url('Trail-of-Evidence-Shadows-over-Innistrad-Art.jpg')">

	<!-- Navbar -->
	<div class="w3-top">
		<ul class="w3-navbar w3-theme w3-top w3-left-align w3-large">
			<li class="w3-opennav w3-right w3-hide-large">
			</li>
			<li><a href="indexLoggedIn.html"><div id="header">MagicMen</div></a></li>
			<!-- <div class="w3-left"> -->
			<div>
				<li><a href=deckBuilder.php><div id="navbar">Deck Builder</div></a></li>
				<li><a href="playgame.php"><div id="navbar">Play a Game</div></a></li>
				<li><a href="search.html"><div id="navbar">Search</div></a></li>
				<li><a href="about.html"><div id="navbar">About M:TG</div></a></li>
			</div>
		</ul>
	</div>
	<div class="w3-row w3-padding-64">
		<div class="w3-twothird w3-container">
			<h2>Search Results</h2>
			<div>
				<a href="search.html"><button>Go Back to Search</button></a>
			</div>
			<?php
			try
			{
				//open the sqlite database file
				$db = new PDO('sqlite:./database/mtgcard.db');

	    		// Set errormode to exceptions
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    		//safely insert values into passengers table
				if(empty($_POST['power']) && empty($_POST['tough'])) {
					$resultC = $db->query("SELECT * FROM nonCreatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' ORDER BY cardName");

					$resultN = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' ORDER BY cardName");

					echo '<table border="1" bgcolor="white">';
					//loop through each tuple in result set
					foreach($resultC as $tuple)
					{
						echo '<tr><td>';
						echo "&nbsp;<font color='blue'>$tuple[cardName]</font>&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[manacost]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[color]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardType]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardText]&nbsp;";
						echo '</td></tr>';
										//echo '<form action=".php" method="POST">';
										//echo '<input type="submit" value="View Decklist"></form>';
										//echo '</td></tr>';
										//echo '<br>';
					}
					foreach($resultN as $tuple)
					{
						echo '<tr><td>';
						echo "&nbsp;<font color='blue'>$tuple[cardName]</font>&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[manacost]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[color]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardType]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardText]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[power]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[toughness]&nbsp;";
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';

				} else if(empty($_POST['power'])) {
					$result = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND toughness=$_POST[tough] ORDER BY cardName");
					echo '<table border="1">';
					//loop through each tuple in result set
					foreach($result as $tuple)
					{
						echo '<tr><td>';
						echo "&nbsp;<font color='blue'>$tuple[cardName]</font>&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[manacost]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[color]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardType]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardText]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[power]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[toughness]&nbsp;";
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';

				} else if(empty($_POST['tough'])) {
					$result = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND power=$_POST[power] ORDER BY cardName");
					echo '<table border="1">';
					//loop through each tuple in result set
					foreach($result as $tuple)
					{
						echo '<tr><td>';
						echo "&nbsp;<font color='blue'>$tuple[cardName]</font>&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[manacost]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[color]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardType]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardText]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[power]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[toughness]&nbsp;";
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';

				} else {
					$result = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' AND power=$_POST[power] AND toughness=$_POST[tough] ORDER BY cardName");
					echo '<table border="1">';
					//loop through each tuple in result set
					foreach($result as $tuple)
					{
						echo '<tr><td>';
						echo "&nbsp;<font color='blue'>$tuple[cardName]</font>&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[manacost]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[color]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardType]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[cardText]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[power]&nbsp;";
						echo '</td>';
						echo '<td>';
						echo "&nbsp;$tuple[toughness]&nbsp;";
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';

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
		</div>
	</div>

</body>
</html>

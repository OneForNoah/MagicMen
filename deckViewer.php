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
<body style="background-image:url('deckviewerbackground.jpg')">

  <!-- Navbar -->
  <div class="w3-top">
    <ul class="w3-navbar w3-theme w3-top w3-left-align w3-large">
      <li class="w3-opennav w3-right w3-hide-large">
      </li>
      <li><a href="indexLoggedIn.html"><div id="header">MagicMen</div></a></li>
      <!-- <div class="w3-left"> -->
      <div>
        <li><a href="deckBuilder.php"><div id="navbar">Deck Builder</div></a></li>
        <li><a href="playgame.php"><div id="navbar">Play a Game</div></a></li>
        <li><a href="search.html"><div id="navbar">Search</div></a></li>
      </div>
    </ul>
  </div>
  <br>
  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      Your deck ID is
        <?php
        try
        {
          $deck_id = $_POST['deck_id'];
          echo $deck_id;
          echo '<form action="deckEditor.php" method="POST">';
          echo '<input type="hidden" name="deck_id" value="$deck_id">';
          echo '<input type="submit" value="Edit Deck"></form>';

          //open the sqlite database file
          $db = new PDO('sqlite:./database/mtgcard.db');

          // Set errormode to exceptions
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //safely insert values into passengers table
          $result = $db->query("SELECT cardID, cardName FROM Decklists WHERE deckID = '$deck_id'");

          echo '<table border="1">';
          //loop through each tuple in result set
          foreach($result as $tuple)
          {
            $cncre = $db->query("SELECT cardName, manacost, color, cardType, cardText, power, toughness FROM creatures WHERE cardID = '$tuple[cardID]' AND cardName = '$tuple[cardName]'");
            // $res1 = $cncre->fetch(PDO::FETCH_OBJ);
            // $resid1 = $res1->cardID;
            // $resn1 = $res1->cardName;

            $cnnon = $db->query("SELECT cardName, manacost, color, cardType, cardText FROM nonCreatures WHERE cardID = '$tuple[cardID]' AND cardName = '$tuple[cardName]'");
            // $res2 = $cncre->fetch(PDO::FETCH_OBJ);
            // $resid2 = $res2->cardID;
            // $resn2 = $res2->cardName;

            if(empty($cncre) && empty($cnnon)) {
              die("Something Broke. Its on us. Please retry later :(");
            } else if(empty($cnnon)) {
              foreach($cncre as $tuple)
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
            } else {
              foreach($cnnon as $tuple)
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
              }
            }
          }
          echo '</table>';

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
  <!-- END MAIN -->
</div>

</body>
</html>

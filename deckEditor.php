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
      <li><a href="deckBuilder.php"><div id="navbar">Deck Builder</div></a></li>
      <li><a href="playgame.php"><div id="navbar">Play a Game</div></a></li>
      <li><a href="search.html"><div id="navbar">Search</div></a></li>
    </div>
  </ul>
</div>
<div class="w3-row w3-padding-64">
  <div class="w3-twothird w3-container">
    <h2>Edit your decks</h2><br>
    <h4>Each card must be typed exactly how it is spelled, and on a different line from the previous card</h4>
    <div class="col-md-8">
      <?php
      try
      {
        $deckID = $_POST['deck_id'];
        echo '<FORM METHOD=POST>';
        echo '<input type="hidden" name="deckID" value="'.$deckID.'">';
        echo '<textarea name = "cardList" placeholder="Enter card names here"rows="10" cols="100"></textarea>';
        echo '<P><INPUT TYPE=SUBMIT> <INPUT TYPE=RESET>';
        echo '</FORM>';

        $db = new PDO('sqlite:./database/mtgcard.db');

        // Set errormode to exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $un = $_POST['deckID'];
        $id = $db->query("SELECT * FROM Decklists WHERE deckID = '$un';");
        $deck_id = $id->fetchColumn(0);
        if(empty($deck_id)) {
          die('Exception : need real deck ID');
        }
        $cards = explode("\n", $_POST['cardList']);

        foreach($cards as $target)
        {
          $stmt = $db->prepare('INSERT INTO Decklists (deckID, cardID, numOf) VALUES (:deckID, :cardID, :numOf);');
          $stmt->bindParam(':deckID', $deckID);
          $stmt->bindParam(':cardID', $playerID);
          $stmt->bindParam(':numOf', $numOf);


          $resultC = $db->query("SELECT * FROM nonCreatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' ORDER BY cardName");

          $resultN = $db->query("SELECT * FROM creatures WHERE cardName LIKE '%$_POST[name]%' AND color LIKE '%$_POST[color]%' AND cardType LIKE '%$_POST[type]%' AND cardText LIKE '%$_POST[ruletext]%' ORDER BY cardName");


          $deckID=$id;
          $cardID = $db->query("SELECT cardID FROM nonCreatures NATURAL JOIN creatures WHERE cardName='$target'");
          $numOf = $db->query("SELECT numOf FROM Decklists WHERE cardName='$target'");
        if($numOf<4) {//if there are already 4 copies of this card then do not put it into the deck
          $stmt->execute();
        }
      }
      $db = null;

    }
    catch(PDOException $e)
    {
     die('Exception : '.$e->getMessage());
   }
   ?>
   <!--input name="deckID" placeholder="deckID" size="100">-->
 </div>
</div>
<footer id="myFooter">
  <div id="footer" class="w3-container w3-theme-l2 w3-padding-16">
    <h6>Designed by Trevor Nunn, Noah Reyes, Alden Walsh, and Andy Van Heuit.
      <p>
        All cards and art belongs to Wizards of the Coast.
      </h5>
    </div>
  </footer>
  <!-- END MAIN -->
</div>

<script>
// Get the Sidenav
var mySidenav = document.getElementById("mySidenav");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidenav, and add overlay effect
function w3_open() {
  if (mySidenav.style.display === 'block') {
    mySidenav.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidenav.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidenav with the close button
function w3_close() {
  mySidenav.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>

 !DOCTYPE html>
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
<body style="background-image:url('deckbuilderbackground.jpg')">
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
        <li><a href="about.html"><div id="navbar">About M:TG</div></a></li>
      </div>
    </ul>
  </div>
  <div id="textbox">
    <div class="w3-row w3-padding-32">
      <div class="w3-twothird w3-container">
       <?php
       try
       {
        error_reporting(E_ALL & ~E_NOTICE);

        $deck_id = $_POST['deck_id'];
        if(empty($deck_id)) {
          die('Exception : need real deck ID');
        }
        $cards = explode("\n", $_POST['cardList']);

        $db = new PDO('sqlite:./database/mtgcard.db');

        // Set errormode to exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_TIMEOUT, 20);

        $sentinel = True;

        foreach($cards as $target)
        {
          $copies = substr($target, 0, 1);
          $cs = $db->query("SELECT deckSize FROM DeckInfo WHERE deckID='$deck_id';");
          $currSize = $cs->fetchColumn(0);
          $newSize = $currSize + $copies;
          $que = "Update DeckInfo Set deckSize=$newSize Where deckID=$deck_id;";
          $db->query($que);
          $target = substr($target, 2);
          $target= trim(preg_replace('/\s\s+/', '', $target));

          $stmt = $db->prepare('INSERT INTO Decklists (deckID, playerID, cardID, cardName, numOf) VALUES (:deckID, :playerID, :cardID, :cardName, :numOf);');
          $stmt->bindParam(':deckID', $deckID);
          $stmt->bindParam(':playerID', $playerID);
          $stmt->bindParam(':cardID', $cardID);
          $stmt->bindParam(':cardName', $cardName);
          $stmt->bindParam(':numOf', $numOf);

          $deckID=$deck_id;

          $que = "SELECT playerID FROM DeckInfo WHERE deckID='$deckID';";
          $playid = $db->query($que);
          $playerID = $playid->fetchColumn(0);

          $que = "SELECT cardID, cardName FROM creatures WHERE cardName='$target';";
          $idcre = $db->query($que);
          $rescobj = $idcre->fetch(PDO::FETCH_OBJ);
          $resccid = $rescobj->cardID;
          $resccn = $rescobj->cardName;

          $que = "SELECT cardID, cardName FROM nonCreatures WHERE cardName='$target';";
          $idnonc = $db->query($que);
          $resnobj = $idnonc->fetch(PDO::FETCH_OBJ);
          $resncid = $resnobj->cardID;
          $resnccn = $resnobj->cardName;

          if(empty($resncid) && empty($resccid)) {
            $sentinel = False;
          } else if(empty($resncid)) {
            $cardID = $resccid;
            $cardName = $resccn;
          } else {
            $cardID = $resncid;
            $cardName = $resnccn;
          }
          $numOf = $copies;

          $stmt->execute();


        }
        $id = $db->query("SELECT deckID FROM DeckInfo WHERE deckID = '$deck_id'");
        foreach($id as $tuple) {
          if($sentinel == True) {
            echo '<h3>Card addition successful!</h3>';
            echo '<form action="deckViewer.php" method="POST">';
            echo '<input type="hidden" name="deck_id" value="'.$tuple['deckID'].'">';
            echo '<input type="submit" value="Go back"></form>';
          } else {
            echo '<h3>Card name not valid!</h3>';
            echo '<form action="deckEditor.php" method="POST">';
            echo '<input type="hidden" name="deck_id" value="'.$tuple['deckID'].'">';
            echo '<input type="submit" value="Go back"></form>';
          }
          
        }
        $db = null;

      }
      catch(PDOException $e)
      {
        die('Exception : '.$e->getMessage());
      }

  //header("Location: ./deckViewer.php");
      ?>
    </div>
  </div>
</div>
</body>
</html>

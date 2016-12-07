 <?php
 try
 {
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
<?php
try
{
  $db = new PDO('sqlite:./database/mtgcard.db');

  // Set errormode to exceptions
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $deck_id = $_POST['deckID'];
  if(empty($deck_id)) {
    die('Exception : need real deck ID');
  }
  $cards = explode("\n", $_POST['cardList']);

  foreach($cards as $target)
  {
    $copies = substr($target, 0[, 1]);
    $target = substr($target, 2[, strlen($target)]);
    $stmt = $db->prepare('INSERT INTO Decklists (deckID, cardID, numOf) VALUES (:deckID, :cardID, :numOf);');
    $stmt->bindParam(':deckID', $deckID);
    $stmt->bindParam(':cardID', $cardID);
    $stmt->bindParam(':numOf', $numOf);


    $deckID=$deck_id;
    $id = $db->query("SELECT cardID FROM nonCreatures NATURAL JOIN creatures WHERE cardName='$target';");
    $cardID = $id->fetchColumn(0);
    echo $cardID;
    //$num = $db->query("SELECT numOf FROM Decklists WHERE cardID='$cardID' AND deckID='$deckID';");
    $numOf = 1; //$num->fetchColumn(0);
    for($i = 0; $i<$copies; $i++ ) {
      $stmt->execute();
    }
  }
  $db = null;

}
catch(PDOException $e)
{
  die('Exception : '.$e->getMessage());
}

header("Location: ./deckEditor.php");
?>

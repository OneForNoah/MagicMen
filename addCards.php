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
    $stmt = $db->prepare('INSERT INTO Decklists (deckID, cardID, numOf) VALUES (:deckID, :cardID, :numOf);');
    $stmt->bindParam(':deckID', $deckID);
    $stmt->bindParam(':cardID', $cardID);
    $stmt->bindParam(':numOf', $numOf);


    $deckID=$deck_id;
    echo $target;
    $idcre = $db->query('SELECT cardID FROM creatures  WHERE cardName="$target"');
    $idnonc = $db->query('SELECT cardID FROM creatures  WHERE cardName="$target"');
    if(empty($idcre)) {
      $cardID = $idnonc->fetchColumn(0);
    } else {
      $cardID = $idcre->fetchColumn(0);
    }
    echo $cardID;
    //$num = $db->query("SELECT numOf FROM Decklists WHERE cardID='$cardID' AND deckID='$deckID';");
    $numOf = 1; //$num->fetchColumn(0);

    $stmt->execute();
  }
  $db = null;

  }
  catch(PDOException $e)
  {
    die('Exception : '.$e->getMessage());
  }

  header("Location: ./deckEditor.php");
?>
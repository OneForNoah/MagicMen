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
  $cards = explode('\n', $_POST['cardList']);

  foreach($cards as $target)
  {
    $stmt = $db->prepare('INSERT INTO Decklists (deckID, playerID, cardID, cardName, numOf) VALUES (:deckID, :playerID, :cardID, :cardName, :numOf);');
    $stmt->bindParam(':deckID', $deckID);
    $stmt->bindParam(':playerID', $playerID);
    $stmt->bindParam(':cardID', $cardID);
    $stmt->bindParam(':cardName', $cardName);
    $stmt->bindParam(':numOf', $numOf);


    $deckID=$deck_id;
    $playid = $db->query("SELECT playerID FROM DeckInfo WHERE deckID='$deckID';");
    $playerID = $playid->fetchColumn(0);

    $idnonc = $db->query("SELECT cardID, cardName FROM nonCreatures WHERE cardName='$target';");
    $idcre = $db->query("SELECT cardID, cardName FROM creatures WHERE cardName='$target';");
    //echo $idcre->fetchColumn(0);
    if(empty($idcre->fetchColumn(0)) && empty($idnonc->fetchColumn(0))) {
      die("Exception : '$target' Card name not valid");
    } else if(empty($idnonc)) {
      foreach($idcre as $tuple)
      {
        $cardID = $tuple['cardID'];
        $cardName = $tuple['cardName'];
      }
    } else {
      foreach($idnonc as $tuple)
      {
        $cardID = $tuple['cardID'];
        $cardName = $tuple['cardName'];
      }
    }
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

  header("Location: ./deckBuilder.php");
?>
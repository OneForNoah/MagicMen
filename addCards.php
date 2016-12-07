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
    $copies = substr($target, 0, 1);
    $target = substr($target, 2);

    $stmt = $db->prepare('INSERT INTO Decklists (deckID, playerID, cardID, cardName, numOf) VALUES (:deckID, :playerID, :cardID, :cardName, :numOf);');
    $stmt->bindParam(':deckID', $deckID);
    $stmt->bindParam(':playerID', $playerID);
    $stmt->bindParam(':cardID', $cardID);
    $stmt->bindParam(':cardName', $cardName);
    $stmt->bindParam(':numOf', $numOf);

    $deckID=$deck_id;
    $playid = $db->query("SELECT playerID FROM DeckInfo WHERE deckID='$deckID';");
    $playerID = $playid->fetchColumn(0);

    $idcre = $db->query("SELECT cardID, cardName FROM creatures WHERE cardName='$target';");
    $rescobj = $idcre->fetch(PDO::FETCH_OBJ);
    $resccid = $rescobj->cardID;
    $resccn = $rescobj->cardName;

    $idnonc = $db->query("SELECT cardID, cardName FROM nonCreatures WHERE cardName='$target';");
    $resnobj = $idnonc->fetch(PDO::FETCH_OBJ);
    $resncid = $resnobj->cardID;
    $resnccn = $resnobj->cardName;
    
    if(empty($resncid) && empty($resccid)) {
      die("Exception : '$target' Card name not valid");
    } else if(empty($resncid)) {
      $cardID = $resccid;
      $cardName = $resccn;
    } else {
      $cardID = $resncid;
      $cardName = $resnccn;
    }

    $numOf = $copies;

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

  header("Location: ./deckBuilder.php");
?>
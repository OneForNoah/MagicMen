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

    $idnonc = $db->query("SELECT cardID, cardName FROM nonCreatures WHERE cardName='$target';");
    $idcre = $db->query("SELECT cardID, cardName FROM creatures WHERE cardName='$target';");
    //echo $idcre->fetchColumn(0);

    $res = $idnonc->fetch(PDO::FETCH_OBJ);
    if(!isset($result->id_email)) {
      die("Exception : '$target' Card name not valid");
    } else if( $idcre->rowCount() > 0 ) {
      echo "made it into creature insert";
      foreach($idcre as $tuple)
      {
        $cardID = $tuple['cardID'];
        echo $cardID;
        $cardName = $tuple['cardName'];
        echo $cardName;
      }
    } else {
      echo "made it into noncreature insert";
      foreach($idnonc as $tuple)
      {
        $cardID = $tuple['cardID'];
        echo $cardID;
        $cardName = $tuple['cardName'];
        echo $cardName;
      }
    }
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

  //header("Location: ./deckBuilder.php");
?>
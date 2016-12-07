<?php
  try
  {
    $required = array('deckID', 'cardList');
    $error = false;
    foreach($required as $field) {
      if (empty($_POST[$field])) {
        $error = true;
      }
    }
    if ($error) {
      echo "Deck ID is required";
      header("Location:newDeck.html");
		}

	 }
	  catch(PDOException $e)
	 {
     die('Exception : '.$e->getMessage());
   }

   //redirect user to another page now
	 header("Location: deckEditor.html");
?>

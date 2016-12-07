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
        <li><a href=deckBuilder.php><div id="navbar">Deck Builder</div></a></li>
        <li><a href="playgame.php"><div id="navbar">Play a Game</div></a></li>
        <li><a href="search.html"><div id="navbar">Search</div></a></li>
      </div>
    </ul>
  </div>
  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
    <!--  <a href="newDeck.html"><button>draw a card</button></a>-->
      <?php
      try
      {
        //open the sqlite database file
        $db = new PDO('sqlite:./database/mtgcard.db');

        // Set errormode to exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //safely insert values into passengers table
        $deck = $db->query("SELECT cardID FROM Decklists WHERE deckID=1;");
        //shuffle($deck);
        echo $deck->fetchColumn(0);
        $rows = $db->query("SELECT deckSize FROM DeckInfo WHERE deckID=1;");
        for($i = 1; $i <= $rows->fetchColumn(0); $i++) {

          //get the name of the current card
          $name = $db->query("SELECT cardName FROM nonCreatures NATURAL JOIN creatures WHERE cardID='$card[cardID]'");
          echo  $name->fetchColumn(0);
          //get the manacost
          $mana = $db->query("SELECT manacost FROM nonCreatures NATURAL JOIN creatures WHERE cardID='$card[cardID]'");
          echo  $mana->fetchColumn(0);
          //get the color
          $color = $db->query("SELECT color FROM nonCreatures NATURAL JOIN creatures WHERE cardID='$card[cardID]'");
          echo  $color->fetchColumn(0);
          //get the cardType
          $type = $db->query("SELECT cardType FROM nonCreatures NATURAL JOIN creatures WHERE cardID='$card[cardID]'");
          echo  $type->fetchColumn(0);
          //get the get the cardText
          $text = $db->query("SELECT cardText FROM nonCreatures NATURAL JOIN creatures WHERE cardID='$card[cardID]'");
          echo  $text->fetchColumn(0);
          //if a creature, get power and toughness too!!
          //  $doIfStatement = $db->query("SELECT cardType FROM nonCreatures NATURAL JOIN creatures WHERE cardID='$deck[cardID]' AND LIKE '%creature'%");

          //get the power
          $pow = $db->query("SELECT power FROM creatures WHERE cardID='$deck[cardID]'");
          //get the toughness
          $tough = $db->query("SELECT toughness FROM creatures WHERE cardID='$deck[cardID]'");
          //put everything together in one variable with line breaks where appropriate
          if(empty($pow)){
            $total = $name + "\r\n" + $mana + "\r\n" + $type + "  " + $color + "\r\n" + $text;
          } else {
            $total = $name + "\r\n" + $mana + "\r\n" + $type + "  " + $color + "\r\n" + $pow + "/" + $tough + "\r\n" + $text;
          }
          echo '<head>';
          echo '<meta charset="utf-8" />';
          echo '<title>jQuery UI Draggable - Default functionality</title>';
          echo '<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />';
          echo '<script src="http://code.jquery.com/jquery-1.9.1.js"></script>';
          echo '<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>';
          echo '<link rel="stylesheet" href="/resources/demos/style.css" />';
          echo '<style>';
          echo '#draggable { width: 150px; height: 150px; padding: 0.5em; }';
          echo '</style>';
          echo '<script>';
          echo '$(function() {';
            echo '  $( "#draggable" ).draggable();';
            echo '});';
            echo '</script>';
            echo '</head>';

            echo '<div id="draggable" class="ui-widget-content">';
            echo '    <p>$total</p>';
            echo '</div>';

            $db = null;
          }
        }
        catch(PDOException $e)
        {
          die('Exception : '.$e->getMessage());
        }
        ?>

      </div>
    </div>
    <footer id="myFooter">
      <div id="footer" class="w3-container w3-theme-l2 w3-padding-16">
        <h6>Designed by Trevor Nunn, Noah Reyes, Alden Walsh, and Andy Van Heuit.
          <p>
            All cards and art belongs to Wizards of the Coast.
          </h6>
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

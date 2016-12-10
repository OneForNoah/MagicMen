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
    </div>
  </ul>
</div>
  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h2>New Deck</h2>
       <?php
        try
        {
          //open the sqlite database file
          $db = new PDO('sqlite:./database/mtgcard.db');

          // Set errormode to exceptions
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //safely insert values into passengers table
          $result = $db->query("SELECT max(deckID) FROM DeckInfo");
          $id = $result->fetchColumn(0);
          $id++;
          //echo ''+$id;
          $db = null;
          echo '<FORM METHOD=POST ACTION="makeDeck.php">';
          echo '<P>Title: <input name="deckTitle" size="32">';
          echo '<P>UserName: <input name="usern" size="32">';
          echo '<input type="hidden" name="deck_id" value="$id">';
          echo '<P><INPUT TYPE=SUBMIT> <INPUT TYPE=RESET>';
          echo '</FORM>';
          //disconnect from database
          
        }
        catch(PDOException $e)
        {
          die('Exception : '.$e->getMessage());
        }

        //redirect user to another page now
        //header("Location: login.html");
        ?>
      
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

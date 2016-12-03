<?php
        try
        {
                $required = array('command1', command2');
                $error = false;
                foreach($required as $field) {
                        if (empty($_POST[$field])) {
                                $error = true;
                        }
                }
                if ($error) {
                        echo "SELECT and FROM are required fields.";
                        header("Location:textBox.html");
                }

                //open the sqlite database file
                $db = new PDO('sqlite:./database/airport.db');

                // Set errormode to exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //order matters -- SELECT > FROM > WHERE
                $stmt = $db->prepare("SELECT " + $command1 + " FROM " + $command2 + " WHERE " + $command3);
                $stmt->bindParam(':command1', $command1);
                $stmt->bindParam(':command2', $command2);
                $stmt->bindParam(':command3', $command3);

                $notrequired = 'command3';
                if(empty($_POST[$notrequired])) {
                        $command1 = $_POST[command1];
                        $command1 = $_POST[command2];
                        $command3 = null;
                } else {
                        $command1 = $_POST[command1];
                        $command1 = $_POST[command2];
                        $command3 = $_POST[command3];
                }
                echo($stmt);
                //$db->exec($stmt);
                $stmt->execute();

                //disconnect from database
                $db = null;
        }
        catch(PDOException $e)
        {
            die('Exception : '.$e->getMessage());
        }

        //redirect user to another page now
        //header("Location: successfulInsert.html");
?>


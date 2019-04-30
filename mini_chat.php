<?php
session_start();

if ($_POST) { $_SESSION['pseudo'] = $_POST['pseudo']; } 

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/> 
  <title>Mini_Chat</title>
    </head>
       
       <style >
          form
            {
          text-align:center;
            }
       </style>  
           
           <body>   
              <form action="mini_chat_post.php" method="post">
              <p>

              <label for="pseudo">Pseudo</label> :<input type="text" name="pseudo" value="'<?php if (isset($_SESSION['pseudo'])){ echo $_SESSION['pseudo'];} ?> '"  /> <br/>
              <label for="message">Message</label> : <input type="text" name="message" id="message" /><br />
              <input type="submit" value="Envoyer" />
            </p>
              </form>
                    
                    <?php 

                       try 
                       {
                           $bdd= new PDO ('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root' , '' );
                       }
                       catch(Exception $e)
                       {
                        die('Erreur:'. $e->getMessage());
                       }

                           $reponse=$bdd->query('SELECT pseudo,message,DATE_FORMAT(date_post, \'Le %d/%m/%Y à %Hh %imin %ss\') AS date_post_fr FROM mini_chat ORDER BY ID DESC  LIMIT 0,10');

                           while ($donnees = $reponse->fetch())

                            {
                             echo  '<p> ['. htmlspecialchars($donnees['date_post_fr']). ']'  .  ' <strong>'. htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
                            }

                            $reponse->closeCursor();

                    ?>
           </body>
</html>
<?php

session_start(); 
   if(isset($_SESSION['pseudo']))
       { 
        $_SESSION['pseudo'] = $_POST['pseudo']; 
       }

    try
     {
       $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
     }
    catch(Exception $e)
     {
        die('Erreur : '.$e->getMessage());
     }


         $req = $bdd->prepare('INSERT INTO mini_chat (pseudo, message, date_post) VALUES(?, ?, NOW())');
         $req->execute(array($_SESSION['pseudo'], $_POST['message']));


         header('Location: mini_chat.php');
?>
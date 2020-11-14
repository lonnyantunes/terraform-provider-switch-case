<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';


function validate(PDO $PDO){
    if(!isset($_POST["title"]) || empty($_POST["title"])) {
        echo '<p style="color: red; font-weight: bold;">Il manque le titre de l\'article</p>';
    }
    elseif(!isset($_POST["title"]) || empty($_POST["author"])) {
        echo '<p style="color: red; font-weight: bold;">Il manque le nom de l\'auteur de l\'article</p>';
    }
    elseif(!isset($_POST["content"]) || empty($_POST["content"])) {
        echo '<p style="color: red; font-weight: bold;">Il manque le contenu de l\'article</p>';
    }else{
        $request = $PDO->prepare("INSERT INTO articles (title, author, content) VALUES (:title, :author, :content)");
        $request->bindValue(":title", $_POST["title"]);
        $request->bindValue(":author", $_POST["author"]);
        $request->bindValue(":content", $_POST["content"]);
        $request->execute();
        header('Location: index.php'); 
    }

    echo '<p><a href="index.php">accueil</a></p>';
   
}

$PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options);
validate($PDO);
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db-config.php';

function getArticles(PDO $PDO)
{
  $sql = "SELECT * FROM articles ORDER BY id DESC";
  $result = $PDO->query($sql);

  $articles = $result->fetchAll(PDO::FETCH_ASSOC);

  $result->closeCursor();

  return $articles;
}
?>





<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Ma propre image Docker !</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Bootstrap core CSS -->
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="navbar-top-fixed.css" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">sample</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Accueil</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Articles <span class="sr-only">(current)</span></a>
        </li>

      </ul>
    </div>
  </nav>

  <main role="main" class="container">

    <h1 class="mt-5">Articles (machine <?= gethostname() ?>)</h1>

    <hr>

    <h2 class="mt-5 mb-3">Nouveau article</h2>


    <form action="validation.php" method="post">
      <div class="form-group">
        <label for="title">Titre <span style="color: red; font-weight: bold;">*</span></label>
        <input type="text" class="form-control" id="title" name="title" placeholder="titre de votre article" required="required">
      </div>

      <div class="form-group">
        <label for="author">Nom de l'auteur <span style="color: red; font-weight: bold;">*</span></label>
        <input type="text" class="form-control" id="author" name="author" placeholder="Nom de l'auteur" required="required">
      </div>
      
      <div class="form-group">
        <label for="content">Contenu <span style="color: red; font-weight: bold;">*</span></label>
        <textarea class="form-control" id="content" name="content" rows="3" required="required"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <hr>

    <h2 class="mt-5 mb-5">Liste d'articles</h2>

    <?php
    try {
      $PDO = new PDO(DB_DSN, DB_USER, DB_PASS, $options);

      $articles = getArticles($PDO);
      foreach ($articles as $article) {
        $articleTime = date("d/m/y H:i", strtotime($article["date"]));
        ?>
        <div class="card mt-5">
          <div class="card-header">
            <h2 class="h3"><?= $article["title"] ?> <small class="text-muted font-italic"></h2>
            <?= $articleTime ?></small>
          </div>
          <div class="card-body">
            <p class="card-text"><?= $article["content"] ?></p>
            <footer class="blockquote-footer"><cite title="Source Title"><?= $article["author"] ?><cite></footer>
          </div>
        </div>
      <?php
      }
    } catch (PDOException $pe) {
      echo 'ERREUR :', $pe->getMessage();
    }
    ?>

  </main>

  <footer class="page-footer font-small bg-dark mt-5">
    <div class="footer-copyright text-center py-3 text-white">© Copyright:
      <a href="#"> MonAppDocker</a>
    </div>
  </footer>

</body>

</html>

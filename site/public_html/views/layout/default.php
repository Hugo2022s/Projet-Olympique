<!doctype html>
<html lang="fr">
<head>
  <base href="https://projetbloc3.com">
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tinos&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/atelier.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jeux Olympiques</title>
</head>
<body>
  
  <div class="transition transition-3 is-active"></div>

  <header>
    <div class="main-head">
      <div class="small-head-left">
        <a href="offres" class="main-title">Offres Disponibles</a>
      <?php if(isset($_SESSION["login_email"]) && isset($_SESSION["login_password"])){
      ?><a href="panier" class="panier">Panier</a><?php
      }?>  
      </div>
      <a class="accueillink" href="https://projetbloc3.com">
        <img src="assets/img/emblemeparis1.png" alt="Logo des JO de Paris" id="logo"/>
      </a>
      <?php if(!isset($_SESSION["login_email"]) && !isset($_SESSION["login_password"]) && !isset($_SESSION["admin_email"]) && !isset($_SESSION["admin_password"])){
      ?><a href="inscription" class="main-title">Connexion / Inscription</a><?php
      }?>
      <?php if(isset($_SESSION["login_email"]) && isset($_SESSION["login_password"])){
      ?>
      <div class="small-head-right">
        <a href = "logout" class="deconnect">Déconnexion</a>
        <a href = "profil" class="user-profil">Profil</a>
      </div>  
      <?php
      }?>
      <?php if(isset($_SESSION["admin_email"]) && isset($_SESSION["admin_password"])){
      ?>
      <div class="small-head-right">
        <a href = "logout" class="deconnect">Déconnexion</a>
        <a href = "config" class="user-profil">Configuration</a>
      </div>  
      <?php
      }?>
    </div>
  </header>

  <main>
    <?= $content ?>
  </main>

<footer>
<div class="bas_de_page">
  <h4 class="ipad-size">Copyright 2024. Tous droits réservés</h4>
  <div class="social">
    <h4 class="socialtitre" id="hide-mobile">Suivez nous sur:</h4>
    <a href="https://www.facebook.com/Paris2024/">
      <i class="fa-brands fa-square-facebook"></i>
    </a>
    <a href="https://twitter.com/Paris2024">
      <i class="fa-brands fa-x-twitter"></i>
    </a>
    <a href="https://www.instagram.com/paris2024/">
      <i class="fa-brands fa-instagram"></i>
    </a>
    <a href="https://www.youtube.com/channel/UCg4W1uf-i5X1nVaeWJsKuyA/videos">
      <i class="fa-brands fa-youtube"></i>
    </a>
    <a href="https://www.tiktok.com/@paris2024officiel?is_copy_url=1&is_from_webapp=v1">
      <i class="fa-brands fa-tiktok"></i>
    </a>
    <a href="https://www.linkedin.com/company/paris-2024-olympic-and-paralympic-games-bid/">
      <i class="fa-brands fa-linkedin"></i>
    </a>
    <a href="https://www.threads.net/@paris2024">
      <i class="fa-brands fa-threads"></i>
    </a>
  </div>
  <h4 class="ipad-size" id="hide-mobile">+33 805 08 12 30</h4>
  <h4 class="ipad-size" id="hide-mobile"><a href="https://olympics.com/fr">Olympics.com</a></h4>
  <h4 class="ipad-size" id="hide-mobile">Paris2024hospitalityservice@onlocationexp.com</h4>
</div>  
</footer>

<script src="https://kit.fontawesome.com/39a3a8866f.js" crossorigin="anonymous"></script>
<script src="assets/javascript/script.js"></script>
</body>
</html>
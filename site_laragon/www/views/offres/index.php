<div class="container-all-offres">
<?php foreach($info_off as $info): ?>              
    <form method="post" class="banner-offres">
        <img src="assets/img/parislogo.jpg" alt="logo des JO de Paris">
        <p class="offres-banner"><?= htmlspecialchars($info['off_cat'], ENT_QUOTES, 'UTF-8') ?></p>
        <div class="content">
            <p class="offres"><?= htmlspecialchars($info['off_descrip'], ENT_QUOTES, 'UTF-8') ?></p>
            <p class="offres_prix"><?= htmlspecialchars($info['off_prix'], ENT_QUOTES, 'UTF-8') ?>€</p>
			<?php if(isset($_SESSION["login_email"]) && isset($_SESSION["login_password"])){
      		?>
            <input type="hidden" name="off_cat" value="<?= htmlspecialchars($info['off_cat'], ENT_QUOTES, 'UTF-8') ?>">
            <input type="hidden" name="off_prix" value="<?= htmlspecialchars($info['off_prix'], ENT_QUOTES, 'UTF-8') ?>">
            <button name="offre" type="submit">Acheter</button>
			<?php
      }?>
        </div>
    </form>
<?php endforeach; ?>
</div>
<script type="text/javascript" src="assets/javascript/vanilla-tilt.js"></script>
  <script type="text/javascript">
	  VanillaTilt.init(document.querySelectorAll(".banner-offres"), {
	  max: 25,
		speed: 400
	});
</script>

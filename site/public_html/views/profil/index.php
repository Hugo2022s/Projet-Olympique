<base href="https://projetbloc3.com">
<?php require_once 'auth_check.php';?>
<?php $_SESSION["login_id"] = $info_uti['uti_id'];?>
<div class="profil-uti">
        <h2 class="titre-latelier">Bienvenue <?=$info_uti['uti_prenom']?> !</h2>
        <div class="profil-utisub">
                <p class="texte-latelier">Nom : <?=$info_uti['uti_nom']?></p>
                <p class="texte-latelier">Email : <?=$info_uti['uti_email']?></p>    
        </div>                 
</div>                      
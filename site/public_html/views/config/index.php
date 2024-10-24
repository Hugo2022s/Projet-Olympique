<base href="https://projetbloc3.com">
<?php require_once 'auth_check.php'; ?>
<?php $_SESSION["admin_id"] = $info_ad['ad_id']; ?>

<div class="profil-uti">
    <h2 class="titre-latelier">Bienvenue <?=$info_ad['ad_prenom']?> !</h2>
    <div class="profil-utisub">
        <p class="texte-latelier">Nom : <?=$info_ad['ad_nom']?></p>
        <p class="texte-latelier">Email : <?=$info_ad['ad_email']?></p>    
    </div>                 
</div>     

<div class="admin-form">
    <form method="POST">
        <h2 class="admin-title">Ajouter une offre</h2>
        <label for="add_off_cat">Catégorie:</label>
        <input class="admin-input-css" type="text" id="add_off_cat" name="off_cat" minlength="5" maxlength="20" required>
        
        <label for="add_off_prix">Prix:</label>
        <input class="admin-input-css" type="number" id="add_off_prix" name="off_prix" step="0.01" minlength="1" maxlength="4" required>
        
        <label for="add_off_descrip">Description:</label>
        <textarea class="admin-input-css" id="add_off_descrip" name="off_descrip" rows="4" minlength="5" maxlength="100" required></textarea>
        
        <input class="submitadmin" type="submit" name="offSubmit" value="Ajouter Offre">
    </form>
</div> 

<div class="admin-form">       
    <form method="POST">
        <h2 class="admin-title">Effacer une offre</h2> 
        <input type="hidden" name="offDelete" value="1">
        <select class="admin-input-css" name="off_cat">
            <?php
                foreach ($lire_off as $category) {
                    echo "<option value='" . htmlspecialchars($category['off_cat']) . "'>" . htmlspecialchars($category['off_cat']) . "</option>";
                }
            ?>
        </select>
        <input class="submitadmin" type="submit" value="Supprimer Offre">
    </form>   
</div>

<div class="admin-form">  
    <form method="post">
        <h2 class="admin-title">Modifier une offre</h2> 
        
        <select class="admin-input-css" id="select_cat" name="off_cat" onchange="updateFields(this.value)">
            <?php
                foreach ($lire_off as $category) {
                    echo "<option value='" . htmlspecialchars($category['off_cat']) . "'>" . htmlspecialchars($category['off_cat']) . "</option>";
                }
            ?>
        </select>

        <label for="mod_off_prix">Prix:</label>
        <input class="admin-input-css" type="number" id="mod_off_prix" name="off_prix" step="0.01" required>

        <label for="mod_off_descrip">Description:</label>
        <textarea class="admin-input-css" id="mod_off_descrip" name="off_descrip" rows="4" cols="50" required></textarea>

        <input class="submitadmin" type="submit" name="offModif" value="Modifier Offre">
    </form> 
</div>

<div class="admin-list">
<h2 class="admin-title">Ventes</h2>
<?php
if ($config_ach) {
    foreach ($config_ach as $category) {
        echo "<p class='admin-title'> Catégorie: " . htmlspecialchars($category['ach_cat']) . ", Vente(s): " . htmlspecialchars($category['category_count']) . "</p>";
    }
} else {
    echo "Aucune catégorie n'a été trouvée.";
}
?>
</div>

<script>
function updateFields(category) {

    const offers = <?php echo json_encode($info_off); ?>;

    const selectedOffer = offers.find(offer => offer.off_cat === category);

    if (selectedOffer) {
        document.getElementById('mod_off_prix').value = selectedOffer.off_prix;
        document.getElementById('mod_off_descrip').value = selectedOffer.off_descrip;
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const firstCategory = document.getElementById('select_cat').value;
    updateFields(firstCategory);
});
</script>

     

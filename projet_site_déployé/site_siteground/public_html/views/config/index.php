<base href="https://projetbloc3.com">
<?php require_once 'auth_check.php';?>
<?php $_SESSION["admin_id"] = $info_ad['ad_id'];?>
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
        <label for="off_cat">Catégorie:</label>
        <input class="admin-input-css" type="text" id="off_cat" name="off_cat" minlength="5" maxlength="20" required>
        
        <label for="off_prix">Prix:</label>
        <input class="admin-input-css" type="number" id="off_prix" name="off_prix" minlength="1" maxlength="4" required>
        
        <label for="off_descrip">Description:</label>
        <textarea class="admin-input-css" id="off_descrip" name="off_descrip" rows="4" minlength="5" maxlength="100" required></textarea>
        
        <input class="submitadmin" type="submit" name="offSubmit" value="Ajouter Offre">
    </form>
</div> 
<div class="admin-form">       
<form method="POST">
    <h2 class="admin-title">Effacer une offre</h2> 
    <input type="hidden" name="offDelete" value="1">
    <select class="admin-input-css" name="off_cat">
        <?php
            // Assuming $categories is an array containing all categories fetched from the database
            foreach ($lire_off as $category) {
                echo "<option value='" . $category['off_cat'] . "'>" . $category['off_cat'] . "</option>";
            }
        ?>
    </select>
    <input class="submitadmin" type="submit" value="Supprimer Offre">
</form>   
</div>
<div class="admin-form">  
<form method="post">
    <h2 class="admin-title">Modifier une offre</h2> 
    <select class="admin-input-css" name="off_cat">
        <?php
            // Assuming $categories is an array containing all categories fetched from the database
            foreach ($lire_off as $category) {
                echo "<option value='" . $category['off_cat'] . "'>" . $category['off_cat'] . "</option>";
            }
        ?>
    </select>

    <label for="off_prix">Prix:</label>
    <input class="admin-input-css" type="number" id="off_prix" name="off_prix" minlength="1" maxlength="4" required>

    <label for="off_descrip">Description:</label>
    <textarea class="admin-input-css" id="off_descrip" name="off_descrip" rows="4" cols="50" minlength="5" maxlength="100" required></textarea>

    <input class="submitadmin" type="submit" name="offModif" value="Modifier Offre">
</form> 
</div>
<div class="admin-list">
<h2 class="admin-title">Ventes</h2>
<?php

// Check if there are categories returned
if ($config_ach) {
    // Iterate over each category and its count
    foreach ($config_ach as $category) {
        // Output the category and its count
        echo "<p class'admin-title'> Catégorie: " . $category['ach_cat'] . ", Vente(s): " . $category['category_count'] . "</p>";
    }
} else {
    // Handle the case when there are no categories
    echo "Aucune catégorie n'a été trouvée.";
}
?>
</div>
     

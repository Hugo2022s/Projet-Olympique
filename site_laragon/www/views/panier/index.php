<?php require_once 'auth_check.php';?>
<?php
require 'vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
?>
<?php foreach($info_panier as $info): ?> 
    <div class="profil-uti">
                <h2 class="titre-latelier">Offre <?=$info['ach_cat']?></h2>
                <div class="profil-subcolumn">
                    <div class="profil-utisub">
                        <p class="texte-latelier">Prix : <?=$info['ach_prix']?>€</p>  
                        <p class="texte-latelier">ID : <?=$info['ach_id']?></p>
                    </div>      
                        <?php

// Combinez les valeurs de $user_cle['uti_cle'] et $achat_cle['ach_cle']

$data = $info['uti_cle'] . '-' . $info['ach_cle'];

// Générer un nom de fichier unique basé sur les données combinées
$hashedData = md5($data);  // Utiliser md5 pour créer un hachage unique basé sur les données
$fileName = 'qrcode_' . $hashedData . '.png';

$savePath = 'assets/qrcode/' . $fileName;

// Assurez-vous que le répertoire 'assets/qrcode' existe et est accessible en écriture.
if (!is_dir('assets/qrcode')) {
    mkdir('assets/qrcode', 0755, true);
}

$builder = Builder::create()
    ->writer(new PngWriter())
    ->data($data)  // Utilisez les données combinées pour le code QR
    ->size(300)
    ->margin(10)
    ->build();

$builder->saveToFile($savePath);

echo '<img src="' . $savePath . '" alt="QR Code">';
?>     
                </div>                 
    </div>  
<?php endforeach;?>           
      
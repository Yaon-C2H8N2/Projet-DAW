<?php

include "../app/models/User.php";
include "../app/models/DBManage.php";
include "../app/models/Utility.php";


if (!isset($_FILES['img'])) {
    echo "Aucune image reçue";
    exit();
}
$image = $_FILES['img'];

if(modifyImgProfile($image)){
    echo "Photo de profil modifiée avec succès";
} else {
    echo "Erreur lors de la modification de la photo de profil";
}



<?php
include("../Parties/Classes.php");
//connexion à la base de données
$conn = new SQLconn();
//récupération du numéro du dernier commentaire affiché
$comNumber = $_GET["firstComment"];
$post_id=$_GET["post_id"];
// Récupération des id des coms
$com_id_list = $conn->getComsByDate($post_id);

// Suppression des posts déjà affichés
for ($i = 0; $i < $comNumber; $i++) {
    array_shift($com_id_list);
}

for ($i = 0; $i < count($com_id_list); $i++) {
    $com_id = $com_id_list[$i];
    $com_data=$conn->getComData($com_id);
    $com_text=$com_data['comment_text'];
    $com_time=$com_data['created_time'];
    echo (isset($com_text) ? $com_text . " <br> " . (isset($com_time)? $com_time : '') : ''); 
    echo "<br>";
}

//deconnexion de la base de données
$conn->closeDB();
?>

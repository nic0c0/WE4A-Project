<?php
include("../Parties/Classes.php");
//conexion à la base de données
$conn = new SQLconn();
//récupération du numéro du dernier post affiché
$postNumber = $_GET["firstPost"];
// Récupération des id des posts
$post_id_list = $conn->getPostsByDate();
// Suppression des posts déjà affichés
for ($i = 0; $i < $postNumber; $i++) {
    array_shift($post_id_list);
  }
// Récupération des données des 5 premiers posts
if (!empty($post_id_list)) {
    for ($i = 0; $i < 5; $i++) {
        if (isset($post_id_list[$i])) {
            $post_id = $post_id_list[$i];
            include "../Parties/post.php";
        } else {
            break;
        }
    }
}


//deconnexion de la base de données
$conn->closeDB();

?>

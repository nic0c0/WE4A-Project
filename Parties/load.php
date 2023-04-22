<?php
include("../Parties/Classes.php");
//conexion à la base de données
$conn = new SQLconn();
//récupération du numéro du dernier post affiché
$postNumber = $_GET["firstPost"];

// Récupération des id des posts
$post_id_list = $conn->getPostsByDate();
//si on veut afficher les posts d'un utilisateur particulier
if (isset($_GET['moreInfo'])) {
    $user_id = $_GET['moreInfo'];
    $filtered_posts = array();
    foreach ($post_id_list as $post_id) {
        $poster_user = $conn->getUserIdFromPostId($post_id);
        if ($poster_user == $user_id) {
            $filtered_posts[] = $post_id;
        }
    }
    $post_id_list = $filtered_posts;
}

// Suppression des posts déjà affichés
for ($i = 0; $i < $postNumber; $i++) {
    array_shift($post_id_list);
}
// Affichage des posts 1 par 1 car on ne connait pas le nombre de posts déja affiché donc pb quand nb de posts impairs( affichage d'un doublon souvent si 2 en 2)
if (isset($post_id_list[0])) {
    $post_id = $post_id_list[0];
    include "../Parties/post.php";
}


// Récupération des données des 5 premiers posts



//deconnexion de la base de données
$conn->closeDB();

?>
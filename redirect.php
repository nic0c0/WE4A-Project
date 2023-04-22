<?php include("./Parties/Classes.php") ?>

<?php
$cook = new Cookie();

if (!$cook->CheckIntegrity()) {
    header("Location: ./Index.php?PBINTEG");
    $cook->clean();
} else {
    $conn = new SQLconn();

    isset($_POST['path']) ? $path = $_POST['path'] : $path = 'NOPATH';

    switch ($path) {
        case 'action.php':
            if (isset($_POST['delete'])) {
                $post_id = $_POST['post_id'];
                $conn->deletePost($post_id);
            }
            header("Location: index.php");
            exit();

        case 'comment.php':
            //on traite les infos pour le commentaire
            if (isset($_POST['com'])) {
                //Récupération des données du form : 
                $post_id = $_POST['post_id'];
                $user_id = $_POST['user_id'];
                $commenter = $_POST['commenter']; //commentateur
                $com_text = $_POST['comment_text'];
                $conn->insertComment($commenter, $post_id, $com_text);
            }
            if (isset($_POST['like'])) {
                $post_id = $_POST['post_id'];
                $user_id = $_POST['user_id'];
                $info = $conn->getLikeUserId($user_id, $post_id);
                if ($info) {
                    $conn->deleteLike($user_id, $post_id);
                } else {
                    $conn->addLike($user_id, $post_id);
                }
            }
            header("Location: $path?post_id=$post_id");
            exit();
        case 'poster.php': //path utilise basename(__FILE__) donc il va ressortir poster.php
            //on traite les infos quand on rajoute un post depuis l'index
            if (isset($_POST['save'])) {
                //Récupération des données du form :
                $post_title = $_POST['post_title'];
                $post_text = $_POST['post_text'];
                $user_id = $_POST['user_id'];
                isset($_POST['request']) ? $request = $_POST['request'] : $request = false;
                if ($request) {
                    //sauvegarde de l'image
                    $name = $conn->getPostData($request)['post_img'];
                    $test = isset($_FILES['post_img']) && $_FILES['post_img']['size'] != 0 ? "newimg" : "noimg";
                    isset($_FILES['post_img']) && $_FILES['post_img']['size'] != 0 ? $post_img = saveImageAsNew($user_id, false, $request, $name) : $post_img = $name;
                } else {
                    //sauvegarde de l'image
                    $postid = $conn->getUserPostCount($user_id);
                    $name = null;
                    $post_img = saveImageAsNew($user_id, false, $postid, $name);
                }
                //Mise à jour de la base de données
                $request ? $conn->updatePost($request, $user_id, $post_title, $post_text, $post_img) : $conn->insertPost($user_id, $post_title, $post_text, $post_img);
            }
            $request ? $path = "comment.php?post_id=$request&$test" : $path = "index.php";
            header("Location: $path");
            exit();
        case 'Settings.php':
            //on traite les infos pour les settings
            //si c'est un changement dans le profil
            if (isset($_POST['save'])) {
                $user_email = $_POST['user_email'];
                $user_name = $_POST['user_name'];
                $user_surname = $_POST['user_surname'];
                $user_desc = $_POST['user_desc'];
                $user_id = $_POST['user_id'];
                $path = $_POST['path'];

                // Chargement de l'image de profil
                $user_pp = $_POST['user_pp'];
                if (isset($_FILES['new_pp']) && $_FILES['new_pp']['size'] != 0) {
                    $new_pp = saveImageAsNew($user_id, true, 0, null);
                    if ($new_pp) {
                        $user_pp = $new_pp;
                    }
                }
                // Mise à jour des données utilisateur dans la base de données
                $conn->updateProfile($user_id, $user_email, $user_pp, $user_name, $user_surname, $user_desc);
                $error = "";
            }
            //si c'est un changement de mot de passe
            if (isset($_POST['ChangePassword'])) {
                $OLDPASSWORD = htmlentities($_POST["oldpassword"]);
                $PASSWORD1 = htmlentities($_POST["password1"]);
                $PASSWORD2 = htmlentities($_POST["password2"]);
                $test = $OLDPASSWORD;
                if ($conn->CheckDB($cook->getUsername(), $OLDPASSWORD)) {

                    if ($PASSWORD1 == $PASSWORD2) {

                        $hash = EncryptedPassword($PASSWORD1);
                        $conn->updatePassword($cook->getUsername(), $hash);
                        $cook->UpdatePassword(EncryptedPassword($cook->getUsername()));

                    } else {
                        $error = "error_password1"; //les mdp ne correspondent pas
                    }
                } else {
                    $error = "error_password2"; //mdp incorrect
                }


            }
            !$save = isset($_POST['save']);
            !$cp = isset($_POST['ChangePassword']);
            header("Location: $path?$error");
            exit();

        case 'card.php': //path utilise basename(__FILE__) donc il va ressortir card.php
            //on traite les infos pour le profil
            if (isset($_POST['follow'])) {
                $user_id = $_POST['user_id'];
                $this_user = $_POST['this_user_id'];
                $user_pseudo = $conn->getUserPseudo($user_id);
                if ($conn->checkFollow($this_user, $user_id)) {
                    $error = "unfollow";
                    $conn->unfollow($this_user, $user_id);
                } else {
                    $error = "follow";
                    $conn->follow($this_user, $user_id);
                }
            }
            header("Location: ./Profil.php?user_pseudo=" . $user_pseudo);
            exit();
        case 'header.php':
            if (isset($_POST['voir_post'])) {
                $suggestField = $_POST['suggestField'];

                if ($conn->UserExist($suggestField) || $conn->PostExist($suggestField)) {
                    if ($conn->PostExist($suggestField)) {
                        $post_id = $conn->getPostId($suggestField);
                        $path = "./comment.php?post_id=" . $post_id;
                    }

                    var_dump($conn->UserExist($suggestField));

                    if ($conn->UserExist($suggestField)) {
                        $user_pseudo = $suggestField;
                        $path = "./Profil.php?user_pseudo=" . $user_pseudo;
                    }
                } else {
                    $path = "./index.php?ERROR";
                }


            }
            header("Location: $path");
            exit();

        default:
            header("Location: ./index.php?ERROR");
            exit();
    }

}

?>
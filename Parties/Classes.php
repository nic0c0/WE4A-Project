<?php

include("./Parties/dbfunctions.php");

class Cookie {

    private $username;
    private $password;

    public function __construct() {
        if($this->IssetCookie()) {
            $this->username = $_COOKIE['username'];
            $this->password = $_COOKIE['password'];
        }
    }


   public function IssetCookie(){
        return (isset($_COOKIE['username']) && isset($_COOKIE['password']));
    }

    
    public function CreateLoginCookie($username, $password){

        setcookie("username", $username, time() + 24*3600 );
        setcookie("password", EncryptedPassword($username), time() + 24*3600);


    }// fin de Méthode

    public function CheckIntegrity(){
        return CheckPassword($this->username,$this->password);
    }
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function UpdateUsername($username) {
        setcookie("username", $username, time() + 24*3600 );

    }

    public function UpdatePassword($password) {
        setcookie("password",$password, time() + 24*3600);
 
    }

    function clean() {

        setcookie("username", '', time() - 3600);
        setcookie("password", '', time() - 3600);
                
    }


}



class SQLconn {
    public $conn = NULL;
    public $loginStatus = NULL;

    // Fonction qui connecte la BDD
    //--------------------------------------------------------------------------------
    function __construct() {

        //Créer connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "DB";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ( $this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Après connection, créer l'objet loginstatus
        //$this->loginStatus = new LoginStatus($this);
    }

    function GetConn(){
        return $this->conn;
    } 

    function CloseDB(){
        mysqli_close($this->GetConn());
    }
    
    public function AlreadyExist($user) {           
        $sql = "SELECT * FROM T_USER_PROFILE WHERE USER_PSEUDO = ?"; // ? = valeurs a remplacer lors de lexec
        $stmt = mysqli_prepare($this->GetConn(), $sql); // preparation requête
        mysqli_stmt_bind_param($stmt, "s", $user); // ss = string string, les ? sont remplacés
        mysqli_stmt_execute($stmt);  //on execute la requette
        $result = mysqli_stmt_get_result($stmt); // on récupère le résultat de la requête

        if (mysqli_num_rows($result) > 0) {
            
            echo "Le pseudo est déjà pris";
            return true;

        } else {
            return false;
        }
    }

public function CountFollows($user_id) {           
    $sql = "SELECT COUNT(*) AS count FROM T_FRIENDSHIP WHERE ACCEPT_USER_ID = ?";//  OR ACCEPT_USER_ID = ?
    $stmt = mysqli_prepare($this->GetConn(), $sql); 
    mysqli_stmt_bind_param($stmt, "s", $user_id); 
    mysqli_stmt_execute($stmt);  
    $result = mysqli_stmt_get_result($stmt);
    $count = mysqli_fetch_assoc($result)['count'];
    echo $count;
}

public function CountFollowers($user_id) {           
        $sql = "SELECT COUNT(*) AS count FROM T_FRIENDSHIP WHERE REQUEST_USER_ID = ?";
        $stmt = mysqli_prepare($this->GetConn(), $sql); 
        mysqli_stmt_bind_param($stmt, "s", $user_id); 
        mysqli_stmt_execute($stmt);  
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_fetch_assoc($result)['count'];
        echo $count;
}
public function displayFollowers($user_id) {
    $stmt = $this->conn->prepare("SELECT T_USER_PROFILE.USER_PSEUDO FROM T_FRIENDSHIP INNER JOIN T_USER_PROFILE ON T_FRIENDSHIP.REQUEST_USER_ID = T_USER_PROFILE.USER_ID WHERE T_FRIENDSHIP.ACCEPT_USER_ID = ?;");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) {
        echo "Aucun abonné trouvé.";
    } else {
         //Récupération du pseudo de l'utilisateur connecté
         $cook= new Cookie();
         $user_pseudo=$cook->getUsername();

        echo "<h1>Abonnés de " . $user_pseudo . "</h1>";
        echo "<p>";
        while($row = $result->fetch_assoc()) {
            echo "<a href='./Profil.php?user_pseudo=".$row["USER_PSEUDO"]."'>".$row["USER_PSEUDO"]."</a><br>";
        }
        echo "</p>";
    }
}
public function displayFollows($user_id) {
    $stmt = $this->conn->prepare("SELECT T_USER_PROFILE.USER_PSEUDO FROM T_FRIENDSHIP INNER JOIN T_USER_PROFILE ON T_FRIENDSHIP.ACCEPT_USER_ID = T_USER_PROFILE.USER_ID WHERE T_FRIENDSHIP.REQUEST_USER_ID = ?;");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) {
        echo "Aucun abonnement trouvé.";
    } else {
        //Récupération du pseudo de l'utilisateur connecté
        $cook= new Cookie();
        $user_pseudo=$cook->getUsername();

        echo "<h1>Abonnements de " . $user_pseudo . "</h1>";
        //Affichage des abonnements
        echo "<p>";
        while($row = $result->fetch_assoc()) {
            echo "<a href='./Profil.php?user_pseudo=".$row["USER_PSEUDO"]."'>".$row["USER_PSEUDO"]."</a><br>";
        }
        echo "</p>";
    }
}
public function checkFollow($follower_id, $followed_id) {
    $stmt = $this->conn->prepare("SELECT COUNT(*) as nb FROM T_FRIENDSHIP WHERE REQUEST_USER_ID = ? AND ACCEPT_USER_ID = ?");
    $stmt->bind_param("ii", $follower_id, $followed_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['nb'] > 0;
}

public function follow($user_id, $follow_user_id) {
    $stmt = $this->conn->prepare("INSERT INTO T_FRIENDSHIP (REQUEST_USER_ID, ACCEPT_USER_ID) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $follow_user_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

public function unfollow($request_user_id, $accept_user_id) {
    $stmt = $this->conn->prepare("DELETE FROM T_FRIENDSHIP WHERE REQUEST_USER_ID = ? AND ACCEPT_USER_ID = ?");
    $stmt->bind_param("ii", $request_user_id, $accept_user_id);
    $stmt->execute();
    if($stmt->affected_rows === 0) {
        echo "Impossible de supprimer le follow. Veuillez vérifier les ID des utilisateurs.";
    } else {
        echo "Le follow a été supprimé avec succès.";
    }
}



public function CountPost($user_id) {           
    $sql = "SELECT COUNT(*) AS count FROM T_USER_POST WHERE USER_ID = ?";
    $stmt = mysqli_prepare($this->GetConn(), $sql); 
    mysqli_stmt_bind_param($stmt, "s", $user_id); 
    mysqli_stmt_execute($stmt);  
    $result = mysqli_stmt_get_result($stmt);
    $count = mysqli_fetch_assoc($result)['count'];
    echo $count;
}

    public function CheckDB($user, $password) {           
        $sql = "SELECT * FROM T_USER_PROFILE WHERE USER_PSEUDO = ?"; // ? = valeurs a remplacer lors de lexec
        $stmt = mysqli_prepare($this->GetConn(), $sql); // preparation requête
        mysqli_stmt_bind_param($stmt, "s", $user); // ss = string string, les ? sont remplacés
        mysqli_stmt_execute($stmt);  //on execute la requette
        $result = mysqli_stmt_get_result($stmt); // on récupère le résultat de la requête

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
           //echo $password,"<br>",password_hash($password,PASSWORD_BCRYPT),"<br>",$row['USER_PASSWORD'];
            return CheckPassword($password,$row['USER_PASSWORD']);

        } else {
            return false;
        }
    }
    public function getUserData($username) {
        $stmt = $this->conn->prepare("SELECT * FROM T_USER_PROFILE WHERE USER_PSEUDO = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_data = array(
                "user_id" => $row["USER_ID"],
                "user_email" => $row["USER_EMAIL"],
                "user_pp" => $row["USER_PP"],
                "user_pseudo" => $row["USER_PSEUDO"],
                "user_name" => $row["USER_NAME"],
                "user_surname" => $row["USER_SURNAME"],
                "user_desc"=> $row["USER_DESC"]
            );
            return $user_data;
        } else {
            return false;
        }
    }
    public function getPostData($post_id) {
        $stmt = $this->conn->prepare("SELECT * FROM T_USER_POST WHERE POST_ID = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $post_data = array(
                "post_id" => $row["POST_ID"],
                "post_title" => $row["POST_TITLE"],
                "post_text" => $row["POST_TEXT"],
                "created_time" => $row["CREATED_TIME"],
                "post_img" => $row["POST_IMG"],
                "user_id" => $row["USER_ID"]
            );
            return $post_data;
        } else {
            return false;
        }
    }
public function getPosts($user_id) {
    if ($user_id === 0) { // Si le numéro utilisateur est null, on affiche tous les posts existants
        $stmt = $this->conn->prepare("SELECT * FROM T_USER_POST");
    } else { // Sinon, on affiche tous les posts publiés par le numéro utilisateur
        $stmt = $this->conn->prepare("SELECT * FROM T_USER_POST WHERE USER_ID = ?");
        $stmt->bind_param("i", $user_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $post_id = $row['POST_ID'];
        include "post.php";
    }
}
function getUserIdFromPostId($post_id) {
    $stmt = $this->conn->prepare("SELECT USER_ID FROM T_USER_POST WHERE POST_ID = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row["USER_ID"];
    } else {
        return null;
    }
}
public function getUserPseudo($user_id) {
    $stmt = $this->conn->prepare("SELECT USER_PSEUDO FROM T_USER_PROFILE WHERE USER_ID = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['USER_PSEUDO'];
}


    public function getComData($com_id) {
        $stmt = $this->conn->prepare("SELECT * FROM T_POST_COMMENT WHERE COMMENT_ID = ?");
        $stmt->bind_param("i", $com_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $comment_data = array(
                "comment_id" => $row["COMMENT_ID"],
                "comment_text" => $row["COMMENT_TEXT"],
                "created_time" => $row["CREATED_TIME"],
                "post_id" => $row["POST_ID"],
                "user_id" => $row["USER_ID"]
            );
            return $comment_data;
        } else {
            return false;
        }
    }
    
    
    
    
    public function updateProfile($user_id, $user_email, $user_pp, $user_name, $user_surname, $user_desc) {
        $sql = "UPDATE T_USER_PROFILE SET USER_EMAIL=?, USER_PP=?, USER_NAME=?, USER_SURNAME=?, USER_DESC=? WHERE USER_ID=?";
        $stmt = mysqli_prepare($this->GetConn(), $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $user_email, $user_pp, $user_name, $user_surname, $user_desc, $user_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Vos informations ont été mises à jour avec succès.";
        } else {
            echo "Erreur: " . mysqli_error($this->GetConn());
        }
        mysqli_stmt_close($stmt); // fermeture du statement
        mysqli_close($this->GetConn()); // fermeture de la connexion à la DB
    }

    public function updatePassword($user_pseudo, $user_password) {
        $sql = "UPDATE T_USER_PROFILE SET USER_PASSWORD=? WHERE USER_PSEUDO=?";
        $stmt = mysqli_prepare($this->GetConn(), $sql);
        mysqli_stmt_bind_param($stmt, "ss", $user_password, $user_pseudo);
        if (mysqli_stmt_execute($stmt)) {
            echo "Votre mot de passe a été mises à jour avec succès.";
        } else {
            echo "Erreur: " . mysqli_error($this->GetConn());
        }
        mysqli_stmt_close($stmt); // fermeture du statement
        mysqli_close($this->GetConn()); // fermeture de la connexion à la DB
    }

    public function insertPost($user_id, $titre, $description, $image_path) {
        $post_date = date("Y-m-d H:i:s"); // date actuelle
        $sql = "INSERT INTO T_USER_POST (USER_ID, POST_TITLE, POST_TEXT, POST_IMG, CREATED_TIME) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->GetConn(), $sql);
        mysqli_stmt_bind_param($stmt, "issss", $user_id, $titre, $description, $image_path, $post_date);
        if (mysqli_stmt_execute($stmt)) {
            echo "Le post a été ajouté avec succès.";
        } else {
            echo "Erreur: " . mysqli_error($this->GetConn());
        }
        mysqli_stmt_close($stmt); // fermeture du statement
        mysqli_close($this->GetConn()); // fermeture de la connexion à la DB
    }
    public function insertComment($user_id, $post_id, $comment_text) {
        $created_time = date("Y-m-d H:i:s"); // date actuelle
        $sql = "INSERT INTO T_POST_COMMENT (USER_ID, POST_ID, COMMENT_TEXT, CREATED_TIME) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->GetConn(), $sql);
        mysqli_stmt_bind_param($stmt, "iiss", $user_id, $post_id, $comment_text, $created_time);
        if (mysqli_stmt_execute($stmt)) {
            echo "Le commentaire a été ajouté avec succès.";
        } else {
            echo "Erreur: " . mysqli_error($this->GetConn());
        }
        mysqli_stmt_close($stmt); // fermeture du statement
        mysqli_close($this->GetConn()); // fermeture de la connexion à la DB
    }
    


    public function CreateAccount($pseudo, $password) {
        $password = EncryptedPassword($password);
        $sql = "INSERT INTO T_USER_PROFILE (USER_PSEUDO, USER_PASSWORD) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->GetConn(), $sql);
        mysqli_stmt_bind_param($stmt, "ss", $pseudo, $password);
        if (mysqli_stmt_execute($stmt)) {
            echo "CREATION DU COMPTE $pseudo";
        } else {
            echo "Erreur: " . mysqli_error($this->GetConn());
        }
        mysqli_stmt_close($stmt); // fermeture du statement
        mysqli_close($this->GetConn()); // fermeture de la connexion à la DB
    }

    
    public function getUserPostCount($user_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM T_USER_POST WHERE USER_ID = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['COUNT(*)'];
        } else {
            return 0;
        }
    }
    
    



    /*        */

    //Fonction pour sécuriser les données utilisateur de manière basique
    //--------------------------------------------------------------------------------
    function SecurizeString_ForSQL($string) {
        $string = trim($string);
        $string = stripcslashes($string);
        $string = addslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    
}
?>
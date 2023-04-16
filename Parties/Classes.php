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
        setcookie("password", EncryptedPaswword($password), time() + 24*3600);

    }// fin de Méthode
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
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
<<<<<<< Updated upstream
    
=======

    public function CreateAccount($pseudo, $password) {
        $password = EncryptedPaswword($password);
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

>>>>>>> Stashed changes


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
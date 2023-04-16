<?php
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

    public function EncryptedPaswword($password){
        return password_hash($password,PASSWORD_BCRYPT);
    }
    
    public function CreateLoginCookie($username, $password){

        setcookie("username", $username, time() + 24*3600 );
        setcookie("password", $this->EncryptedPaswword($password), time() + 24*3600);

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
    
    public function CheckPassword($password,$hash){
        return password_verify($password, $hash);

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
            return $this->CheckPassword($password,$row['USER_PASSWORD']);

        } else {
            echo "données incohérentes";
            return false;
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
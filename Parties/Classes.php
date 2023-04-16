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

    /*
    //Fonction pour traiter un formulaire de création de compte
    //--------------------------------------------------------------------------------
    function Process_NewAccount_Form(){

        $creationAttempted = false;
        $creationSuccessful = false;
        $error = NULL;
    
        //Données reçues via formulaire?
        if(isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["confirm"])){
    
            $creationAttempted = true;
    
            //Form is only valid if password == confirm, and username is at least 4 char long
            if ( strlen($_POST["name"]) < 4 ){
                $error = "Un nom utilisateur doit avoir une longueur d'au moins 4 lettres";
            }
            elseif ( $_POST["password"] != $_POST["confirm"] ){
                $error = "Le mot de passe et sa confirmation sont différents";
            }
            else {
                $username = $this->SecurizeString_ForSQL($_POST["name"]);
                $password = md5($_POST["password"]);
    
                $query = "INSERT INTO `login` VALUES (NULL, '$username', '$password' )";
                $result = $this->conn->query($query);
    
                if( mysqli_affected_rows($this->conn) == 0 )
                {
                    $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
                }
                else{
                    $creationSuccessful = true;
                }
                
            }
    
        }
    
        return array($creationAttempted, $creationSuccessful, $error);
    }

    // Fonction pour obtenir le nom d'un propriétaire de blog + savoir si c'est "moi"
	// "moi" est relatif au nom du "mec connecté", qui est fourni en paramètre
    //--------------------------------------------------------------------------------
    function GetBlogOwnerFromID($ID, $connectedGuyName){
        $query = "SELECT `logname` from `login` WHERE `ID` = $ID";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0 ){
			
			//There should only be one result
            $row = $result->fetch_assoc();
			
			//We compare the
            if ($row["logname"] == $connectedGuyName){
                return array($connectedGuyName, true);
            }
            else {
                return array($row["logname"], false);
            }
        }
        else {
            return array("Invalid", false);
        }
    }

    // Fonction pour générer une page de posts en HTML à partir de paramètres
    //--------------------------------------------------------------------------------
    function GenerateHTML_forPostsPage($blogID, $ownerName, $isMyBlog) {

        $query = "SELECT * FROM `post` WHERE `owner_login` = ".$blogID." ORDER BY `date_lastedit` DESC LIMIT 10";
        $result = $this->conn->query($query);
        if( mysqli_num_rows($result) != 0 ){
    
            if ($isMyBlog){
            ?>
    
            <form action="editPost.php" method="POST">
                <input type="hidden" name="newPost" value="1">
                <button type="submit">Ajouter un nouveau post!</button>
            </form>
    
            <?php    
            }
    
            while( $row = $result->fetch_assoc() ){
    
                $timestamp = strtotime($row["date_lastedit"]);
                echo '
                <div class="blogPost">
                    <div class="postTitle">';
    
                if ($isMyBlog){
    
                    echo '
                    <div class="postModify">
                        <form action="editPost.php" method="GET">
                            <input type="hidden" name="postID" value="'.$row["ID_post"].'">
                            <button type="submit">Modifier/effacer</button>
                        </form>
                    </div>';
                }
                else {
                    echo '
                    <div class="postAuthor">par '.$ownerName.'</div>
                    ';
                }
    
                echo '<h3>•'.$row["title"].'</h3>
                <p>dernière modification le '.date("d/m/y à h:i:s", $timestamp ).'</p>
                </div>
                ';
    
                //On regarde si il y a une image, si oui, on l'insère
                if (!is_null($row["image_url"])){

                    //je choisis de redimentionner mon image pour 200px de large
                    $size = getimagesize($row["image_url"]);
                    if ($size){
                        $goalsize = 200;

                        $ratio = $goalsize/$size[0]; //on calcule le redimentionnement
                        $newHeight = $size[1]*$ratio;
                        echo '<img class ="postImg" src="'.$row["image_url"].'"width="'.$goalsize.'px" height ="'.$newHeight.'px">';
                    } 
                }
    
                echo'
                <p class="postContent">'.$row["content"].'</p>
                <div style="clear:both; height:0px; margin:0; padding:0"></div>
                </div>
                ';
            }
        }
        else {
            echo '
            <p>Il n\'y a pas de post dans ce blog.</p>';
    
            if ($isMyBlog){
            ?>
                <form action="editPost.php" method="POST">
                    <input type="hidden" name="newPost" value="1">
                    <button type="submit">Ajouter un premier post!</button>
                </form>
            <?php
            }
            
    
        }

    }
	
	//Proxy qui appelle query sur conn. Juste là pour le confort.
	function query($stringQuery){
		return $this->conn->query($stringQuery);
	}
*/
    //Fonction pour fermer la connection sur base de données
    //--------------------------------------------------------------------------------
}

class LoginStatus{

    public $loginSuccessful = false;
    public $loginAttempted = false;
    public $errorText = "";
    public $userID = 0;
    public $userName = "";

    // Constructeur de la classe
    //-------------------------------------------------------------------------------------------------------
    function __construct(&$SQLconn) {
        
        $this->loginSuccessful = false;

        //Données reçues via formulaire?
        if(isset($_POST["name"]) && isset($_POST["password"])){
            $this->userName = $SQLconn->SecurizeString_ForSQL($_POST["name"]);
            $password = md5($_POST["password"]);
            $this->loginAttempted = true;
        }
        //Données via le cookie?
        elseif ( isset( $_COOKIE["name"] ) && isset( $_COOKIE["password"] ) ) {
            $this->userName = $_COOKIE["name"];
            $password = $_COOKIE["password"];
            $this->loginAttempted = true;
        }
        else {
            $this->loginAttempted = false;
        }

        //Si un login a été tenté, on interroge la BDD
        if ( $this->loginAttempted ){
            $query = "SELECT * FROM login WHERE logname = '".$this->userName."' AND password ='".$password."'";
            $result = $SQLconn->conn->query($query);

            if ( $result ){
                $row = $result->fetch_assoc();
                $this->userID = $row["ID"];
                $this->userName = $row["logname"];
                $this->CreateLoginCookie($this->userName, $password);
                $this->loginSuccessful = true;
            }
            else {
                $this->errorText = "Ce couple login/mot de passe n'existe pas. Créez un Compte";
            }
        }
    }// fin de Méthode

    // Méthode pour stocker un login réussi dans un cookie
    //-------------------------------------------------------------------------------------------------------
    function CreateLoginCookie($username, $encryptedPasswd){

        setcookie("name", $username, time() + 24*3600 );
        setcookie("password", $encryptedPasswd, time() + 24*3600);

    }// fin de Méthode

    // Méthode pour se délogger. Détruit le cookie.
    //-------------------------------------------------------------------------------------------------------
    function Logout(){

        setcookie("name", NULL, -1 );
        setcookie("password", NULL, -1);

    }// fin de Méthode

} // Fin de classe



        

?>
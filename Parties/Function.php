<?php 
function showSignin(){

        //var_dump(isset($_COOKIE['username']));
        //var_dump(isset($_COOKIE['password']));
        if(!(isset($_COOKIE['username']) && isset($_COOKIE['password']))){
            include("./signin.php");
         }
}
?>
<?php 
function showSignin(){

    var_dump($_COOKIE['username']);
    var_dump($_COOKIE['password']);
    if(!(isset($_COOKIE['username']) && isset($_COOKIE['password']))){
        header("Location: ./signin.php");
        exit();
    }else{
        header("Location: ./index.php");
        exit();
    }
       
    
}

?>
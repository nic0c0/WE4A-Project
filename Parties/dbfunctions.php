<?php
function saveImageAsNew($user_id, $isProfilePic, $number, $name)
{
    $savePath = "./IMGDB/";
    $var = $isProfilePic ? 'new_pp' : 'post_img';
    $hasAdequateFile = isBufferFileAdequate($var);

    if ($hasAdequateFile) {
        $file = $_FILES[$var]['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];

        $temp_name = $_FILES[$var]['tmp_name'];
        $new_filename = $name ? $name : ($isProfilePic ? $user_id . "profilpicture" : $user_id . "picture" . $number);
        $path_filename_ext = $name ? $new_filename : $savePath . $new_filename . "." . $ext;

        if (file_exists($path_filename_ext)) {
            // If file already exists, delete it before saving the new one
            unlink($path_filename_ext);
        }

        move_uploaded_file($temp_name, $path_filename_ext);
        $errorText = "Congratulations! File Uploaded Successfully.";
        return $path_filename_ext;
    } else {
        echo "Erreur";
        return false;
    }
}

function isBufferFileAdequate($var)
{
    $lenght = 10485760; //10Mo
    if (isset($_FILES[$var]) && $_FILES[$var]['size'] != 0) {
        if ($_FILES[$var]['size'] > $lenght) {
            echo "Fichier trop grand! Respectez la limite de 10Mo.";
            return false;
        } elseif (in_array($_FILES[$var]['type'], array("image/jpeg", "image/png", "image/gif"))) {
            return true;
        } else {
            echo "Type de fichier non accepté! Images JPG et PNG seulement.";
            return false;
        }
    } else {
        echo "No file or file size = 0";
        return false;
    }
}

function EncryptedPassword($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function CheckPassword($password, $hash)
{
    return password_verify($password, $hash);
}

function CheckIntegrity()
{
    $cook = new Cookie();

    if (!$cook->CheckIntegrity()) {
        $cook->clean();
        header("Location: ./Index.php");
    }
}

function soustraire_dates($date1, $date2)
{
    $date1_timestamp = strtotime($date1);
    $date2_timestamp = strtotime($date2);

    $difference = $date2_timestamp - $date1_timestamp;

    $jours = floor($difference / (60 * 60 * 24));
    $heures = floor(($difference - $jours * 60 * 60 * 24) / (60 * 60));
    $minutes = floor(($difference - $jours * 60 * 60 * 24 - $heures * 60 * 60) / 60);
    $secondes = $difference - $jours * 60 * 60 * 24 - $heures * 60 * 60 - $minutes * 60;

    $resultat = array(
        'jours' => $jours,
        'heures' => $heures,
        'minutes' => $minutes,
        'secondes' => $secondes
    );

    if (($resultat['jours'] == 0) && ($resultat['heures'] == 0) && ($resultat['minutes'] == 0)) {
        return $resultat['secondes'];
    } else {
        return 1000;
    }

}
function isAdmin($user){
    return $user==('Alb'||'Nico'||'Init');
}

?>
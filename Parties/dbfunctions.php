<?php
function saveImageAsNew($user_id, $isProfilePic, $number) {
    $savePath = "./IMGDB/";
    $var= $isProfilePic ? 'new_pp' : 'post_img';
    $hasAdequateFile = isBufferFileAdequate($var);

    if ($hasAdequateFile) {
        $file = $_FILES[$var]['name'];
        $path = pathinfo($file); 
        $ext = $path['extension'];

        $temp_name = $_FILES[$var]['tmp_name'];
        $new_filename = $isProfilePic ? $user_id . "profilpicture": $user_id . "picture".$number;
        $path_filename_ext = $savePath . $new_filename . "." . $ext;

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

function isBufferFileAdequate($var){
    $lenght=10485760;//10Mo
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
?>
<?php
function saveImageAsNew($user_id) {
    $hasAdequateFile = isBufferFileAdequate();
    $savePath = "./IMGDB/";

    if ($hasAdequateFile) {
        $file = $_FILES['new_pp']['name'];
        echo"<br> your file is:";
        var_dump($file);
        $path = pathinfo($file); 
        $ext = $path['extension'];

        $temp_name = $_FILES['new_pp']['tmp_name'];
        $new_filename = $user_id . "profilpicture";
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

function isBufferFileAdequate(){
    $lenght=10485760;//10Mo
    if (isset($_FILES['new_pp']) && $_FILES['new_pp']['size'] != 0) {
        if ($_FILES['new_pp']['size'] > $lenght) {
            echo "Fichier trop grand! Respectez la limite de 10Mo.";
            return false;
        } elseif (in_array($_FILES['new_pp']['type'], array("image/jpeg", "image/png", "image/gif"))) {
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
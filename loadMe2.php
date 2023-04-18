<?php
    include ("./Parties/Classes.php");
    $conn = new SQLconn();
    $protectedText = $conn->SecurizeString_ForSQL($_GET["var"]);
    $protectedTextMaj = ucwords( $protectedText );

    echo 'Suggestions : <i>';

    if ($protectedText != "") {
        $query = "SELECT POST_TITLE FROM T_USER_POST WHERE LOWER(POST_TITLE) LIKE LOWER('%$protectedText%')";
        $result = $conn->GetConn()->query($query);

        if ($result->num_rows > 0) {
            $i = 1;
            while( $row = $result->fetch_assoc() ){
                $res="<span onclick='autoFillName(this.innerHTML)'>".$row["POST_TITLE"]."</span>";
                echo $res;
                if ($i < $result->num_rows) {
                    echo " - ";
                }
                $i++;
            }
        }
        else {
            echo '(pas de suggestion pour le texte actuel)';
        }
    }
    else{
        echo '(tapez quelque chose pour en avoir!)';
    }

    echo '</i>';
?>
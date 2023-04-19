<?php
    include ("./Parties/Classes.php");
    $conn = new SQLconn();
    $protectedText = $conn->SecurizeString_ForSQL($_GET["var"]);
    $protectedTextMaj = ucwords( $protectedText );

    echo '<i>';

    if ($protectedText != "") {
        $query = "SELECT POST_TITLE FROM T_USER_POST WHERE LOWER(POST_TITLE) LIKE LOWER('%$protectedText%')";
        $query2 = "SELECT USER_PSEUDO FROM T_USER_PROFILE WHERE LOWER(USER_PSEUDO) LIKE LOWER('%$protectedText%')";
        $result = $conn->GetConn()->query($query);
        $result2 = $conn->GetConn()->query($query2);
        $test=(($result->num_rows > 0 ) && ($result2->num_rows > 0 ));

        if ($test) {
            if($result->num_rows >0){
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

            if($result2->num_rows >0){
                $j = 1;
                while( $row2 = $result2->fetch_assoc() ){
                    $res2="<span onclick='autoFillName(this.innerHTML)'>".$row2["USER_PSEUDO"]."</span>";
                    echo $res2;
                    if ($j < $result2->num_rows) {
                        echo " - ";
                    }
                    $j++;
                }
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
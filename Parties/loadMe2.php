<?php
    include ("../Parties/Classes.php");
    $conn = new SQLconn();
    $protectedText = $conn->SecurizeString_ForSQL($_GET["var"]);
    $protectedTextMaj = ucwords( $protectedText );

    echo '<i>';

    if ($protectedText != "") {
        $query = "SELECT POST_TITLE FROM T_USER_POST WHERE LOWER(POST_TITLE) LIKE LOWER('%$protectedText%')";
        $query2 = "SELECT USER_PSEUDO FROM T_USER_PROFILE WHERE LOWER(USER_PSEUDO) LIKE LOWER('%$protectedText%')";
        $result = $conn->GetConn()->query($query);
        $result2 = $conn->GetConn()->query($query2);
        $test=(($result->num_rows > 0 ) || ($result2->num_rows > 0 ));

        if ($test) {

            echo '<select name="suggestions" onchange="autoFillName(this.value)" >';
            
            if($result->num_rows >0){
                $i = 1;
                while( $row = $result->fetch_assoc() ){
                    $res="<option>".$row["POST_TITLE"]."</option>";
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
                    $res2="<option>".$row2["USER_PSEUDO"]."</option>";
                    echo $res2;
                    if ($j < $result2->num_rows) {
                        echo " - ";
                    }
                    $j++;
                }
            }

            echo '</select>';
        }
        else {
            echo '...';
        }
    }
    else{
        echo '...';
    }

    echo '</i>';
?>


  <form class="signout" action="./index.php" method="post">
  <button type="submit" name="signout">Se déconnecter</button>
  </form>


<?php
  if(isset($_POST["signout"])){
      $cook = new Cookie();
      $cook->clean();
      header("Location: ./index.php");
  }
?>

<?php
include "./Parties/head.php";
include "./Parties/Classes.php";

//CheckIntegrity();

?>

<body>
  <?php
  $cook = new Cookie();
  if (!$cook->IssetCookie()) {
    include "./Parties/signin.php";
  } else {
    CheckIntegrity();
    include "./Parties/header.php";

    $username = $cook->getUsername(); //utile pour poster
    // Connexion à la base de données
    $conn = new SQLconn();
    ?>
    <div class="main">

      <div class="leftmain">
      </div>
      <div>
        <h1>Bon retour,
          <?= $username ?>
        </h1>
        <?php include "./Parties/poster.php"; ?>

        <div id="myPosts">
          <?php
          if (true) {
            $user_pseudo = $cook->getUsername();
            $user_date = $conn->getUserData($user_pseudo)['user_created'];
            //echo date("Y-m-d H:i:s"),"<br>", $user_date;
            $res = soustraire_dates(date("Y-m-d H:i:s"), $user_date);
            if ($res == 0) {
              ?>
              <script>alert("Bienvenue sur ASIAN FOOD <?php echo $cook->getUsername() ?> !!!");</script>
              <?php
            }
          }
          ?>
          <div id="allPosts">
            <script>loadPostsOnScroll(0);</script>
          </div>
        </div>
      </div>
    </div>
    <?php include "./Parties/footer.php"; ?>
    <?php
  }
  ?>
</body>

</html>
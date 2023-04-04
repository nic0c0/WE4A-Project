<?php include("./Parties/head.php") ?>
<?php include("./Parties/header.php"); ?>
<body>
    
<div class="center">
  <div class="settings">
        <h1>Compte</h1>
        <form class="set1" action="">
            <fieldset>
                <legend>Informations</legend>
                <label for="username">Pseudo : 
                    <input id="username" type="text" placeholder="Username" required>
                </label>
                <label for="email">Email : 
                    <input id="email" type="email" placeholder="Email" required>
                </label>
                <label for="name">Nom : 
                    <input id="name" type="text" placeholder="Name" required>
                </label>
                <label for="firstname">Prénom : 
                    <input id="firstname" type="text" placeholder="Firstname" required>
                </label>
            </fieldset>
        </form>


        <form class="set2">
            <fieldset>
                <legend>Profil</legend>
            <div class="img-upload">
                <label class="img-upload">
                <input type="file" accept=".jpg, .png, .jpeg, .gif" value="">
                </label>
                <!-- ADD preview IMG -->
            </div>
                <button class="btn button full" type="submit" disabled="">Sauvegarder</button>
            </fieldset>
        </form>
        <form class="set3">
            <fieldset>
                <legend>Changer de Mot de passe</legend>
                <label for="password1">Mot de passe :</label>
                <input id="password1" type="password" placeholder="Password" required>
                <label for="password2">Mot de passe :</label>
                <input id="password2" type="password" placeholder="Password" required>
            </fieldset>
            <button type="submit">Modifier</button>
        </form>
    </div>
</div>


<?php include("./Parties/footer.php"); ?>


<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        header();
        applyStyles(false);
      });
    </script>
</body>
</html>
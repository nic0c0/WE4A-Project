<header>
    <div class="logo">
        <a href="./index.php">       
            <img src="./IMG/t3.ico" alt="Logo">
        </a>
    </div>
    <form class="search">
    <script>

//Variable globale
previousText = "";
timer = 0;

//Timer qui boucle toutes les secondes pour changer la variable globale
function TimerIncrease() {
  timer+=1000;
  setTimeout('TimerIncrease()',1000);
}
TimerIncrease();

function suggestNamesFromInput(currentText) {

  if (currentText != previousText && timer >= 1000 ){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("suggestions").innerHTML = this.responseText;
      }
    xhttp.open("GET", "./loadMe2.php?var=" + currentText , true); //Le booléen final dit si le chargement est asynchrone ou non
    xhttp.send();

    previousText = currentText;
    timer = 0;
  }
  
}

function autoFillName(nametext){
  document.getElementById("suggestField").value = nametext;
}

</script>
  <input id="suggestField" type="text" onkeyup="suggestNamesFromInput(this.value)">
  <p id="suggestions"><i></i></p>
</div>
        <button type="submit">Go</button>
    </form>
    <nav>
        <ul>
            <li><a href="./Profil.php">Profil</a></li>
            <li><a href="./Settings.php">Paramètres</a></li>
        </ul>
        <?php include("./Parties/signout.php"); ?>
    </nav>

</header>




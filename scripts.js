

function applyStyles(x) {
  // Créer une balise <link> pour la feuille de style s1
  var cssLink = document.createElement("link");
  cssLink.href = x ? "../CSS/style1.css" : "./CSS/style1.css";

  cssLink.rel = "stylesheet";
  cssLink.type = "text/css";
  document.head.appendChild(cssLink);

  // Vérifier si le navigateur est Firefox 
  var isFirefox = typeof InstallTrigger !== 'undefined';
  if (isFirefox) {
    var cssLink2 = document.createElement("link");
    cssLink2.href = x ? "../CSS/style2.css" : "./CSS/style2.css";
    cssLink2.rel = "stylesheet";
    cssLink2.type = "text/css";
    document.head.appendChild(cssLink2);
  }
}


if (typeof imgInp !== 'undefined') {
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
}

// Charger les posts au défilement de la page
function loadPostsOnScroll(user) {
  // Récupère l'élément HTML où afficher les posts
  const writearea = user ? document.getElementById("myPosts") : document.getElementById("allPosts");
  let numberOfPostsAlready = 0;
  let isFetching = false; // Variable de contrôle pour éviter de lancer plusieurs requêtes AJAX en même temps et donc d'éviter les doublons de posts

  // Fonction pour charger plus de posts
  async function loadMorePosts() {
    // Vérifie si une requête AJAX est déjà en cours
    if (isFetching) {
      return;
    }
    // Alors une requête AJAX est en cours
    isFetching = true;

    let url = `./Parties/load.php?firstPost=${numberOfPostsAlready}`;
    // Ajoute l'argument 'moreInfo' si la fonction est appelée pour afficher les posts d'un utilisateur spécifique
    if (user != 0) {
      url += `&moreInfo=${user}`;
    }
    // Envoie une requête AJAX à l'URL spécifiée et attend la réponse
    const AJAXresult = await fetch(url);
    // Ajoute le résultat de la requête à l'élément HTML où afficher les posts
    writearea.innerHTML += await AJAXresult.text();
    // Incrémente le nombre de posts déjà affichés
    numberOfPostsAlready += 1;

    // Réinitialise la var à false une fois la requête AJAX terminée
    isFetching = false;
  }

  // Détecte si l'utilisateur a atteint le bas de la page
  window.addEventListener("scroll", () => {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
    if (scrollTop + clientHeight >= scrollHeight - 5) {
      // Charge plus de posts
      loadMorePosts();
    }
  });

  // Charge les premiers posts au chargement de la page
  // loadMorePosts();//idk si essentiel
}





//afficher les commentaires 
function loadCommentsOnScroll(postid) {
  const commentContainer = document.getElementById("comment-container");
  let numberOfCommentsAlready = 4;
  let isFetching = false; // variable de contrôle

  async function loadMoreComments() {
    // Vérifie si la fonction est déjà en cours d'exécution
    if (isFetching) {
      return;
    }
    isFetching = true; // Définit la variable à true pour indiquer que la fonction est en cours d'exécution

    let url = `./Parties/loadcom.php?firstComment=${numberOfCommentsAlready}&post_id=${postid}`;
    const AJAXresult = await fetch(url);
    commentContainer.innerHTML += await AJAXresult.text();
    numberOfCommentsAlready += 4;
    // console.log(url); //debug

    isFetching = false; // Réinitialise la variable à false une fois la fonction terminée
  }

  commentContainer.addEventListener("scroll", () => {
    const { scrollTop, scrollHeight, clientHeight } = commentContainer;

    if (scrollTop + clientHeight >= scrollHeight - 5) {
      loadMoreComments();
    }
  });
}






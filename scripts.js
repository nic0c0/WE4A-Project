

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
//passe de relative à fixed
// function header(){ // fixe le header en haut de page si on est pas au sommet
//   var myElement = document.querySelector('header');

//   window.addEventListener('scroll', function() {
//     if (window.pageYOffset > 0) {
//       myElement.style.position = 'fixed';
//     } else {
//       myElement.style.position = 'relative';
//     }
//   });
// }

if (typeof imgInp !== 'undefined') {
  imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
}

function loadPostsOnScroll(user) {
  const writearea = user ? document.getElementById("myPosts"):document.getElementById("allPosts");
  let numberOfPostsAlready = 0;

  async function loadMorePosts() {
    let url = `./Parties/load.php?firstPost=${numberOfPostsAlready}`;
    if (user!=0) {
      url += `&moreInfo=${user}`;
    }
    // console.log(url);
    const AJAXresult = await fetch(url);
    writearea.innerHTML += await AJAXresult.text();
    numberOfPostsAlready += 1;
  }

  window.addEventListener("scroll", () => {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;

    if (scrollTop + clientHeight >= scrollHeight - 5) {
      loadMorePosts();
    }
  });

  loadMorePosts();
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
    console.log(url);

    isFetching = false; // Réinitialise la variable à false une fois la fonction terminée
  }

  commentContainer.addEventListener("scroll", () => {
    const { scrollTop, scrollHeight, clientHeight } = commentContainer;

    if (scrollTop + clientHeight >= scrollHeight - 5) {
      loadMoreComments();
    }
  });
}






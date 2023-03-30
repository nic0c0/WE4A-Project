

function applyStyles() {
  // Créer une balise <link> pour la feuille de style s1
  var cssLink = document.createElement("link");
  cssLink.href = "./CSS/style1.css";
  cssLink.rel = "stylesheet";
  cssLink.type = "text/css";
  document.head.appendChild(cssLink);

  // Vérifier si le navigateur est Firefox 
  var isFirefox = typeof InstallTrigger !== 'undefined';
  if (isFirefox) {
    var cssLink2 = document.createElement("link");
    cssLink2.href = "./CSS/style2.css";
    cssLink2.rel = "stylesheet";
    cssLink2.type = "text/css";
    document.head.appendChild(cssLink2);
  }
}

function header(){ // fixe le header en haut de page si on est pas au sommet
  var myElement = document.querySelector('header');

  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 0) {
      myElement.style.position = 'fixed';
    } else {
      myElement.style.position = 'relative';
    }
  });
}


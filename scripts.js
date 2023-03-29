function getHeaderHeight() {
    const header = document.querySelector('header');
    const headerHeight = window.getComputedStyle(header).height;
    return headerHeight;
  }
  
function setSiblingHeight() {
    const headerHeight = getHeaderHeight();
    const sibling = document.querySelector('header + *');
    sibling.style.top = `${headerHeight}`;
    sibling.style.position = 'relative';
    sibling.style.marginBottom = `${headerHeight}`;
    console.log(sibling);
}

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


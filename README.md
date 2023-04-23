# UTBM WE4A

## Information

### Projet étudiant

- Université: [UTBM](http://www.utbm.fr/)
- UV: WE4A
- Semestre: P23

### Auteurs

- [Nicolas Marcelin](https://github.com/nic0c0)
- [Albert Royer](https://github.com/Rarynn)

### Sujet

Ce projet consiste à créer un site web permettant à des utilisateurs d'échanger des messages entre eux.


#### Objectifs principaux

- Création d'un simple d'un site permettant de partager des messages.
- Valorisation de la recherche et l'expérimentation pour aller au-delà des exigences minimums du projet.
- Utilisation des langages HTML, CSS, PHP et JavaScript.

#### Fonctionnalités

- Implémentation d'une fonction de recherche pour permettre aux utilisateurs de trouver du contenu spécifique.
- Ajout d'un système de commentaires pour permettre aux utilisateurs de réagir aux messages des autres.

### Le site :

#### Fichiers
- Sorte de blogs / fil twitter portant autour de la nourriture asiatique ou les utilisateurs peuvent partager des photos et commenter et réagir aux photos des autres.
- Pages :
  - Accueil (index.php) : page d'accueil du site : connexion, creation de post, affichage des posts en feed
  - Inscription (signup.php) : page pour créer un compte
  - Profil (Profil.php) : page pour afficher les informations d'un utilisateur : pseudo, description, photo de profil, stats, posts
  - Relation (relation.php) : page pour afficher les relations de l'utilisateur (abonnements, abonnés)
  - Paramètres (settings.php) : page pour modifier les paramètres du compte : nom, prénom, mot de passe, photo de profil, etc.
  - Page du poste (comment.php) : page pour afficher un poste et ses commentaires, ajouter un commentaire, liker, modifier ou supprimer le poste si il nous appartient
  - Page d'action (action.php) : page pour modifier / supprimer un poste
  - Redirection (redirect.php) : page de redirection global pour les formulaires
- Parties :
    - card.php : affichage de la carte de profil (cad sans les postes)
    - Classes.php : Contient les classes utilisées dans le projet : 
        - Cookie : permet de gérer les cookies
        - SQLconn : permet de gérer tout ce qui est en rapport avec la base de données
    - dbfunctions.php : Contient les fonctions utilisées en plus des méthodes des classes : 
        - saveImageAsNew() : permet de sauvegarder une image dans le dossier 
        - isBufferFileAdequate() : permet de vérifier si le fichier est une image ainsi que sa taille
        - EncryptedPassword() : permet de crypter le mot de passe
        - CheckPassword() : permet de vérifier si le mot de passe est correct
        - CheckIntegrity() : permet de vérifier si les données sont correctes avant de déconnecter l'utilisateur dans le cas contraire
        - soustraire_dates() : permet de calculer la différence entre deux dates
        - isAdmin() : permet de vérifier si l'utilisateur est un admin
    - footer.php : Contient le footer du site
    - head.php : Contient le head du site
    - header.php : Contient le header du site : 
        - une search bar
        - un lien pour accéder au profil
        - un lien pour accéder aux paramètres
        - un lien pour accéder à l'accueil
        - un bouton pour se déconnecter
    - load.php : Contient le php à charger en AJAX pour les posts
    - loadcomment.php : Contient le php à charger en AJAX pour les commentaires
    - post.php : php d'un post
    - poster.php : php d'un post étant uploadé / modifié
    - signin.php : php de connexion
    - signout.php : php de déconnexion
- script.js : Contient les scripts javascript utilisés dans le projet :
    - loadPostsOnScroll() : permet de charger les posts en AJAX
    - loadCommentsOnScroll() : permet de charger les commentaires en AJAX
    - script pour prévisualiser l'image
- Base de Données :
    - Table likes : T_LIKE
    - Table post : T_USER_POST
    - Table commentaire : T_POST_COMMENT
    - Table utilisateur : T_USER_PROFILE
    - Table relation : T_FRIENDSHIP
- CSS : style du site

#### Style


### Echantillon de test : 
- 10 comptes :
    - Init : 
        - Mdp : init
    - Alb | Nico : 
        - Mdp : root
    - Bob | Jane | Sam | Sarah | Chris | Lisa | Mike : 
        - Mdp : test
- 12 posts
- 25 commentaires
- 30 likes


 ### Conclusion

Ce projet permettra de développer des compétences en développement web et de créer un site fonctionnel pour l'échange de messages entre utilisateurs.

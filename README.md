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
- Système de commentaires.
- Système de like.
- Système publication de photos / modification / effacement.
- Système de connexion / déconnexion / inscription.
- Système de profil / paramètres.
- Système de relation (abonnements / abonnés).
- Chargement de posts et commentaires en AJAX.
- Admins : suppression de posts.




### Echantillon de test : 
- 10 comptes :
    |Compte|Mot de passe|Droits            |
    |------|------------|------------------|
    |Init  |init        |:white_check_mark:| 
    |Alb   |root        |:white_check_mark:|
    |Nico  |root        |:white_check_mark:|
    |Bob   |test        |:x:               |
    |Jane  |test        |:x:               |
    |Sam   |test        |:x:               |
    |Sarah |test        |:x:               |
    |Chris |test        |:x:               |
    |Lisa  |test        |:x:               |
    |Mike  |test        |:x:               |

- 12 posts
- 25 commentaires
- 30 likes

#### Connexion à la base de données : 

    Changer les informations de connexion dans le fichier Classes.php : ligne 87


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
- CSS : style du site

- Base de Données :
    - Table likes : 
        | Nom de la colonne | Type de données | Contraintes             |
        | ----------------- | -------------- | ----------------------- |
        | LIKE_ID           | BIGINT(4)      | NOT NULL, AUTO_INCREMENT |
        | CREATED_TIME      | datetime       | NULL                    |
        | USER_ID           | BIGINT(4)      | NOT NULL                |
        | POST_ID           | BIGINT(4)      | NOT NULL                |
        | PRIMARY KEY       | (LIKE_ID)      |                         |
    - Table post : 
        | Nom de la colonne | Type de données | Contraintes             |
        | ----------------- | -------------- | ----------------------- |
        | POST_ID           | BIGINT(4)      | NOT NULL, AUTO_INCREMENT |
        | POST_TEXT         | VARCHAR(256)  | NOT NULL                |
        | POST_TITLE        | VARCHAR(32)   | NOT NULL                |
        | CREATED_TIME      | datetime       | NOT NULL                |
        | POST_IMG          | VARCHAR(255)  | NOT NULL                |
        | USER_ID           | BIGINT(4)      | NOT NULL                |
        | PRIMARY KEY       | (POST_ID)      |                         |
    - Table commentaire :
        | Nom de la colonne | Type de données | Contraintes             |
        | ----------------- | -------------- | ----------------------- |
        | COMMENT_ID        | BIGINT(4)      | NOT NULL, AUTO_INCREMENT |
        | COMMENT_TEXT      | VARCHAR(128)  | NOT NULL                |
        | CREATED_TIME      | datetime       | NOT NULL                |
        | POST_ID           | BIGINT(4)      | NOT NULL                |
        | USER_ID           | BIGINT(4)      | NOT NULL                |
        | PRIMARY KEY       | (COMMENT_ID)   |                         |
    - Table utilisateur : 
        | Nom de la colonne | Type de données | Contraintes             |
        | ----------------- | -------------- | ----------------------- |
        | USER_ID           | BIGINT(4)      | NOT NULL, AUTO_INCREMENT |
        | USER_EMAIL        | VARCHAR(128)  | NOT NULL                |
        | USER_DESC         | VARCHAR(128)  | NOT NULL                |
        | USER_PP           | VARCHAR(256)  | NOT NULL                |
        | USER_PSEUDO       | VARCHAR(50)   | NOT NULL                |
        | USER_NAME         | VARCHAR(50)   | NOT NULL                |
        | USER_SURNAME      | VARCHAR(50)   | NOT NULL                |
        | USER_PASSWORD     | VARCHAR(256)  | NOT NULL                |
        | USER_CREATED      | datetime       | NOT NULL                |
        | PRIMARY KEY       | (USER_ID)      |                         |
    - Table relation :
        | Nom de la colonne  | Type de données | Contraintes                                                     |
        | ------------------ | -------------- | --------------------------------------------------------------- |
        | FRIENDSHIP_ID      | BIGINT(4)      | NOT NULL, AUTO_INCREMENT                                       |
        | REQUEST_USER_ID    | BIGINT(4)      | NOT NULL                                                        |
        | ACCEPT_USER_ID     | BIGINT(4)      | NOT NULL                                                        |
        | PRIMARY KEY        | (FRIENDSHIP_ID)|                                                                 |
        | FK_T_FRIENDSHIP_REQUEST | FOREIGN KEY (REQUEST_USER_ID) | REFERENCES T_USER_PROFILE (USER_ID) |
        | FK_T_FRIENDSHIP_ACCEPT  | FOREIGN KEY (ACCEPT_USER_ID)  | REFERENCES T_USER_PROFILE (USER_ID) |


#### Style : 

- Utilisation de Flex et Grid

#### Classes importantes : 
- card : carte de profil
- post : un post
- main : la page principale (sans le header et le footer) utilisée dans l'index
- desc,com,left : parties d'un post
- login : interface pour formulaire de connexion / inscription
- center : centre la page semblable à main

 ### Conclusion

Ce projet nous a permis de développer nos compétences en développement web et de créer un site fonctionnel pour l'échange de messages entre utilisateurs, nous avons donc beaucoup appris sur les langages HTML, CSS, PHP et JavaScript, ainsi que sur les bases de données.

DROP DATABASE IF EXISTS DB;

CREATE DATABASE IF NOT EXISTS DB;
USE DB;
# -----------------------------------------------------------------------------
#       TABLE : T_COMMENTAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_COMMENTAIRE
 (
   USERID BIGINT(4) NOT NULL  ,
   POSTID BIGINT(4) NOT NULL  ,
   COMNUM BIGINT(4) NOT NULL  ,
   COMFEED VARCHAR(128) NOT NULL  ,
   COMLIKE BIGINT(4) NOT NULL  
   , PRIMARY KEY (USERID,POSTID,COMNUM) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE T_COMMENTAIRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_T_COMMENTAIRE_T_POST
     ON T_COMMENTAIRE (USERID ASC,POSTID ASC);

# -----------------------------------------------------------------------------
#       TABLE : T_UTILISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_UTILISATEUR
 (
   USERID BIGINT(4) NOT NULL  ,
   USERID_ETRE_SUIVI BIGINT(4) NOT NULL  ,
   USERID_T_SUIVRE BIGINT(4) NOT NULL  ,
   USERNAME VARCHAR(30) NULL  ,
   USERSURNAME VARCHAR(30) NULL  ,
   USERMAIL VARCHAR(50) NOT NULL  ,
   USERPASSWORD VARCHAR(50) NOT NULL  
   , PRIMARY KEY (USERID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE T_UTILISATEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_T_UTILISATEUR_T_UTILISATEUR
     ON T_UTILISATEUR (USERID_ETRE_SUIVI ASC);

CREATE  INDEX I_FK_T_UTILISATEUR_T_UTILISATEUR1
     ON T_UTILISATEUR (USERID_T_SUIVRE ASC);

# -----------------------------------------------------------------------------
#       TABLE : T_POST
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_POST
 (
   USERID BIGINT(4) NOT NULL  ,
   POSTID BIGINT(4) NOT NULL  ,
   POSTNAME VARCHAR(50) NOT NULL  ,
   POSTDESC VARCHAR(255) NOT NULL  ,
   POSTDATE DATE NOT NULL  ,
   POSTIMG VARCHAR(128) NOT NULL  ,
   POSTLIKE BIGINT(4) NOT NULL  
   , PRIMARY KEY (USERID,POSTID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE T_POST
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_T_POST_T_UTILISATEUR
     ON T_POST (USERID ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE T_COMMENTAIRE 
  ADD FOREIGN KEY FK_T_COMMENTAIRE_T_POST (USERID,POSTID)
      REFERENCES T_POST (USERID,POSTID) ;


ALTER TABLE T_UTILISATEUR 
  ADD FOREIGN KEY FK_T_UTILISATEUR_T_UTILISATEUR (USERID_ETRE_SUIVI)
      REFERENCES T_UTILISATEUR (USERID) ;


ALTER TABLE T_UTILISATEUR 
  ADD FOREIGN KEY FK_T_UTILISATEUR_T_UTILISATEUR1 (USERID_T_SUIVRE)
      REFERENCES T_UTILISATEUR (USERID) ;


ALTER TABLE T_POST 
  ADD FOREIGN KEY FK_T_POST_T_UTILISATEUR (USERID)
      REFERENCES T_UTILISATEUR (USERID) ;


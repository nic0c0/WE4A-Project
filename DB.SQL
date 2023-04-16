DROP DATABASE IF EXISTS DB;

CREATE DATABASE IF NOT EXISTS DB;
USE DB;
# -----------------------------------------------------------------------------
#       TABLE : T_LIKE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_LIKE
 (
   LIKE_ID BIGINT(4) NOT NULL AUTO_INCREMENT ,
   CREATED_TIME DATE NULL  ,
   USER_ID BIGINT(4) NOT NULL  ,
   POST_ID BIGINT(4) NOT NULL  
   , PRIMARY KEY (LIKE_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE T_LIKE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_T_LIKE_T_USER_PROFILE
     ON T_LIKE (USER_ID ASC);

CREATE  INDEX I_FK_T_LIKE_T_USER_POST
     ON T_LIKE (POST_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : T_USER_POST
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_USER_POST
 (
   POST_ID BIGINT(4) NOT NULL AUTO_INCREMENT  ,
   POST_TEXT VARCHAR(256) NOT NULL  ,
   CREATED_TIME DATE NOT NULL  ,
   POST_IMG VARCHAR(255) NOT NULL  ,
   USER_ID BIGINT(4) NOT NULL  
   , PRIMARY KEY (POST_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE T_USER_POST
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_T_USER_POST_T_USER_PROFILE
     ON T_USER_POST (USER_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : T_POST_COMMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_POST_COMMENT
 (
   COMMENT_ID BIGINT(4) NOT NULL AUTO_INCREMENT ,
   COMMENT_TEXT VARCHAR(128) NOT NULL  ,
   CREATED_TIME DATE NOT NULL  ,
   POST_ID BIGINT(4) NOT NULL  ,
   USER_ID BIGINT(4) NOT NULL  
   , PRIMARY KEY (COMMENT_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE T_POST_COMMENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_T_POST_COMMENT_T_USER_POST
     ON T_POST_COMMENT (POST_ID ASC);

CREATE  INDEX I_FK_T_POST_COMMENT_T_USER_PROFILE
     ON T_POST_COMMENT (USER_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : T_USER_PROFILE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_USER_PROFILE
 (
   USER_ID BIGINT(4) NOT NULL AUTO_INCREMENT ,
   USER_EMAIL VARCHAR(128) NOT NULL  ,
   USER_PP VARCHAR(256) NOT NULL  ,
   USER_PSEUDO VARCHAR(50) NOT NULL  ,
   USER_NAME VARCHAR(50) NOT NULL  ,
   USER_SURNAME VARCHAR(50) NOT NULL  ,
   USER_PASSWORD VARCHAR(50) NOT NULL  
   , PRIMARY KEY (USER_ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : T_FRIENDSHIP
# -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS T_FRIENDSHIP (
  FRIENDSHIP_ID BIGINT(4) NOT NULL AUTO_INCREMENT,
  REQUEST_USER_ID BIGINT(4) NOT NULL,
  ACCEPT_USER_ID BIGINT(4) NOT NULL,
  PRIMARY KEY (FRIENDSHIP_ID),
  CONSTRAINT FK_T_FRIENDSHIP_REQUEST
    FOREIGN KEY (REQUEST_USER_ID)
    REFERENCES T_USER_PROFILE (USER_ID),
  CONSTRAINT FK_T_FRIENDSHIP_ACCEPT
    FOREIGN KEY (ACCEPT_USER_ID)
    REFERENCES T_USER_PROFILE (USER_ID)
) COMMENT = "";

CREATE INDEX IF NOT EXISTS I_FK_T_FRIENDSHIP_REQUEST
  ON T_FRIENDSHIP (REQUEST_USER_ID ASC);

CREATE INDEX IF NOT EXISTS I_FK_T_FRIENDSHIP_ACCEPT
  ON T_FRIENDSHIP (ACCEPT_USER_ID ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE T_LIKE 
  ADD FOREIGN KEY FK_T_LIKE_T_USER_PROFILE (USER_ID)
      REFERENCES T_USER_PROFILE (USER_ID) ;


ALTER TABLE T_LIKE 
  ADD FOREIGN KEY FK_T_LIKE_T_USER_POST (POST_ID)
      REFERENCES T_USER_POST (POST_ID) ;


ALTER TABLE T_USER_POST 
  ADD FOREIGN KEY FK_T_USER_POST_T_USER_PROFILE (USER_ID)
      REFERENCES T_USER_PROFILE (USER_ID) ;


ALTER TABLE T_POST_COMMENT 
  ADD FOREIGN KEY FK_T_POST_COMMENT_T_USER_POST (POST_ID)
      REFERENCES T_USER_POST (POST_ID) ;


ALTER TABLE T_POST_COMMENT 
  ADD FOREIGN KEY FK_T_POST_COMMENT_T_USER_PROFILE (USER_ID)
      REFERENCES T_USER_PROFILE (USER_ID) ;



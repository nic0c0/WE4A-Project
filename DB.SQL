DROP DATABASE IF EXISTS DB;

CREATE DATABASE IF NOT EXISTS DB;
USE DB;
# -----------------------------------------------------------------------------
#       TABLE : T_LIKE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS T_LIKE
 (
   LIKE_ID BIGINT(4) NOT NULL AUTO_INCREMENT ,
   CREATED_TIME datetime NULL  ,
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
   POST_TITLE VARCHAR(32) NOT NULL  ,
   CREATED_TIME datetime NOT NULL  ,
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
   CREATED_TIME datetime NOT NULL  ,
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
   USER_DESC VARCHAR(128) NOT NULL  ,
   USER_PP VARCHAR(256) NOT NULL  ,
   USER_PSEUDO VARCHAR(50) NOT NULL  ,
   USER_NAME VARCHAR(50) NOT NULL  ,
   USER_SURNAME VARCHAR(50) NOT NULL  ,
   USER_PASSWORD VARCHAR(256) NOT NULL ,  
   USER_CREATED datetime NOT NULL  ,
   PRIMARY KEY (USER_ID) 
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









INSERT INTO `t_user_profile` (`USER_ID`, `USER_EMAIL`, `USER_PP`, `USER_PSEUDO`, `USER_NAME`, `USER_SURNAME`, `USER_PASSWORD`,`USER_DESC`, `USER_CREATED`) VALUES
(NULL, 'init@utbm.fr', './IMGDB/1profilpicture.gif', 'Init', 'IN', 'IT', '$2y$10$qcTXA0toOSOEL.xqfOpJ0OvwF0EpGjDV5B88R5gK8PCW5VXYd9b.S','','2023-04-18 19:14:06'),
(2, 'Nico@utbm.fr', './IMGDB/2profilpicture.png', 'Nico', 'Nicolas', 'Marcelin', '$2y$10$ljA/qByHsDnwqsIroyIk/O.Kb0AsO4Dgvpu8qUq1QqxUCO2ABv3Uy','', '2023-04-18 19:14:06'),
(3, 'Alb@utbm.fr', './IMGDB/3profilpicture.jpg', 'Alb', 'Albert', 'Royer', '$2y$10$ljA/qByHsDnwqsIroyIk/O.Kb0AsO4Dgvpu8qUq1QqxUCO2ABv3Uy','', '2023-04-18 19:14:06'),
(4, 'bob@yahoo.com', './IMGDB/4profilpicture.jpg', 'Bob', 'Jones', 'Bob', '$2y$10$yb4WTvcAB9BB099tNHhlg.jFLETNGcQKme9pQ4fvS43Aq/54GC1HC','Fan de Vincent van Gogh à mes heures perdues', '2023-04-18 19:14:06'),
(5, 'jane@hotmail.com', '', 'Jane', 'Doe', 'Jane', '$2y$10$yb4WTvcAB9BB099tNHhlg.jFLETNGcQKme9pQ4fvS43Aq/54GC1HC','', '2023-04-18 19:14:06'),
(6, 'sam@gmail.com', '', 'Sam', 'Smith', 'Sam', '$2y$10$yb4WTvcAB9BB099tNHhlg.jFLETNGcQKme9pQ4fvS43Aq/54GC1HC','', '2023-04-18 19:14:06'),
(7, 'sarah@hotmail.com', '', 'Sarah', 'Johnson', 'Sarah', '$2y$10$yb4WTvcAB9BB099tNHhlg.jFLETNGcQKme9pQ4fvS43Aq/54GC1HC','', '2023-04-18 19:14:06'),
(8, 'chris@yahoo.com', '', 'Chris', 'Davis', 'Chris', '$2y$10$yb4WTvcAB9BB099tNHhlg.jFLETNGcQKme9pQ4fvS43Aq/54GC1HC','', '2023-04-18 19:14:06'),
(9, 'lisa@gmail.com', '', 'Lisa', 'Jones', 'Lisa', '$2y$10$yb4WTvcAB9BB099tNHhlg.jFLETNGcQKme9pQ4fvS43Aq/54GC1HC','', '2023-04-18 19:14:06'),
(10, 'mike@hotmail.com', '', 'Mike', 'Miller', 'Mike', '$2y$10$yb4WTvcAB9BB099tNHhlg.jFLETNGcQKme9pQ4fvS43Aq/54GC1HC','','2023-04-18 19:14:06');


INSERT INTO `t_user_post` (`POST_ID`, `POST_TEXT`, `POST_TITLE`, `CREATED_TIME`, `POST_IMG`, `USER_ID`) VALUES
(NULL, 'Go Oun', 'Bulgogi', '2023-04-17 19:14:06', './IMGDB/1picture0.jpg', 1),
(NULL, 'Quel est ce plat ?', 'Bibimbap', '2023-04-18 19:14:06', './IMGDB/2picture0.jpg', 2),
(NULL, 'Ceci était un possible logo', 'Bibimbap', '2023-04-19 20:14:06', './IMGDB/3picture0.png', 3);
INSERT INTO `t_friendship` (`FRIENDSHIP_ID`, `REQUEST_USER_ID`, `ACCEPT_USER_ID`) VALUES 
(NULL, '2', '1'),
(NULL, '3', '1'),
(NULL,'4','3'),
(NULL,'4','2'),
(NULL,'4','1'),
(NULL,'3','2'),
(NULL,'2','3');

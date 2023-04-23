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
(NULL, 'Quel est ce plat ?', 'Bibimbap', '2023-04-18 20:20:06', './IMGDB/2picture0.jpg', 2),
(NULL, 'J\'ai généré ca !!', 'Bibimbap', '2023-04-19 21:26:06', './IMGDB/3picture0.png', 3),
(NULL, 'Je suis allé au Tokyo et c\'était super !', 'Sushi', '2023-04-23 14:06:35', './IMGDB/4picture0.jpg', 4),
(NULL, 'Nouvelle recette', 'Tteok-bokki', '2023-04-20 22:32:06', './IMGDB/5picture0.jpg', 5),
(NULL, 'Kimchi maison', 'Kimchi', '2023-04-21 23:38:06', './IMGDB/6picture0.jpg', 6),
(NULL, 'Recette facile', 'Jjajangmyeon', '2023-04-22 00:44:06', './IMGDB/7picture0.jpg', 7),
(NULL, 'Le plat du jour', 'Kimbap', '2023-04-23 01:50:06', './IMGDB/8picture0.jpg', 8),
(NULL, 'Nouvelle recette', 'Japchae', '2023-04-25 15:30:00', './IMGDB/10picture0.jpg', 10),
(NULL, 'Ramen', 'Super ramen', '2023-04-26 12:45:00', './IMGDB/3picture1.jpg', 3),
(NULL, 'Le Tonkatsu est un plat japonais composé d\'une tranche de porc panée et frite. Il est souvent servi avec du riz et des légumes.', 'Tonkatsu', '2023-04-25 15:30:00', './IMGDB/3picture2.jpg', 3),
(NULL, 'Dessert coréen', 'Bingsu', '2023-04-24 02:56:06', './IMGDB/9picture0.jpg', 9);



INSERT INTO `t_friendship` (`FRIENDSHIP_ID`, `REQUEST_USER_ID`, `ACCEPT_USER_ID`) VALUES 
(NULL, '2', '1'),
(NULL, '3', '1'),
(NULL,'4','3'),
(NULL,'4','2'),
(NULL,'4','1'),
(NULL,'3','2'),
(NULL,'2','3'),
(NULL, '5', '1'),
(NULL, '5', '2'),
(NULL, '5', '3'),
(NULL, '5', '4'),
(NULL, '5', '6'),
(NULL, '6', '1'),
(NULL, '6', '2'),
(NULL, '6', '4'),
(NULL, '7', '1'),
(NULL, '7', '3'),
(NULL, '7', '5'),
(NULL, '8', '2'),
(NULL, '8', '3'),
(NULL, '8', '6'),
(NULL, '9', '1'),
(NULL, '9', '4'),
(NULL, '9', '7'),
(NULL, '10', '2'),
(NULL, '10', '5');

INSERT INTO `t_post_comment` (`COMMENT_ID`, `COMMENT_TEXT`, `CREATED_TIME`, `POST_ID`, `USER_ID`) VALUES 
(NULL, 'Super photo !', '2023-04-18 10:30:00', '1', '5'),
(NULL, 'J\'adore ce plat !', '2023-04-18 12:15:00', '1', '6'),
(NULL, 'Les couleurs sont magnifiques !', '2023-04-19 14:34:17', '2', '4'),
(NULL, 'Très appétissant !', '2023-04-19 16:22:00', '2', '7'),
(NULL, 'J\'ai envie de le goûter !', '2023-04-20 11:10:00', '3', '3'),
(NULL, 'Belle présentation !', '2023-04-20 13:45:00', '3', '5'),
(NULL, 'J\'adore les sushis !', '2023-04-23 14:30:00', '4', '2'),
(NULL, 'Super voyage !', '2023-04-23 16:00:00', '4', '8'),
(NULL, 'Je vais essayer cette recette !', '2023-04-21 10:20:00', '5', '1'),
(NULL, 'Ça a l\'air délicieux !', '2023-04-21 12:40:00', '5', '6'),
(NULL, 'Le kimchi, mon plat préféré !', '2023-04-22 15:30:00', '6', '7'),
(NULL, 'Je suis fan de kimchi aussi !', '2023-04-22 17:45:00', '6', '3'),
(NULL, 'Je vais tester cette recette !', '2023-04-23 10:30:00', '7', '4'),
(NULL, 'Le kimbap, j\'adore !', '2023-04-23 12:15:00', '7', '8'),
(NULL, 'Je ne connais pas ce plat, mais ça a l\'air bon !', '2023-04-24 08:30:00', '9', '1'),
(NULL, 'Je suis curieux de goûter !', '2023-04-24 10:00:00', '9', '5'),
(NULL, 'J\'adore les ramen !', '2023-04-25 15:45:00', '10', '2'),
(NULL, 'La photo est très réussie !', '2023-04-25 17:30:00', '10', '7'),
(NULL, 'Ça a l\'air délicieux !', '2023-04-26 13:30:00', '11', '6'),
(NULL, 'Je vais tester cette recette ce week-end !', '2023-04-26 15:15:00', '11', '4'),
(NULL, 'J\'adore le Tonkatsu !', '2023-04-25 15:45:00', '12', '2'),
(NULL, 'J\'aime beaucoup ce plat !', '2023-04-19 16:20:42.000000', '3', '5'),
(NULL, 'Ça a l\'air délicieux !', '2023-04-20 09:45:53.000000', '4', '6'),
(NULL, 'J\'aimerais bien essayer cette recette !', '2023-04-21 13:37:20.000000', '5', '7'),
(NULL, 'J\'adore le kimchi maison !', '2023-04-22 18:59:12.000000', '6', '8'),
(NULL, 'Je vais essayer de faire cette recette ce week-end', '2023-04-23 08:12:39.000000', '7', '9'),
(NULL, 'C\'est l\'un de mes plats coréens préférés !', '2023-04-25 16:05:28.000000', '10', '2'),
(NULL, 'Je suis fan de ce plat !', '2023-04-26 14:20:19.000000', '11', '3'),
(NULL, 'Je ne connais pas encore ce plat, mais ça donne envie !', '2023-04-25 16:40:00.000000', '12', '4'),
(NULL, 'J\'adore les desserts coréens, et le bingsu est l\'un de mes préférés !', '2023-04-24 05:30:11.000000', '9', '1'),
(NULL, 'Je suis curieux de goûter à ce plat !', '2023-04-26 16:45:08.000000', '5', '5'),
(NULL, 'C\'est cool', '2023-04-19 14:34:17.000000', '2', '4'),
(NULL, 'Super post !', '2023-04-18 09:12:30.000000', '2', '5'),
(NULL, 'J\'adore ce que vous faites !', '2023-04-17 17:29:45.000000', '2', '6'),
(NULL, 'Très intéressant, merci pour le partage !', '2023-04-16 21:06:12.000000', '2', '7'),
(NULL, 'Je suis complètement d\'accord avec vous', '2023-04-16 10:45:21.000000', '2', '8'),
(NULL, 'Vous êtes vraiment talentueux, continuez comme ça !', '2023-04-15 16:22:33.000000', '2', '9'),
(NULL, 'Merci pour cette belle découverte', '2023-04-14 11:09:27.000000', '2', '10'),
(NULL, 'Je n\'aurais pas dit mieux moi-même !', '2023-04-13 19:57:41.000000', '2', '1'),
(NULL, 'Impressionnant !', '2023-04-12 08:33:56.000000', '2', '2'),
(NULL, 'Bravo pour ce post très instructif', '2023-04-11 15:20:10.000000', '2', '3');

INSERT INTO t_like (LIKE_ID, CREATED_TIME, USER_ID, POST_ID) VALUES 
(NULL, '2023-04-23 15:30:12', '2', '5'),
(NULL, '2023-04-23 16:12:45', '7', '9'),
(NULL, '2023-04-23 16:45:23', '4', '3'),
(NULL, '2023-04-23 17:20:56', '8', '11'),
(NULL, '2023-04-23 18:08:34', '1', '4'),
(NULL, '2023-04-23 19:01:02', '5', '12'),
(NULL, '2023-04-23 20:10:43', '6', '8'),
(NULL, '2023-04-23 21:30:21', '10', '2'),
(NULL, '2023-04-23 22:52:15', '9', '7'),
(NULL, '2023-04-23 23:33:51', '3', '1'),
(NULL, '2023-04-24 00:45:29', '2', '10'),
(NULL, '2023-04-24 01:37:11', '6', '6'),
(NULL, '2023-04-24 02:24:49', '8', '3'),
(NULL, '2023-04-24 03:15:27', '7', '11'),
(NULL, '2023-04-24 04:10:06', '5', '4'),
(NULL, '2023-04-24 05:08:46', '4', '12'),
(NULL, '2023-04-24 06:11:27', '1', '8'),
(NULL, '2023-04-24 07:18:09', '10', '2'),
(NULL, '2023-04-24 08:28:52', '9', '7'),
(NULL, '2023-04-24 09:43:36', '3', '1'),
(NULL, '2023-04-24 11:02:21', '2', '10'),
(NULL, '2023-04-24 12:25:07', '6', '6'),
(NULL, '2023-04-24 13:51:54', '8', '3'),
(NULL, '2023-04-24 15:22:42', '7', '11'),
(NULL, '2023-04-24 16:57:31', '5', '4'),
(NULL, '2023-04-24 18:36:21', '4', '12'),
(NULL, '2023-04-24 20:19:12', '1', '8'),
(NULL, '2023-04-24 22:06:04', '10', '2'),
(NULL, '2023-04-24 23:56:57', '9', '7');
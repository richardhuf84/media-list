# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.42)
# Database: media
# Generation Time: 2017-11-16 13:22:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `mediaid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(255) NOT NULL COMMENT 'User id',
  `imdbid` text NOT NULL,
  `title` text NOT NULL,
  `year` int(11) NOT NULL,
  `plot` text NOT NULL,
  `posterURL` text NOT NULL COMMENT 'URL to the movie poster on IMDB',
  `director` text NOT NULL,
  `genre` text NOT NULL,
  `media_type` text NOT NULL,
  PRIMARY KEY (`mediaid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;

INSERT INTO `media` (`mediaid`, `userid`, `imdbid`, `title`, `year`, `plot`, `posterURL`, `director`, `genre`, `media_type`)
VALUES
	(1,0,'0133093','The Matrix',1999,'Stuff happens.','http://www.imdb.com/media/rm461886464/tt0133093?ref_=tt_ov_i','fdgfg','Action','DVD'),
	(9,41,'tt0286716','Hulk',2003,'Bruce Banner, a genetics researcher with a tragic past, suffers an accident that causes him to transform into a raging green monster when he gets angry.','https://images-na.ssl-images-amazon.com/images/M/MV5BMTQxNzUxNTE4Nl5BMl5BanBnXkFtZTYwMjcyNTk5._V1_SX300.jpg','Ang Lee','Action, Sci-Fi','dvd'),
	(10,41,'tt0133093','The Matrix',1999,'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.','https://images-na.ssl-images-amazon.com/images/M/MV5BMDMyMmQ5YzgtYWMxOC00OTU0LWIwZjEtZWUwYTY5MjVkZjhhXkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SX300.jpg','Lana Wachowski, Lilly Wachowski','Action, Sci-Fi','bluray');

/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) NOT NULL COMMENT 'Users First Name',
  `LastName` varchar(255) NOT NULL COMMENT 'Users Last Name',
  `Email` varchar(255) NOT NULL COMMENT 'User email address',
  `Password` varchar(255) NOT NULL DEFAULT '' COMMENT 'User Password',
  `KeepLoggedIn` tinyint(1) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`, `KeepLoggedIn`)
VALUES
	(41,'user1','','user1@example.com','$2y$10$D9S.6GSFH5OwtVlV8bBlLO/.wiSHHgXZXy3o7qy/AkfsP1nepbTwO',0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

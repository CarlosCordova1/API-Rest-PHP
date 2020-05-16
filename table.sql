#http://localhost/test1/developer/api-rest/?user&unique=1
#http://carloscordova.com/developer/api-rest/?user&unique=1
#create by Carlos Cordova
#URL: http://carloscordova.com/

CREATE TABLE `api_user` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `nombre` varchar(45) NOT NULL,
   `apellido` varchar(45) NOT NULL,
   `ciudad` varchar(45) NOT NULL,
   `pais` varchar(45) NOT NULL,
   `genero` varchar(2) NOT NULL,
   `useragente` varchar(1000) DEFAULT NULL,
   `remoteip` varchar(45) DEFAULT NULL,
   `datein` datetime DEFAULT current_timestamp(),
   `dateupdate` datetime DEFAULT NULL,
   `datedelete` datetime DEFAULT NULL,
   PRIMARY KEY (`id`),
   UNIQUE KEY `nombre_UNIQUE` (`nombre`)
 ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
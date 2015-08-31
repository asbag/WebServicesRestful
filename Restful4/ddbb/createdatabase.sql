SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `frameworks`;
CREATE TABLE `frameworks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(36) NOT NULL COMMENT 'Framework name',
  `website` varchar(96) NOT NULL COMMENT 'website url',
  `installation` tinyint(4) NOT NULL COMMENT 'Manual or Composer',
  `description` varchar(512) NOT NULL,
  `somentions` mediumint(9) NOT NULL COMMENT 'Stackoverflow mentions',
  `lastup` varchar(10) NOT NULL COMMENT 'Last updated',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `installation` (`installation`),
  KEY `somentions` (`somentions`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

INSERT INTO `frameworks` (`id`, `name`, `website`, `installation`, `description`, `somentions`, `lastup`) VALUES
(2,	'swiftlet',	'http://swiftlet.org/',	0,	'Quite possibly the smallest MVC framework you will ever use.',	9,	'13/04/2014'),
(3,	'flight',	'http://flightphp.com',	0,	'An extensible micro-framework for PHP',	23,	'13/01/2015'),
(4,	'silex',	'http://silex.sensiolabs.org/',	1,	'A PHP micro-framework standing on the shoulder of giants',	1574,	'20/01/2015'),
(6,	'Slim',	'http://slimframework.com/',	1,	'A PHP micro framework that helps you quickly write simple yet powerful web applications and APIs',	6142,	'9/12/2014');


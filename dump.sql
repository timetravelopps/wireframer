CREATE TABLE `project` (
  `id_project` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(256) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `layout` (
  `id_layout` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) DEFAULT NULL,
  `order` int(5) NOT NULL DEFAULT '0',
  `element` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_layout`),
  KEY `fk_layout__project_idx` (`id_project`),
  CONSTRAINT `fk_layout__project` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

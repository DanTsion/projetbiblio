CREATE DATABASE IF NOT EXISTS projetBibliotheque;
USE projetBibliotheque;


DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `dateDeNaissance` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `codePostal` int(5) UNSIGNED ZEROFILL NOT NULL,
  `ville` varchar(30) NOT NULL,
  PRIMARY KEY (`idClient`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8_unicode_ci;



INSERT INTO `client` (`idClient`, `nom`, `prenom`, `dateDeNaissance`, `email`, `adresse`, `codePostal`, `ville`) VALUES
(1, 'ABGRALL', 'Gregory', '1984-05-17', 'greg.abgrall@gmail.com', '9 bis rue du collet', 13124, 'PEYPIN'),
(2, 'BRAME', 'Anthony', '1987-09-30', 'brame.anthony@hotmail.fr', '28, rue Edouard Herriot', 13090, 'AIX EN PROVENCE'),
(3, 'HENRI', 'Jacques', '1947-05-27', 'jacqueshenri@gmail.com', '8 avenue Robert Schuman', 75000, 'PARIS'),
(4, 'LABELLE', 'Violette', '1974-06-06', 'violettelabelle@gmail.com', '64, rue victor hugo', 33800, 'BORDEAUX'),
(5, 'LAMBERT', 'Rene', '1962-07-25', 'renelambert@gmail.com', '94, avenue de la rose', 13013, 'MARSEILLE'),
(6, 'ROUX', 'Aubert', '1940-09-26', 'aubertroux@yahoo.com', '41, rue albert camus', 13090, 'AIX EN PROVENCE');



DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `idLivre` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `auteur` varchar(30) NOT NULL,
  `editeur` varchar(30) NOT NULL,
  `dateDeParution` date NOT NULL,
  `ISBN` varchar(22) NOT NULL,
  `dispo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idLivre`),
  UNIQUE KEY `ISBN` (`ISBN`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8_unicode_ci;



INSERT INTO `livre` (`idLivre`, `titre`, `auteur`, `editeur`, `dateDeParution`, `ISBN`, `dispo`) VALUES
(1, 'Shinning', 'Stephen King', 'Double day', '1977-01-28', 'ISBN 978 0 3851 2167 5', 1),
(2, 'Les Miserable', 'Victor Hugo', 'Lacroix', '1862-05-21', 'ISBN 978 0 3851 2168 5', 1),
(3, 'notre dame de paris', 'Victor Hugo', 'Goselin', '1831-04-14', 'ISBN 978 0 3851 2168 7', 1),
(4, 'Les Trois Mousquetaires', 'Alexandre Dumas', 'Baudry', '1844-05-07', 'ISBN 978 0 3851 2161 4', 1),
(5, '20 000 Lieues sous les mers', 'Jules Verne', 'Goselin', '1841-04-05', 'ISBN 978 0 3851 2168 8', 1),
(6, 'Germinal', 'Emile Zola', 'Gil Blas', '1885-04-21', 'ISBN 978 0 3851 2877 1', 1);


DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `idEmprunt` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) NOT NULL,
  `idLivre` int(11) NOT NULL,
  `dateEmprunt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEmprunt`),
  KEY `FK_ClientEmprunt` (`idClient`),
  KEY `FK_LivreEmprunt` (`idLivre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE=utf8_unicode_ci;


DROP TRIGGER IF EXISTS `empruntLivre`;
DELIMITER //
CREATE TRIGGER `empruntLivre` AFTER INSERT ON `emprunt`
 FOR EACH ROW BEGIN
UPDATE livre SET dispo = 0 WHERE NEW.idLivre = livre.idLivre;
END
//

DELIMITER ;
DROP TRIGGER IF EXISTS `retourLivre`;
DELIMITER //
CREATE TRIGGER `retourLivre` BEFORE DELETE ON `emprunt`
 FOR EACH ROW BEGIN
UPDATE livre SET dispo = 1 WHERE OLD.idLivre = livre.idLivre;
END
//
DELIMITER ;


DELIMITER $$
DROP FUNCTION IF EXISTS `nbreEmprunt`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nbreEmprunt` (`choixidClient` VARCHAR(30)) RETURNS INT(3)
BEGIN
DECLARE nbreTotal int(3);
SELECT COUNT(`idClient`) INTO nbreTotal FROM `emprunt` WHERE idClient = choixidClient;  
RETURN nbreTotal;
END$$


ALTER TABLE `emprunt`
  ADD CONSTRAINT `FK_ClientEmprunt` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `FK_LivreEmprunt` FOREIGN KEY (`idLivre`) REFERENCES `livre` (`idLivre`);


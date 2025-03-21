/*
--------------------------------------------------------------------------------------------------------------------------------------------------------------
---FICHIER SQL POUR LA CREATION DE LA BASE DE DONNEES POUR LE PROJET DE BIBLIO---------------
---------------------------------------------------------------------------------------------
---Création de la base de données------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
DROP DATABASE IF EXISTS `biblio_iaec`;
CREATE DATABASE IF NOT EXISTS `biblio_iaec`;
USE `biblio_iaec`;


/*
--------------------------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
---Création des tables-----------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
DROP TABLE IF EXISTS `users_type`; 
CREATE TABLE IF NOT EXISTS `users_type`
(
    `id_user_type` CHAR(1) PRIMARY KEY, 
    `user_admin_statut` VARCHAR(15)
);

DROP TABLE IF EXISTS `users_infos`; 
CREATE TABLE IF NOT EXISTS `users_infos`
(
    `id_user` INT AUTO_INCREMENT PRIMARY KEY, 
    `user_lastname` VARCHAR(30) NOT NULL, 
    `user_firstname` VARCHAR(35) NOT NULL, 
    `user_sexe` VARCHAR(9), 
    `user_birthday` DATE, 
    `user_registration_date` DATETIME, 
    `user_email` VARCHAR(35) UNIQUE, 
    `user_password` VARCHAR(45) NOT NULL, 
    `id_user_type` CHAR(1),
    FOREIGN KEY (`id_user_type`) REFERENCES `users_type`(`id_user_type`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `app_contents`; 
CREATE TABLE IF NOT EXISTS `app_contents` 
(
    `id_content` INT AUTO_INCREMENT PRIMARY KEY, 
    `content_name` VARCHAR(70) UNIQUE, 
    `content_path` VARCHAR(80) NOT NULL, 
    `content_size` INT, 
    `content_bin` LONGBLOB NOT NULL,
    `content_typeMIME` VARCHAR(25) NOT NULL, 
    `content_upload_date` DATETIME, 
    `content_accessibility` VARCHAR(15), 
    `id_user` INT, 
    FOREIGN KEY (`id_user`) REFERENCES `users_infos`(`id_user`) ON DELETE CASCADE
) 
;


/*
--------------------------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
---Insertion de données-----------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
INSERT INTO `users_type`(`id_user_type`, `user_admin_statut`)
VALUES 
('1', 'Administrateur'),
('2', 'Utilisateur');


/*
--------------------------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
---Création des index-----------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE UNIQUE INDEX `searching_content` 
ON `app_contents`(`id_content`, `content_name`, `content_typeMIME`, `content_upload_date`);

/*
--------------------------------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
---Création des vues-----------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE VIEW `catalogue` AS
SELECT `content_name`, `content_typeMIME`, `content_upload_date`
FROM `app_contents`
GROUP BY `content_upload_date`;

DROP TABLE IF EXISTS `access_code`;
CREATE TABLE IF NOT EXISTS `access_code` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` char(7) NOT NULL,
  `Numadmin` char(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
);
INSERT INTO `access_code` (`id`, `code`, `Numadmin`) VALUES
(1, 'k@v,0n,', '001'),
(2, 'k@l,@b,', '002'),
(3, '@rn,0d,', '003');

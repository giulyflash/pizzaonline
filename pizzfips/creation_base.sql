CREATE TABLE `client` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`login` VARCHAR( 255 ) NOT NULL ,
`password` VARCHAR( 255 ) NOT NULL ,
`nom` VARCHAR( 255 ) NOT NULL ,
`prenom` VARCHAR( 255 ) NOT NULL ,
`adresse` VARCHAR( 255 ) NOT NULL ,
`codepostal` INT NOT NULL ,
`ville` VARCHAR( 255 ) NOT NULL ,
`telephone` INT NOT NULL
) ENGINE = MYISAM ;
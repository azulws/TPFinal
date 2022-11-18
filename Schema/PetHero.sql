CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOR EXISTS users
(
    id INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(20) NOT NULL,
    lastName VARCHAR(20) NOT NULL,
    userName VARCHAR(20) NOT NULL,
    password VARCHAR(20) NOT NULL,
    CONSTRAINT PK_Users PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS sizes
(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(20) NOT NULL,
    CONSTRAINT PK_Sizes PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS keepers 
(
    idKeeper INT NOT NULL AUTO_INCREMENT,
    user INT NOT NULL,
    remuneration INT DEFAULT 0,
    availability VARCHAR(1000) NOT NULL,
    CONSTRAINT PK_Keepers PRIMARY KEY (idKeeper),
    CONSTRAINT FK_User FOREIGN KEY (user) REFERENCES users(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS keepersXsizes
(
    id INT NOT NULL AUTO_INCREMENT,
    idSize INT NOT NULL,
    idKeeper INT NOT NULL,
    CONSTRAINT PK_keepersXsizes PRIMARY KEY (id),
    CONSTRAINT FK_idSize FOREIGN KEY (idSize) REFERENCES sizes(id),
    CONSTRAINT FK_idKeeper FOREIGN KEY (idKeeper) REFERENCES keepers(idKeeper)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS owners
(
    idOwner INT NOT NULL AUTO_INCREMENT,
    user INT NOT NULL,
    CONSTRAINT PK_Owners PRIMARY KEY (idOwner),
    CONSTRAINT FK_User FOREIGN KEY (user) REFERENCES users(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS petTypes
(
    id INT NOT NULL AUTO_INCREMENT,
    breed VARCHAR(20) NOT NULL,
    CONSTRAINT PK_PetTypes PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS pets
(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    Owner INT NOT NULL,
    petType INT NOT NULL,
    description VARCHAR(100) NOT NULL,
    image VARCHAR(100) NOT NULL,
    vaccination VARCHAR(100) NOT NULL,
    video VARCHAR(100) NOT NULL,
    size INT NOT NULL,
    CONSTRAINT PK_Pets PRIMARY KEY (id),
    CONSTRAINT FK_Owner FOREIGN KEY (Owner) REFERENCES Owners(idOwner),
    CONSTRAINT FK_PetType FOREIGN KEY (petType) REFERENCES petTypes(id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS Reservations
(
    id INT NOT NULL AUTO_INCREMENT,
    keeper INT NOT NULL,
    pet INT NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    state VARCHAR(100) NOT NULL DEFAULT("PENDING"),
    price VARCHAR(100) NOT NULL,
    CONSTRAINT PK_Reservations PRIMARY KEY (id),
    CONSTRAINT FK_Keeper FOREIGN KEY (keeper) REFERENCES keepers(idKeeper),
    CONSTRAINT FK_Pet FOREIGN KEY (pet) REFERENCES pets(id)
)

DROP procedure IF EXISTS `User_GetByUserName`;

DELIMITER $$

CREATE PROCEDURE User_GetByUserName (IN userName VARCHAR(100))
BEGIN
	SELECT id
    FROM users
    WHERE (users.userName = userName);
END$$

DROP procedure IF EXISTS `Keeper_Add`;

DELIMITER $$

CREATE PROCEDURE Keeper_Add (IN firstName VARCHAR(20), IN lastName VARCHAR(20), IN userName VARCHAR(20), IN password VARCHAR(20), IN availability VARCHAR(1000), IN sizes INT)
BEGIN
    INSERT INTO users
        (users.firstName, users.lastName, users.userName, users.password)
    VALUES
        (firstName, lastName, userName, password)

	INSERT INTO keepers
        (User_GetByUserName,keeper.remuneration,keeper.availability)
    VALUES
        (remuneration);
END$$

DROP procedure IF EXISTS `Keeper_GetAll`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetAll ()
BEGIN
	SELECT *
    FROM keepers;
END$$

DROP procedure IF EXISTS `Keeper_Remove`;

DELIMITER $$

CREATE PROCEDURE Keeper_Remove (IN id INT)
BEGIN
	DELETE 
    FROM keepers
    WHERE (keepers.idKeeper = id);
END$$

DROP procedure IF EXISTS `Keeper_GetByUserName`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetByUserName (IN userName VARCHAR(100))
BEGIN
	SELECT *
    FROM keepers
    WHERE (keepers.userName = userName);
END$$

DROP procedure IF EXISTS `Keeper_GetById`;

DELIMITER $$

CREATE PROCEDURE Keeper_GetById (IN id INT)
BEGIN
	SELECT *
    FROM keepers
    WHERE (keepers.idKeeper = id);
END$$

INSERT INTO sizes 
    (nombre)
VALUES
    ("CHICO"),
    ("MEDIO"),
    ("GRANDE");
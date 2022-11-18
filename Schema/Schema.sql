create database PetHero;

use PetHero;

create table PetType(
id int ,
breed varchar(50),
constraint pk_id primary key (id)
);


create table Owner(
idOwner int auto_increment,
firstName varchar(50),
lastName varchar (50),
userName varchar (50),
userPassword varchar (50),
constraint pk_idOwner primary key (idOwner)
);


create table Pet(
id int auto_increment,
name varchar(50),
idOwner int,
idPetType int,
description varchar(200),
petsize varchar (50),
image varchar(50),
vaccination varchar(50),
video varchar (50),
constraint pk_idPet primary key(id),
constraint fk_idOwner foreign key (idOwner) references Owner (idOwner),
constraint fk_idPetType foreign key (idPetType) references PetType (id)

);


insert into PetType(id, breed)
values(1, 'Dog'),
(2, 'Cat');


create table keeper(
idKeeper int auto_increment,
firstName varchar(50),
lastName varchar (50),
userName varchar (50),
userPassword varchar (50),
remuneration int (50) default 0,
reputation int (50) default 0,
constraint pk_idKeeper primary key (idKeeper)
);

create table availability(
id int auto_increment,
fecha date,
idKeeper int,
constraint pk_id primary key (id),
constraint fk_idKeeper foreign key (idKeeper) references keeper (idKeeper)
);

create table petsize(
id int auto_increment,
petsize varchar(50),
constraint pk_id primary key (id) 
);

create table Size_x_keeper(
id int auto_increment,
idPetSize int,
idKeeper int,
constraint pk_idSxK primary key (id),
constraint  foreign key (idKeeper) references keeper (idKeeper),
constraint  foreign key (idPetSize) references petsize (id),
constraint uc_sizeXkeeper unique (idPetSize, idKeeper)
);

CREATE TABLE IF NOT EXISTS reservation
(
    id INT NOT NULL AUTO_INCREMENT,
    idKeeper INT NOT NULL,
    idPet INT NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL,
    state VARCHAR(100) NOT NULL DEFAULT "PENDING",
    price INT NOT NULL,
    CONSTRAINT PK_Reservations PRIMARY KEY (id),
    CONSTRAINT FK_Keeper FOREIGN KEY (idKeeper) REFERENCES keepers(idKeeper),
    CONSTRAINT FK_Pet FOREIGN KEY (idPet) REFERENCES pets(id)
);

DROP procedure IF EXISTS `reservation_Add`;

DELIMITER $$

CREATE PROCEDURE reservation_Add (IN idKeeper INT, IN idPet INT, IN startDate date, IN endDate date, IN price INT)
BEGIN
    INSERT INTO reservation
        (reservation.idKeeper, reservation.idPet, reservation.startDate, reservation.endDate, reservation.price)
    VALUES
        (idKeeper, idPet, startDate, endDate, price);
	select last_insert_id();
END$$

DELIMITER ;;
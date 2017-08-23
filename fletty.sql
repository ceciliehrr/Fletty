use fletty;


DROP TABLE IF EXISTS flettylogg;
DROP TABLE IF EXISTS brukere;
DROP TABLE IF EXISTS uttrekk;
DROP TABLE IF EXISTS infofiler;

CREATE TABLE infofiler (
	filnavn VARCHAR(150),
	filtype VARCHAR(10),
	filsize INT,
	innhold MEDIUMBLOB,
PRIMARY KEY (filnavn)
 ) engine = InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
CREATE TABLE brukere (
	id INT(6) UNSIGNED AUTO_INCREMENT,
	brukernavn VARCHAR(50),
	passord VARCHAR(50),
PRIMARY KEY (id)
 ) engine = InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE uttrekk (
	id INT(6) UNSIGNED AUTO_INCREMENT,
	skjermet VARCHAR(10),
	arkivskaper VARCHAR(100) NOT NULL,
	arkivleder VARCHAR(100),
	status VARCHAR(100) NOT NULL,
	startDato VARCHAR(15),
	sluttDato VARCHAR(15),
	saksNR VARCHAR(50),
	mottattDATO DATE,
	forventetAnkomst VARCHAR(50),
	system VARCHAR (100) NOT NULL,
	systemversjon VARCHAR (50),
	systemtype VARCHAR(100),
	databaseplattform VARCHAR(100),
	etikett VARCHAR(100),
	ansvarlig VARCHAR(50) NOT NULL,
	kommentar VARCHAR(500),
	sistendret TIMESTAMP,
	endretAv VARCHAR(100),
	infofil VARCHAR(150),
	FOREIGN KEY(infofil) REFERENCES infofiler(filnavn),
PRIMARY KEY (id)
 ) engine = InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 

CREATE TABLE flettylogg (
	id INT(6) NOT NULL,
	skjermet VARCHAR(10),
	arkivskaper VARCHAR(100) NOT NULL,
	arkivleder VARCHAR(100),
	status VARCHAR(100) NOT NULL,
	startDato VARCHAR(15),
	sluttDato VARCHAR(15),
	saksNR VARCHAR(50),
	mottattDATO DATE,
	forventetAnkomst VARCHAR(50),
	system VARCHAR (100) NOT NULL,
	systemversjon VARCHAR (50),
	systemtype VARCHAR (100),
	databaseplattform VARCHAR(100),
	etikett VARCHAR(100),
	ansvarlig VARCHAR(50) NOT NULL,
	kommentar VARCHAR(500),
	infofil VARCHAR(255),
	logg_id INT auto_increment,
	sistendret TIMESTAMP,
	endretAv VARCHAR(100),
	slettet DATETIME,
	slettetAv VARCHAR(100),
PRIMARY KEY (logg_id)
 ) engine = InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 DROP TRIGGER IF EXISTS uttrekk_a_upd;


DELIMITER //
CREATE TRIGGER uttrekk_a_upd
BEFORE UPDATE ON uttrekk
FOR EACH ROW
BEGIN

-- DECLARE vUser varchar(50);
-- SELECT USER() INTO vUser;

INSERT INTO flettylogg(id ,skjermet,arkivskaper,arkivleder,status,startDato,sluttDato, saksNR,mottattDATO,forventetAnkomst,system ,systemversjon, systemtype,databaseplattform, etikett,ansvarlig , kommentar, sistendret,endretAv)
VALUES(OLD.id,OLD.skjermet, OLD.arkivskaper,OLD.arkivleder,OLD.status,OLD.startDato,OLD.sluttDato, OLD.saksNR,OLD.mottattDATO,OLD.forventetAnkomst,OLD.system ,OLD.systemversjon, OLD.systemtype,OLD.databaseplattform, OLD.etikett,OLD.ansvarlig,OLD.kommentar, NOW(),OLD.endretAv);

END;//
DELIMITER ;


DROP TRIGGER IF EXISTS uttrekk_before_delete;
DELIMITER //



CREATE TRIGGER uttrekk_before_delete
BEFORE DELETE
   ON uttrekk FOR EACH ROW

BEGIN

   DECLARE vUser varchar(50);

   -- Find username of person performing the DELETE into table
   SELECT USER() INTO vUser;

   -- Insert record into audit table
   INSERT INTO flettylogg
   ( id, skjermet,
      arkivskaper,arkivleder, status, startDato,sluttDato, saksNR, mottattDATO, forventetAnkomst, system, systemversjon, systemtype,databaseplattform, etikett, ansvarlig, kommentar, sistendret, endretAv,
     slettet,
     slettetAv)
   VALUES
   ( OLD.id, OLD.skjermet,
     OLD.arkivskaper,OLD.arkivleder, OLD.status, OLD.startDato, OLD.sluttDato, OLD.saksNR, OLD.mottattDATO, OLD.forventetAnkomst, OLD.system,OLD.systemversjon, OLD.systemtype,OLD.databaseplattform, OLD.etikett, OLD.ansvarlig,OLD.kommentar, NOW(), OLD.endretAv,
     NOW(),
     OLD.endretAv );

END; //

DELIMITER ;


INSERT INTO uttrekk
		(skjermet,arkivskaper,arkivleder,  status, startDato, sluttDato, saksNR, mottattDATO, forventetAnkomst, system, systemversjon, systemtype,databaseplattform,
		  etikett, ansvarlig, sistendret)
		 VALUES
		 ('ja','Kongsberg','tove', '1: Avtalt', '2001', '2012', '1232134', '2017-02-02', '2017-04-04', 'esa','0.2', 'noark 4','esa',
		   'esa', 'cecilie', now() );
		   
INSERT INTO brukere 
(brukernavn, passord)
VALUES 
('', '');

INSERT INTO brukere 
(brukernavn, passord)
VALUES 
('', '');

INSERT INTO brukere 
(brukernavn, passord)
VALUES 
('admin', 'admin') ;
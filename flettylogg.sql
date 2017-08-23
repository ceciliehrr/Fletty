use fletty;


DROP TABLE IF EXISTS flettylogg;

CREATE TABLE flettylogg (
	id INT(6) NOT NULL,
	arkivskaper VARCHAR(100) NOT NULL,
	status VARCHAR(100) NOT NULL,
	startDato VARCHAR(15),
	sluttDato VARCHAR(15),
	saksNR VARCHAR(50),
	mottattDATO DATE NOT NULL,
	forventetAnkomst DATE,
	system VARCHAR (100) NOT NULL,
	systemversjon VARCHAR (50),
	systemtype VARCHAR (100),
	etikett VARCHAR(100),
	ansvarlig VARCHAR(50) NOT NULL,
	kommentar VARCHAR(500),
	logg_id INT auto_increment,
	sistendret TIMESTAMP,
	endretAv VARCHAR(100),
	slettet DATETIME,
	slettetAv VARCHAR(100),
PRIMARY KEY (logg_id)
 ) engine = InnoDB;
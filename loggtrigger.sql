
\W

USE fletty;

DROP TRIGGER IF EXISTS uttrekk_a_upd;


DELIMITER //
CREATE TRIGGER uttrekk_a_upd
BEFORE UPDATE ON uttrekk
FOR EACH ROW
BEGIN

DECLARE vUser varchar(50);
SELECT USER() INTO vUser;

INSERT INTO flettylogg(id ,arkivskaper,status,startDato,sluttDato, saksNR,mottattDATO,forventetAnkomst,system ,systemversjon, systemtype, etikett,ansvarlig , kommentar, sistendret,endretAv)
VALUES(NEW.id,NEW.arkivskaper,NEW.status,NEW.startDato,NEW.sluttDato, NEW.saksNR,NEW.mottattDATO,NEW.forventetAnkomst,NEW.system ,NEW.systemversjon, NEW.systemtype, NEW.etikett,NEW.ansvarlig,NEW.kommentar, NOW(),vUser);

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
   ( id,
      arkivskaper, status, startDato,sluttDato, saksNR, mottattDATO, forventetAnkomst, system, systemversjon, systemtype, etikett, ansvarlig, kommentar, sistendret,
     slettet,
     slettetAv)
   VALUES
   ( OLD.id,
     OLD.arkivskaper, OLD.status, OLD.startDato, OLD.sluttDato, OLD.saksNR, OLD.mottattDATO, OLD.forventetAnkomst, OLD.system,OLD.systemversjon, OLD.systemtype, OLD.etikett, OLD.ansvarlig,OLD.kommentar, NOW(),
     NOW(),
     vUser );

END; //

DELIMITER ;
	

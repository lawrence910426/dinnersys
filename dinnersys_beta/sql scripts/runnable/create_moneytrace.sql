USE dinnersys;
DROP PROCEDURE IF EXISTS create_moneytrace;
DELIMITER $$

CREATE PROCEDURE create_moneytrace(esti_recv DATETIME)
BEGIN
	#### MAKE MONEY TRACE ####
	DECLARE id INT DEFAULT -1;
	
	#### CREATE PAYMENT ####
	CALL create_payment(esti_recv);
	CALL create_payment(esti_recv);
	CALL create_payment(esti_recv);
	CALL create_payment(esti_recv);

	SET id = (SELECT MAX(P.id) FROM `dinnersys`.`payment` AS P);
    
	INSERT INTO `dinnersys`.`money_trace`
	(`charge`,
	`user`,
	`dinnerman`,
	`cafeteria`,
	`factory`)
	VALUES ('55', id - 0, id - 1, id - 2, id - 3);
END$$
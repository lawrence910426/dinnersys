#### CREATE PAYMENT ####

USE dinnersys;

DROP PROCEDURE IF EXISTS create_payment;
DROP FUNCTION IF EXISTS get_day_start;
DROP FUNCTION IF EXISTS get_day_end;

DELIMITER $$

CREATE FUNCTION get_day_start(moment DATETIME) RETURNS DATETIME
BEGIN
	RETURN FROM_UNIXTIME(floor((UNIX_TIMESTAMP(moment) + 28800) / 86400) * 86400 - 28800);		# 28800 is for timezone shift.
END$$

CREATE FUNCTION get_day_end(moment DATETIME) RETURNS TIMESTAMP
BEGIN
	RETURN FROM_UNIXTIME(ceil((UNIX_TIMESTAMP(moment) + 28800) / 86400) * 86400 - 28800 - 1);			# 28800 is for timezone shift.
END$$


CREATE PROCEDURE create_payment(esti_recv DATETIME)
BEGIN
	INSERT INTO `dinnersys`.`payment`
	(`paid`, 
	`freeze_datetime`, `able_datetime`, `paid_datetime`,
	`include_credit`, `authority_id`)
	VALUES
	(
		FALSE,
		get_day_end(esti_recv), get_day_start(esti_recv), NULL,
		FALSE,
		-1
    );
END$$
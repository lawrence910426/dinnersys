#### INIT CLASS ####
USE DINNERSYS;

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`class`;
SET FOREIGN_KEY_CHECKS = 1;

DROP PROCEDURE IF EXISTS run_loop;

DELIMITER $$
CREATE PROCEDURE run_loop()
BEGIN
	DECLARE counter INT default 1;
	WHILE (counter <= 20) DO
		INSERT INTO `dinnersys`.`class`
		(`year`,`grade`,
		`class_no`,
		`members`, `dinnerman_id`, `leader_id`)
		VALUES
		(2018, @grade,
		@grade * 100 + counter,
		NULL, NULL ,NULL);
		SET counter = counter + 1;
	END WHILE;
END$$

DELIMITER ;
SET @grade = 1;
CALL run_loop();
SET @grade = 2;
CALL run_loop();
SET @grade = 3;
CALL run_loop();


#### CREATE VIRTUAL CLASS TO SATISFY DEPENDENCY ####
INSERT INTO `dinnersys`.`class` (`id`, `year`, `grade`, `class_no`, `members`, `dinnerman_id`, `leader_id`)
VALUES (-1, -1, -1, -1, NULL, NULL, NULL);

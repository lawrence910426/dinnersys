
#### ADD LOG ####

USE dinnersys;

DROP PROCEDURE IF EXISTS make_log;

DELIMITER $$
CREATE PROCEDURE make_log(uid INT ,func_name VARCHAR(128) ,query_detail VARCHAR(4096) ,ip VARCHAR(128))
BEGIN
	INSERT INTO `dinnersys`.`log`
	(`user_name`,
	`prev_sum`,
	`oper_name`,
	`query_detail`,
	`datetime`,
	`ip`,
	`device_id`)
	VALUES
	((SELECT UI.name FROM `dinnersys`.`users` ,`dinnersys`.`user_information` AS UI WHERE users.id = uid AND users.info_id = UI.id),
	(SELECT prev_sum FROM `dinnersys`.`users` WHERE id = uid),
	func_name,
	query_detail,
	CURRENT_TIMESTAMP,
	ip,
	(SELECT device_id FROM `dinnersys`.`users` WHERE users.id = uid));
END$$

DELIMITER ;

CALL make_log(807 ,'asdf' ,'fdas' ,'0.0.0.0');

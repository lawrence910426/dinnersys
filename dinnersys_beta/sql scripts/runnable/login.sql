#### login ####
USE dinnersys;

DROP PROCEDURE IF EXISTS login;
SET collation_connection = 'utf8_unicode_ci';

DELIMITER $$
CREATE PROCEDURE login(login_id VARCHAR(128) ,pswd VARCHAR(1024) ,device VARCHAR(1024))
BEGIN
	DECLARE id INT DEFAULT (
		SELECT U.id FROM `dinnersys`.`users` AS U
		WHERE U.login_id = login_id COLLATE utf8_unicode_ci
		AND U.password = pswd COLLATE utf8_unicode_ci
	);
	
	UPDATE `dinnersys`.`users`
	SET `device_id` = device
	WHERE users.`id` = id;
	
    SELECT U.id ,UI.name ,U.class_id FROM `dinnersys`.`users` AS U ,`dinnersys`.`user_information` AS UI
    WHERE U.info_id = UI.id AND U.id = id;
END$$

DELIMITER ;

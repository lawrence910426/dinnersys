#### LOGOUT ####

USE dinnersys;

DROP PROCEDURE IF EXISTS logout;

DELIMITER $$
CREATE PROCEDURE logout(user_id INT)
BEGIN
	UPDATE `dinnersys`.`users`
	SET `device_id` = NULL
	WHERE `id` = user_id;
END$$

DELIMITER ;

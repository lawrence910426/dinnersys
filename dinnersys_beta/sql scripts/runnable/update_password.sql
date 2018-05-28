#### CHANGE PASSWORD ####

USE dinnersys;

DROP FUNCTION IF EXISTS change_password;

DELIMITER $$
CREATE FUNCTION change_password(id INT ,pswd_old VARCHAR(1024) ,pswd_new VARCHAR(1024)) RETURNS VARCHAR(1024)
BEGIN
	DECLARE user_id INT DEFAULT (
		SELECT U.id FROM users AS U 
        WHERE id = U.id
        AND pswd_old = U.`password` COLLATE utf8_unicode_ci
    );
    
    IF user_id IS NULL THEN
		RETURN 'wrong password';
    END IF;
    
    UPDATE `dinnersys`.`users`
	SET `password` = pswd_new
	WHERE `users`.`id` = user_id;
    
    RETURN 'success';
END$$

DELIMITER ;

SELECT change_password('-4' ,'44' ,'1234');
#### GET AUTH ####

USE dinnersys;

DROP FUNCTION IF EXISTS get_auth_id;

DELIMITER $$
CREATE FUNCTION get_auth_id(user INT ,ip VARCHAR(1024)) RETURNS INT
BEGIN
	DECLARE id INT DEFAULT NULL;
	SET id = 
	(
		SELECT A.id FROM `dinnersys`.`authority` AS A
		WHERE A.user = user
		AND A.ip = ip COLLATE utf8_unicode_ci
        LIMIT 1
	);
    
	IF id IS NULL THEN
		INSERT INTO `dinnersys`.`authority`
		(`user`, `ip`)
		VALUES ( user, ip );
        RETURN (SELECT MAX(A.id) FROM `dinnersys`.`authority` AS A);
    ELSE
		UPDATE `dinnersys`.`authority`
		SET `last_used_datetime` = CURRENT_TIMESTAMP
		WHERE `id` = id;
		RETURN id;
    END IF;
END$$

DELIMITER ;

SELECT get_auth_id(1 ,'127.0.0.1');


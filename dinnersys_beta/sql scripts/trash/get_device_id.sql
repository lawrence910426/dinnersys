#### GET DEVICE ####
USE dinnersys;

DROP FUNCTION IF EXISTS get_device_id;

DELIMITER $$
CREATE FUNCTION get_device_id(usr_id INT ,device_id VARCHAR(4096) ,device_type VARCHAR(128)
	,ip VARCHAR(1024)) RETURNS INT
BEGIN
	DECLARE id INT DEFAULT NULL;
	SET id = 
	(
		SELECT D.id FROM `dinnersys`.`device` AS D 
		WHERE D.belongs_user_id = usr_id
		AND D.device_id = device_id
        AND D.device_type = device_type LIMIT 1
	);
	
    IF id = NULL THEN
		INSERT INTO `dinnersys`.`device`
        (`device_id`,
        `device_info`,
		`device_type`,
		`last_ip`,
		`last_used_datetime`,
		`belongs_user_id`)
		VALUES
		(device_id,
        'unknown device info',
		device_type,
		ip,
		CURRENT_TIMESTAMP,
		usr_id);

        RETURN (SELECT MAX(id) FROM `dinnersys`.`device`);
    ELSE
		UPDATE `dinnersys`.`device` AS D
		SET D.`last_ip` = ip,
		D.`last_used_datetime` = CURRENT_TIMESTAMP
		WHERE D.`id` = id;
		RETURN id;
    END IF;
END$$

DELIMITER ;
SELECT get_device_id(1 ,'0000' ,'Android' ,'127.0.0.1');


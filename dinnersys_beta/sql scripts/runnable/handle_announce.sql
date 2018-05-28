#### HANDLE ANNOUNCE ####
USE dinnersys;
DROP PROCEDURE IF EXISTS get_announce;
DROP PROCEDURE IF EXISTS done_announce;

DELIMITER $$

CREATE PROCEDURE get_announce(lower_bound DATETIME ,upper_bound DATETIME)
BEGIN
	SELECT A.id ,A.msg ,A.anno_type ,A.estimate_datetime ,U.device_id
    FROM users AS U ,orders AS O ,announce AS A
    
    WHERE IFNULL(lower_bound ,CURRENT_TIMESTAMP) < A.estimate_datetime
    AND A.estimate_datetime < IFNULL(upper_bound ,DATE_ADD(CURRENT_TIMESTAMP ,INTERVAL 30 MINUTE))
    AND O.announce_id = A.id AND O.user_id = U.id
    AND A.disabled = FALSE AND A.announced = FALSE;
END$$

CREATE PROCEDURE done_announce(id INT ,device_id VARCHAR(4096))
BEGIN
	UPDATE `dinnersys`.`announce`
	SET `pushed_datetime` = CURRENT_TIMESTAMP,
	`announced` = TRUE,
	`notify_on` = device_id
	WHERE announce.`id` = id;
END$$

DELIMITER ;

CALL get_announce(null ,DATE_ADD(CURRENT_TIMESTAMP ,INTERVAL 30 HOUR));
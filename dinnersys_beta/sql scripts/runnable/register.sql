#### REGISTER ####

USE dinnersys;

DROP FUNCTION IF EXISTS register;

DELIMITER $$
CREATE FUNCTION register(
	usr_name VARCHAR(1024) ,phone_num VARCHAR(128) ,is_vege INT ,gen VARCHAR(64) ,email VARCHAR(1024) ,
    usr_login_id VARCHAR(128) ,pswd VARCHAR(1024)) RETURNS VARCHAR(128)
BEGIN
	IF (SELECT COUNT(id) FROM `dinnersys`.`users` AS U 
		WHERE U.login_id = usr_login_id COLLATE utf8_unicode_ci) = 1 THEN
		RETURN 'repeated login id';
    END IF;

	INSERT INTO `dinnersys`.`user_information`
	(`name`, `ad_times`,`phone_number`, `is_vegetarian`,
	`credits`, `gender`, `class_id`, `school_id` ,
	`seat_id` ,`email`)
	VALUES
	(usr_name ,0 ,phone_num ,is_vege ,
    0 ,gen ,-1 ,NULL ,
    NULL ,email);

	## CREATE user ##
		
	INSERT INTO `dinnersys`.`users`
	(`login_id`,`prev_sum`, `password`,
	`class_id`, `year`, `info_id`)
	VALUES
	(usr_login_id ,3 ,pswd ,
    -1 ,-1 ,(SELECT MAX(UI.id) FROM `dinnersys`.`user_information` AS UI));
    
    RETURN 'success';
END$$

DELIMITER ;

SELECT register('lawrence'
,'0905-098-503'  
,0 
,'MALE' 
,'lrc1234@gmail.com'  
,'l4wr3nc3' 
,'2rjurrru' 
);
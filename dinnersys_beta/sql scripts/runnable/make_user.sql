#### MAKE USER ####
use dinnersys;

DROP PROCEDURE IF EXISTS make_user;
DROP PROCEDURE IF EXISTS reset_user;

DELIMITER $$

CREATE PROCEDURE make_user(
	id INT ,uname VARCHAR(128) ,phone VARCHAR(128) ,
    is_vege BOOL ,gender VARCHAR(64) ,class_id INT ,class_no INT ,
    school_id INT ,seat_id INT ,email VARCHAR(256) ,
    
    login_id VARCHAR(128) ,pswd VARCHAR(1024) ,
    prev_sum INT ,grade INT)
BEGIN
	IF id IS NULL THEN
		SET id = (SELECT MAX(U.id) FROM users AS U) + 1;
        SET id = IFNULL(id ,1);							# if users is empty id would be null.
    END IF;
    
	INSERT INTO `dinnersys`.`user_information`
	(`id` ,`name`,
	`ad_times`,
	`phone_number`,
	`is_vegetarian`,
	`credits`,
	`gender`,			
	`class_id`,
	`school_id` ,
	`seat_id` ,
	`email`)			
	VALUES
	(id ,uname,
	0,
	phone,
	is_vege,
	0,
	gender,
	class_no,
	school_id ,
	seat_id ,
	email);

	## CREATE user ##

	INSERT INTO `dinnersys`.`users`
	(`id`, 
	`login_id`,
	`prev_sum`,
	`password`,
	`class_id`,
	`year`,
	`info_id`)
	VALUES
	(
    id ,
	login_id,
	prev_sum,
	pswd,
	class_id,
	grade,
	(SELECT MAX(id) FROM `dinnersys`.`user_information`));

END$$


CREATE PROCEDURE reset_user()
BEGIN
	SET FOREIGN_KEY_CHECKS = 0;
	TRUNCATE TABLE `dinnersys`.`users`;
	TRUNCATE TABLE `dinnersys`.`user_information`;
	SET FOREIGN_KEY_CHECKS = 1;
END$$
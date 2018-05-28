#### UPDATE MENU ####
USE dinnersys;

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`menu`;
SET FOREIGN_KEY_CHECKS = 1;

DROP PROCEDURE IF EXISTS run_loop;

DELIMITER $$
CREATE PROCEDURE run_loop()
BEGIN
	DECLARE counter INT default 0;
	WHILE (counter <= 100) DO
		INSERT INTO `dinnersys`.`menu`
		(`charge`, `name`, 
		`is_ingredient`, `is_dish`, 
		`factory_id`, `is_vegetarian`,
		`is_idle`)
		VALUES
		(
			-1 ,'閒置中的餐點' ,
            TRUE ,TRUE ,
            (
				SELECT id FROM `dinnersys`.`factory` WHERE name = @factory_name LIMIT 1
            ), FALSE ,TRUE
        );
		SET counter = counter + 1;
	END WHILE;
END$$

DELIMITER ;
SET @factory_name = '愛佳便當' COLLATE utf8_unicode_ci;
CALL run_loop();
SET @factory_name = '早餐部' COLLATE utf8_unicode_ci;
CALL run_loop();
SET @factory_name = '關東煮' COLLATE utf8_unicode_ci;
CALL run_loop();
SET @factory_name = '台灣小吃部' COLLATE utf8_unicode_ci;
CALL run_loop();

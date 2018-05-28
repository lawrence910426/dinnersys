#### INIT MENU AND DISH ####

USE DINNERSYS;

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE menu;
TRUNCATE TABLE dish;
SET FOREIGN_KEY_CHECKS = 1;

DROP PROCEDURE IF EXISTS init_food;

DELIMITER $$
CREATE PROCEDURE init_food()
BEGIN
	DECLARE facto INT DEFAULT 1;
	DECLARE counter INT DEFAULT 1;
    i: WHILE (facto <= 4) DO
		SET counter = 1;
	   j: WHILE (counter <= 100) DO
			INSERT INTO `dinnersys`.`menu`
			(`charge`,
			`name`,
			`is_ingredient`,
			`is_dish`,
			`factory_id`,
			`is_vegetarian`,
			`is_idle`)
			VALUES
			(0,
			"閒置",
			IF(counter = 1, TRUE ,FALSE),
			0,
			facto,
			0,
			IF(counter = 1, FALSE ,TRUE));
			
			SET counter = counter + 1;
		END WHILE j;
        SET facto = facto + 1;
	END WHILE i;
    
    SET facto = 1;
    i: WHILE (facto <= 4) DO
		SET counter = 1;
	   j: WHILE (counter <= 100) DO
			INSERT INTO `dinnersys`.`dish`
			(`dish_name`,
			`charge_sum`,
			`ingredient_0`,
			`is_vegetarian`,
			`is_custom`,
			`is_idle`)
			VALUES
			("閒置",
			0,
			(facto - 1) * 100 + 1,
			0,
			0,
			IF(counter = 1, FALSE ,TRUE));
			SET counter = counter + 1;
		END WHILE j;
        SET facto = facto + 1;
	END WHILE i;
END$$

DELIMITER ;

CALL init_food();

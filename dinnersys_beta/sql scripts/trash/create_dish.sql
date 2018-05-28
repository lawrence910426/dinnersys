#### CREATE DISH ####
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`dish`;
SET FOREIGN_KEY_CHECKS = 1;

DELIMITER $$

CREATE PROCEDURE create_dish(
	i0 INT ,i1 INT ,i2 INT ,i3 INT ,i4 INT ,
     i5 INT ,i6 INT ,i7 INT ,i8 INT ,i9 INT)
BEGIN
	DECLARE charge_sum INT DEFAULT (
		SELECT SUM(charge) FROM `dinnersys`.`menu`
		WHERE id = IFNULL(i0 ,-1)
		OR id = IFNULL(i1 ,-1) OR id = IFNULL(i2 ,-1)
		OR id = IFNULL(i3 ,-1) OR id = IFNULL(i4 ,-1)
		OR id = IFNULL(i5 ,-1)
		OR id = IFNULL(i6 ,-1) OR id = IFNULL(i7 ,-1)
		OR id = IFNULL(i8 ,-1) OR id = IFNULL(i9 ,-1)
	);

	DECLARE dish_name VARCHAR(1024) DEFAULT (
		SELECT GROUP_CONCAT(M.name SEPARATOR ',') FROM `dinnersys`.`menu` AS M
		WHERE id = IFNULL(i0 ,-1)
		OR id = IFNULL(i1 ,-1) OR id = IFNULL(i2 ,-1)
		OR id = IFNULL(i3 ,-1) OR id = IFNULL(i4 ,-1)
		OR id = IFNULL(i5 ,-1)
		OR id = IFNULL(i6 ,-1) OR id = IFNULL(i7 ,-1)
		OR id = IFNULL(i8 ,-1) OR id = IFNULL(i9 ,-1)
	);

	DECLARE single_factory BOOLEAN DEFAULT(
	(SELECT DISTINCT COUNT(id) FROM `dinnersys`.`menu`
		WHERE id = IFNULL(i0 ,-1)
		OR id = IFNULL(i1 ,-1) OR id = IFNULL(i2 ,-1)
		OR id = IFNULL(i3 ,-1) OR id = IFNULL(i4 ,-1)
		OR id = IFNULL(i5 ,-1)
		OR id = IFNULL(i6 ,-1) OR id = IFNULL(i7 ,-1)
		OR id = IFNULL(i8 ,-1) OR id = IFNULL(i9 ,-1))
		= 1
	);

	IF single_factory THEN
		UPDATE `dinnersys`.`dish`
		SET
		`dish_name` = dish_name,
		`charge_sum` = charge_sum,
		`ingredient_0` = i0,
		`ingredient_1` = i1,
		`ingredient_2` = i2,
		`ingredient_3` = i3,
		`ingredient_4` = i4,
		`ingredient_5` = i5,
		`ingredient_6` = i6,
		`ingredient_7` = i7,
		`ingredient_8` = i8,
		`ingredient_9` = i9,
		`is_vegetarian` = FALSE
		WHERE `id` = 1;
	END IF;

END$$






####
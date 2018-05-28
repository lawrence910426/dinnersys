#### UPDATE MENU ####

USE dinnersys;
DROP PROCEDURE IF EXISTS update_menu;
DROP FUNCTION IF EXISTS update_dish;
DROP FUNCTION IF EXISTS get_dish_name;
DROP FUNCTION IF EXISTS get_charge_sum;
DROP FUNCTION IF EXISTS check_single_facto;
DROP FUNCTION IF EXISTS check_vege;

DELIMITER $$

CREATE FUNCTION get_dish_name
	(i0 INT ,i1 INT ,i2 INT ,i3 INT ,i4 INT ,
		 i5 INT ,i6 INT ,i7 INT ,i8 INT ,i9 INT) RETURNS VARCHAR(1024)
BEGIN
	RETURN (
		SELECT GROUP_CONCAT(name SEPARATOR ' + ') FROM `dinnersys`.`menu`
		WHERE id = IFNULL(i0 ,-1)
		OR id = IFNULL(i1 ,-1) OR id = IFNULL(i2 ,-1)
		OR id = IFNULL(i3 ,-1) OR id = IFNULL(i4 ,-1)
		OR id = IFNULL(i5 ,-1)
		OR id = IFNULL(i6 ,-1) OR id = IFNULL(i7 ,-1)
		OR id = IFNULL(i8 ,-1) OR id = IFNULL(i9 ,-1)
	);
END$$

CREATE FUNCTION get_charge_sum
	(i0 INT ,i1 INT ,i2 INT ,i3 INT ,i4 INT ,
		 i5 INT ,i6 INT ,i7 INT ,i8 INT ,i9 INT) RETURNS INT
BEGIN
	RETURN (
		SELECT SUM(charge) FROM `dinnersys`.`menu`
		WHERE id = IFNULL(i0 ,-1)
		OR id = IFNULL(i1 ,-1) OR id = IFNULL(i2 ,-1)
		OR id = IFNULL(i3 ,-1) OR id = IFNULL(i4 ,-1)
		OR id = IFNULL(i5 ,-1)
		OR id = IFNULL(i6 ,-1) OR id = IFNULL(i7 ,-1)
		OR id = IFNULL(i8 ,-1) OR id = IFNULL(i9 ,-1)
	);
END$$

CREATE FUNCTION check_single_facto
	(i0 INT ,i1 INT ,i2 INT ,i3 INT ,i4 INT ,
		 i5 INT ,i6 INT ,i7 INT ,i8 INT ,i9 INT) RETURNS BOOL
BEGIN
	RETURN (
		(SELECT COUNT(DISTINCT factory_id) FROM `dinnersys`.`menu`
		WHERE id = IFNULL(i0 ,-1)
		OR id = IFNULL(i1 ,-1) OR id = IFNULL(i2 ,-1)
		OR id = IFNULL(i3 ,-1) OR id = IFNULL(i4 ,-1)
		OR id = IFNULL(i5 ,-1)
		OR id = IFNULL(i6 ,-1) OR id = IFNULL(i7 ,-1)
		OR id = IFNULL(i8 ,-1) OR id = IFNULL(i9 ,-1))
		= 1
	);
END$$

CREATE FUNCTION check_vege
	(i0 INT ,i1 INT ,i2 INT ,i3 INT ,i4 INT ,
		 i5 INT ,i6 INT ,i7 INT ,i8 INT ,i9 INT) RETURNS INT
BEGIN
	RETURN (
		(SELECT MIN(DISTINCT is_vegetarian) FROM `dinnersys`.`menu`
		WHERE
        (id = IFNULL(i0 ,-1)
		OR id = IFNULL(i1 ,-1) OR id = IFNULL(i2 ,-1)
		OR id = IFNULL(i3 ,-1) OR id = IFNULL(i4 ,-1)
		OR id = IFNULL(i5 ,-1)
		OR id = IFNULL(i6 ,-1) OR id = IFNULL(i7 ,-1)
		OR id = IFNULL(i8 ,-1) OR id = IFNULL(i9 ,-1))
        )
	);
END$$


CREATE PROCEDURE update_menu(id INT ,charge_sum INT ,menu_name VARCHAR(128)
	,ingre_able BOOL ,dish_able BOOL	# automaticly update related dish
    ,vege INT ,idle BOOL)
BEGIN
	UPDATE `dinnersys`.`menu`
	SET `charge` = IFNULL(charge_sum ,`charge`),
	`name` = IFNULL(menu_name ,`name`),
	`is_ingredient` = IFNULL(ingre_able ,`is_ingredient`),
	`is_dish` = IFNULL(dish_able ,`is_dish`),
	`is_vegetarian` = IFNULL(vege ,`is_vegetarian`),
	`is_idle` = IFNULL(idle ,`is_idle`)
	WHERE menu.id = id;
	
    UPDATE `dinnersys`.`dish`
    SET `dish_name` = get_dish_name(ingredient_0 ,ingredient_1 ,ingredient_2 ,ingredient_3 ,ingredient_4 ,ingredient_5 ,ingredient_6 ,ingredient_7 ,ingredient_8 ,ingredient_9),
	`charge_sum` = get_charge_sum(ingredient_0 ,ingredient_1 ,ingredient_2 ,ingredient_3 ,ingredient_4 ,ingredient_5 ,ingredient_6 ,ingredient_7 ,ingredient_8 ,ingredient_9),
    `is_vegetarian` = check_vege(ingredient_0 ,ingredient_1 ,ingredient_2 ,ingredient_3 ,ingredient_4 ,ingredient_5 ,ingredient_6 ,ingredient_7 ,ingredient_8 ,ingredient_9)
    WHERE (ingredient_0 = id OR ingredient_1 = id OR ingredient_2 = id OR
		ingredient_3 = id OR ingredient_4 = id OR ingredient_5 = id OR
        ingredient_6 = id OR ingredient_7 = id OR ingredient_8 = id OR
		ingredient_9 = id);
END$$

CREATE FUNCTION update_dish(
	dish_id INT,is_idle BOOLEAN ,
	i0 INT ,i1 INT ,i2 INT ,i3 INT ,i4 INT ,
     i5 INT ,i6 INT ,i7 INT ,i8 INT ,i9 INT) RETURNS VARCHAR(128)
BEGIN
	IF check_single_facto(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9) THEN
		UPDATE `dinnersys`.`dish`
		SET `dish_name` = get_dish_name(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9),
		`charge_sum` = get_charge_sum(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9),
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
		`is_vegetarian` = check_vege(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9) ,
        dish.is_idle = is_idle
		WHERE `dish`.`id` = dish_id;
        
		RETURN 'success';
    ELSE
		RETURN 'different factory.';
	END IF;
END$$

DELIMITER ;

CALL update_menu(1 ,0 ,'閒置' ,
	NULL ,NULL ,
    NULL ,FALSE);
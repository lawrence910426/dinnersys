#### SHOW MENU ####
USE dinnersys;

DROP PROCEDURE IF EXISTS show_menu;
DROP PROCEDURE IF EXISTS show_dish;
DROP FUNCTION IF EXISTS is_vege;

DELIMITER $$

CREATE FUNCTION is_vege(usr_id INT) RETURNS INT
BEGIN
	RETURN (
		SELECT I.is_vegetarian FROM `dinnersys`.`users` AS U ,`dinnersys`.`user_information` AS I
		WHERE (U.info_id = I.id  AND U.id = usr_id)
	);
END$$

CREATE PROCEDURE show_menu(usr_id INT ,factory_id INT)
BEGIN
	DECLARE vegetarian INT DEFAULT is_vege(usr_id);

	SELECT DISTINCT 
    M.id ,M.name ,M.charge 
    ,M.is_dish ,M.is_ingredient ,M.is_idle
    ,F.id ,F.name 
	FROM `dinnersys`.`menu` AS M ,`dinnersys`.`factory` AS F
	WHERE M.factory_id = F.id
	AND F.id = IFNULL(factory_id ,F.id)
	ORDER BY M.factory_id ,ABS(M.is_vegetarian - vegetarian) ,M.id;
END$$

CREATE PROCEDURE show_dish(usr_id INT ,factory_id INT ,is_custom BOOL)
BEGIN
	DECLARE vegetarian INT DEFAULT is_vege(usr_id);

	SELECT DISTINCT 
    D.id ,D.dish_name ,D.charge_sum ,F.id ,F.name ,D.is_idle ,D.is_custom ,
    D.ingredient_0 ,D.ingredient_1 ,D.ingredient_2 ,D.ingredient_3 ,D.ingredient_4 ,
    D.ingredient_5 ,D.ingredient_6 ,D.ingredient_7 ,D.ingredient_8 ,D.ingredient_9
    
	FROM `dinnersys`.`dish` AS D ,`dinnersys`.`menu` AS M ,`dinnersys`.`factory` AS F
	WHERE 
	(
		D.ingredient_0 = M.id OR D.ingredient_1 = M.id OR D.ingredient_2 = M.id OR 
		D.ingredient_3 = M.id OR D.ingredient_4 = M.id OR D.ingredient_5 = M.id OR 
		D.ingredient_6 = M.id OR D.ingredient_7 = M.id OR D.ingredient_8 = M.id OR 
		D.ingredient_9 = M.id
	)
	AND M.factory_id = F.id
	AND F.id = IFNULL(factory_id ,F.id)
    AND IF(is_custom IS NULL ,TRUE ,is_custom = D.is_custom)
	ORDER BY M.factory_id ,ABS(D.is_vegetarian - vegetarian) ,D.id;
END$$

DELIMITER ;

CALL show_dish(-1 ,NULL ,FALSE);
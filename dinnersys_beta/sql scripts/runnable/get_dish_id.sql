#### GET DISH ID ####

USE dinnersys;

DROP FUNCTION IF EXISTS get_dish_id;

DELIMITER $$
CREATE FUNCTION get_dish_id(i0 INT ,i1 INT ,i2 INT ,i3 INT ,i4 INT ,
		 i5 INT ,i6 INT ,i7 INT ,i8 INT ,i9 INT) RETURNS VARCHAR(128)
BEGIN
	DECLARE id INT DEFAULT (
		SELECT D.id FROM dish AS D
        WHERE 
			(i0 <=> ingredient_0) AND (i1 <=> ingredient_1) AND 
			(i2 <=> ingredient_2) AND (i3 <=> ingredient_3) AND 
            (i4 <=> ingredient_4) AND (i5 <=> ingredient_5) AND 
            (i6 <=> ingredient_6) AND (i7 <=> ingredient_7) AND 
            (i8 <=> ingredient_8) AND (i9 <=> ingredient_9)
		LIMIT 1
    );
            
    IF ((SELECT MIN(IF(is_ingredient ,1 ,0)) FROM menu AS M WHERE
			(i0 <=> M.id) OR (i1 <=> M.id) OR 
			(i2 <=> M.id) OR (i3 <=> M.id) OR 
            (i4 <=> M.id) OR (i5 <=> M.id) OR 
            (i6 <=> M.id) OR (i7 <=> M.id) OR 
            (i8 <=> M.id) OR (i9 <=> M.id)) = 0) THEN
		RETURN 'some ingredient is not ingredient_able';
    END IF;
    
    
    IF NOT check_single_facto(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9) THEN
		RETURN 'different factory';
    END IF;
    
    IF id IS NULL THEN
		INSERT INTO `dinnersys`.`dish`
		(	`dish_name`,
			`charge_sum`,
			`ingredient_0`,
			`ingredient_1`,
			`ingredient_2`,
			`ingredient_3`,
			`ingredient_4`,
			`ingredient_5`,
			`ingredient_6`,
			`ingredient_7`,
			`ingredient_8`,
			`ingredient_9`,
			`is_vegetarian` ,
            `is_custom`)
		VALUES
		(	
			get_dish_name(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9),
			get_charge_sum(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9),
			i0 ,i1 ,i2 ,i3, i4 ,i5 ,i6 ,i7 ,i8, i9 ,
			check_vege(i0 ,i1 ,i2 ,i3 ,i4 ,i5 ,i6 ,i7 ,i8 ,i9) ,
            TRUE
		);
        RETURN CONCAT((SELECT MAX(D.id) FROM `dinnersys`.`dish` AS D));
    ELSE
		RETURN CONCAT(id);
    END IF;
END$$

DELIMITER ;

SELECT get_dish_id(3 ,NULL ,NULL ,NULL ,NULL
	,NULL ,NULL ,NULL ,NULL ,NULL);


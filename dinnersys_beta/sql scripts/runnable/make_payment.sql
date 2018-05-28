#### MAKE PAYMENT ####

USE dinnersys;
DROP FUNCTION IF EXISTS make_payment;
DROP FUNCTION IF EXISTS valid_payment;

DELIMITER $$

CREATE FUNCTION valid_payment(oid INT ,uid INT ,money_to VARCHAR(128)) RETURNS BOOL
BEGIN
	IF money_to = 'fact' THEN 
		RETURN 
        IF(
			(SELECT COUNT(FA.id) FROM factory_auth AS FA ,orders AS O ,dish AS D ,menu AS M
			WHERE FA.user_id = uid AND
             O.id = oid AND O.dish = D.id AND D.ingredient_0 = M.id AND M.factory_id = FA.factory_id) = 1,
		TRUE ,
		FALSE);
	END IF;
	IF money_to = 'cafet' THEN 
		RETURN TRUE;
	END IF;
	IF money_to = 'dm' THEN 
		RETURN IF(
			(SELECT COUNT(DISTINCT U.class_id) FROM orders AS O ,users AS U
            WHERE (O.id = oid AND O.user_id = U.id) OR (U.id = uid)) = 1,
            TRUE ,
            FALSE);
	END IF;
	IF money_to = 'usr' THEN 
		RETURN IF((SELECT COUNT(O.id) FROM orders AS O WHERE oid = O.id AND uid = O.user_id) = 1 ,
			TRUE ,
            FALSE 
        );
	END IF; 
    RETURN FALSE;
END$$


CREATE FUNCTION make_payment(order_id INT ,user_id INT ,money_to VARCHAR(128) ,target BOOL ,ip VARCHAR(1024))
		RETURNS VARCHAR(128)
BEGIN
	DECLARE auth_id INT DEFAULT get_auth_id(user_id ,ip);
    
	DECLARE mtrace_id INT DEFAULT (
		SELECT M.id FROM 
		`dinnersys`.`money_trace` AS M 
		,`dinnersys`.`orders` AS O
		WHERE O.id = order_id
        AND O.money_trace_id = M.id
    );
    DECLARE payment_id INT DEFAULT -1;
    DECLARE able_dt DATETIME DEFAULT NULL;
    DECLARE freeze_dt DATETIME DEFAULT NULL;
    
    IF NOT valid_payment(order_id ,user_id ,money_to) THEN
		RETURN 'Access denied';
    END IF;
    
    IF money_to = 'fact' THEN 
		SET payment_id = (SELECT factory FROM `dinnersys`.`money_trace` WHERE id = mtrace_id);
	END IF;
	IF money_to = 'cafet' THEN 
		SET payment_id = (SELECT cafeteria FROM `dinnersys`.`money_trace` WHERE id = mtrace_id);
	END IF;
	IF money_to = 'dm' THEN 
		SET payment_id = (SELECT dinnerman FROM `dinnersys`.`money_trace` WHERE id = mtrace_id);
	END IF;
	IF money_to = 'usr' THEN 
		SET payment_id = (SELECT user FROM `dinnersys`.`money_trace` WHERE id = mtrace_id);
	END IF;
    
    
    IF (SELECT paid FROM `dinnersys`.`payment` WHERE id = payment_id) = target THEN
		RETURN 'already done';
    END IF;
    
    SET freeze_dt = (SELECT freeze_datetime FROM `dinnersys`.`payment` WHERE id = payment_id);
    SET able_dt = (SELECT able_datetime FROM `dinnersys`.`payment` WHERE id = payment_id);
    IF NOT(able_dt < CURRENT_TIMESTAMP AND CURRENT_TIMESTAMP < freeze_dt) THEN
		RETURN 'the order is freezed or unable to be access now.';
    END IF;
     
    UPDATE `dinnersys`.`payment`
	SET `paid` = target,
	`paid_datetime` = IF(target ,CURRENT_TIMESTAMP ,NULL),
	`authority_id` = auth_id
	WHERE `id` = payment_id;
    RETURN 'success done';
END$$

DELIMITER ;

SELECT make_payment(1 ,-7 ,'fact' ,false , '127.0.0.1');
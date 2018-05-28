#### SHOW AVAIALBLE OPERATIONS ####

USE dinnersys;

DROP FUNCTION IF EXISTS check_able;
DROP FUNCTION IF EXISTS get_name;
DROP PROCEDURE IF EXISTS show_avaialble_operations;

DELIMITER $$
SET @psum = -1$$

CREATE FUNCTION get_name(id INT) RETURNS VARCHAR(128)
BEGIN
	RETURN (SELECT `prev_name` FROM `dinnersys`.`previleges` AS P WHERE P.id = id LIMIT 1);
END$$

CREATE FUNCTION check_able(id INT) RETURNS BOOL
BEGIN
	DECLARE prev_code INT DEFAULT 
	(SELECT `prev_code` FROM `dinnersys`.`previleges` AS P WHERE P.id = id LIMIT 1);
    
	IF @psum >= prev_code THEN 
        SET @psum = @psum - prev_code;
        RETURN TRUE;
    END IF;
    RETURN FALSE;
END$$

CREATE PROCEDURE show_avaialble_operations(user_id INT)
BEGIN
	DECLARE _1 BOOL DEFAULT FALSE;
	DECLARE _2 BOOL DEFAULT FALSE;
    DECLARE _3 BOOL DEFAULT FALSE;
    DECLARE _4 BOOL DEFAULT FALSE;
    DECLARE _5 BOOL DEFAULT FALSE;
    DECLARE _6 BOOL DEFAULT FALSE;
    
    SET @psum = (SELECT prev_sum FROM `dinnersys`.`users` WHERE id = user_id);
    SET _6 = check_able(6);
    SET _5 = check_able(5);
    SET _4 = check_able(4);
    SET _3 = check_able(3);
    SET _2 = check_able(2);
    SET _1 = check_able(1);

    
	SELECT DISTINCT O.oper_func_name ,O.oper_name
	FROM 
	`dinnersys`.`operations` AS O
	,`dinnersys`.`previleges` AS P
	WHERE O.require_prev = P.id 
	AND
	(
		(_1 AND P.id = 1) OR
        (_2 AND P.id = 2) OR
        (_3 AND P.id = 3) OR
        (_4 AND P.id = 4) OR
        (_5 AND P.id = 5) OR
        (_6 AND P.id = 6)
	);
END$$

DELIMITER ;

CALL show_avaialble_operations(807);
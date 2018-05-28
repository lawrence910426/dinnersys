#### DELETE ORDER ####

USE dinnersys;

DROP FUNCTION IF EXISTS delete_order;

DELIMITER $$
CREATE FUNCTION delete_order(id INT ,user_id INT) RETURNS VARCHAR(128)
BEGIN
	DECLARE mt INT DEFAULT ( SELECT money_trace_id FROM orders WHERE orders.id = id );
    
    DECLARE has_row BOOL DEFAULT (
		( SELECT COUNT(O.id) FROM orders AS O WHERE O.id = IFNULL(id ,-1) ) = 1
    );
    
    DECLARE dm BOOLEAN DEFAULT (
		SELECT P.paid FROM money_trace AS M ,payment AS P
        WHERE M.id = mt AND M.dinnerman = P.id
    );
    DECLARE cafet BOOLEAN DEFAULT (
		SELECT P.paid FROM money_trace AS M ,payment AS P
        WHERE M.id = mt AND M.dinnerman = P.id
    );
    DECLARE facto BOOLEAN DEFAULT (
		SELECT P.paid FROM money_trace AS M ,payment AS P
        WHERE M.id = mt AND M.dinnerman = P.id
    );
    
	DECLARE anno_id INT DEFAULT (
		SELECT announce_id FROM `dinnersys`.`orders` AS O
        WHERE O.id = id
    );
    
    IF NOT has_row THEN
		RETURN 'unable to find the order';
    END IF;
    
    IF dm OR cafet OR facto THEN
		RETURN 'unable to delete order because having payment done.';
    END IF;
    
    IF (SELECT O.disabled FROM `dinnersys`.`orders` AS O WHERE O.id = id) = TRUE THEN
		RETURN 'already deleted';
    END IF;
    
    IF NOT ((SELECT O.user_id FROM `dinnersys`.`orders` AS O WHERE O.id = id) = user_id) THEN
		RETURN 'different user';
    END IF;
    
	UPDATE `dinnersys`.`orders` SET `disabled` = TRUE WHERE orders.`id` = id;
	UPDATE `dinnersys`.`announce` SET `disabled` = TRUE WHERE announce.`id` = anno_id;
    
    RETURN 'success';
END$$

DELIMITER ;

SELECT delete_order(null ,807);
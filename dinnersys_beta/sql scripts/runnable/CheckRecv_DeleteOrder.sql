#### check_recv / delete_order ####

USE dinnersys;

DROP FUNCTION IF EXISTS delete_order;
DROP FUNCTION IF EXISTS check_recv;
DROP FUNCTION IF EXISTS chkrcv_delorder_able;

DELIMITER $$
CREATE FUNCTION chkrcv_delorder_able(id INT ,user_id INT) RETURNS VARCHAR(128)
BEGIN
    DECLARE has_row BOOL DEFAULT (
		( SELECT COUNT(O.id) FROM orders AS O WHERE O.id = IFNULL(id ,-1) ) = 1
    );
    
    IF NOT has_row THEN
		RETURN 'unable to find the order';
    END IF;
    
    IF (SELECT O.disabled FROM `dinnersys`.`orders` AS O WHERE O.id = id) = TRUE THEN
		RETURN 'already deleted';
    END IF;
    
    IF (SELECT L.has_recv FROM logistics_info AS L ,orders AS O  WHERE O.logistics_info = L.id AND O.id = id) = TRUE THEN
		RETURN 'already received';
    END IF;
    
    IF NOT ((SELECT O.user_id FROM `dinnersys`.`orders` AS O WHERE O.id = id) = user_id) THEN
		RETURN 'different user';
    END IF;
    
    RETURN 'able';
END$$

#### DELETE ORDER ####

USE dinnersys;

DROP FUNCTION IF EXISTS delete_order;

DELIMITER $$
CREATE FUNCTION delete_order(id INT ,user_id INT) RETURNS VARCHAR(128)
BEGIN
	DECLARE mt INT DEFAULT ( SELECT money_trace_id FROM orders WHERE orders.id = id );
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
    
    DECLARE result VARCHAR(128) DEFAULT (chkrcv_delorder_able(id ,user_id));
    IF NOT result = 'able' THEN
		RETURN result;
    END IF;
    
    
    IF dm OR cafet OR facto THEN
		RETURN 'unable to delete order because there is a payment done.';
    END IF;
    
    
	UPDATE `dinnersys`.`orders` SET `disabled` = TRUE WHERE orders.`id` = id;
	UPDATE `dinnersys`.`announce` SET `disabled` = TRUE WHERE announce.`id` = anno_id;
    
    RETURN 'success';
END$$

CREATE FUNCTION check_recv(id INT ,user_id INT) RETURNS VARCHAR(128)
BEGIN
	DECLARE logistics_id INT DEFAULT (
		SELECT L.id FROM logistics_info AS L ,orders AS O
        WHERE O.logistics_info = L.id AND O.id = id
    );
	DECLARE mt INT DEFAULT ( SELECT money_trace_id FROM orders WHERE orders.id = id );
    DECLARE facto BOOLEAN DEFAULT (
		SELECT P.paid FROM money_trace AS M ,payment AS P
        WHERE M.id = mt AND M.factory = P.id
    );
    
    DECLARE result VARCHAR(128) DEFAULT (chkrcv_delorder_able(id ,user_id));
    IF NOT result = 'able' THEN
		RETURN result;
    END IF;
    
    IF NOT facto THEN
		RETURN 'factory hasnt get money yet';
    END IF;
    
	UPDATE logistics_info SET has_recv = TRUE WHERE logistics_info.id = logistics_id;
    
    RETURN 'success';
END$$

DELIMITER ;

SELECT check_recv(1 ,807);
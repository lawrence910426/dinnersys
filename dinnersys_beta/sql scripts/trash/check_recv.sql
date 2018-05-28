#### CHECK RECV ####

USE dinnersys;

DROP FUNCTION IF EXISTS check_recv;

DELIMITER $$
CREATE FUNCTION check_recv(id INT ,user_id INT) RETURNS VARCHAR(128)
BEGIN
	DECLARE logistics_id INT DEFAULT (
		SELECT L.id FROM logistics_info AS L ,orders AS O
        WHERE O.logistics_info = L.id AND O.id = id
    );
    
	DECLARE mt INT DEFAULT ( SELECT money_trace_id FROM orders WHERE orders.id = id );
    DECLARE dm BOOLEAN DEFAULT (
		SELECT P.paid FROM money_trace AS M ,payment AS P
        WHERE M.id = mt AND M.dinnerman = P.id
    );
    DECLARE cafet BOOLEAN DEFAULT (
		SELECT P.paid FROM money_trace AS M ,payment AS P
        WHERE M.id = mt AND M.cafeteria = P.id
    );
    DECLARE facto BOOLEAN DEFAULT (
		SELECT P.paid FROM money_trace AS M ,payment AS P
        WHERE M.id = mt AND M.factory = P.id
    );
    
    IF NOT facto THEN
		RETURN 'factory hasnt get money yet';
    END IF;
    
    IF (SELECT O.disabled FROM `dinnersys`.`orders` AS O WHERE O.id = id) = TRUE THEN
		RETURN 'order deleted';
    END IF;
    
     IF (SELECT L.has_recv FROM logistics_info AS L WHERE L.id = logistics_id) = TRUE THEN
		RETURN 'already received';
    END IF;
    
    IF NOT ((SELECT O.user_id FROM `dinnersys`.`orders` AS O WHERE O.id = id) = user_id) THEN
		RETURN 'different user';
    END IF;
    
	UPDATE logistics_info SET has_recv = TRUE WHERE logistics_info.id = logistics_id;
    
    RETURN 'success';
END$$

DELIMITER ;

SELECT check_recv(16181 ,807);
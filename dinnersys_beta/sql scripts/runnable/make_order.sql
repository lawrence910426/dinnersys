#### MAKE ANNOUNCE ####
USE dinnersys;

DROP PROCEDURE IF EXISTS make_announce;
DROP FUNCTION IF EXISTS make_order;
DROP PROCEDURE IF EXISTS make_logistics_info;

DELIMITER $$

CREATE PROCEDURE make_announce(
	msg VARCHAR(4096) ,anno_type VARCHAR(128) ,esti_datetime DATETIME)
BEGIN
	INSERT INTO `dinnersys`.`announce`
	(`msg`,
	`anno_type`,
	`estimate_datetime`, `pushed_datetime`,
	`announced`, `disabled`)
	VALUES
	(msg,
	anno_type,
	esti_datetime, NULL,
	FALSE, FALSE);
END$$

CREATE PROCEDURE make_logistics_info(esti_recv DATETIME ,vege BOOLEAN)
BEGIN
	INSERT INTO `dinnersys`.`logistics_info`
	(`esti_recv_datetime`,
	`recv_datetime`,
	`is_vegetarian`)
	VALUES
	(esti_recv, NULL, vege);
END$$

#### MAKE ORDER ####
CREATE FUNCTION make_order(usr_id INT ,dish_id INT ,esti_recv DATETIME) RETURNS VARCHAR(128)
BEGIN
	DECLARE is_vege INT DEFAULT (
		SELECT is_vegetarian FROM dinnersys.dish WHERE id = dish_id
    );
     
    DECLARE dish_name VARCHAR(1024) DEFAULT (
		SELECT dish.dish_name FROM dish WHERE dish_id = id
    );
    
    DECLARE factory_id INT DEFAULT (
		SELECT M.factory_id FROM dinnersys.menu AS M ,dinnersys.dish AS D
        WHERE D.ingredient_0 = M.id AND D.id = dish_id
	);
   
    DECLARE time_result VARCHAR(128) DEFAULT (
		check_valid_time(factory_id ,esti_recv)
    );
    
    DECLARE user_payment_id INT DEFAULT -1;
    
    IF NOT (time_result = "success") THEN
		RETURN time_result;
    END IF;
    
	CALL make_announce(CONCAT('午餐系統提醒您今天有訂購「' ,dish_name ,'」 喔') 
		,'VIBRATE ,ANNOUNCE' 
        ,DATE_SUB(esti_recv ,INTERVAL 10 MINUTE));
    CALL create_moneytrace(esti_recv);
    CALL make_logistics_info(esti_recv ,is_vege);
    
    INSERT INTO `dinnersys`.`orders`
	(`announce_id`,
	`money_trace_id`,
	`dish`,
	`user_id`,
	`logistics_info`)
	VALUES
	((SELECT MAX(id) FROM dinnersys.announce LIMIT 1),
	(SELECT MAX(id) FROM dinnersys.money_trace LIMIT 1),
	dish_id,
	usr_id,
	(SELECT MAX(id) FROM dinnersys.logistics_info LIMIT 1));
    
    SET user_payment_id = (SELECT MAX(P.id) FROM dinnersys.payment AS P);
    UPDATE dinnersys.payment
    SET paid = true
    WHERE id = user_payment_id;			# THE PAYMENT HAS THE BIGGEST ID IS USER PAYMENT.
    
	RETURN CONCAT((SELECT MAX(O.id) FROM dinnersys.orders AS O));
END$$

select make_order(807 ,1 ,DATE_ADD(CURRENT_TIMESTAMP ,INTERVAL 15 HOUR));
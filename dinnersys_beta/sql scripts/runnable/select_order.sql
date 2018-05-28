#### SELECT ORDER ####

USE dinnersys;

DROP PROCEDURE IF EXISTS select_order;
DROP PROCEDURE IF EXISTS fetch_money_trace;

DELIMITER $$
CREATE PROCEDURE select_order
	(vege INT ,
	usr BOOL ,dm BOOL ,cafet BOOL ,facto BOOL ,
    esti_start DATETIME ,esti_end DATETIME ,
    factory_id INT ,
    user_id INT ,person BOOL ,class BOOL ,
    class_no INT ,
    grade INT ,yr INT)
BEGIN
	DECLARE class_id INT DEFAULT(
		IF(class IS NULL OR class = FALSE , -1,
			(SELECT U.class_id FROM users AS U WHERE U.id = user_id)
		)
    );
    IF yr IS NULL THEN
		SET yr = FLOOR((UNIX_TIMESTAMP() + 10529374) / 31556926)  + 1970;
    END IF;
    
	SELECT DISTINCT 
    /*-----------------import data columns---------------------*/
    O.id ,
    U.id ,UI.seat_id ,UI.name ,UI.class_id ,
    D.id ,D.dish_name ,D.charge_sum ,
    MT.id ,MT.charge ,
    LO.esti_recv_datetime ,
    F.id ,F.name ,
    
    (SELECT P.id FROM payment AS P WHERE P.id = MT.user LIMIT 1) AS user_paid_id ,
    (SELECT P.paid FROM payment AS P WHERE P.id = MT.user LIMIT 1) AS user_paid ,
    (SELECT P.able_datetime FROM payment AS P WHERE P.id = MT.user LIMIT 1) AS user_able_dt ,
    (SELECT P.paid_datetime FROM payment AS P WHERE P.id = MT.user LIMIT 1) AS user_paid_dt,
    (SELECT P.freeze_datetime FROM payment AS P WHERE P.id = MT.user LIMIT 1) AS user_freeze_dt ,
    
    (SELECT P.id FROM payment AS P WHERE P.id = MT.dinnerman LIMIT 1) AS dinnerman_paid_id ,
    (SELECT P.paid FROM payment AS P WHERE P.id = MT.dinnerman LIMIT 1) AS dinnerman_paid ,
    (SELECT P.able_datetime FROM payment AS P WHERE P.id = MT.dinnerman LIMIT 1) AS dinnerman_able_dt ,
    (SELECT P.paid_datetime FROM payment AS P WHERE P.id = MT.dinnerman LIMIT 1) AS dinnerman_paid_dt,
    (SELECT P.freeze_datetime FROM payment AS P WHERE P.id = MT.dinnerman LIMIT 1) AS dinnerman_freeze_dt ,
    
    (SELECT P.id FROM payment AS P WHERE P.id = MT.cafeteria LIMIT 1) AS cafeteria_paid_id ,
    (SELECT P.paid FROM payment AS P WHERE P.id = MT.cafeteria LIMIT 1) AS cafeteria_paid ,
    (SELECT P.able_datetime FROM payment AS P WHERE P.id = MT.cafeteria LIMIT 1) AS cafeteria_able_dt ,
    (SELECT P.paid_datetime FROM payment AS P WHERE P.id = MT.cafeteria LIMIT 1) AS cafeteria_paid_dt,
    (SELECT P.freeze_datetime FROM payment AS P WHERE P.id = MT.cafeteria LIMIT 1) AS cafeteria_freeze_dt ,
    
    (SELECT P.id FROM payment AS P WHERE P.id = MT.factory LIMIT 1) AS factory_paid_id ,
    (SELECT P.paid FROM payment AS P WHERE P.id = MT.factory LIMIT 1) AS factory_paid ,
    (SELECT P.able_datetime FROM payment AS P WHERE P.id = MT.factory LIMIT 1) AS factory_able_dt ,
    (SELECT P.paid_datetime FROM payment AS P WHERE P.id = MT.factory LIMIT 1) AS factory_paid_dt,
    (SELECT P.freeze_datetime FROM payment AS P WHERE P.id = MT.factory LIMIT 1) AS factory_freeze_dt
    /*-----------------import data tables---------------------*/
    FROM orders AS O ,
    users AS U ,user_information AS UI ,class AS C ,
	dish AS D ,menu AS M , factory AS F ,
    money_trace AS MT ,
    logistics_info AS LO
    
    /*-----------------connect data tables--------------------------*/
    WHERE O.logistics_info = LO.id
    AND O.money_trace_id = MT.id
    AND O.dish = D.id
    AND M.factory_id = F.id
    AND O.user_id = U.id
    AND U.info_id = UI.id
    AND U.class_id = C.id
    AND D.ingredient_0 = M.id
    AND O.disabled = FALSE
    AND LO.has_recv = FALSE
    
    /*------------------create selection criteria-----------------*/
    AND IF(vege IS NULL ,TRUE ,vege = LO.is_vegetarian)
    AND (
		(IF(usr IS NULL ,TRUE ,(SELECT P.paid FROM payment AS P WHERE P.id = MT.user) = usr)) AND
		(IF(dm IS NULL ,TRUE ,(SELECT P.paid FROM payment AS P WHERE P.id = MT.dinnerman) = dm)) AND 
        (IF(cafet IS NULL ,TRUE ,(SELECT P.paid FROM payment AS P WHERE P.id = MT.cafeteria) = cafet)) AND 
        (IF(facto IS NULL ,TRUE ,(SELECT P.paid FROM payment AS P WHERE P.id = MT.factory) = facto))
	)
	AND IF((esti_start IS NULL) OR (esti_end IS NULL)
		, TRUE
		,LO.esti_recv_datetime BETWEEN esti_start AND esti_end)
	AND IF(factory_id IS NULL ,TRUE ,factory_id = M.factory_id)
    AND IF((person IS NULL) OR (person = FALSE) ,TRUE ,user_id = O.user_id)
    AND IF((class IS NULL) OR (class = FALSE) ,TRUE ,class_id = U.class_id)
    
    AND IF(class_no IS NULL ,TRUE ,UI.class_id = class_no)
	AND IF(grade IS NULL ,TRUE ,grade = C.grade)
    AND IF(U.`year` = -1 ,TRUE ,U.`year` = yr)
    /*-----------------------sort order----------------------------------*/
    ORDER BY UI.class_id ,
    UI.seat_id ,
    LO.esti_recv_datetime ,
    D.dish_name ,
    D.charge_sum ,
    O.id;
END$$


CREATE PROCEDURE fetch_money_trace(id INT)
BEGIN
	SELECT 
    P.id ,P.paid ,
    P.able_datetime ,P.paid_datetime ,P.freeze_datetime ,
    (
		CASE P.id 
			WHEN MT.user THEN 'usr'
			WHEN MT.dinnerman THEN 'dm'
			WHEN MT.cafeteria THEN 'cafet'
			WHEN MT.factory THEN 'facto'
        END
    ) AS `name`
    FROM money_trace AS MT ,payment AS P
    WHERE MT.id = id AND
    (
		P.id = MT.user OR P.id = MT.dinnerman OR
		P.id = MT.cafeteria OR P.id = MT.factory
    );
END$$

DELIMITER ;

CALL select_order(null ,
	true ,null ,null ,true ,
    null ,null ,
	null ,
	null ,null ,null ,
	null, 
    null ,null);
#### get factory info ####

DROP PROCEDURE IF EXISTS get_factory_info;
DROP FUNCTION IF EXISTS check_valid_time;

DELIMITER $$


CREATE FUNCTION check_valid_time(fid INT ,esti_recv DATETIME) RETURNS VARCHAR(128)
BEGIN
	DECLARE lower_bound TIME DEFAULT(SELECT lower_bound FROM dinnersys.factory AS F WHERE F.id = fid);
    DECLARE upper_bound TIME DEFAULT(SELECT upper_bound FROM dinnersys.factory AS F WHERE F.id = fid);
    DECLARE lower_time DATETIME DEFAULT (
		ADDTIME(
			CONCAT(CURDATE() ,' ', CURTIME()) ,
            CONCAT((SELECT pre_time FROM dinnersys.factory WHERE id = fid))
		)
	);
	DECLARE recv TIME DEFAULT (DATE_FORMAT(esti_recv,'%H:%i:%s'));
    
	IF recv > upper_bound THEN 
		RETURN "廠商已經關門了";
	END IF;
    IF recv < lower_bound THEN 
		RETURN "廠商還沒開門";
	END IF;
    
    IF esti_recv < lower_time THEN 
		RETURN CONCAT("廠商需要 "  ,
			DATE_FORMAT((SELECT pre_time FROM dinnersys.factory WHERE id = fid),'%i') ,
            " 分鐘準備餐點");
	END IF;
    
    RETURN "success";
END$$

CREATE PROCEDURE get_factory_info(id INT)
BEGIN
	SELECT F.id ,F.name ,F.disabled ,
		F.lower_bound ,F.upper_bound ,F.pre_time
	FROM dinnersys.factory AS F
    WHERE IFNULL(id ,F.id) = F.id;
END$$

DELIMITER ;

SELECT check_valid_time(1 ,DATE_ADD(CURRENT_TIMESTAMP ,INTERVAL 17 HOUR));
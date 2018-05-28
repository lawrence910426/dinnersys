#### INIT USERS ####

USE DINNERSYS;

CALL reset_user();

DROP PROCEDURE IF EXISTS init_user;

SET @yr = 2018;

DELIMITER $$
CREATE PROCEDURE init_user()
BEGIN
	DECLARE gr INT default 1;
    DECLARE class INT default 1;
    DECLARE seat INT default 1;
   i: WHILE (gr <= 3) DO
		SET class = 1;
		j: WHILE (class <= 20) DO
            SET seat = 1;
			k: WHILE (seat <= 50) DO
				CALL make_user(
					null ,gr * 10000 + class * 100 + seat ,'0900-000-000' ,
					FALSE ,'UNKNOWN' ,(
						SELECT C.id FROM `dinnersys`.`class` as C 
						WHERE C.class_no = gr * 100 + class
						AND C.year =  @yr
					) ,gr * 100 + class ,
					null ,gr * 10000 + class * 100 + seat ,'UNKNOWN',
					
					CONCAT(@yr ,'_' ,gr * 10000 + class * 100 + seat) ,CONCAT(gr * 10000 + class * 100 + seat) ,
					IF(seat = 50 ,7 ,3) , @yr
				);
			SET seat = seat + 1;
			END WHILE k;
		SET class = class + 1;
		END WHILE j;
	SET gr = gr + 1;
	END WHILE i;
END$$

DELIMITER ;

CALL init_user();

#### ADD ADMIN USER ####

CALL make_user(
	-1 ,'ADMINSTRATOR' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'dinnersys' ,'2rjurrru' ,
	63 ,-1
);

CALL make_user(
	-2 ,'ADMINSTRATOR' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'lawrence910426' ,'2rjurrru' ,
	63 ,-1
);

#### ADD GUEST USER ####

CALL make_user(
	-3 ,'guest' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'guest' ,'guest' ,
	1 ,-1
);


#### ADD authority satisfy user ####

CALL make_user(
	-4 ,'auth_satisfy' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'!!!!!' ,'!!!!!' ,					# special characters would be blocked by regex in php
	1 ,-1
);

INSERT INTO `dinnersys`.`authority`
(`id` ,`user`, `ip`)
VALUES
(-4, -2, '0.0.0.0');



#### ADD factory users ####

CALL make_user(
	-5 ,'愛佳便當' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'ai_jia_bian_dang' ,'dinnersystem' ,
	11 ,-1
);

CALL make_user(
	-6 ,'台灣小吃部' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'tai_wan_hsiao_chi_bu' ,'dinnersystem' ,
	11 ,-1
);

CALL make_user(
	-7 ,'關東煮' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'guan_dung_ju' ,'dinnersystem' ,
	11 ,-1
);

CALL make_user(
	-8 ,'早餐部' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'breakfast' ,'dinnersystem' ,
	11 ,-1
);


#### ADD cafeteria ####

CALL make_user(
	-9 ,'早餐部' ,'0900-000-000' ,
	FALSE ,'UNKNOWN' ,-1 ,-1 ,
	null ,-1 ,'UNKNOWN',
	'cafeteria' ,'dinnersys' ,
	19 ,-1
);

SELECT * FROM dinnersys.users;

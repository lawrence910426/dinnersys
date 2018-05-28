#### MAKE AUTHORITY ####

## CHECK IF NECESSARY ADDING AUTHORITY ##

SELECT * FROM `dinnersys`.`authority`
WHERE 
`user` = 
(
	SELECT id FROM `dinnersys`.`users` AS U
	WHERE U.login_id = '2018_11707'
)
AND `device_id` = 
(
	SELECT id FROM `dinnersys`.`device` AS D
    WHERE D.belongs_user_id = 
    (
		SELECT id FROM `dinnersys`.`users` AS U
		WHERE U.login_id = '2018_11707'
    )
    AND D.device_id = 'the device id'
)
AND `ip` = '127.0.0.1' ;

## CREATE NECESSARY DEVICE ROW ##
# CREATE DEVICE.sql #

## CREATE AUTHORITY ##
SET @id =
(
	SELECT id FROM `dinnersys`.`users` AS U
	WHERE U.login_id = '2018_11707'
);

INSERT INTO `dinnersys`.`authority`
(`user`, `device_id`, `ip`)
VALUES (
@id,
(
	SELECT id FROM `dinnersys`.`device` AS D
    WHERE D.belongs_user_id = @id
    AND D.device_id = '0001'
),
'127.0.0.1'
);

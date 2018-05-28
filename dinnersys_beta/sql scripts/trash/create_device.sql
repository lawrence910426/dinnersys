#### MAKE DEVICE ROW ####

## CHECK IF NECESSARY ADDING NEW DEVICE ROW ##

SELECT * FROM `dinnersys`.`device`
WHERE device_id = 'the device id'
AND belongs_user_id = 
(
	SELECT id FROM `dinnersys`.`users`
	WHERE login_id = '2018_11707'
);

## REQUIRE NEW DEVICE ROW ##

INSERT INTO `dinnersys`.`device`
(`device_id`,
`device_info`,
`device_type`,
`last_ip`,
`last_used_datetime`,
`belongs_user_id`)
VALUES(
	'the device id' ,
    'the device info' ,
    'Android' ,
    '127.0.0.1' ,
    CURRENT_TIMESTAMP ,
    (
		SELECT id FROM `dinnersys`.`users`
		WHERE login_id = '2018_11707'
	)
);

## NOT REQUIRE NEW DEVICE ROW ##
UPDATE `dinnersys`.`device`
SET `device_info` = 'the device info',
`last_ip` = '127.0.0.1',
`last_used_datetime` = CURRENT_TIMESTAMP
WHERE device_id = 'the device id'
AND belongs_user_id = 
(
	SELECT id FROM `dinnersys`.`users`
	WHERE login_id = '2018_11707'
)


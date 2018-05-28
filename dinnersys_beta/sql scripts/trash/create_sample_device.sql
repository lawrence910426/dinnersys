#### CREATE SAMPLE DEVICE ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`device`;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `dinnersys`.`device`
(`device_id`,
`device_info`,
`device_type`,
`last_ip`,
`last_used_datetime`,
`belongs_user_id`)
VALUES(
	'0001' ,
    'the device info' ,
    'Android' ,
    '127.0.0.1' ,
    CURRENT_TIMESTAMP ,
    (
		SELECT id FROM `dinnersys`.`users`
		WHERE login_id = '2018_11707'
	)
);


INSERT INTO `dinnersys`.`device`
(`device_id`,
`device_info`,
`device_type`,
`last_ip`,
`last_used_datetime`,
`belongs_user_id`)
VALUES(
	'0002' ,
    'the device info' ,
    'Android' ,
    '127.0.0.1' ,
    CURRENT_TIMESTAMP ,
    (
		SELECT id FROM `dinnersys`.`users`
		WHERE login_id = '2018_11707'
	)
);



INSERT INTO `dinnersys`.`device`
(`device_id`,
`device_info`,
`device_type`,
`last_ip`,
`last_used_datetime`,
`belongs_user_id`)
VALUES(
	'0003' ,
    'the device info' ,
    'Android' ,
    '127.0.0.1' ,
    CURRENT_TIMESTAMP ,
    (
		SELECT id FROM `dinnersys`.`users`
		WHERE login_id = '2018_11708'
	)
);


INSERT INTO `dinnersys`.`device`
(`device_id`,
`device_info`,
`device_type`,
`last_ip`,
`last_used_datetime`,
`belongs_user_id`)
VALUES(
	'0004' ,
    'the device info' ,
    'Android' ,
    '127.0.0.1' ,
    CURRENT_TIMESTAMP ,
    (
		SELECT id FROM `dinnersys`.`users`
		WHERE login_id = '2018_11708'
	)
);


INSERT INTO `dinnersys`.`device`
(`device_id`,
`device_info`,
`device_type`,
`last_ip`,
`last_used_datetime`,
`belongs_user_id`)
VALUES(
	'0005' ,
    'the device info' ,
    'Android' ,
    '127.0.0.1' ,
    CURRENT_TIMESTAMP ,
    (
		SELECT id FROM `dinnersys`.`users`
		WHERE login_id = '2018_11707'
	)
);

INSERT INTO `dinnersys`.`device`
(`device_id`,
`device_info`,
`device_type`,
`last_ip`,
`last_used_datetime`,
`belongs_user_id`)
VALUES(
	'0000' ,
    'the device info' ,
    'Android' ,
    '127.0.0.1' ,
    CURRENT_TIMESTAMP ,
    (
		SELECT id FROM `dinnersys`.`users`
		WHERE login_id = '2018_11707'
	)
);

SELECT * FROM `dinnersys`.`device`;
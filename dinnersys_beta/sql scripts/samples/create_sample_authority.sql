#### CREATE SAMPLE AUTHORITY ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`authority`;
SET FOREIGN_KEY_CHECKS = 1;

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
    AND D.device_id = '0000'
),
'127.0.0.1'
);


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
    AND D.device_id = '0002'
),
'127.0.0.1'
);


SET @id =
(
	SELECT id FROM `dinnersys`.`users` AS U
	WHERE U.login_id = '2018_11708'
);
INSERT INTO `dinnersys`.`authority`
(`user`, `device_id`, `ip`)
VALUES (
@id,
(
	SELECT id FROM `dinnersys`.`device` AS D
    WHERE D.belongs_user_id = @id
    AND D.device_id = '0003'
),
'127.0.0.1'
);


SET @id =
(
	SELECT id FROM `dinnersys`.`users` AS U
	WHERE U.login_id = '2018_11708'
);
INSERT INTO `dinnersys`.`authority`
(`user`, `device_id`, `ip`)
VALUES (
@id,
(
	SELECT id FROM `dinnersys`.`device` AS D
    WHERE D.belongs_user_id = @id
    AND D.device_id = '0004'
),
'127.0.0.1'
);


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
    AND D.device_id = '0005'
),
'127.0.0.1'
);

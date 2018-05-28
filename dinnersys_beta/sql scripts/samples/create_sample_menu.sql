#### CREATE SAMPLE MENU ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`menu`;
SET FOREIGN_KEY_CHECKS = 1;


INSERT INTO `dinnersys`.`menu`
(`charge`, `name`,
`is_ingredient`, `is_dish`,
`factory_id`,
`is_vegetarian`, `is_idle`)
VALUES
('55' ,'大麥克',
TRUE, TRUE,
(
	SELECT id FROM `dinnersys`.`factory` WHERE `name` = '愛佳便當'
),
FALSE, FALSE);

INSERT INTO `dinnersys`.`menu`
(`charge`, `name`,
`is_ingredient`, `is_dish`,
`factory_id`,
`is_vegetarian`, `is_idle`)
VALUES
('55' ,'黑胡椒井飯',
FALSE, TRUE,
(
	SELECT id FROM `dinnersys`.`factory` WHERE `name` = '台灣小吃部'
),
FALSE, FALSE);

INSERT INTO `dinnersys`.`menu`
(`charge`, `name`,
`is_ingredient`, `is_dish`,
`factory_id`,
`is_vegetarian`, `is_idle`)
VALUES
('10' ,'貢丸',
TRUE, FALSE,
(
	SELECT id FROM `dinnersys`.`factory` WHERE `name` = '關東煮'
),
FALSE, FALSE);

INSERT INTO `dinnersys`.`menu`
(`charge`, `name`,
`is_ingredient`, `is_dish`,
`factory_id`,
`is_vegetarian`, `is_idle`)
VALUES
('10' ,'白肉',
TRUE, FALSE,
(
	SELECT id FROM `dinnersys`.`factory` WHERE `name` = '關東煮'
),
FALSE, FALSE);

INSERT INTO `dinnersys`.`menu`
(`charge`, `name`,
`is_ingredient`, `is_dish`,
`factory_id`,
`is_vegetarian`, `is_idle`)
VALUES
('25' ,'大亨堡',
FALSE, TRUE,
(
	SELECT id FROM `dinnersys`.`factory` WHERE `name` = '早餐部'
),
FALSE, FALSE);

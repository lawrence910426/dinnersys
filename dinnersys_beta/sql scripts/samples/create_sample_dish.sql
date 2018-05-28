#### CREATE SAMPLE DISH ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`dish`;
SET FOREIGN_KEY_CHECKS = 1;

### WARNING ###
## THE INGREDIENT SHOULD BE SORTED IN ID ##

INSERT INTO `dinnersys`.`dish`
(`dish_name`,
`charge_sum`,
`ingredient_0`,
`ingredient_1`)
VALUES
(
'貢丸 + 白肉',
'20',
(SELECT id FROM `dinnersys`.`menu` WHERE `name` = '貢丸'),
(SELECT id FROM `dinnersys`.`menu` WHERE `name` = '白肉'));

INSERT INTO `dinnersys`.`dish`
(`dish_name`,
`charge_sum`,
`ingredient_0`)
VALUES
(
'貢丸',
'10',
(SELECT id FROM `dinnersys`.`menu` WHERE `name` = '貢丸'));

INSERT INTO `dinnersys`.`dish`
(`dish_name`,
`charge_sum`,
`ingredient_0`)
VALUES
(
'大亨堡',
'25',
(SELECT id FROM `dinnersys`.`menu` WHERE `name` = '大亨堡'));

INSERT INTO `dinnersys`.`dish`
(`dish_name`,
`charge_sum`,
`ingredient_0`)
VALUES
(
'黑胡椒井飯',
'55',
(SELECT id FROM `dinnersys`.`menu` WHERE `name` = '黑胡椒井飯'));

INSERT INTO `dinnersys`.`dish`
(`dish_name`,
`charge_sum`,
`ingredient_0`)
VALUES
(
'大麥克',
'87',
(SELECT id FROM `dinnersys`.`menu` WHERE `name` = '大麥克'));
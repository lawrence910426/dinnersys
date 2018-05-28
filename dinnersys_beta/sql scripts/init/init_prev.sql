#### INITILIZE THE PREVILEGES TABLE ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`previleges`;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `dinnersys`.`previleges`
(`prev_name`, `chinese_name`, `prev_code`)
VALUES ('guest', '訪客', 1);

INSERT INTO `dinnersys`.`previleges`
(`prev_name`, `chinese_name`, `prev_code`)
VALUES ('normal', '使用者', 2);

INSERT INTO `dinnersys`.`previleges`
(`prev_name`, `chinese_name`, `prev_code`)
VALUES ('dinnerman', '代訂', 4);

INSERT INTO `dinnersys`.`previleges`
(`prev_name`, `chinese_name`, `prev_code`)
VALUES ('factory', '廠商', 8);

INSERT INTO `dinnersys`.`previleges`
(`prev_name`, `chinese_name`, `prev_code`)
VALUES ('cafeteria', '合作社', 16);

INSERT INTO `dinnersys`.`previleges`
(`prev_name`, `chinese_name`, `prev_code`)
VALUES ('admin', '系統管理員', 32);

#### MIGHT HAVE MORE IN THE FUTURE ####
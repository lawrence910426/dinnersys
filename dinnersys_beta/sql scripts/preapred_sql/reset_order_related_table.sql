#### RESET ORDER RELATED TABLES ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`orders`;
TRUNCATE TABLE `dinnersys`.`announce`;
TRUNCATE TABLE `dinnersys`.`payment`;
TRUNCATE TABLE `dinnersys`.`money_trace`;
TRUNCATE TABLE `dinnersys`.`logistics_info`;
#TRUNCATE TABLE `dinnersys`.`authority`;					### reset it in init_user ###
SET FOREIGN_KEY_CHECKS = 1;


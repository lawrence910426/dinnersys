#### CREATE SAMPLE CLASS ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`class`;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `dinnersys`.`class`
(`year`, `grade`,
`class_no`,
`members`,
`dinnerman_id`,
`leader_id`)
VALUES
(
2018, 1,
117,		# full class number
NULL, NULL, NULL);

INSERT INTO `dinnersys`.`class`
(`year`, `grade`,
`class_no`,
`members`,
`dinnerman_id`,
`leader_id`)
VALUES
(
2019, 2,
221,		# full class number
NULL, NULL, NULL);
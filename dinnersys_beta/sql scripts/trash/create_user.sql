#### CREATE USER 1 ####
SET foreign_key_checks = 0;
TRUNCATE TABLE dinnersys.users;
TRUNCATE TABLE dinnersys.user_information;
SET foreign_key_checks = 1;

## CREATE user_information ##
INSERT INTO `dinnersys`.`user_information`
(`name`,
`ad_times`,
`phone_number`,
`is_vegetarian`,
`credits`,
`gender`,
`class_id`,
`school_id` ,
`seat_id` ,
`email`)
VALUES
(
"陳子豪",
0,
'0905-098-503',
FALSE,
0,
'MALE',
117,
'610089' ,
'11707' ,
'lawrence910426@gmail.com');

## CREATE user ##

INSERT INTO `dinnersys`.`users`
(
`login_id`,
`prev_sum`,
`password`,
`class_id`,
`year`,
`info_id`)
VALUES
(
'2018_11707',
-1,
'2rjurrru',
(
	SELECT id FROM `dinnersys`.`class` as C 
    WHERE C.class_no = '117' 
    AND C.year =  2018
),
'2018',
(
	SELECT MAX(id) FROM `dinnersys`.`user_information`
));






######################################################
## ------------------------------------------------ ##
######################################################




#### CREATE USER 2 ####

## CREATE user_information ##
INSERT INTO `dinnersys`.`user_information`
(`name`,
`ad_times`,
`phone_number`,
`is_vegetarian`,
`credits`,
`gender`,
`class_id`,
`school_id`,
`seat_id` ,
`email`)
VALUES
(
"吳邦寧",
0,
'0905-098-503',
FALSE,
0,
'MALE',
117,
'610090' ,
'11708' ,
'lawrence910426@gmail.com');

## CREATE user ##

INSERT INTO `dinnersys`.`users`
(
`login_id`,
`prev_sum`,
`password`,
`class_id`,
`year`,
`info_id`)
VALUES
(
'2018_11708',
-1,
'2rjurrru',
(
	SELECT id FROM `dinnersys`.`class` as C 
    WHERE C.class_no = '117' 
    AND C.year =  2018
),
'2018',
(
	SELECT MAX(id) FROM `dinnersys`.`user_information`
));



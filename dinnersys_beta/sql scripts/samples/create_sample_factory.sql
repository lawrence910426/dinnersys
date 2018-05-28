#### CREATE SAMPLE FACTORY ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`factory`;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `dinnersys`.`factory`
(`name`,
`handle_person_name`,
`boss_name`,
`disabled` ,
`lower_bound` ,`upper_bound` ,
`pre_time`)
VALUES
('台灣小吃部',
'負責人: 吳邦寧',
'老闆: 陳子豪',
FALSE ,
'09:00:00' ,'15:00:00' ,
'00:30:00');

INSERT INTO `dinnersys`.`factory`
(`name`,
`handle_person_name`,
`boss_name`,
`disabled`,
`lower_bound` ,`upper_bound`,
`pre_time`)
VALUES
('早餐部',
'負責人: 吳邦寧',
'老闆: 陳子豪',
FALSE,
'06:00:00' ,'10:00:00' ,
'00:05:00');

INSERT INTO `dinnersys`.`factory`
(`name`,
`handle_person_name`,
`boss_name`,
`disabled`,
`lower_bound` ,`upper_bound`,
`pre_time`)
VALUES
('愛佳便當',
'負責人: 吳邦寧',
'老闆: 陳子豪',
FALSE,
'09:00:00' ,'15:00:00' ,
'00:30:00');

INSERT INTO `dinnersys`.`factory`
(`name`,
`handle_person_name`,
`boss_name`,
`disabled`,
`lower_bound` ,`upper_bound`,
`pre_time`)
VALUES
('關東煮',
'負責人: 吳邦寧',
'老闆: 陳子豪',
FALSE,
'09:00:00' ,'15:00:00' ,
'00:30:00');

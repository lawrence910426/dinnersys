#### CHANGE CLASS ####

## A NEW YEAR CAN BE SEEN AS A LARGE SCALE OF CHANGING CLASS ##

SET @year = '2019';
SET @class_no = '221';
SET @seat_no = '07';
SET @old_login_id = '2018_11707';

/*
SET @year = '2018';
SET @class_no = '117';
SET @seat_no = '07';
SET @old_login_id = '2019_22107';
*/

SET @id =
(
	SELECT id FROM `dinnersys`.`users` WHERE login_id = @old_login_id
    COLLATE utf8_general_ci
);

SET @info_id = 
(
	SELECT info_id FROM `dinnersys`.`users` WHERE login_id = @old_login_id
    COLLATE utf8_general_ci
);


UPDATE `dinnersys`.`users`
SET
`login_id` = CONCAT(@year , '_' , @class_no , @seat_no),
`class_id` = 
(
	SELECT id FROM `dinnersys`.`class` WHERE class_no = @class_no
),
`year` = @year
WHERE `id` = @id;

UPDATE `dinnersys`.`user_information`
SET
`class_id` = @class_no,
`seat_id` = @class_no + @seat_no
WHERE `id` = @info_id;




#### INITILIZE OPERATION TABLE ####

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `dinnersys`.`operations`;
SET FOREIGN_KEY_CHECKS = 1;

#####################################################
SET @oper_name = 'login';
SET @oper_func = 'login';
SET @oper_chinese = '登入';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'guest'
));

SET @oper_name = 'logout';
SET @oper_func = 'logout';
SET @oper_chinese = '登出';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'guest'
));

SET @oper_name = 'register';
SET @oper_func = 'register';
SET @oper_chinese = '註冊';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'guest'
));
#####################################################

#####################################################
SET @oper_name = 'show_factory';
SET @oper_func = 'show_factory';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));

SET @oper_name = 'show_menu';
SET @oper_func = 'show_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));

SET @oper_name = 'show_dish';
SET @oper_func = 'show_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));
#####################################################


#####################################################
SET @oper_name = 'update_menu';
SET @oper_func = 'update_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'factory'
));

SET @oper_name = 'update_menu';
SET @oper_func = 'update_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'cafeteria'
));

SET @oper_name = 'update_menu';
SET @oper_func = 'update_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'admin'
));



SET @oper_name = 'update_dish';
SET @oper_func = 'update_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'factory'
));

SET @oper_name = 'update_dish';
SET @oper_func = 'update_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'cafeteria'
));

SET @oper_name = 'update_dish';
SET @oper_func = 'update_food';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'admin'
));
#####################################################


#####################################################
SET @oper_name = 'select_self';
SET @oper_func = 'show_order';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));

SET @oper_name = 'select_class';
SET @oper_func = 'show_order';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'dinnerman'
));

SET @oper_name = 'select_other';
SET @oper_func = 'show_order';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'cafeteria'
));

SET @oper_name = 'select_other';
SET @oper_func = 'show_order';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'factory'
));

SET @oper_name = 'select_everyone';
SET @oper_func = 'show_order';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'admin'
));
#####################################################

#####################################################
SET @oper_name = 'make_order';
SET @oper_func = 'make_order';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));

SET @oper_name = 'get_custom_dish_id';
SET @oper_func = 'get_custom_dish_id';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));

SET @oper_name = 'check_recv';
SET @oper_func = 'check_recv';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));
#####################################################


#####################################################
SET @oper_name = 'payment_dm';
SET @oper_func = 'set_payment';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'dinnerman'
));

SET @oper_name = 'payment_cafet';
SET @oper_func = 'set_payment';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'cafeteria'
));

SET @oper_name = 'payment_facto';
SET @oper_func = 'set_payment';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'factory'
));
#####################################################


#####################################################
SET @oper_name = 'change_password';
SET @oper_func = 'change_password';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));
#####################################################


#####################################################
SET @oper_name = 'delete_order';
SET @oper_func = 'delete_order';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));
#####################################################

#####################################################
SET @oper_name = 'get_date';
SET @oper_func = 'get_date';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));

SET @oper_name = 'get_datetime';
SET @oper_func = 'get_date';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'normal'
));
#####################################################

#####################################################
SET @oper_name = 'get_announce';
SET @oper_func = 'announce_handle';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'admin'
));

SET @oper_name = 'done_announce';
SET @oper_func = 'announce_handle';
SET @oper_chinese = '';

INSERT INTO `dinnersys`.`operations`
(`oper_name`, `oper_func_name`, `oper_chinese`, `require_prev`)
VALUES (@oper_name ,@oper_func ,@oper_chinese ,
(
	SELECT id FROM `dinnersys`.`previleges`
    WHERE prev_name = 'admin'
));
#####################################################
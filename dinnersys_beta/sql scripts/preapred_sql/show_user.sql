#### SHOW USER ####

SELECT * FROM dinnersys.users ,dinnersys.user_information ,dinnersys.class
WHERE users.class_id = class.id
AND users.info_id = user_information.id
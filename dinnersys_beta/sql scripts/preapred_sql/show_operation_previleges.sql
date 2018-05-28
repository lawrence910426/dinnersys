#### SHOW OPERATIONS AND PREVILEGES ####

SELECT * FROM 
`dinnersys`.`operations` AS O ,
`dinnersys`.`previleges` AS P
WHERE O.require_prev = P.id;

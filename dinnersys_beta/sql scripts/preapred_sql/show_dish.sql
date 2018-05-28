#### SHOW DISH ####

SELECT * FROM dinnersys.dish ,dinnersys.menu ,dinnersys.factory
WHERE (dish.ingredient_0 = menu.id OR dish.ingredient_1 = menu.id)
AND menu.factory_id = factory.id;
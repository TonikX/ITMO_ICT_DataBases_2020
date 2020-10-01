--вывод столбца тираж, напечатанных газет данного тиража с распределением по почтовым отделениям с адресом и номером
--
SELECT "Edition"."Newspaper_amount","Distribution"."Full_quantity_newspaper", "Postoffice"."Post_adress", "Postoffice"."Branch_number" FROM public."Distribution" 
INNER JOIN public."Postoffice" ON "Distribution"."ID_Post"="Postoffice"."ID_Post" 
INNER JOIN public."Edition" ON "Distribution"."ID_Edition"="Edition"."ID_Edition" 
ORDER BY "Edition"."Newspaper_amount";
--
--
--Список Почтовых отделений, у которых в точка находится в 34 доме или Номер отделения больше 10
--
SELECT * FROM public."Postoffice" WHERE "Post_adress" LIKE '%д.34%' OR "Branch_number" > 10;
--
--
--информация о газетах и их тиражей в единой таблице
--
SELECT * FROM public."Newspaper" 
INNER JOIN public."Edition" on "Edition"."ID_Newspaper"="Newspaper"."ID_Newspaper" 
ORDER BY "Publication_number";
--
--
--Вывод ID_Tipography напечатавшей тираж газеты, редактором которого является «Никита Михалков»
--
SELECT "ID_Tipography" FROM public."Print" 
INNER JOIN public."Edition" on "Print"."ID_Edition"="Edition"."ID_Edition" 
WHERE "Edition"."ID_Edition" IN (SELECT "ID_Newspaper" FROM "Newspaper" WHERE "Newspaper"."Reductor"='Никита Михалков');
--
--
--Вывод всех газет, редактором которых является гражданин с именем СЕРГЕЙ или вывод всех газет, в которых встречается буква С
--
SELECT * FROM public."Newspaper" 
WHERE POSITION(btrim(LOWER(' Сергей ')) in LOWER ("Reductor"))>0 OR POSITION(btrim(LOWER('С')) in LOWER("Naming"))>0;
--
--
--Подсчет типографий, которым отправили тираж газеты с ID_Edition = 1
--
SELECT COUNT(DISTINCT "Printed_quantity") AS "Quantity_of_1_ID_Edition"
FROM public."Print" WHERE "Printed_quantity" IN (SELECT "Printed_quantity" FROM public."Print" WHERE "ID_Edition" = 1);
--
--
--Вывод количества уникальных газет, номер публикации которой выше 2 номера (рентабельность газеты) 
--и подсчет напечатанных газет, номер публикации которой удовлетворяет условию номер публикации которой выше 2 номера.
--
SELECT SUM("Printed_quantity" ) AS "Quantity_of_Regular_Newspaper",
COUNT ("Newspaper_amount") AS "Regular_Newspaper" FROM public."Print" 
INNER JOIN public."Edition" ON "Print"."ID_Edition"="Edition"."ID_Edition" 
WHERE "Newspaper_amount" IN (SELECT "Newspaper_amount" FROM public."Edition" WHERE "Publication_number" >2);
--
--
--Вывод данных о газетах, чьи напечатанные экземпляры меньше 11 штук от любой типографии среди всех заказов на печать 
--
SELECT "Newspaper"."Naming", "Newspaper"."Index", "Newspaper"."Reductor", MIN ("Print"."Printed_quantity") 
FROM public."Edition" 
 INNER JOIN public."Newspaper" 
 ON "Edition"."ID_Newspaper"="Newspaper"."ID_Newspaper" 
 INNER JOIN public."Print" 
 ON "Edition"."ID_Edition"="Print"."ID_Edition"
GROUP BY "Newspaper"."Naming", "Newspaper"."Index", "Newspaper"."Reductor" 
HAVING MIN ("Print"."Printed_quantity")<11;
--
--
--Вывод данных о почтовых отделениях(номер почтового отделения и адрес), для которых осуществляется доставка 
--
SELECT "Branch_number", "Post_adress" 
FROM public."Postoffice" 
WHERE EXISTS(SELECT "ID_Distribution" FROM public."Distribution" WHERE "Postoffice"."ID_Post"="Distribution"."ID_Post");
--
--
--нахождение всех газет, которые были разделены в разные типографии (реляционная алгебра. разность)
--
SELECT "Newspaper_amount" 
FROM public."Edition" EXCEPT SELECT "Printed_quantity" FROM public."Print";
--
--
--вывод таблицы тиража для значений, если номер публикации выше 7 и если число экземпляров больше 30
--
SELECT * FROM public."Edition" 
WHERE "Publication_number" >7 UNION SELECT * from public."Edition" WHERE "Newspaper_amount" >30;
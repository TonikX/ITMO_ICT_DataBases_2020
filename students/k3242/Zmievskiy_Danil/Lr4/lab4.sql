-- Книги, закрепленные за определенным читателем с ID = 6

SELECT DISTINCT "Name"
FROM public."Book", public."Book_instance"
WHERE "Book"."ID_book" = "Book_instance"."ID_book"
AND "ID_instance" IN (SELECT "ID_instance" FROM public."Getting_book" WHERE
"ID_reader" = 6)
ORDER BY "Name"

-- Читатели, которые взяли книгу более месяца тому назад

SELECT "Name"
FROM public."Reader"
INNER JOIN public."Getting_book"
ON "Reader"."ID_reader" = "Getting_book"."ID_reader"
WHERE CURRENT_DATE - "Date_of_receiving" > 31
ORDER BY "Name"

-- Читатели, у которых количество экземпляров книг в библиотеке более 10

SELECT "Reader"."Name"
FROM public."Reader"
INNER JOIN public."Getting_book"
ON "Reader"."ID_reader" = "Getting_book"."ID_reader"
INNER JOIN public."Book_instance"
ON "Getting_book"."ID_instance" = "Book_instance"."ID_instance"
INNER JOIN public."Book"
ON "Book_instance"."ID_book" = "Book"."ID_book"
WHERE "Book"."ID_book" = ANY (SELECT "ID_book" FROM
public."Number_of_instances_in_r/r" WHERE "Number_of_instances" > 10)
ORDER BY "Name"

-- Читателей младше 30 лет

SELECT COUNT("ID_reader")
FROM public."Reader"
WHERE EXTRACT(YEAR FROM AGE(CURRENT_DATE, "Date_of_birth")) < 30

-- Список читателей, которые закреплены за залом с номером 3

SELECT "Name"
FROM public."Reader"
INNER JOIN public."Creation_new_reader"
ON "Reader"."ID_reader" = "Creation_new_reader"."ID_reader"
WHERE "ID_room" = ANY (SELECT "ID_room" FROM public."Reading_room"
WHERE "Number" = 3)
ORDER BY "Name"

-- Номера залов, в которых есть книги, начинающиеся на “Гарри...”

SELECT "Number"
FROM public."Reading_room"
LEFT JOIN public."Number_of_instances_in_r/r"
ON "Reading_room"."ID_room" = "Number_of_instances_in_r/r"."ID_room"
WHERE "ID_book" = ANY (SELECT "ID_book" FROM public."Book" WHERE
"Name" LIKE 'Гарри%')

-- Количество читателей, записавшихся в библиотеку в 2018 году в зал 2

SELECT COUNT("Reader"."ID_reader")
FROM public."Reader"
INNER JOIN public."Creation_new_reader"
ON "Reader"."ID_reader" = "Creation_new_reader"."ID_reader"
WHERE EXTRACT(YEAR FROM "Date_of_creation") = 2018
AND "ID_room" = ANY (SELECT "ID_room" FROM public."Reading_room" WHERE
"Number" = 2)

-- Количество экземпляров книг, которых больше 10 и меньше или равно 10

SELECT '>10' AS type, COUNT("ID_book")
FROM public."Number_of_instances_in_r/r"
WHERE "Number_of_instances" >10
UNION
SELECT '<=10' AS type, COUNT("ID_book")
FROM public."Number_of_instances_in_r/r"
WHERE "Number_of_instances" <=10

-- Имена и адреса читателей, которые родились позже 1990 и не имеют ученой степени, поменяв аббревиатуру “СПБ” на “Санкт-Петербург”

SELECT "Name", REPLACE("Address", 'СПБ', 'Санкт-Петербург') AS Address
FROM public."Reader"
WHERE EXTRACT(YEAR FROM "Date_of_birth") > 1990 AND "Academic_degree"
= FALSE
ORDER BY "Name"

-- Названия читательских залов и количество читателей, если их количество в них меньше 10

SELECT "Reading_room"."Name", COUNT("Reader"."ID_reader")
FROM public."Reading_room", public."Creation_new_reader", public."Reader"
WHERE "Reading_room"."ID_room" = "Creation_new_reader"."ID_room"
AND "Creation_new_reader"."ID_reader" = "Reader"."ID_reader"
GROUP BY "Reading_room"."ID_room"
HAVING COUNT("Reader"."ID_reader") < 10
ORDER BY "Name"



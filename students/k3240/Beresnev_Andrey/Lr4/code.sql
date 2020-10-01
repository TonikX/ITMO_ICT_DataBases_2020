-- Имена и возраст всех посетителей с ученой степенью родившихся до 2001
SELECT public."Customer"."name", age(public."Customer"."date_of_birth") as "age"  FROM public."Customer"
WHERE public."Customer"."science_degree "  = true AND public."Customer"."date_of_birth" < timestamp '2001-04-10';

-- Список всех посетителей с паспортами взявших книгу отсортировано по id
SELECT public."Customer"."name", public."Customer"."passport" FROM public."Customer" 
WHERE public."Customer"."id" < ANY 
(SELECT public."Taken_books"."customer_id" FROM public."Taken_books");

-- Смежная таблица всех посетителей взявших книгу c помощью join
SELECT * FROM public."Customer" INNER JOIN public."Taken_books" 
ON public."Customer"."id" = public."Taken_books"."customer_id";

-- Средняя вместимость залов 
select round(avg(public."Hall"."capacity"),2) from public."Hall";

-- Количество книг по залам
select public."number_of_books"."hall_id", sum(public."number_of_books"."amount") as "amount" 
from public."number_of_books"
GROUP BY "hall_id";

-- Какие книги взял каждый читатель и когда отсортировано по имени читателя
select public."Customer"."name", public."Customer"."passport", public."Book"."name", public."Taken_books"."date_of_taking"
FROM public."Customer", public."Taken_books", public."Book"
WHERE public."Customer"."id" = public."Taken_books"."customer_id" 
and public."Book"."id" = public."Taken_books"."book_id"
ORDER BY public."Customer"."name";

-- Объединенная строка названия книги и издательства и год издания
select CONCAT(public."Book"."name", ' by ', public."Book"."publisher"), public."Book"."publishing_date" 
from public."Book";

-- Сколько людей взяли книгу
select public."Book"."name", Count(public."Taken_books"."book_id")
FROM public."Book", public."Taken_books"
WHERE public."Book"."id" = public."Taken_books"."book_id"
GROUP BY public."Book"."name"; 

-- Кто взял книги до 2019 года
select public."Customer"."name", public."Taken_books"."date_of_taking" 
FROM public."Customer", public."Taken_books"
WHERE "date_of_taking" < timestamp '2019-01-01' and
	public."Customer"."id" = public."Taken_books"."customer_id";
	
-- Какие книги есть в 1 зале
Select public."Book"."name" from public."Book"
WHERE public."Book"."id" IN 
(SELECT public."number_of_books"."book_id" from public."number_of_books"
 Where public."number_of_books"."hall_id" = 1);
1)SELECT full_name FROM public."Readers" order by full_name ASC; 
  --Получить ФИО всех читателей по алфавиту по возрастанию.

2)SELECT * FROM public."Readers" 
  inner join public."Instance_issues" 
  on public."Instance_issues".id_reader = public."Readers".id 
  order by number_of_card;
  --Получить информацию о читателях, которые брали книгу. 

3)SELECT id_rooms FROM public."Instances_in_room"
  INNER JOIN "Book_instances"
  ON "Instances_in_room".id_instance = "Book_instances".id
  where "Book_instances".id_book in (SELECT ID  FROM "Books" WHERE "Books".author = 'Сергей Тармашев' and (CURRENT_DATE - year_of_pub) > 1000);
  --Получить id зала, где находится заданная книга по автору и дата выпуска больше 1000 дней назад.

4)Select * from public."Books" where POSITION(btrim(LOWER('Узник     ')) in LOWER(name)) > 0 or POSITION(btrim(LOWER('   Джон  ')) in LOWER(author)) > 0;
  --Получить всю информацию о книгах в названии которых есть слово узник или имя автора Джон.
  
5)SELECT AVG((current_date - "Readers".data_of_birthday)/365) as age, AVG(ABS("Instance_issues".date_of_issue - "Instance_issues".return_date )) from public."Readers"
  INNER JOIN "Instance_issues" on "Readers".id = "Instance_issues".id_reader;
  -- Получить средний возраст читателей и среднюю длительность нахождения книги у читателя в днях.
  
6)select name from public."Books" where EXISTS (select id_book from "Book_instances" where "Books".id = "Book_instances".id_book);
   -- Получить имя книги, для которой есть экземпляр.
   
7)SELECT id_rooms, "Books".name, max(value)
  FROM "Instances_in_room" 
  inner join "Book_instances" on "Instances_in_room".id_instance = "Book_instances".id
  inner join "Books" on "Books".id = "Book_instances".id_book
  GROUP BY id_rooms, name
  HAVING max(value) > 50;
  -- Получить наименование максимального колличества книг в каждом читальном зале, кол-во которых больше 50. 
	
8)Select * from public."Books" where name Like '%7%' union
  Select * from public."Books" where debit_date is not NULL;
  -- Получить все книги в названии которых есть цифра 7 или книга списана.
   
9)Select passport_number, date_recorded, name, "Reading_rooms".people_capacity from public."Readers"
  INNER JOIN "Registers" on "Readers".id = "Registers".id_reader
  INNER JOIN "Reading_rooms" on "Registers".id_room = "Reading_rooms".id where "Reading_rooms".people_capacity >= 20;
  -- Получить номер паспорта читателей, который был когда либо записан в читательский зал с вместимостью более 20 человек.
  
10)SELECT name from public."Readers" 
   inner join "Instance_issues" on "Instance_issues".id_reader = "Readers".id
   inner join "Book_instances" on "Instance_issues".id_instance = "Book_instances".id
   inner join "Books" on "Book_instances".id_book = "Books".id
   where number_of_card = 2457456;
   --Получить все книги который брал читатель с номером читательского билета 2457456.

11)select name, "Books".year_of_pub from "Book_instances" 
   inner join "Books" on "Books".id = "Book_instances".id_book
   order by "Books".year_of_pub limit 1;
   -- Получить наименование самой старой книги, у которой есть экземпляр.

12)SELECT name from "Instance_issues" 
   inner join "Book_instances" on "Instance_issues".id_instance = "Book_instances".id
   inner join "Books" on "Book_instances".id_book = "Books".id
   where return_date is Null and (CURRENT_DATE - "Instance_issues".date_of_issue) > 30;
   --Получить список выданных книг и не возращённых книг в течение месяца.
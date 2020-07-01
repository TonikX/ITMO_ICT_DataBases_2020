--Список запросов:
--1.	 Выбор значений, заданных атрибутов из более, чем двух таблиц, с сортировкой
--1.1 Вывод списка студентов и списка курсов отсортированного по стоимости

SELECT "Course"."Students_list", "Directory_professions"."Course_list" FROM l_e."Course", l_e."Directory_professions" WHERE "Course"."ID_course" = "Directory_professions"."ID_course" ORDER BY "Price";

--1.2 Вывод ID и ФИО работодателей отсортированных по названию организации 

SELECT "ID_employer", "FCS_employer" FROM l_e."Employers" ORDER BY "Organization_name";

--2.	Использование условий WHERE, состоящих из более, чем одного условия
--2.1	Вывод заявителей мужчин младше 30 лет

SELECT * FROM l_e."Applicant" WHERE "Sex"='M' AND "Age"<30;

--2.2	Вывод контактного номера работодателя А.О. Попова, который работает в Яндексе

SELECT "Contact_details" FROM l_e."Employers" WHERE "Organization_name"='Яндекс' AND "FCS_employer"='А.О. Попов';

--3.	Использование функций для работы с датами
--3.1	Вывод ФИО и дат начала выплаты пособия для заявителей

SELECT "ID_applicant", "FCS_applicant", "Start_receiving_benefits" FROM l_e."Applicant";

--3.2	Вывод ID заявителей и ФИО, которые уже закончили их получать в сентябре 2019

 SELECT "ID_applicant", "FCS_applicant" FROM l_e."Applicant" WHERE "End_benefit_receipt"<'2019-09-01';

--4.	Использование строковых функций
--4.1	Вывод контактной информации от организаций, в которых название организации меньше 7 символов

SELECT "Contact_details", "Organization_name" FROM l_e."Employers" WHERE char_length("Organization_name")<7;

--4.2	Выводим только фамилии заявителей (без И.О.)

SELECT SUBSTR("FCS_applicant",6) FROM l_e."Applicant";

--5.	Запрос с использованием подзапросов
--5.1	Выводим ФИО заявителей женского пола

SELECT "FCS_applicant" FROM l_e."Applicant" WHERE "Sex" = (SELECT "Sex" FROM l_e."Applicant" WHERE "Applicant"."Sex" = 'F');

--5.2 Вывод ФИО заявителей с предыдущей зарплатой больше 30000
SELECT "FCS_applicant" FROM l_e."Applicant" WHERE "Last_salary" = (SELECT "Last_salary" FROM l_e."Applicant" WHERE "Applicant"."Last_salary" > 30000);

--6.	Вычисление групповой (агрегатной) функции
--6.1	Вывод количества учащихся на втором курсе 

SELECT count("ID_course") FROM l_e."Course" WHERE "Group_number" LIKE '_3%';

--6.2	Вычисление средней прошлой зарплаты заявителей 
SELECT AVG("Last_salary") FROM l_e."Applicant";

--7.	Вычисление групповой (агрегатной) функции с условием HAVING
--7.1	Вывод заявителей младше 30.

SELECT "ID_applicant", "FCS_applicant" FROM l_e."Applicant" GROUP BY "Age", "ID_applicant", "FCS_applicant" HAVING "Age"<30;

--7.2	Вывод ФИО и название организаций, в которых фамилия короче 7 букв.
SELECT "FCS_employer", "Organization_name" FROM l_e."Employers" GROUP BY "FCS_employer", "Organization_name" HAVING LENGTH("FCS_employer")< 12;

--8.	Использование предикатов EXISTS, ALL, SOME и ANY
--8.1	Выведем курсы, стоимость которых меньше 5000

SELECT "ID_course", "Price" FROM l_e."Course" WHERE "Price" = ANY(SELECT "Price" FROM l_e."Course" WHERE "Price" < 5000 );

--9.	Использование запросов с операциями реляционной алгебры (объединение, пересечение и т.д.)
--9.1	Вывод ФИО заявителя и количество курсов, которые он может оплатить на предыдущую зарплату

SELECT "Applicant"."FCS_applicant", CAST("Applicant"."Last_salary" as FLOAT) / CAST("Course"."Price" as FLOAT) FROM l_e."Applicant" INNER JOIN l_e."Course" ON "Applicant"."ID_applicant"="Course"."ID_course";

--10.	Использование объединений запросов (inner join и т.д.)
--10.1 Вывод ФИО всех работодателей и заявителей
SELECT "FCS_employer" FROM l_e."Employers" UNION ALL SELECT "FCS_applicant" FROM l_e."Applicant";

--10.2 Вывести все данные о курсах, которые находятся в справочнике

SELECT "Course"."ID_course", "New_discharge", "Duration", "Price", "Group_number", "Students_list" FROM l_e."Course" INNER JOIN l_e."Directory_professions" ON "Course"."ID_course"="Directory_professions"."ID_course" WHERE "Course_list"="New_discharge";


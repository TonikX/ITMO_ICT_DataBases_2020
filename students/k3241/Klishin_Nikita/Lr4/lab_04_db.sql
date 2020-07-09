select chicken.id_chiken, chicken.chicken_weight from chicken order by chicken.id_chiken
--1.	Выбрать всех записи о chicken с атрибутами id_chiken, chicken_weight и отсортировать их по id_chiken

select id_chiken, chicken_weight from chicken where (chicken_weight > 3) and (chicken_weight < 6)
--2.	Выбрать всех записи о chicken с атрибутами id_chiken, chicken_weight где chicken_weight  больше 3, но меньше 6

select id_worker from worker where worker.birth_date < CURRENT_DATE - INTERVAL '20 years'
--3.	Выбрать всех работников которые старше 20 лет.

select id_worker, fio from worker where char_length(worker.fio) < 21
--4.	Выбрать всех работников длина ФИО которых меньше 19 символов.

select id_worker, substring (fio from '%#" % #"%' for '#') from worker
--5.	Выбрать имена всех работников.

select id_chicken from chicken where exists (select id_chicken from chicken_worker where chicken_worker.id_chicken=chicken.id_chicken)
--6.	Выбрать всех кур, за которыми закреплены работники.

select count(id_chicken) from chicken
--7.	Выводит количество кур.

select avg(number_of_eggs) from chicken where cell in (select id_cell from cell where shop in (select id_shop from shop where shop.namber_of_shop = 1))
--8.	Выводит среднюю производительность кур в первом цехе.

select chicken_weight, sum (number_of_eggs) from chicken group by chicken_weight having (chicken_weight > 3)
--9.	Выбрать всех куриц, сгруппировать их по весу и подсчитать суммарную производительность групп куриц каждого веса.

select id_worker, fio from worker where (id_worker = any (select id_worker from chicken_worker))
--10.	Выбрать всех работников, за каждым из которых закреплена хотя бы одна курица.

select id_worker, fio from worker where exists (select id_chicken from chicken where (chicken_weight > 5) and id_chicken in (select id_chicken from chicken_worker where id_worker = worker.id_worker))
--11.	Выбрать всех работников за каждым из которых закреплена хотя бы одна курица весом более 5 кг.

(select chicken_weight from chicken where chicken.cell in (select id_cell from cell where cell.shop = 1)) intersect (select chicken_weight from chicken where chicken.cell in (select id_cell from cell where cell.shop = 3))
--12.	Выбрать веса кур, которые присутствуют и в 1 и в 3 цехах.

select * from chicken inner join breed on (chicken.id_breed = breed.id_breed)
--13.	Вывести всех кур, с информацией о их породе.

select * from chicken as ch join chicken_worker on (ch.id_chicken = chicken_worker.id_chicken) left join worker as w on (chicken_worker.id_worker=w.id_worker)
--14.	Выводит информацию о курах и закрепленных за ними работников.

select * from worker cross join chicken
--15.	Выводит все возможные связи кур и работников.

-- Вывод опр. данных о клетке, учитывая номер ряда и цеха из других таблиц, с сортировкой
select "ID_cell", number_cellinrow from "PoultryFarm"."Cell"
inner join "PoultryFarm"."Row"
on "PoultryFarm"."Cell".number_row = "PoultryFarm"."Row".number_row
inner join "PoultryFarm"."Tsekh"
on "PoultryFarm"."Row".number_tsekh = "PoultryFarm"."Tsekh".number_tsekh
order by number_cellinrows

-- Вывод номера цеха, содержащийся в другой таблице, учитывая ограничения на количество клеток и номер ряда
select number_row from "PoultryFarm"."Row"
inner join "PoultryFarm"."Tsekh"
on "PoultryFarm"."Row".number_tsekh = "PoultryFarm"."Tsekh".number_tsekh
where (amount_cells < 16) and (number_row > 3)

-- Вывод паспортных данных сотрудников, учитывая ограничения на ЗП и клетки, с сортировкой
select passport from "PoultryFarm"."Worker"
where (salary > 19000) and (cells = '1')
order by "ID_worker" desc

-- Вывод длины текста паспортных данных сотрудников
select char_length (passport) from "PoultryFarm"."Worker"

-- Перевод в верхний регистр породы, учитывая опр. данные о продуктивности и диете
select upper (name), productivity from "PoultryFarm"."Breed"
where (productivity > 19) and (diet = 'Vegetables')

-- Вывод опр. данных о курице, учитывая ограничения на ID породы из другой таблицы
select weight, number_row, number_tsekh from "PoultryFarm"."Chicken"
where "ID_breed" in (select "ID_breed" from "PoultryFarm"."Breed"
				  where ("ID_breed") = 3)
                  
-- Вывод опр. данных о клетке, учитывая ограничения на номер цеха из другой таблицы
select "ID_cell", number_cellinrow, number_tsekh from "PoultryFarm"."Cell"
where number_tsekh in (select number_tsekh from "PoultryFarm"."Tsekh"
				  where (number_tsekh) > 3)
                  
-- Вычисление общей ЗП сотрудников на фабрике
select sum(salary) from "PoultryFarm"."Worker"

-- Определение среднего округленного возраста куриц, учитывая опр. данные о весе
select round(avg(age)), weight from "PoultryFarm"."Chicken"
group by weight
having weight > 3.2

-- Определение средней округленной ЗП сотрудников, у которых более 5 клеток на обслуживании
select round(avg(salary)), cells from "PoultryFarm"."Worker"
group by cells
having cells > '5'

-- Вывод опр. данных о породах, которые уже содержатся на фабрике, с сортировкой
select productivity, diet from "PoultryFarm"."Breed"
where "ID_breed" = any (select "ID_breed" from "PoultryFarm"."Chicken")
order by productivity desc

-- Определение ныне существующих на фабрике пород куриц методом пересечений
select "ID_breed" from "PoultryFarm"."Breed"
intersect
select "ID_breed" from "PoultryFarm"."Chicken"

-- Определение номеров цеха, которые не заняты, методом исключений
select number_tsekh from "PoultryFarm"."Tsekh"
except
select number_tsekh from "PoultryFarm"."Row"

-- Вывод опр. данных о курицах, учитывая ID породы из другой таблицы, с сортировкой
select "ID_chicken", age, eggs_per_month from "PoultryFarm"."Chicken"
inner join "PoultryFarm"."Breed"
on "PoultryFarm"."Chicken"."ID_breed" = "PoultryFarm"."Breed"."ID_breed"
order by "ID_chicken" desc

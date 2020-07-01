-- Название офиса брокера и сумма его продаж
select "Broker"."ID_broker", "Broker"."Sales_price", "Office"."Office_name"
from "Exchange"."Broker"
inner join "Exchange"."Office" ON "Broker"."FK_ID_office" = "Office"."ID_office"


-- Название офиса брокера, сумма продаж которого больше 100.000$ и номер офиса которого больше 3.
select "Broker"."ID_broker", "Broker"."Sales_price", "Office"."Office_name"
from "Exchange"."Broker"
inner join "Exchange"."Office" ON "Broker"."FK_ID_office" = "Office"."ID_office"
where "Broker"."Sales_price" > money(100000) and "Office"."ID_office" > 3


-- Вывод информации о сделке, которая состоялась 04.14.2020
select *
from "Exchange"."Deal"
inner join "Exchange"."Lot" ON "Deal"."FK_ID_lot" = "Lot"."ID_lot"
where "Deal_date" = date('2020-04-14')


-- Вывод всей информации о уже просроченных продуктах
select *
from "Exchange"."Product"
inner join "Exchange"."Manufacturing_firm" ON "Product"."FK_ID_firm" = "Manufacturing_firm"."ID_firm"
where "Expiration_date" < current_date


-- Вывод имени клиента, затем подсчет количества букв в имени, вывод капсом, вывод обратной строки, приведение регистра в правильный вид (первые буквы - заглавные, другие - нет)
select "Client"."Client_name", length("Client_name"), upper("Client_name"), reverse("Client_name"), initcap("Client_name")
from "Exchange"."Client"


-- Контракт на продажу с минимальной ценой
select *
from "Exchange"."Contract_to_sell"
where "Selling_price" = (select min("Selling_price") from "Exchange"."Contract_to_sell")


-- Средняя цена контрактов продаж и покупок
select avg("Buying_price"::money::numeric::int)::int::money as "Average_buying_price", 
avg("Selling_price"::money::numeric::int)::int::money as "Average_selling_price"
from "Exchange"."Contract_to_buy"
inner join "Exchange"."Contract_to_sell" on "ID_contract_to_purchase" = "ID_contract_to_sale"


-- Клиенты, максимальное количество денег которых не превышает 490.000$
select "Client_name", max("Account") as "Max_amount_of_money"
from "Exchange"."Client"
group by "Client_name"
having max("Account") < money(490000)
order by "Max_amount_of_money"


-- Партия, цена которой составил 600$ и существует условие предоплаты
select * from "Exchange"."Lot"
where "Lot_price" = money(600)
and exists (select * from "Exchange"."Lot"
			where "Lot_delivery_conditions" = 'Prepayment')


-- Объединение всех строк таблиц брокер и контора с ограничением повторяющихся данных с сортировкой по именам контор
select distinct * from "Exchange"."Broker"
inner join "Exchange"."Office" on "Broker"."FK_ID_office" = "Office"."ID_office"
order by "Office_name"


-- Вывод айди товара, количество товара, название фирмы производителя, айди фирмы производителя
select distinct "ID_product", "Amount", "Firm_name", "ID_firm" from "Exchange"."Product"
inner join "Exchange"."Manufacturing_firm" on "Product"."FK_ID_firm" = "Manufacturing_firm"."ID_firm"
order by "Amount"
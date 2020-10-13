-- 1. (2б) Выбрать все поставки с предоплатой и на сумму не менее 1 млрд.
select * from commodities."Shipments" where "Prepayment" = true and "Subtotal" >= 10000;

-- 2. (2б) Посмотрим поставку, самую близкую к новому году (сортированным списков).
select 
	"ID", "Broker_ID", age(timestamp '2020-12-31', "Shipped_at") as "Until New Years" 
from 
	commodities."Shipments" 
order by "Until New Years";

-- 3. (2б) Получим все поставки, совершенные в промежуток между полночью и часом ночи.
select * from commodities."Shipments" where extract(hour from "Shipped_at") between '00' and '01';

-- 4. (2б) Получим всех брокеров, чье имя длиннее 5 символов.
select * from commodities."Brokers" where char_length("Name") > 5;

-- 5. (2б) Получим форматированный список работников.
select 'Broker ' || "Name" as "Employee Titles" from commodities."Brokers";

-- 6. (6б) Вывести товары, которые были выставлены на продажу в промежуток времени. Оставить только те товары, которые начинаются на 'i'.
-- 2б - подзапросы, 2б - group by, 2б - having
select "Title" from commodities."Products" where "ID" in (
	select "Product_ID" from commodities."Batches" where "Shipment_ID" in (
		select "Shipment_ID" from commodities."Shipments" where "Shipped_at" between '2020-01-01' and '2025-12-31'
	)
)
group by
	"Title"
having
	"Title" like 'i%';

-- 7. (6б) Вывести отчет по брокерам и их фирмам за все время.
select
	f."Title" as "Company Title", b."ID" as "Broker ID", b."Name" as "Broker Name", count(s."ID") as "Shipments made"
from
	commodities."Brokers" b
left join
	commodities."Shipments" s on s."Broker_ID" = b."ID"
left join
	commodities."Firms" f on b."Firm_ID" = f."Firm_ID"
group by
	f."Firm_ID", b."ID"
order by
	"Shipments made" desc;

-- 8. Вывести кол-во поставленных (не обязательно произведенных) товаров от каждого производителя за все время.
select
	ms."Title" as "Company", coalesce(sum("Quantity"), 0) as "Items shipped"
from
	commodities."Manufacturers" ms
left join
	commodities."Batches" b on b."Manufacturer_ID" = ms."ID"
left join
	commodities."Shipments" s on s."ID" = b."Shipment_ID"
group by
	ms."ID"
order by
	"Items shipped" desc;

-- 9. Сколько каждый брокер должен будет перечислить в свою фирму в конце октября (из тех, кто вообще оформлял какие-либо поставки)?
select
	f."Title" as "Company", b."ID" as "Broker ID", b."Name" as "Broker Name", sum(s."Subtotal") * 0.1 as "Comission due"
from
	(select * from commodities."Shipments" where extract(month from "Shipped_at") = '10') s
inner join
	commodities."Brokers" b on b."ID" = s."Broker_ID"
inner join
	commodities."Firms" f on b."Firm_ID" = f."Firm_ID"
group by
	f."Firm_ID", b."ID"
order by
	"Comission due" desc;

-- 10. Найти все факты выставления на продажу товаров с просроченной годностью (номер партии, код товара, наименование товара, данные о брокере).
select
	s."ID" as "Shipment ID",
	b."Product_ID" as "Product ID",
	(select "Title" from commodities."Products" where "ID" = b."Product_ID") as "Product Title",
	(select "ID" from commodities."Brokers" where "ID" = s."Broker_ID") as "Responsible Broker ID",
	(select "Name" from commodities."Brokers" where "ID" = s."Broker_ID") as "Responsible Broker Name"
from
	commodities."Batches" b
inner join
	commodities."Shipments" s on s."ID" = b."Shipment_ID"
where
	b."Expires_at" <= s."Shipped_at";
-- информация о товарах, измеряемых в баррелях, которые были произведены позже, чем 20 декабря 2019 года
select * from exchange.product 
where unit_of_measurement='barrel' and date_of_manufacture > '2019-12-20'
order by id_product;


-- информация о договорах на продажу и тех, что были заключены после июня 
select * from exchange.treaty where treaty_type = 'sell' 
union
select * from exchange.treaty where treaty_date >= '2020-06-01';


-- информация о продуктах, стоимость которых больше 100, и их производителях
select product.product_name, manufacturer.firm_name, id_batch, price from exchange.batch
inner join exchange.product on exchange.batch.id_product=exchange.product.id_product
inner join exchange.manufacturer on exchange.batch.id_manufacturer=exchange.manufacturer.id_manufacturer
where price > 100
order by product_name;


-- информация о биржах и суммах их сделок за товары, цена которых больше 1000 
select exchange.exchange_name, deal.deal_sum from exchange.deal 
inner join exchange.exchange on exchange.deal.id_exchange=exchange.exchange.id_exchange
where id_batch = any(
	select id_batch from exchange.batch 
	where price > 1000)
group by deal_sum, exchange_name;


-- информация о типе, сумме и дате договора с брокером, который работает в компании, начинающийся на "S"
select treaty.treaty_type, treaty.treaty_sum, treaty.treaty_date from exchange.treaty 
where id_broker = some(
	select id_broker from exchange.broker 
	where company_name like 'S%')
group by treaty_type, treaty_sum, treaty_date;


-- информация о компаниях, представленных в базе данных
select company_name as organisation from exchange.broker 
union
select firm_name as organisation from exchange.manufacturer
order by organisation;


-- информация о бирже, купленном товаре, его цене, количестве и сумме сделки, где партия содержит больше 15 единиц продукции
select exchange.exchange_name, product.product_name, batch.amount, batch.price, deal.deal_sum 
from exchange.exchange
inner join exchange.deal on exchange.deal.id_exchange=exchange.exchange.id_exchange
inner join exchange.batch on exchange.batch.id_batch=exchange.deal.id_batch
inner join exchange.product on exchange.batch.id_product=exchange.product.id_product
where batch.amount > 15
order by exchange_name;


-- информация о клиентах и суммах их договоров, при условии, что договор заключен на сумму больше 10000
select client.client_name, treaty.treaty_sum from exchange.treaty
left join exchange.client on exchange.client.id_client=exchange.treaty.id_client
group by client_name, treaty_sum having treaty_sum > 10000;


-- производители, сделки по продуктам которых были совершены в первой половине месяца
select firm_name from exchange.manufacturer 
where id_manufacturer = any(select id_manufacturer from exchange.batch
			where id_batch = any(select id_batch from exchange.deal
					where extract(day from deal.deal_date) < 15))
group by firm_name
order by firm_name;


-- информация о биржах, суммарная сумма сделок которых больше 10000
select exchange_name, sum(deal.deal_sum) from exchange.exchange 
inner join exchange.deal on exchange.deal.id_exchange=exchange.exchange.id_exchange
group by exchange_name having sum(deal.deal_sum) > 10000
order by exchange_name;


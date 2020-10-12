-- информация о товарах, измеряемых в баррелях, которые были произведены позже, чем 20 декабря 2019 года (1)
select * from product
where units='barrel' and date_of_production > '2019-12-20' order by id_product;


-- информация о договорах на продажу и тех, что были заключены после июня (2)
select * from contract where type_contract = 'sell' union 
select * from contract where date_of_purchase >= '2020-06-01';


-- информация о продуктах, стоимость которых больше 100, и их производителях (3)
select product.name_product, producer.name_of_firm, id_batch, cost_product from parties
inner join product on
parties.id_product=product.id_product
inner join producer on
parties.id_firm=producer.id_firm
where cost_product > 100
order by name_product;



-- информация о биржах и суммах их сделок за товары, цена которых больше 1000 (4)
select exchange.name_exchange, cost_transaction from transaction
inner join exchange on
transaction.id_exchange=exchange.id_exchange
where id_batch = any(select id_batch from parties where cost_product > 1000) group by cost_transaction, name_exchange;



-- информация о типе, сумме и дате договора с брокером, который работает в компании, начинающийся на "S"(5)
select type_contract, cost, date_of_purchase from contract
where id_broker = some( select id_broker from broker where name_company like 'S%')
group by type_contract, cost, date_of_purchase;



-- информация о компаниях, представленных в базе данных (6)
select company_name as organisation from exchange.broker union
select name_of_firm as organisation from producer order by organisation;



-- информация о бирже, купленном товаре, его цене, количестве и сумме сделки, где партия содержит больше 15 единиц продукции (7)
select exchange.name_exchange, product.name_product, parties.num_of_units, parties.cost_product, transaction.cost_transaction
from exchange
inner join transaction on
transaction.id_exchange=exchange.id_exchange
inner join parties on parties.id_batch=transaction.id_batch
inner join product on parties.id_product=product.id_product where parties.cost_product > 15
order by name_exchange;



-- информация о клиентах и суммах их договоров, при условии, что договор заключен на сумму больше 10000 (8)
select client.name_client, cost from contract
left join client on client.id_client=contract.id_client 
group by name_client, cost having cost > 10000;



-- производители, сделки по продуктам которых были совершены в первой половине месяца (9)
select name_of_firm from producer
where id_firm = any(select id_firm from parties where id_batch = any(select id_batch from transaction
where extract(day from transaction.date_transaction) < 15))
group by name_of_firm
order by name_of_firm;



-- информация о биржах, суммарная сумма сделок которых больше 10000 (10)
select name_exchange, sum(transaction.cost_transaction) from exchange
inner join transaction on
transaction.id_exchange= exchange.id_exchange
group by name_exchange having sum(transaction.cost_transaction) > 10000
order by name_exchange;


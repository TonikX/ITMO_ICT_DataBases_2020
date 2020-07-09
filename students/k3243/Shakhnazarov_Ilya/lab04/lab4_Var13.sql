-- 1
SELECT fk_bureau_name FROM Bargain.broker
WHERE Broker_salary > 20000 AND Broker_salary < 80000

-- 2
UPDATE Bargain.Client
SET client_name = REPLACE(client_name, 'Ilya', 'Igor 2')

-- 3
SELECT *, POSITION('Igor 2' IN client_name) AS cl
FROM Bargain.Client
WHERE POSITION('Igor 2' IN client_name)

-- 4
SELECT SUM(DISTINCT Employees_amount)
FROM Bargain.Bureau

-- 5
SELECT pr.expiration_date, pr.date_of_manufacture FROM bargain.product pr
INNER JOIN bargain.buy_contract bp ON pr.id_product = bp.id_buy_contract
WHERE amount_of_bought_product < 100000

-- 6
SELECT
	TO_CHAR(Deal_date, 'dd Mon, yyyy') Deal_date
FROM
	bargain.deal

-- 7
SELECT fk_manufacturer_name FROM bargain.product
WHERE expiration_date = ALL(SELECT  MAX(expiration_date) FROM bargain.product)
AND shipping_date < '2020-04-10'

-- 8
SELECT AVG(amount_of_bought_product) FROM bargain.buy_contract
WHERE terms_of_purchase = 'Prepayment' AND buy_price > 20000

-- 9
SELECT client_name
FROM bargain.client
WHERE id_client = (SELECT fk_id_client
				  	FROM bargain.buy_contract
				  	WHERE fk_id_deal = (SELECT id_deal FROM bargain.deal
										 	WHERE transaction_amount > 2500000))

-- 10
SELECT client_name FROM bargain.client cl
INNER JOIN bargain.buy_contract bc ON bc.fk_id_client=cl.id_client
WHERE bc.amount_of_bought_product > 800 AND bc.buy_price < 250000

-- 11
SELECT d.deal_date, d.transaction_amount
FROM bargain.deal d
INNER JOIN bargain.consignment con ON d.fk_id_consignment = con.id_consignment
WHERE consignment_delivery_conditions = 'Prepayment'

-- 12
SELECT Manufacturer_name
FROM bargain.manufacturer
WHERE Manufacturer_name = (SELECT fk_Manufacturer_name
				  			FROM bargain.product
				  			WHERE fk_id_consignment = (SELECT id_consignment 
													   	FROM bargain.consignment
													  	WHERE fk_id_product = (SELECT id_product 
																			  	FROM bargain.product
																			  	WHERE amount < 100)))

-- 13
SELECT SUM(DISTINCT Sale_price) FROM bargain.sale_contract
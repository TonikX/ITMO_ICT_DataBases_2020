-- таблица "Клиент"
CREATE TABLE exchange.client
(
    id_client integer NOT NULL,
    client_name text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT client_pkey PRIMARY KEY (id_client)
)

TABLESPACE pg_default;

ALTER TABLE exchange.client
    OWNER to postgres;


-- таблица "Биржа"
CREATE TABLE exchange.exchange
(
    id_exchange integer NOT NULL,
    exchange_name text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT exchange_pkey PRIMARY KEY (id_exchange)
)

TABLESPACE pg_default;

ALTER TABLE exchange.exchange
    OWNER to postgres;


-- таблица "Товар"
CREATE TABLE exchange.product
(
    id_product integer NOT NULL,
    product_name text COLLATE pg_catalog."default" NOT NULL,
    expiration_date date NOT NULL,
    date_of_manufacture date NOT NULL,
    unit_of_measurement text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT product_pkey PRIMARY KEY (id_product)
)

TABLESPACE pg_default;

ALTER TABLE exchange.product
    OWNER to postgres;


-- таблица "Производитель"
CREATE TABLE exchange.manufacturer
(
    id_manufacturer integer NOT NULL,
    firm_name text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT manufacturer_pkey PRIMARY KEY (id_manufacturer)
)

TABLESPACE pg_default;

ALTER TABLE exchange.manufacturer
    OWNER to postgres;


-- таблица "Партия"
CREATE TABLE exchange.batch
(
    id_batch integer NOT NULL,
    amount integer NOT NULL,
    price integer NOT NULL,
    conditions text COLLATE pg_catalog."default" NOT NULL,
    id_product integer NOT NULL,
    id_manufacturer integer NOT NULL,
    CONSTRAINT batch_pkey PRIMARY KEY (id_batch),
    CONSTRAINT id_manufacturer FOREIGN KEY (id_manufacturer)
        REFERENCES exchange.manufacturer (id_manufacturer) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT id_product FOREIGN KEY (id_product)
        REFERENCES exchange.product (id_product) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE exchange.batch
    OWNER to postgres;
-- Index: fki_id_manufacturer

-- DROP INDEX exchange.fki_id_manufacturer;

CREATE INDEX fki_id_manufacturer
    ON exchange.batch USING btree
    (id_manufacturer ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: fki_id_product

-- DROP INDEX exchange.fki_id_product;

CREATE INDEX fki_id_product
    ON exchange.batch USING btree
    (id_product ASC NULLS LAST)
    TABLESPACE pg_default;


-- таблица "Сделка"
CREATE TABLE exchange.deal
(
    id_deal integer NOT NULL,
    deal_sum integer NOT NULL,
    deal_date date NOT NULL,
    id_exchange integer NOT NULL,
    id_batch integer NOT NULL,
    CONSTRAINT deal_pkey PRIMARY KEY (id_deal),
    CONSTRAINT id_batch FOREIGN KEY (id_batch)
        REFERENCES exchange.batch (id_batch) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT id_exchange FOREIGN KEY (id_exchange)
        REFERENCES exchange.exchange (id_exchange) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE exchange.deal
    OWNER to postgres;
-- Index: fki_id_batch

-- DROP INDEX exchange.fki_id_batch;

CREATE INDEX fki_id_batch
    ON exchange.deal USING btree
    (id_batch ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: fki_id_exchange

-- DROP INDEX exchange.fki_id_exchange;

CREATE INDEX fki_id_exchange
    ON exchange.deal USING btree
    (id_exchange ASC NULLS LAST)
    TABLESPACE pg_default;


-- таблица "Брокер"
CREATE TABLE exchange.broker
(
    id_broker integer NOT NULL,
    salary integer NOT NULL,
    company_name text COLLATE pg_catalog."default" NOT NULL,
    id_exchange integer NOT NULL,
    CONSTRAINT broker_pkey PRIMARY KEY (id_broker),
    CONSTRAINT id_exchange FOREIGN KEY (id_exchange)
        REFERENCES exchange.exchange (id_exchange) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE exchange.broker
    OWNER to postgres;


-- таблица "Договор"
CREATE TABLE exchange.treaty
(
    id_treaty integer NOT NULL,
    id_client integer NOT NULL,
    id_broker integer NOT NULL,
    treaty_type text COLLATE pg_catalog."default" NOT NULL,
    amount integer NOT NULL,
    treaty_date date NOT NULL,
    treaty_sum integer NOT NULL,
    CONSTRAINT treaty_pkey PRIMARY KEY (id_treaty),
    CONSTRAINT id_broker FOREIGN KEY (id_broker)
        REFERENCES exchange.broker (id_broker) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT id_client FOREIGN KEY (id_client)
        REFERENCES exchange.client (id_client) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE exchange.treaty
    OWNER to postgres;
-- Index: fki_id_broker

-- DROP INDEX exchange.fki_id_broker;

CREATE INDEX fki_id_broker
    ON exchange.treaty USING btree
    (id_broker ASC NULLS LAST)
    TABLESPACE pg_default;
-- Index: fki_id_client

-- DROP INDEX exchange.fki_id_client;

CREATE INDEX fki_id_client
    ON exchange.treaty USING btree
    (id_client ASC NULLS LAST)
    TABLESPACE pg_default;


-- Заполнение таблицы "Клиент"
INSERT INTO exchange.client(id_client, client_name) VALUES 
	(1, 'Andrey'),
	(2, 'Victoria'),
	(3, 'Maria'),
	(4, 'Igor'),
	(5, 'Michael');

-- Заполнение таблицы "Товар"
INSERT INTO exchange.product( id_product, product_name, expiration_date, date_of_manufacture, unit_of_measurement)
	VALUES 
	(1, 'oil', '2026-01-01', '2020-01-01', 'barrel'),
	(2, 'milk', '2020-08-12', '2020-01-22', 'barrel'),
	(3, 'zink', '2029-03-02', '2019-11-14', 'ton'),
	(4, 'nickel', '2027-04-09', '2020-05-03', 'ton'),
	(5, 'cacao', '2022-06-11', '2020-06-11', 'ton');

-- Заполнение таблицы "Производитель"
INSERT INTO exchange.manufacturer(id_manufacturer, firm_name) VALUES 
	(1, 'losevo'),
	(2, 'severstal'),
	(3, 'gasprom'),
	(4, 'EVRAS'),
	(5, 'cacaocup');

-- Заполнение таблицы "Партия"
INSERT INTO exchange.batch(id_batch, amount, price, conditions, id_product, id_manufacturer)
	VALUES 
	(1, 12, 58, 'prepayment', 1, 3),
	(2, 104, 30, 'no_prepayment', 2, 1),
	(3, 26, 2030, 'prepayment', 3, 4),
	(4, 48, 13420, 'prepayment', 4, 2),
	(5, 24, 1550, 'no_prepayment', 5, 5);

-- Заполнение таблицы "Биржа"
INSERT INTO exchange.exchange(id_exchange, exchange_name) VALUES 
	(1, 'SPb excange'),
	(2, 'PTC'),
	(3, 'OPEX'),
	(4, 'KOSDAQ'),
	(5, 'Mooscow exchange');

-- Заполнение таблицы "Сделка"
INSERT INTO exchange.deal(id_deal, deal_sum, deal_date, id_exchange, id_batch)
	VALUES 
	(1, 644160, '2020-06-01', 1, 4),
	(2, 52780, '2020-07-03', 4, 3),
	(3, 37200, '2020-02-11', 5, 5),
	(4, 696, '2020-01-21', 2, 1),
	(5, 3120, '2020-03-01', 3, 2);

-- Заполнение таблицы "Брокер"
INSERT INTO exchange.broker(id_broker, salary, company_name, id_exchange)
	VALUES 
	(1, 27000, 'VTB', 1),
	(2, 44000, 'Sberbank', 2),
	(3, 29000, 'BKS', 3),
	(4, 56000, 'Tinkoff', 4),
	(5, 38000, 'Sberbank', 5);

-- Заполнение таблицы "Договор"
INSERT INTO exchange.treaty(id_treaty, id_client, id_broker, treaty_type, amount, treaty_date, treaty_sum)
	VALUES 
	(1, 1, 3, 'buy', 4, '2020-06-21', 48590),
	(2, 3, 5, 'buy', 10, '2020-03-21', 7490),
	(3, 2, 2, 'sell', 3, '2020-06-25', 1270),
	(4, 4, 4, 'buy', 28, '2020-05-11', 23570),
	(5, 5, 1, 'sell', 17, '2020-05-16', 14580);


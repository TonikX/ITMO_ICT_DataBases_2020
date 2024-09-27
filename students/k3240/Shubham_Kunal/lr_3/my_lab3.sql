-- Table: public.broker

-- DROP TABLE public.broker;

CREATE TABLE public.broker
(
    "ID_broker" integer NOT NULL,
    salary integer NOT NULL,
    name_company text COLLATE pg_catalog."default" NOT NULL,
    "ID_exchange" integer NOT NULL,
    CONSTRAINT broker_pkey PRIMARY KEY ("ID_broker"),
    CONSTRAINT "broker_ID_exchange_fkey" FOREIGN KEY ("ID_exchange")
        REFERENCES public.exchange ("ID_exchange") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public.broker
    OWNER to postgres;

    -- Table: public.client

-- DROP TABLE public.client;

CREATE TABLE public.client
(
    "ID_client" integer NOT NULL,
    name_client text COLLATE pg_catalog."default",
    CONSTRAINT client_pkey PRIMARY KEY ("ID_client")
)

TABLESPACE pg_default;

ALTER TABLE public.client
    OWNER to postgres;

-- Table: public.contract

-- DROP TABLE public.contract;

CREATE TABLE public.contract
(
    "ID_contract" integer NOT NULL,
    type_contract text COLLATE pg_catalog."default" NOT NULL,
    date_of_purchase date NOT NULL,
    cost integer NOT NULL,
    "ID_client" integer NOT NULL,
    "ID_broker" integer NOT NULL,
    CONSTRAINT contract_pkey PRIMARY KEY ("ID_contract"),
    CONSTRAINT "contract_ID_broker_fkey" FOREIGN KEY ("ID_broker")
        REFERENCES public.broker ("ID_broker") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "contract_ID_client_fkey" FOREIGN KEY ("ID_client")
        REFERENCES public.client ("ID_client") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public.contract
    OWNER to postgres;


-- Table: public.exchange

-- DROP TABLE public.exchange;

CREATE TABLE public.exchange
(
    "ID_exchange" integer NOT NULL,
    name_exchange text COLLATE pg_catalog."default",
    CONSTRAINT exchange_pkey PRIMARY KEY ("ID_exchange")
)

TABLESPACE pg_default;

ALTER TABLE public.exchange
    OWNER to postgres;

-- Table: public.parties

-- DROP TABLE public.parties;

CREATE TABLE public.parties
(
    "ID_batch" integer NOT NULL,
    num_of_units integer NOT NULL,
    cost_product integer NOT NULL,
    conditions_put text COLLATE pg_catalog."default" NOT NULL,
    "ID_firm" integer NOT NULL,
    "ID_product" integer NOT NULL,
    CONSTRAINT parties_pkey PRIMARY KEY ("ID_batch"),
    CONSTRAINT "parties_ID_firm_fkey" FOREIGN KEY ("ID_firm")
        REFERENCES public.producer ("ID_firm") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "parties_ID_product_fkey" FOREIGN KEY ("ID_product")
        REFERENCES public.product ("ID_product") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public.parties
    OWNER to postgres;

-- Table: public.producer

-- DROP TABLE public.producer;

CREATE TABLE public.producer
(
    "ID_firm" integer NOT NULL,
    name_of_firm text COLLATE pg_catalog."default",
    CONSTRAINT producer_pkey PRIMARY KEY ("ID_firm")
)

TABLESPACE pg_default;

ALTER TABLE public.producer
    OWNER to postgres;

-- Table: public.product

-- DROP TABLE public.product;

CREATE TABLE public.product
(
    "ID_product" integer NOT NULL,
    name_product text COLLATE pg_catalog."default",
    guarantee_time integer,
    date_of_production date,
    units integer,
    CONSTRAINT product_pkey PRIMARY KEY ("ID_product")
)

TABLESPACE pg_default;

ALTER TABLE public.product
    OWNER to postgres;

-- Table: public.transaction

-- DROP TABLE public.transaction;

CREATE TABLE public.transaction
(
    "ID_transaction" integer NOT NULL,
    cost_transaction integer NOT NULL,
    date_transaction date NOT NULL,
    "ID_exchange" integer NOT NULL,
    "ID_batch" integer NOT NULL,
    CONSTRAINT transaction_pkey PRIMARY KEY ("ID_transaction"),
    CONSTRAINT "transaction_ID_batch_fkey" FOREIGN KEY ("ID_batch")
        REFERENCES public.parties ("ID_batch") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT "transaction_ID_exchange_fkey" FOREIGN KEY ("ID_exchange")
        REFERENCES public.exchange ("ID_exchange") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public.transaction
    OWNER to postgres;



-- Table Product
INSERT INTO product( ID_product, name_product, guarantee_time, date_of_production, units)
	VALUES 
	(1, 'oil', '2026-01-01', '2020-01-01', 'barrel'),
	(2, 'milk', '2020-08-12', '2020-01-22', 'barrel'),
	(3, 'oil', '2029-03-02', '2019-11-14', 'ton'),
	(4, 'nickel', '2027-04-09', '2020-05-03', 'ton'),
	(5, 'cream', '2022-06-11', '2020-06-11', 'ton');

-- Table Producer
INSERT INTO producer(ID_firm, name_of_firm) VALUES 
	(1, 'firm1'),
	(2, 'firm2'),
	(3, 'firm3'),
	(4, 'firm4'),
	(5, 'firm5');

-- Table Parties
INSERT INTO parties(ID_batch, num_of_units, cost_product, conditions_put, ID_product, ID_firm)
	VALUES 
	(1, 12, 58, 'prepayment', 1, 3),
	(2, 104, 30, 'no_prepayment', 2, 1),
	(3, 26, 2030, 'prepayment', 3, 4),
	(4, 48, 13420, 'prepayment', 4, 2),
	(5, 24, 1550, 'no_prepayment', 5, 5);

-- Table exchange
INSERT INTO exchange(ID_exchange, name_exchange) VALUES 
	(1, 'SPb excange'),
	(2, 'NPS'),
	(3, 'OPEX'),
	(4, 'NASDAQ'),
	(5, 'Moscow exchange');

-- Table transaction
INSERT INTO transaction(ID_transaction, cost_transaction, date_transaction, ID_exchange, ID_batch)
	VALUES 
	(1, 644160, '2020-06-01', 1, 4),
	(2, 52780, '2020-07-03', 4, 3),
	(3, 37200, '2020-02-11', 5, 5),
	(4, 696, '2020-01-21', 2, 1),
	(5, 3120, '2020-03-01', 3, 2);

-- Table broker
INSERT INTO broker(ID_broker, salary, name_company, ID_exchange)
	VALUES 
	(1, 27000, 'NY Bank', 1),
	(2, 44000, 'Sberbank', 2),
	(3, 29000, 'BKS', 3),
	(4, 56000, 'SBI', 4),
	(5, 38000, 'Alpha bank', 5);

-- Table contract
INSERT INTO contract(ID_contract, type_contract, date_of_purchase, cost, ID_client, ID_broker)
	VALUES 
	(1, 'buy',  '2020-06-21', 48590, 1, 3),
	(2, 'buy', '2020-03-21', 7490, 3, 5),
	(3, 'sell', '2020-06-25', 1270, 2, 2),
	(4, 'buy', '2020-05-11', 23570, 4, 4 ),
	(5, 'sell', '2020-05-16', 14580, 5, 1);
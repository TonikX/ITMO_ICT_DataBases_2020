--заполнение справочника страны
INSERT INTO alpinisty.strany (name_strana) VALUES ('Россия');
INSERT INTO alpinisty.strany (name_strana) VALUES ('США');
INSERT INTO alpinisty.strany (name_strana) VALUES ('Украина');
INSERT INTO alpinisty.strany (name_strana) VALUES ('Германия');
INSERT INTO alpinisty.strany (name_strana) VALUES ('Бразилия');
--заполнение справочника нештатные ситуации
INSERT INTO alpinisty.nesht_situacii(name_ns) VALUES ('травма');
INSERT INTO alpinisty.nesht_situacii(name_ns) VALUES ('пропал без вести');
INSERT INTO alpinisty.nesht_situacii(name_ns) VALUES ('летальный исход');
INSERT INTO alpinisty.nesht_situacii(name_ns) VALUES ('остался жить в горах');
INSERT INTO alpinisty.nesht_situacii(name_ns) VALUES ('псих. травма');
INSERT INTO alpinisty.nesht_situacii(name_ns) VALUES ('без проишествий');
-- заполнение справочника горные районы
INSERT INTO alpinisty.rayon(name_rayon, id_strany)VALUES ('Большой Кавказ', 1);
INSERT INTO alpinisty.rayon(name_rayon, id_strany)VALUES ('Уральские горы', 1);
INSERT INTO alpinisty.rayon(name_rayon, id_strany)VALUES ('Алтай', 1);
INSERT INTO alpinisty.rayon(name_rayon, id_strany)VALUES ('Западные Саяны', 1);
INSERT INTO alpinisty.rayon(name_rayon, id_strany)VALUES ('Восточные Саяны', 1);
-- заполнение справочника альпинисткие клубы
INSERT INTO alpinisty.cluby(
	 name_clubs, adres, tel, email, id_strany, kontakt_lico)
	VALUES ('Альпклуб ЛЭТИ', 'Санкт-Петербург', '898190912345', 'alpclubleti@gmail.com', 1, 'Дмитрий Евгеньевич Царегородцев');
	INSERT INTO alpinisty.cluby(
	 name_clubs, adres, tel, email, id_strany, kontakt_lico)
	VALUES ('Ключ', 'Москва', '892626281905', 'alpclub@gmail.com', 1, 'Александр Геннадьевич Лавров');
	INSERT INTO alpinisty.cluby(
	 name_clubs, adres, tel, email, id_strany, kontakt_lico)
	VALUES ('Штурм', 'Владиковказ', '8952346346333', 'clubshturm@mail.com', 1, 'Владимир Анатольевич Кореньков');
	INSERT INTO alpinisty.cluby(
	 name_clubs, adres, tel, email, id_strany, kontakt_lico)
	VALUES ('Крокус', 'Омск', '8956777373737', 'alpclub@mail.com', 1, 'Евгений Сергеевич Жулинский');
	INSERT INTO alpinisty.cluby(
	 name_clubs, adres, tel, email, id_strany, kontakt_lico)
	VALUES ('Барс', 'Санкт-Петербург', '8950474747474', 'alpclubars@mail.com', 1, 'Сергей Алексеевич Семилеткин');
-- заполнение справочника альпинисты
INSERT INTO alpinisty.alpinisty(
	 ima_alpinista, otchestvo_alpinista, familia_alpinista, vozrast, adres, tel, email, id_cluba)
	VALUES ('Алексей','Петрович','Рубинин',39,'Санкт-петербург,ул Бабушкина 11 кв 12','895012312312','rubinin@mail.ru',1);
	INSERT INTO alpinisty.alpinisty(
	 ima_alpinista, otchestvo_alpinista, familia_alpinista, vozrast, adres, tel, email, id_cluba)
	VALUES ('Петр','Иванович','Самопалов',49,'Санкт-петербург,ул Академика Павлова 1 кв 12','8950325235235','samopal@mail.ru',1);
	INSERT INTO alpinisty.alpinisty(
	 ima_alpinista, otchestvo_alpinista, familia_alpinista, vozrast, adres, tel, email, id_cluba)
	VALUES ('Алексей','Исхакович','Рубинштейн',19,'Санкт-петербург,ул Академика Павлова 1 кв 10','8955235252325','rubin@mail.ru',1);
	INSERT INTO alpinisty.alpinisty(
	 ima_alpinista, otchestvo_alpinista, familia_alpinista, vozrast, adres, tel, email, id_cluba)
	VALUES ('Виталий','Романович','Иванов',29,'Санкт-петербург,ул Александра Невского 10 кв 140','8956868656844','ivanov@mail.ru',1);
	INSERT INTO alpinisty.alpinisty(
	 ima_alpinista, otchestvo_alpinista, familia_alpinista, vozrast, adres, tel, email, id_cluba)
	VALUES ('Николай','Семенович','Заикин',20,'Санкт-петербург,ул Балканская 17 кв 10','895532523525','zaikin@mail.ru',1
-- заполнение справочника горы
INSERT INTO alpinisty.gory(vysota, name_gory, rayon)
	VALUES ( 4509, 'Белуха', 3);
	INSERT INTO alpinisty.gory(vysota, name_gory, rayon)
	VALUES ( 4173, 'Маашей-Баш', 3);
	INSERT INTO alpinisty.gory(vysota, name_gory, rayon)
	VALUES ( 3738, 'Беркутаул', 3);
		INSERT INTO alpinisty.gory(vysota, name_gory, rayon)
	VALUES ( 5058, 'Джанга', 1);
		INSERT INTO alpinisty.gory(vysota, name_gory, rayon)
	VALUES (5642, 'Эльбрус', 1);
-- заполнение справочника 	маршруты
INSERT INTO alpinisty.marshruty( opisanie, prodolgitelnost, gory)
	VALUES ('Восхождение на Белуху', 45, 3);
	INSERT INTO alpinisty.marshruty( opisanie, prodolgitelnost, gory)
	VALUES ('Алтайская сказка', 46, 4);
		INSERT INTO alpinisty.marshruty( opisanie, prodolgitelnost, gory)
	VALUES ('Облегченный маршрут на Алтае', 46, 5);
		INSERT INTO alpinisty.marshruty( opisanie, prodolgitelnost, gory)
	VALUES ('Восхождение на Джангу', 49, 6);
		INSERT INTO alpinisty.marshruty( opisanie, prodolgitelnost, gory)
	VALUES ('Сказки Эльбруса', 46, 7);
-- заполнение справочника групп (восхождений)
INSERT INTO alpinisty.alp_gruppa(
 commentariy, rezult, data_otpravlenia, data_vozvrachenia, marshrut, nach_voshog_plan, zaver_voshog_plan, nach_voshog_fact, zaver_voshog_fact)
VALUES ( 'все хорошо', 'успешно','2019-10-19 10:23:54' ,'2019-10-24 10:23:54', 3,'2019-10-20 11:23:54' ,'2019-10-22 10:24:54', 
	'2019-10-20 11:23:54' ,'2019-10-22 10:24:54');
	INSERT INTO alpinisty.alp_gruppa(
 commentariy, rezult, data_otpravlenia, data_vozvrachenia, marshrut, nach_voshog_plan, zaver_voshog_plan, nach_voshog_fact, zaver_voshog_fact)
VALUES ( 'все хорошо', 'успешно','2019-01-19 10:23:54' ,'2019-01-24 10:23:54', 4,'2019-01-20 11:23:54' ,'2019-01-22 10:24:54', 
	'2019-01-20 11:23:54' ,'2019-01-22 10:24:54');
	INSERT INTO alpinisty.alp_gruppa(
 commentariy, rezult, data_otpravlenia, data_vozvrachenia, marshrut, nach_voshog_plan, zaver_voshog_plan, nach_voshog_fact, zaver_voshog_fact)
VALUES ( 'потеряли палатку', 'успешно','2019-11-19 12:23:54' ,'2019-11-24 12:23:54', 3,'2019-11-20 12:23:54' ,'2019-11-22 12:24:54', 
	'2019-11-20 12:23:54' ,'2019-11-22 12:24:54');
	INSERT INTO alpinisty.alp_gruppa(
 commentariy, rezult, data_otpravlenia, data_vozvrachenia, marshrut, nach_voshog_plan, zaver_voshog_plan, nach_voshog_fact, zaver_voshog_fact)
VALUES ( 'травма у одного из участников', 'удовлетварительно','2019-02-19 10:23:54' ,'2019-02-24 10:23:54', 3,'2019-02-20 11:23:54' ,'2019-02-22 10:24:54', 
	'2019-02-20 11:23:54' ,'2019-02-22 10:24:54');
	INSERT INTO alpinisty.alp_gruppa(
 commentariy, rezult, data_otpravlenia, data_vozvrachenia, marshrut, nach_voshog_plan, zaver_voshog_plan, nach_voshog_fact, zaver_voshog_fact)
VALUES ( 'все хорошо', 'успешно','2019-03-19 10:23:54' ,'2019-03-24 10:23:54', 3,'2019-03-20 11:23:54' ,'2019-03-22 10:24:54', 
	'2019-03-20 11:23:54' ,'2019-03-22 10:24:54');
	
-- заполнение справочника участие во восхождениях

INSERT INTO alpinisty.uchastie_vgruppach(
	alpinist, rezult_alpinista, nesht_situacii, gruppa)
	VALUES (2, 'успешно',6, 2);
	INSERT INTO alpinisty.uchastie_vgruppach(
	alpinist, rezult_alpinista, nesht_situacii, gruppa)
	VALUES (2, 'успешно',6, 3);
	INSERT INTO alpinisty.uchastie_vgruppach(
	alpinist, rezult_alpinista, nesht_situacii, gruppa)
	VALUES (2, 'успешно',6 , 4);
	INSERT INTO alpinisty.uchastie_vgruppach(
	alpinist, rezult_alpinista, nesht_situacii, gruppa)
	VALUES (3, 'успешно', 6, 2);
	INSERT INTO alpinisty.uchastie_vgruppach(
	alpinist, rezult_alpinista, nesht_situacii, gruppa)
	VALUES (4, 'удовлетворительно',1 , 2);

	



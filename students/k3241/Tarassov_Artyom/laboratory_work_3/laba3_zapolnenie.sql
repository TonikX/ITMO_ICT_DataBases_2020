INSERT INTO public."Books"(id, author, name, year_of_pub, section, pressmark, debit_date)
	VALUES 
	(DEFAULT, 'Дж. К. Роулинг', 'Гарри Поттер и узник Азкабана', '2017/10/12', 'Зарубежное фэнтези',  '3455', NULL), 
	(DEFAULT, 'Сергей Тармашев', 'Древний. Предыстория. Книга пятая. Время сильных духом', '2016/10/12', ' Древний. Предыстория ',  '1245', NULL),
	(DEFAULT, 'Джон Маррс', 'The One. Единственный', '2013/10/12', 'Альфа-триллер',  '1268', NULL), 
	(DEFAULT, 'Борис Михайлович Литвак', '7 шагов к стабильной самооценке', '2013/11/12', '-',  '4789', NULL),
	(DEFAULT, 'Гузель Яхина', 'Дети мои', '2013/6/6', '-',  '94734', '2020/1/1');
	
INSERT INTO public."Readers"(id, number_of_card, full_name, passport_number, data_of_birthday, address, call_number, graduation, graduate_degree)
	VALUES 
	(DEFAULT, 6434652, 'Василенко Михаил Алексеевич', 5432, '1999/10/6', 'SPB', 8923456, 'Middle', False),
	(DEFAULT, 132546, 'Фомин Николай Григорьевич', 6745, '1999/10/7', 'SPB', 8923455, 'Middle', False),
	(DEFAULT, 2457456, 'Носов Станислав Станиславович', 3457, '1999/10/8', 'SPB', 8923456, 'Middle', True),
	(DEFAULT, 134576, 'Житар Захар Петрович', 3457, '1999/10/9', 'MSK', 89523456, 'Middle', True),
	(DEFAULT, 436534, 'Шаров Марк Максимович', 753478, '1999/10/10', 'OMS', 8923456, 'Middle', False);
	
INSERT INTO public."Book_instances"(id, status, id_book)
	VALUES 
	(DEFAULT, 'Выдана', 1),
	(DEFAULT, 'Выдана', 2),
	(DEFAULT, 'В наличии', 3),
	(DEFAULT, 'Потеряна', 4),
	(DEFAULT, 'Выдана', 1);
	
INSERT INTO public."Instance_issues"(date_of_issue, return_date, id_reader, id_instance)
	VALUES 
	('2020/1/1', '2020/2/2', 1, 11),
	('2020/2/2', NULL, 1, 14),
	('2020/1/1', NULL, 5, 12),
	('2020/5/2', '2020/5/2', 5, 11),
	('2020/1/1', NULL, 3, 13);

INSERT INTO public."Reading_rooms"(id, "number", name, people_capacity)
	VALUES 
	(DEFAULT, 52434, 'Name1', 15),
	(DEFAULT, 12253, 'Name2', 20),
	(DEFAULT, 24356, 'Name3', 16),
	(DEFAULT, 14325, 'Name4', 100),
	(DEFAULT, 16452, 'Name5', 150);
	
INSERT INTO public."Instances_in_room"(id_rooms, id_instance, value)
	VALUES 
	(1, 12, 421),
	(2, 11, 34),
	(3, 14, 52),
	(4, 15, 54),
	(5, 13, 34);
	
INSERT INTO public."Registers"(id_room, id_reader, date_recorded, date_of_re_registration, discharge_date)
	VALUES 
	(1, 1, '2020/5/10', null, '2020/5/10'),
	(2, 1, '2020/2/10', '2020/2/10', null),
	(1, 4, '2020/5/10', null, '2020/5/10'),
	(4, 2, '2020/5/10', '2020/5/10', null),
	(3, 5, '2020/3/10', '2020/3/10', null);
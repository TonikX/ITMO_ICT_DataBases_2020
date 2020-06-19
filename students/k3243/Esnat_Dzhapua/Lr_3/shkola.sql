ALTER DATABASE lab3 OWNER TO postgres;

CREATE SCHEMA shkola;

ALTER SCHEMA shkola OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'TEACHER'


CREATE TABLE shkola.teacher (
	id_teacher SERIAL PRIMARY KEY NOT NULL,
	firstname VARCHAR,
	lastname VARCHAR,
	id_cabinet INTEGER
);

ALTER TABLE shkola.teacher OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'CABINET'


CREATE TABLE shkola.cabinet (
	id_cabinet SERIAL PRIMARY KEY NOT NULL,
	cab_floor INTEGER,
	cab_number INTEGER
);

ALTER TABLE shkola.cabinet OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'SUBJECT'


CREATE TABLE shkola.subject (
	id_subject SERIAL PRIMARY KEY NOT NULL,
	sub_name VARCHAR
);

ALTER TABLE shkola.subject OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'DISCIPLINE'


CREATE TABLE shkola.discipline (
	id_discipline SERIAL PRIMARY KEY NOT NULL,
	id_teacher INTEGER NOT NULL,
	id_subject INTEGER NOT NULL,
	disc_type VARCHAR
);

ALTER TABLE shkola.subject OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'STUDENT'


CREATE TABLE shkola.student (
	id_student SERIAL PRIMARY KEY NOT NULL,
	id_class INTEGER NOT NULL,
	id_teacher INTEGER NOT NULL,
	firstname VARCHAR,
	lastname VARCHAR,
	sex VARCHAR
);

ALTER TABLE shkola.student OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'CLASS'


CREATE TABLE shkola.class (
	id_class SERIAL PRIMARY KEY NOT NULL,
	id_teacher INTEGER NOT NULL,
	class_curator VARCHAR
);

ALTER TABLE shkola.class OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'SCHEDULE'


CREATE TABLE shkola.schedule (
	id_schedule SERIAL PRIMARY KEY NOT NULL,
	id_teacher INTEGER NOT NULL,
	id_subject INTEGER NOT NULL,
	id_class INTEGER NOT NULL,
	id_cabinet INTEGER NOT NULL,
	lesson_date DATE,
	lesson_num INTEGER
);

ALTER TABLE shkola.schedule OWNER TO postgres;


--- СОЗДАЕМ ТАБЛИЦУ 'JOURNAL'


CREATE TABLE shkola.journal (
	id_journal SERIAL PRIMARY KEY NOT NULL,
	id_student INTEGER NOT NULL,
	id_class INTEGER NOT NULL,
	grade INTEGER,
	grade_avg INTEGER,
	grade_quarter INTEGER
);

ALTER TABLE shkola.journal OWNER TO postgres;


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'TEACHER'


INSERT INTO shkola.teacher (id_teacher, firstname, lastname, id_cabinet) VALUES (DEFAULT, 'Иван', 'Ракитич', 1);
INSERT INTO shkola.teacher (id_teacher, firstname, lastname, id_cabinet) VALUES (DEFAULT, 'Кшиштоф', 'Пёнтек', 3);
INSERT INTO shkola.teacher (id_teacher, firstname, lastname, id_cabinet) VALUES (DEFAULT, 'Рахим', 'Стерлинг', 5);
INSERT INTO shkola.teacher (id_teacher, firstname, lastname, id_cabinet) VALUES (DEFAULT, 'Луиш', 'Фигу', 2);
INSERT INTO shkola.teacher (id_teacher, firstname, lastname, id_cabinet) VALUES (DEFAULT, 'Паоло', 'Мальдини', 4);


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'CABINET'


INSERT INTO shkola.cabinet (id_cabinet, cab_floor, cab_number) VALUES (DEFAULT, 1, 113);
INSERT INTO shkola.cabinet (id_cabinet, cab_floor, cab_number) VALUES (DEFAULT, 1, 154);
INSERT INTO shkola.cabinet (id_cabinet, cab_floor, cab_number) VALUES (DEFAULT, 3, 301);
INSERT INTO shkola.cabinet (id_cabinet, cab_floor, cab_number) VALUES (DEFAULT, 2, 223);
INSERT INTO shkola.cabinet (id_cabinet, cab_floor, cab_number) VALUES (DEFAULT, 4, 400);


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'SUBJECT'


INSERT INTO shkola.subject (id_subject, sub_name) VALUES (DEFAULT, 'Информатика');
INSERT INTO shkola.subject (id_subject, sub_name) VALUES (DEFAULT, 'Базы данных');
INSERT INTO shkola.subject (id_subject, sub_name) VALUES (DEFAULT, 'Программирование');
INSERT INTO shkola.subject (id_subject, sub_name) VALUES (DEFAULT, 'Визуализация БД');
INSERT INTO shkola.subject (id_subject, sub_name) VALUES (DEFAULT, 'Физкультура');


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'DISCIPLINE'


INSERT INTO shkola.discipline (id_discipline, id_teacher, id_subject, disc_type) VALUES (DEFAULT, 1, 3, 'Гуманитарный');
INSERT INTO shkola.discipline (id_discipline, id_teacher, id_subject, disc_type) VALUES (DEFAULT, 3, 5, 'Математический');
INSERT INTO shkola.discipline (id_discipline, id_teacher, id_subject, disc_type) VALUES (DEFAULT, 5, 1, 'Искусство');
INSERT INTO shkola.discipline (id_discipline, id_teacher, id_subject, disc_type) VALUES (DEFAULT, 2, 4, 'Филологический');
INSERT INTO shkola.discipline (id_discipline, id_teacher, id_subject, disc_type) VALUES (DEFAULT, 4, 2, 'Начальный');


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'STUDENT'


INSERT INTO shkola.student (id_student, id_class, id_teacher, firstname, lastname, sex) VALUES (DEFAULT, 3, 3, 'Габриэль ', 'Жезус', 'Мужчина');
INSERT INTO shkola.student (id_student, id_class, id_teacher, firstname, lastname, sex) VALUES (DEFAULT, 2, 1, 'Джоан', 'Бенуа', 'Женщина');
INSERT INTO shkola.student (id_student, id_class, id_teacher, firstname, lastname, sex) VALUES (DEFAULT, 5, 4, 'Льюис', 'Хэмилтон', 'Мужчина');
INSERT INTO shkola.student (id_student, id_class, id_teacher, firstname, lastname, sex) VALUES (DEFAULT, 1, 2, 'Энтони', 'Джошуа', 'Мужчина');
INSERT INTO shkola.student (id_student, id_class, id_teacher, firstname, lastname, sex) VALUES (DEFAULT, 4, 5, 'Зеина', 'Нассар', 'Женщина');


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'CLASS'


INSERT INTO shkola.class (id_class, id_teacher, class_curator) VALUES (DEFAULT, 4, 'Иван Ракитич');
INSERT INTO shkola.class (id_class, id_teacher, class_curator) VALUES (DEFAULT, 5, 'Паоло Мальдини');
INSERT INTO shkola.class (id_class, id_teacher, class_curator) VALUES (DEFAULT, 1, 'Луиш Фигу');
INSERT INTO shkola.class (id_class, id_teacher, class_curator) VALUES (DEFAULT, 3, 'Кшиштоф Пьентек');
INSERT INTO shkola.class (id_class, id_teacher, class_curator) VALUES (DEFAULT, 2, 'Рахим Стерлинг');


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'SCHEDULE'


INSERT INTO shkola.schedule (id_schedule, id_teacher, id_subject, id_class, id_cabinet, lesson_date, lesson_num) VALUES (DEFAULT, 1, 2, 3, 4, '2020-06-20', 6);
INSERT INTO shkola.schedule (id_schedule, id_teacher, id_subject, id_class, id_cabinet, lesson_date, lesson_num) VALUES (DEFAULT, 2, 3, 4, 5, '2020-06-21', 1);
INSERT INTO shkola.schedule (id_schedule, id_teacher, id_subject, id_class, id_cabinet, lesson_date, lesson_num) VALUES (DEFAULT, 3, 4, 5, 1, '2020-05-11', 2);
INSERT INTO shkola.schedule (id_schedule, id_teacher, id_subject, id_class, id_cabinet, lesson_date, lesson_num) VALUES (DEFAULT, 4, 5, 1, 2, '2020-06-14', 4);
INSERT INTO shkola.schedule (id_schedule, id_teacher, id_subject, id_class, id_cabinet, lesson_date, lesson_num) VALUES (DEFAULT, 5, 1, 2, 3, '2020-05-19', 7);


--- ЗАПОЛНЯЕМ ТАБЛИЦУ 'JOURNAL'


INSERT INTO shkola.journal (id_journal, id_student, id_class, grade, grade_avg, grade_quarter) VALUES (DEFAULT, 1, 2, 3, 4, 5);
INSERT INTO shkola.journal (id_journal, id_student, id_class, grade, grade_avg, grade_quarter) VALUES (DEFAULT, 2, 3, 4, 5, 1);
INSERT INTO shkola.journal (id_journal, id_student, id_class, grade, grade_avg, grade_quarter) VALUES (DEFAULT, 3, 4, 5, 1, 2);
INSERT INTO shkola.journal (id_journal, id_student, id_class, grade, grade_avg, grade_quarter) VALUES (DEFAULT, 4, 5, 1, 2, 3);
INSERT INTO shkola.journal (id_journal, id_student, id_class, grade, grade_avg, grade_quarter) VALUES (DEFAULT, 5, 1, 2, 3, 4);


---- ЗАДАЕМ ВНЕШНИЕ КЛЮЧИ


ALTER TABLE shkola.schedule ADD FOREIGN KEY (id_teacher) REFERENCES shkola.teacher (id_teacher) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.schedule ADD FOREIGN KEY (id_subject) REFERENCES shkola.subject (id_subject) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.schedule ADD FOREIGN KEY (id_class) REFERENCES shkola.class (id_class) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.schedule ADD FOREIGN KEY (id_cabinet) REFERENCES shkola.cabinet (id_cabinet) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.journal ADD FOREIGN KEY (id_student) REFERENCES shkola.student (id_student) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.journal ADD FOREIGN KEY (id_class) REFERENCES shkola.class (id_class) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.teacher ADD FOREIGN KEY (id_cabinet) REFERENCES shkola.cabinet (id_cabinet) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.discipline ADD FOREIGN KEY (id_teacher) REFERENCES shkola.teacher (id_teacher) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.discipline ADD FOREIGN KEY (id_subject) REFERENCES shkola.subject (id_subject) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.student ADD FOREIGN KEY (id_class) REFERENCES shkola.class (id_class) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.student ADD FOREIGN KEY (id_teacher) REFERENCES shkola.teacher (id_teacher) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE shkola.class ADD FOREIGN KEY (id_teacher) REFERENCES shkola.teacher (id_teacher) ON DELETE CASCADE ON UPDATE CASCADE;


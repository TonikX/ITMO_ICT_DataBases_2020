CREATE TABLE "Subject" (
  "id_Subject" SERIAL PRIMARY KEY NOT NULL,
  "name" varchar NOT NULL
);

CREATE TABLE "Cabinet" (
  "id_Cabinet" int PRIMARY KEY NOT NULL,
  "floor" int NOT NULL
);

CREATE TABLE "Teacher" (
  "id_Teacher" SERIAL PRIMARY KEY NOT NULL,
  "id_Cabinet" int,
  "first_name" varchar NOT NULL,
  "last_name" varchar NOT NULL
);

CREATE TABLE "Discipline" (
  "id_Discipline" SERIAL PRIMARY KEY NOT NULL,
  "id_Teacher" int NOT NULL,
  "id_Subject" int NOT NULL,
  "type" varchar
);

CREATE TABLE "Class" (
  "id_Class" SERIAL PRIMARY KEY NOT NULL,
  "id_Teacher" int,
  "name" varchar,
  "begining_education" date,
  "end_education" date
);

CREATE TABLE "Student" (
  "id_Student" SERIAL PRIMARY KEY NOT NULL,
  "id_Class" int,
  "first_name" varchar,
  "last_name" varchar,
  "sex" varchar
);

CREATE TABLE "Journal" (
  "id_Journal" SERIAL PRIMARY KEY NOT NULL,
  "id_Class" int,
  "id_Discipline" int,
  "mark" int,
  "quarter" int
);

CREATE TABLE "Schedule" (
  "id_Schedule" SERIAL PRIMARY KEY NOT NULL,
  "id_Class" int,
  "id_Cabinet" int,
  "id_Discipline" int,
  "date" date,
  "order" int
);


ALTER TABLE "Teacher" ADD FOREIGN KEY ("id_Cabinet") REFERENCES "Cabinet" ("id_Cabinet") ON DELETE SET NULL;

ALTER TABLE "Discipline" ADD FOREIGN KEY ("id_Subject") REFERENCES "Subject" ("id_Subject") ON DELETE CASCADE;

ALTER TABLE "Discipline" ADD FOREIGN KEY ("id_Teacher") REFERENCES "Teacher" ("id_Teacher") ON DELETE CASCADE;

ALTER TABLE "Schedule" ADD FOREIGN KEY ("id_Class") REFERENCES "Class" ("id_Class") ON DELETE CASCADE;

ALTER TABLE "Schedule" ADD FOREIGN KEY ("id_Cabinet") REFERENCES "Cabinet" ("id_Cabinet") ON DELETE CASCADE;

ALTER TABLE "Schedule" ADD FOREIGN KEY ("id_Discipline") REFERENCES "Discipline" ("id_Discipline") ON DELETE CASCADE;

ALTER TABLE "Class" ADD FOREIGN KEY ("id_Teacher") REFERENCES "Teacher" ("id_Teacher") ON DELETE SET NULL;

ALTER TABLE "Student" ADD FOREIGN KEY ("id_Class") REFERENCES "Class" ("id_Class") ON DELETE SET NULL;

ALTER TABLE "Journal" ADD FOREIGN KEY ("id_Class") REFERENCES "Class" ("id_Class") ON DELETE CASCADE;

ALTER TABLE "Journal" ADD FOREIGN KEY ("id_Discipline") REFERENCES "Discipline" ("id_Discipline") ON DELETE CASCADE;

INSERT INTO "Subject"(id_Subject, name)
	VALUES 
	(DEFAULT, 'Математика'),
	(DEFAULT, 'Русский язык'),
	(DEFAULT, 'Английский язык'),
	(DEFAULT, 'Литература'),
	(DEFAULT, 'Физкультура');

INSERT INTO "Cabinet"(id_Cabinet, floor)
	VALUES 
	(10, '1'),
	(11, '1'),
	(12, '1'),
	(20, '2'),
	(30, '3');

INSERT INTO "Teacher"(id_Teacher, id_Cabinet, id_Subject, last_name)
	VALUES 
	(DEFAULT, 10, 'Александра', 'Васильева'),
	(DEFAULT, NULL, 'Василиса', 'Акифьева'),
	(DEFAULT, 12, 'Дмитрий', 'Зибин'),
	(DEFAULT, 20, 'Анастасия', 'Ландышева'),
	(DEFAULT, NULL, 'Мария', 'Дмитриева');

INSERT INTO "Discipline"(id_Discipline, id_Teacher, id_Subject, type)
	VALUES 
	(DEFAULT, 1, 2, 'Общее'),
	(DEFAULT, 1, 4, 'Факультатив'),
	(DEFAULT, 2, 1, 'Высшее'),
	(DEFAULT, 3, 5, NULL),
	(DEFAULT, 4, 3, 'INTERMEDIATE');

INSERT INTO "Class"(id_Class, id_Teacher, name, begining_education, end_education)
	VALUES 
	(DEFAULT, 1, '1А', '2018/9/1', '2029/9/1'),
	(DEFAULT, 2, '3Б', '2016/9/1', '2027/9/1'),
	(DEFAULT, 3, '3В', '2016/9/1', '2025/9/1'),
	(DEFAULT, 4, '5А', '2014/9/1', '2025/9/1'),
	(DEFAULT, 5, '11В', '2012/9/1', '2023/9/1');
	
INSERT INTO "Student"(id_Student, id_Class, first_name, last_name, sex)
	VALUES 
	(DEFAULT, 1, 1, 'Ли', 'Джызнь', 'female'),
	(DEFAULT, 2, 2, 'Анастасия', 'Акушева', 'female'),
	(DEFAULT, 3, 2, 'Дмитрий', 'Прохоров', 'male'),
	(DEFAULT, 4, 3, 'Данил', 'Ясень', 'male'),
	(DEFAULT, 5, 5, 'Александра', 'Якушева', 'male');
	
INSERT INTO "Journal"(id_Journal, id_Class, id_Discipline, mark, quarter)
	VALUES 
	(DEFAULT, 1, 1, 3, 1),
	(DEFAULT, 1, 1, 4, 1),
	(DEFAULT, 3, 3, 5, 2),
	(DEFAULT, 4, 4, 4, 2),
	(DEFAULT, 5, 5, 5, 3); 
	
INSERT INTO "Schedule"(id_Schedule, id_Class, id_Cabinet, id_Discipline, time, order)
	VALUES 
	(DEFAULT, 1, 10, 1, 1, '2020/4/20', 1),
	(DEFAULT, 1, 11, 2, 3, '2020/4/20', 2),
	(DEFAULT, 1, 20, 4, 2, '2020/4/20', 3),
	(DEFAULT, 2, 11, 5, 2, '2020/4/20', 1),
	(DEFAULT, 3, 12, 3, 5, '2020/4/20', 2),
	(DEFAULT, 4, 13, 3, 4, '2020/4/20', 1);
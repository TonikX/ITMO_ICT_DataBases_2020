CREATE TABLE "Subject" (
  "id_Subject" SERIAL PRIMARY KEY NOT NULL,
  "Name" varchar NOT NULL
);

CREATE TABLE "Cabinet" (
  "id_Cabinet" SERIAL PRIMARY KEY NOT NULL,
  "Floor" int NOT NULL
);

CREATE TABLE "Teacher" (
  "id_Teacher" SERIAL PRIMARY KEY NOT NULL,
  "id_Cabinet" int,
  "First_Name" varchar NOT NULL,
  "Last_Name" varchar NOT NULL
);

CREATE TABLE "Discipline" (
  "id_Discipline" SERIAL PRIMARY KEY NOT NULL,
  "id_Teacher" int,
  "id_Subject" int,
  "Type" varchar NOT NULL
);

CREATE TABLE "Class" (
  "id_Class" SERIAL PRIMARY KEY NOT NULL,
  "id_Teacher" int,
  "Begining_education" date,
  "End_education" date
);

CREATE TABLE "Student" (
  "id_Student" SERIAL PRIMARY KEY NOT NULL,
  "id_Class" int,
  "id_Teacher" int,
  "First_Name" varchar,
  "Last_Name" varchar,
  "Sex" varchar
);

CREATE TABLE "Journal" (
  "id_Journal" SERIAL PRIMARY KEY NOT NULL,
  "id_Class" int,
  "id_Discipline" int,
  "Mark" int,
  "Quarter" int
);

CREATE TABLE "Schedule" (
  "id_Journal" SERIAL PRIMARY KEY NOT NULL,
  "id_Class" int,
  "id_Cabinet" int,
  "id_Teacher" int,
  "id_Subject" int,
  "Date" timestamp,
  "Number" int
);


ALTER TABLE "Teacher" ADD FOREIGN KEY ("id_Cabinet") REFERENCES "Cabinet" ("id_Cabinet") ON DELETE SET NULL;

ALTER TABLE "Discipline" ADD FOREIGN KEY ("id_Subject") REFERENCES "Subject" ("id_Subject") ON DELETE CASCADE;

ALTER TABLE "Discipline" ADD FOREIGN KEY ("id_Teacher") REFERENCES "Teacher" ("id_Teacher") ON DELETE CASCADE;

ALTER TABLE "Schedule" ADD FOREIGN KEY ("id_Class") REFERENCES "Class" ("id_Class") ON DELETE CASCADE;

ALTER TABLE "Schedule" ADD FOREIGN KEY ("id_Cabinet") REFERENCES "Cabinet" ("id_Cabinet") ON DELETE CASCADE;

ALTER TABLE "Class" ADD FOREIGN KEY ("id_Teacher") REFERENCES "Teacher" ("id_Teacher") ON DELETE SET NULL;

ALTER TABLE "Student" ADD FOREIGN KEY ("id_Class") REFERENCES "Class" ("id_Class") ON DELETE SET NULL;

ALTER TABLE "Journal" ADD FOREIGN KEY ("id_Class") REFERENCES "Class" ("id_Class") ON DELETE CASCADE;

ALTER TABLE "Journal" ADD FOREIGN KEY ("id_Discipline") REFERENCES "Discipline" ("id_Discipline") ON DELETE CASCADE;

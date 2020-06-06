

--- Выбор значений, заданных атрибутов из более, чем двух таблиц, с сортировкой
--- Выбор имен и четвертных оценок учеников

SELECT student.firstname,
       student.lastname,
       journal.grade_quarter
FROM student
INNER JOIN journal ON student.id_student = journal.id_student
ORDER BY grade_quarter DESC;


--- Использование условий WHERE, состоящих из более, чем одного условия
--- Выбор имен и средних баллов учениц

SELECT firstname,
       grade_avg
FROM student,
     journal
WHERE sex = 'Женщина'
  AND journal.id_student = student.id_student
  AND journal.grade_avg >= 3
ORDER BY student;


--- Использование функций для работы с датами
--- Выбор количества дней между первым и последним занятием

SELECT
  (SELECT max(lesson_date)
   FROM schedule)::TIMESTAMP -
  (SELECT min(lesson_date)
   FROM schedule)::TIMESTAMP AS difference;


--- Использование строковых функций
--- Выбор имен и пола учеников с заменой.

SELECT firstname, lastname,
REPLACE (REPLACE (sex,'Мужчина','Парень'),'Женщина','Девушка') AS sex
FROM student;


--- Запрос с использованием подзапросов
--- Выбор преподавателей у которых занятия в промежутке выбранных дат

SELECT class_curator,
       lesson_date
FROM class,
     schedule
WHERE lesson_date IN
    (SELECT lesson_date
     FROM schedule
     WHERE lesson_date BETWEEN '2020-05-20' AND '2020-06-21')
ORDER BY lesson_date;


--- Вычисление групповой (агрегатной) функции
--- Выбор средней четвертной оценки среди девочек и мальчиков

SELECT sex,
       ROUND(AVG(grade_quarter)) AS avg_quarter
FROM student
INNER JOIN journal ON student.id_student = journal.id_student
GROUP BY sex;


--- Вычисление групповой (агрегатной) функции с условием HAVING
--- Выбор количества кабинетов на каждом этаже кроме второго

SELECT cab_floor,
       COUNT(sub_name) AS cab_numbers
FROM cabinet
INNER JOIN schedule ON cabinet.id_cabinet = schedule.id_cabinet
INNER JOIN discipline ON schedule.id_subject = discipline.id_subject
INNER JOIN subject ON discipline.id_subject = subject.id_subject
GROUP BY cab_floor HAVING cab_floor != 2;


--- Использование предикатов EXISTS, ALL, SOME и ANY 
--- Выбор студентов четвертная оценка которых четверка или выше

SELECT firstname,
       lastname,
       grade_quarter
FROM student
INNER JOIN journal ON student.id_student = journal.id_student
WHERE grade_quarter = ANY
    (SELECT grade_quarter
     FROM journal
     WHERE grade_quarter >= 4)

--- Выбор преподавателей название дисциплины которых заканчивается на 'ий'

SELECT firstname,
       lastname,
       disc_type
FROM teacher
INNER JOIN discipline ON teacher.id_teacher = discipline.id_teacher
WHERE EXISTS
    (SELECT disc_type
     FROM discipline
     WHERE discipline.id_teacher = teacher.id_teacher
       AND disc_type LIKE '%ий')


--- Использование запросов с операциями реляционной алгебры (объединение, пересечение и т.д.)
--- Выбор преподавателей занятия которых проходят на первом этаже

SELECT firstname,
       lastname,
       cab_number,
       cab_floor
FROM teacher
LEFT JOIN cabinet ON teacher.id_cabinet = cabinet.id_cabinet
AND cab_floor = 1;


--- Использование объединений запросов (inner join и т.д.)
--- Выбор имен всех студентов и учителей

SELECT 'teacher' AS who,
       firstname,
       lastname
FROM teacher
UNION
SELECT 'student',
       firstname,
       lastname
FROM student
ORDER BY who;

--- Выбор преподавателей у занятия которых проходят в указанные даты

SELECT firstname,
       lastname,
       sub_name,
       lesson_date
FROM teacher
JOIN discipline ON teacher.id_teacher = discipline.id_teacher
JOIN subject ON discipline.id_subject = subject.id_subject
JOIN schedule ON discipline.id_teacher = schedule.id_teacher
WHERE lesson_date = '2020-06-20'
  OR lesson_date = '2020-05-19'
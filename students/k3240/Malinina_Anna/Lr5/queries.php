<!DOCTYPE html>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
<head>
    <title>Insert data to PostgreSQL with php - creating a simple
        web application</title>
    <meta http-equiv="Content-Type" content="text/html;
charset=utf-" ;/>
    <style>
        li {
            listt-style: none;
        }
    </style>
</head>
<body>

<h2>5 запросов:</h2>
<form method="post">
        <input type="submit" name="button1"
                class="button" value="Первый запрос" />
        <input type="submit" name="button2"
                class="button" value="Второй запрос" />
        <input type="submit" name="button3"
                class="button" value="Третий запрос" />
        <input type="submit" name="button4"
                class="button" value="Четвертый запрос" />
        <input type="submit" name="button5"
                class="button" value="Пятый запрос" />
    </form>
</body>
</html>
<?php
$dbuser = 'postgres';
$dbpass = 'a31415926';
$host = 'localhost';
$dbname = 'ClimbingClub';
$db = pg_connect("host=$host dbname=$dbname user=$dbuser password=$dbpass");
if(array_key_exists('button1', $_POST)) {
            first($db);
        }
        else if(array_key_exists('button2', $_POST)) {
            second($db);
        }
        else if(array_key_exists('button3', $_POST)) {
                    third($db);
        }
        else if(array_key_exists('button4', $_POST)) {
                    fourth($db);
        }
        else if(array_key_exists('button5', $_POST)) {
                    fifth($db);
         }
function first($db)
{
echo "<br>Показать имена участников клуба, название клуба, страну клуба,
          отсортировав по ид клубов и именам участников.<br>";
    $query = "select members.name, \"Club\".name AS club, \"Club\".country FROM members,
                      \"Club\" WHERE \"Club\".id = members.id_club ORDER BY members.id_club,
                      members.name";
    $header = "<th>ФИО</th><th>Клуб</th><th>Страна</th>";
    $result = pg_query($db, $query);
    Generate($result, $header);
}

function second($db)
{
echo "<br>Показать название горы, сложность маршрута, проходящего через эту
          гору, высоту горы, отсортировав по названию горы.
<br>";
$query = "select mountain.name, difficulty, height FROM mountain, \"Route\" WHERE
\"Route\".id_mountain = mountain.id ORDER BY mountain.name";
$result = pg_query($db, $query);
$header = "<th>Имя</th><th>Сложность</th><th>Высота</th>";
Generate($result, $header);

}

function third($db)
{
echo "<br>Выбрать участников, которые состоят в альпинистских группах.<br>";
$query = "select members.name FROM members WHERE EXISTS(SELECT id_member
          FROM \"Group_member\", members WHERE id_member = members.id)";
$result = pg_query($db, $query);
$header = "<th>Имя</th>";
Generate($result, $header);

}

function fourth($db)
{
echo "<br>Cтраны, в которых расположены клубы или горы.<br>";

$query = "select country FROM \"Club\" UNION SELECT country FROM mountain;";
$result = pg_query($db, $query);
$header = "<th>Страна</th>";
Generate($result, $header);

}

function fifth($db)
{
echo "<br>Показать имена участников, ид группы, в которую они входят, и статус
          восхождения<br>";
$query = "select name, \"Group\".id, climbing_status FROM members LEFT OUTER JOIN
          \"Group_member\" ON members.id = \"Group_member\".id_member INNER JOIN
          \"Group\" ON \"Group_member\".id_group = \"Group\".id";
$result = pg_query($db, $query);
$header = "<th>Имя</th><th>ID</th><th>Статус</th>";
Generate($result, $header);

}

function Generate($result, $header)
{
$result_array = pg_fetch_row($result);
     $NumRows = pg_num_rows($result);
     $NumFields = pg_num_fields($result);
     echo "<table style=\"width:50%\">
     <tr>$header</tr>";
     for ($i = 0; $i < $NumRows; $i++)
         {
         $result_array = pg_fetch_row($result, $i);
         echo "<tr>";
         for ($j = 0; $j < $NumFields; $j++)
         {
         echo "<th>$result_array[$j]</th>";
         }
         echo "</tr>";
         }
         echo "</table>";
}

pg_close($db);
?>

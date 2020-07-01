<?php
  echo "<h2>Запросы<h2>";
	
	$host = "localhost";
	$user = "postgres";
	$password = "Bargi20012";
	$name = "headteacher";
	
$db = pg_connect("host=$host dbname=$name user=$user password=$password");

$query = "SELECT name_subject FROM school.timetable 
INNER JOIN school.subject ON subject.id_subject = timetable.id_subject 
INNER JOIN school.class ON class.id_class = timetable.id_class 
WHERE date_ = '2020-06-29' AND number_class = '2A' AND lesson_number = 1;";


$query1 = "SELECT quarter, name_pupil, grade, name_subject, type_subject FROM school.journale
INNER JOIN school.subject ON subject.id_subject = journale.id_subject
INNER JOIN school.pupil ON pupil.id_pupil = journale.id_pupil
ORDER BY name_pupil";
    
$query2 = "SELECT name_teacher FROM school.teacher 
INNER JOIN school.class ON class.id_teacher = teacher.id_teacher 
INNER JOIN school.subject ON subject.id_teacher = teacher.id_teacher 
WHERE number_class = '8A' OR number_class = '8B' OR number_class = '8V' OR number_class = '8G' AND name_subject = 'Physics'";


$query3 = "SELECT name_pupil FROM school.pupil
INNER JOIN school.journale ON journale.id_pupil = pupil.id_pupil
INNER JOIN school.subject ON subject.id_subject = journale.id_subject
WHERE grade = 5 AND name_subject = 'Physics' AND quarter = 1";

       
$query4 = "SELECT AVG(grade) FROM school.journale 
INNER JOIN school.subject ON subject.id_subject = journale.id_subject 
WHERE name_subject = 'Physics'";


$result = pg_fetch_all(pg_query($db, $query));
$result1 = pg_fetch_all(pg_query($db, $query1));
$result2 = pg_fetch_all(pg_query($db, $query2));
$result3 = pg_fetch_all(pg_query($db, $query3));
$result4 = pg_fetch_all(pg_query($db, $query4));

  
pg_close($db);
?>
<body vlink = "black">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbar1">
        <a class="navbar-brand" href="index.php">Главная</a>       
    </div>
</nav>
<h3> Вывод названия дисциплины, учитывая дату, номер урока и класс: </h3>
<table>
   

     <tr>
       <th><?php echo implode('</th><th>', array_keys($result[0])); ?></th>
     </tr>
   
   <tbody>

 <?php foreach ($result as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>

 <h3> Вывод имен, оценок, четверти, в которой была получена оценка, 
дисциплины, по которой была получена оценка и тип этой дисциплины (при наличии) учеников,
с сортировкой по имени ученика: </h3>

 <table>

     <tr>
       <th><?php echo implode('</th><th>', array_keys($result1[0])); ?></th>
     </tr>
   <tbody>

 <?php foreach ($result1 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>
 <h3> Вывод имен учителей, ведущих физику у заданных классов: </h3>
<table>
   

     <tr>
       <th><?php echo implode('</th><th>', array_keys($result2[0])); ?></th>
     </tr>
  
   <tbody>

 <?php foreach ($result2 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>
<h3> Вывод имен учеников, у которых 5 по физике за первую четверть: </h3>

  <table>
   

     <tr>
       <th><?php echo implode('</th><th>', array_keys($result3[0])); ?></th>
     </tr>
   
   <tbody>

 <?php foreach ($result3 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>

<h3> Вывод средней оценки по физике в школе: </h3>

 <table>
   

     <tr>
       <th><?php echo implode('</th><th>', array_keys($result4[0])); ?></th>
     </tr>
   
   <tbody>

 <?php foreach ($result4 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>
</body>

<style>
    body{
        background: #333;
        background-size: cover;
        font-family: Calibri;
    }
    table, td, th, caption{
        font-family: Calibri;
        width: 70%;
        height: 10%;
        margin: auto;
        border: 1px solid black;
        border-collapse:collapse;
        text-align:left;
        font-size: 15px;
        table-layout: fixed;
        background: white;
        opacity: 0.8;
        color: black;
        margin-top: 100px;
        
    }
    th, td {
        padding: 5px;
        opacity: 0.99;

    }
    a {
        text-decoration: none;
    }
    a:hover { 
        text-decoration: underline;
        color: grey;
    }
    div{
        margin-bottom: 0.5px;
    }

    h3{

      font-family: Calibri;
    }
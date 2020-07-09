<!DOCTYPE html>
<html>
<head>
    <h2 align="center">Список запросов</h2>
    <form> 
    <p><button formaction="index.php">На главную</button></p>
    </form>
</head>
<?php
 	$dbuser = "postgres";
 	$dbpass = "IF875H";
 	$host = "localhost";
 	$dbname= "luch";
 	$db = pg_connect("host=$host dbname=$dbname user=$dbuser
 	password=$dbpass");


 	$query1 = "SELECT id_application FROM luch.application WHERE application.status = 'completed' AND application.date_application < '2020/01/01'";
 	$query2 = "SELECT * FROM luch.application WHERE date_application = '2020/03/06'";
 	$query3 = "SELECT ad_product, amount FROM luch.application JOIN luch.application_list ON application_list.id_application = application.id_application JOIN luch.worker ON worker.id_number = application_list.id_number WHERE worker.name = 'Maria Petrova' AND application.status = 'completed'";
 	$query4 = "SELECT id_application FROM luch.manufactory WHERE id_material = ANY (SELECT id_material FROM luch.material WHERE name_material = 'backlit')";
 	$query5 = "SELECT name, contacts, 'worker' AS role FROM luch.worker WHERE worker.name LIKE 'K%' UNION SELECT name_client, phone_client, 'client' AS role FROM luch.client WHERE client.name_client LIKE 'K%' ORDER BY name ASC";

 	$result1 = pg_fetch_all(pg_query($db, $query1));
 	$result2 = pg_fetch_all(pg_query($db, $query2));
 	$result3 = pg_fetch_all(pg_query($db, $query3));
 	$result4 = pg_fetch_all(pg_query($db, $query4));
 	$result5 = pg_fetch_all(pg_query($db, $query5));
 
 	pg_close($db);
?>

<style>
    body{
        background-color: powderblue;
    }
    table, td, th{
        width: 50%;
        margin: auto;
        border: 1px solid white;
        border-collapse:collapse;
        text-align:center;
        font-size: 12px;
        table-layout: fixed;
        background: white;
        opacity: 0.8;
        color: black;
        margin-top: 20px;
}
    th, td {
        padding: 10px;
    }
</style>

<h4 align="center"> 1) Вывести все номера заявок, статус которых – «выполнено» и дата заявки ранее 2020 года: </h4>

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

 <h4 align="center"> 2) Показать информацию о заказах, оставленных 6 марта 2020 года: </h4>
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

 <h4 align="center"> 3) Показать все рекламные продукты и их объем, выполненные сотрудником Марией Петровой: </h4>
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

 <h4 align="center"> 4) Показать номера заказов, для изготовления которых необходим материал с названием «backlit»: </h4>
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

<h4> 5) Создадим базу работников и заказчиков для удобного поиска по людям, фигурирующим в агентстве.Найдем ФИ, контактные данные и роль в агентстве людей, чье имя начинается на букву К; отсортируем в алфавитном порядке: </h4>

  <table>  
     <tr>
       <th><?php echo implode('</th><th>', array_keys($result5[0])); ?></th>
     </tr>
   <tbody>
 <?php foreach ($result5 as $row): array_map('htmlentities', $row); ?>
     <tr>
       <td><?php echo implode('</td><td>', $row); ?></td>
     </tr>
 <?php endforeach; ?>
   </tbody>
 </table>



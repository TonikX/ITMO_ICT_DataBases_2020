<!DOCTYPE html>
 <head>  <title>Результаты выполнения запросов: </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style>
li {list-style: none;}
</style>
</head>
<body>
<h2>Результаты выполнения запросов: </h2>
</body>
</html>


<?php
$host = 'localhost';
$dbname = 'Advertizing_Agency_Lych';
$dbuser = 'postgres';
$dbpass = 'mrorl';
$connec = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);

//
$query1 = 'SELECT request.request_id, request.request_date, service_pl.serv_name, material_pl.mat_name, request.total_cost
FROM clients.request
  INNER JOIN clients.materials
  ON materials.mat_req_id = request.request_id
  INNER JOIN clients.services
  ON services.serv_req_id = request.request_id
  INNER JOIN clients.service_pl
  ON services.serv_spl_id = service_pl.serv_id
  INNER JOIN clients.material_pl
  ON materials.mat_mpl_id = material_pl.mat_id
ORDER BY request.request_date';

echo 'Запрос № 1: Данные о заявках, услугах и материалах.';
echo '<p></p>';
foreach ($connec->query($query1) as $row) 
{
print $row['request_id'] . " ";
print $row['request_date'] . " ";
print $row['serv_name'] . " ";
print $row['mat_name'] . " ";
print $row['total_cost'] . "<br>";
}
echo '<p></p>';

$query2 = 'SELECT request_id, request_date, total_cost, contact_pers, phone_num 
FROM clients.request 
INNER JOIN clients.client 
ON request.req_cl_id = client.client_id 
WHERE status = \'not paid\' AND request_date < \'2020/03/30\';
';

echo 'Запрос № 2: Данные о неоплаченных заявках с датой заявки раньше, чем 2020/03/20.';
echo '<p></p>';
foreach ($connec->query($query2) as $row) {
print $row['request_id'] . " ";
print $row['request_date'] . " ";
print $row['total_cost'] . " ";
print $row['contact_pers'] . " ";
print $row['phone_num'] . "<br>";
}
echo '<p></p>';

$query3 = 'SELECT request.status, SUM(material_pl.mat_pr*materials.mat_num) AS materials_cost
FROM clients.request
  INNER JOIN clients.materials
  ON materials.mat_req_id = request.request_id
  INNER JOIN clients.material_pl
  ON materials.mat_mpl_id = material_pl.mat_id
GROUP BY request.status';

echo 'Запрос № 3: Данные о суммарной стоимости материалов для оплаченных и неоплаченных заявок.';
echo '<p></p>';
foreach ($connec->query($query3) as $row) 
{
print $row['status'] . " ";
print $row['materials_cost'] . "<br>";
}
echo '<p></p>';

$query4 = 'SELECT client.contact_pers, client.phone_num, client.mail, SUM(service_pl.serv_pr) AS sum
FROM clients.request 
  INNER JOIN clients.services
  ON services.serv_req_id = request.request_id
  INNER JOIN clients.service_pl
  ON services.serv_spl_id = service_pl.serv_id
  INNER JOIN clients.client
  ON client.client_id = request.req_cl_id
GROUP BY client.contact_pers, client.phone_num, client.mail HAVING SUM(service_pl.serv_pr) > 10000;';

echo 'Запрос № 4: Данные о клиентах, общая стоимость услуг в заявке которых превышает установленную.';
echo '<p></p>';
foreach ($connec->query($query4) as $row) 
{
print $row['contact_pers'] . " ";
print $row['phone_num'] . " ";
print $row['mail'] . " ";
print $row['sum'] . "<br>";
}
echo '<p></p>';

$query5 = 'SELECT \'client\' AS relation, contact_pers AS person, phone_num
FROM clients.client
UNION
SELECT \'executor\', exe_name, exe_ph
FROM clients.executor
ORDER BY person';

echo 'Запрос № 5: Телефонная база клиентов и сотрудников.';
echo '<p></p>';
foreach ($connec->query($query5) as $row) 
{
print $row['relation'] . " ";
print $row['person'] . " ";
print $row['phone_num'] . "</br>";
}
echo '<p></p>';
?>

  
<?php

$dbuser = 'postgres';
$dbpass = 'Apple2001';
$host = 'localhost';
$dbname='advertising_agency';
$pdo = new PDO("pgsql:host=$host; dbname=$dbname", $dbuser, $dbpass);

$a1 = "1. Показать контактное лицо и телефон рекламодателя, и состояние заявки, отсортировав по коду рекламодателя и состоянию заявки.";
$q1= 'SELECT public.advertiser.contact_person, public.advertiser.number, public.request.state FROM public.advertiser, public.request WHERE public.advertiser.id = public.request.id_advertiser ORDER BY public.advertiser.id, public.request.state';

$a2 = "2. Показать дату платежного поручения, состояние поручения и состояние заявки, отсортировав по дате платежного поручения.";
$q2 = 'SELECT public.payment_order.data_order, public.payment_order.state, public.request.state FROM public.payment_order, public.request WHERE public.request.id = public.payment_order.id_request ORDER BY public.payment_order.data_order';

$a3 = "3. Показать запрос ФИО сотрудников с исправлением регистра, в случае ошибки при вводе данных.";
$q3 = 'SELECT INITCAP (full_name) AS FIO FROM public.worker';

$a4 = "4. Показать смежную таблицу всех рекламодателей, оформивших заявку с помощью join.";
$q4 = 'SELECT * FROM public.advertiser INNER JOIN public.request ON public.advertiser.id = public.request.id_advertiser';

$a5 = "5. Показать среднюю стоимость работ.";
$q5 = 'SELECT round(avg(public.work.cost),2) FROM public.work';

$q = array($q1, $q2, $q3, $q4, $q5);
$a = array($a1, $a2, $a3, $a4, $a5);

?>
<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<style type="text/css">
		html,
		body,
		header,
		.intro-2 {
		    background-size: cover;
		    background-color: white;
		}
		.navbar {
		    z-index: 1;
		    background-color: rgba(0,0,0,0.92);
		}
		.container-fluid{
			padding-right: 0;
			padding-left: 0;
			margin-bottom: 1em;
		}
		html,
		body,
		header,
		.view {
		  height: 100%;
		}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="container-fluid">
					<nav class="navbar navbar-expand-lg navbar-dark black rgba-black-strong">
						<div class="container">
						  <a class="navbar-brand" href="main.php"><strong>Ермакова Анна</strong></a>
						  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="navbar-toggler-icon"></span>
						  </button>
						  <div class="collapse navbar-collapse" id="navbarSupportedContent">
						    <ul class="navbar-nav mr-auto">
						      <li class="nav-item">
						        <a class="nav-link" href="advertiser.php">Рекламодатель</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="advertising_agency.php">Рекламное агенство</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="payment_order.php">Платежное поручение</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="request.php">Заявка</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="service.php">Рекламная услуга</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="work.php">Работа</a>
						      </li>
						      <li class="nav-item">
						        <a class="nav-link" href="worker.php">Сотрудник агенства</a>
						      </li>
						    </ul>
						  </div>
						</div>
					</nav>
	   			</div>
			</div>
			<div class="view intro-2">
			<div class="full-bg-img">
			  <div class="mask rgba-black-strong flex-center">
			    <div class="container">
			      <div class="white-text wow fadeInUp">
			      	<h2>5 Запросов: </h2>
					<?php 
						for ($i=0; $i < 5; $i++) { 
						echo "<p>".$a[$i]."<p>";
						$result = $pdo->query($q[$i]);
						foreach ($result as $data) {
							$p = 0;
							while ($p != $result->columnCount()) { 
							print_r($data[$p]." ");
							$p+=1;
 						}
						echo "</br>";}
					}
					?>
					</p>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</body>
</html>
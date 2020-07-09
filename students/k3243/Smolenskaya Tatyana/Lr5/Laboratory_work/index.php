<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8" />
<title>Главная</title>
</head>
<body>

<style type="text/css">
	body {
		zoom: 200%;
		background-color: White;
		background-image: url(https://otelpelikan.ru/wp-content/uploads/2017/05/zdrava-min.jpg);
		-webkit-background-size: 100%;
		background-repeat: round;
        text-align:center;
        font-size: 14.4px;
        table-layout: fixed;
        opacity: 0.7;
	}
	h2 {
		text-align:center;
		color: Black;
	}
	#back {
		position: absolute; 
		top: 14px; 
		right: 14px; 
	}
	button {
		color: #fff; 
		background: #FFA500; 
		padding: 5px; 
		border-radius: 5px;
		border: 2px solid #FF8247;
	} 
	button:hover { 
		background: #FF6347; 
	}
	</style>



<table
align="center"
rules="rows"
<tr>
<td>

<table
border="1"
bgcolor=yellow
cellpadding="10"
style="width:100%; border-radius:5px;">
<tr>
<th>
<h1>Лечебная клиника</h1>
</th>
</tr>
</table>
<table
border="1"
cellpadding="10"
style="width:100%; border-radius:5px;">

	<div id="back">
		<form action="requests.php">
			<button>Запросы</button> 
		</form>
	</div>


<td bgcolor=yellow>
<h2>Выбрать категорию:</h2>
<p>
<a href="patient.php">Пациент</a>
<p>
<a href="doctor.php">Врач</a>
<p>
<a href="pricelist.php">Прейскурант</a>
<p>
<a href="schedule.php">График работы</a>
<p>
<a href="meet.php">Приём</a>
<p>
</p>
</td>
</tr>
</table>
</body>
</html>

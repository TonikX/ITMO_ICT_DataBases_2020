<html>
<head>
	<meta charset="utf-8">
	<title>Аэропорт</title>
	<style type="text/css">
	body {
		zoom: 200%;
		background-color: LightBlue;
		background-image: url(https://mota.ru/upload/wallpapers/source/2016/11/04/12/02/50505/mota.ru_20161104148.jpg);
		background-repeat: round;
        text-align:center;
        font-size: 50px;
        table-layout: fixed;
        opacity: 0.7;
	}
	h3 {
		text-align:center;
		color: White;
	}
	#back {
		position: absolute; 
		top: 15px; 
		right: 15px; 
	}
	button {
		background: Red;
	}
	</style>
	
</head>
<body>
	<h3>Аэропорт</h3>
	
	<div id="back">
		<form action="requests.php">
			<button>Запросы</button> 
		</form>
	</div>
	
	 <form id="form1" style="text-align:center" action="" method="post">
		<select name="formchoice" size="3">
			<option disabled>Выберите таблицу</option>
			<option value="rabotnik.php">Работник</option>
			<option value="ekipazh.php">Экипаж</option>
			<option value="samolet.php">Самолёт</option>
			<option value="reys.php">Рейс</option>
			<option value="remont.php">Ремонт</option>
			</select>
		<p><input type="submit" value="Выбрать"></p>
  </form>
<script>
	document.getElementById('form1').formchoice.onchange = function() {
	var newaction = this.value;
	document.getElementById('form1').action = newaction;
	}
</script>
</body>
</html>


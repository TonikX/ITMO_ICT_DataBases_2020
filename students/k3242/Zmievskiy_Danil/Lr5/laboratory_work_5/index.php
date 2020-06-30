<html>
<head>
	<meta charset="utf-8">
	<title>Библиотека</title>
	<style type="text/css">
	body {
		zoom:150%;
		background-color:BurlyWood
	}
	h3 {
		text-align:center
	}
	
	</style>
</head>
<body>
	
	<h3>Администрирование системой Библиотеки</h3>

	 <form id="form1" style="text-align:center" action="" method="post">
		<select name="formchoice" size="4">
			<option disabled>Выберите таблицу</option>
			<option value="Book.php">Книги</option>
			<option value="Reader.php">Читатели</option>
			<option value="Reading_room.php">Читательский зал</option>
			<option value="Creation_new_reader.php">Запись нового читателя</option>
			<option value="Getting_book.php">Выдача книги</option>
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
<html>
	<head>
		<style>
		   h1 {
			font-family: Helvetica; 
			font-size: 32; 
			font-style: bold;
		   } 
		   h3 {
			font-family: Helvetica;
			font-size: 20; 
			font-style: bold;
		   }
		   p {
			font-family: Helvetica;
			font-size: 20; 
		   }
		</style>
	</head>
	<body>
	<h1> Вычисление индекса массы тела </h1>
	  <form method="post" action="page2.php">
		<h3>Имя: <input type="text" name="name"></h3>
		<h3>Рост: <input type="number" name="height" min="120" max="220"> см.</h3>
		<h3>Вес: <input type="number" name="weight" min="30" max="300"> кг.</h3>
		<p><input type="submit" value="Вычислить!"></p>
	  </form>
	</body>
</html>
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
		<?php
		  session_start();
		  unset($_SESSION['username']); 
		  echo "<p>Ваши данные успешно сброшены <br></p>"; 
		  session_destroy();

		?>
		
		<button onclick="location.href='page1.php'" type="button">Вычислить еще раз</button>
	</body>
</html>
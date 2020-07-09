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
	  $_SESSION['username'] = $_POST['name'];
	  $_SESSION['userheight'] = $_POST['height'];
	  $_SESSION['userweight'] = $_POST['weight'];
	  
	  $index = 0;
	  function index ($w, $h){
		  global $index;
		  $h = $h / 100;
		  $index = round(($w /($h * $h)), 1);
		  echo "<h3>Ваш индекс массы тела = ".$index."<br></h3>";
		  
		  if ($index < 18.5){echo "<p> У Вас недостаточный вес! <br></p>";}
		  elseif (($index >= 18.5) && ($index < 25)){echo "<p>У Вас нормальный вес! <br></p>";}
		  elseif (($index >= 25) && ($index < 30)){echo "<p>У Вас избыточный вес! <br></p>";}
		  elseif (($index >= 30) && ($index < 35)){echo "<p>У Вас ожирение I степени! <br></p>";}
		  elseif (($index >= 35) && ($index < 40)){echo "<p>У Вас ожирение II степени! <br></p>";}
		  else {echo "<p>У Вас ожирение III степени! <br></p>";}
		  
	  }
	  
	  echo "<h1>Результат</h1>";
	  echo "<p>Здравствуйте, ".$_SESSION['username']."<br></p>";
	  echo "<p>Ваш рост = ".$_SESSION['userheight']." см. <br></p>";
	  echo "<p>Ваш вес = ".$_SESSION['userweight']." кг.<br></p>";
	  index($_SESSION['userweight'], $_SESSION['userheight']); 
	?>

	  <button onclick="location.href='page3.php'" type="button">Сбросить данные</button>
	</body>
</html>	
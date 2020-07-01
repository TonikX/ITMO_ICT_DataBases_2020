<!DOCTYPE html>
<html>
<head>
  <title>headteacher</title>
</head>
<body vlink = "black">
	<div>
		<table>
			<caption style="text-align:center">Выберите таблицу для редактирования</caption>	
				<tr>
					<td><p><a href="teacher.php">Таблица Учитель</a></p></td>
					<td><p><a href="office.php">Таблица Кабинет</a></p></td>
					<td><p><a href="subject.php">Таблица Дисциплина</a></p></td>
					<td><p><a href="class.php">Таблица Класс</a></p></td>
					<td><p><a href="sql.php">Пять запросов</a></p></td>
				</tr>
		</table>
	</div>
</body>
<style>
    body{
        background: #333;
        background-size: cover;
    }
    table, td, th, caption{
    	font-family: Calibri;
        width: 80%;
        margin: auto;
        border: 1px solid white;
        border-collapse:collapse;
        text-align:center;
        font-size: 15px;
        table-layout: fixed;
        background: white;
        opacity: 0.8;
        color: black;
        margin-top: 100px;
	}
    th, td {
        padding: 20px;
        opacity: 0.99;

    }
    a {
    	text-decoration: none;
	}
    a:hover { 
    	text-decoration: underline;
    	color: grey;
	}
	caption{
		font-size: 25px;
    } 
</style>
</html>

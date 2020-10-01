<?php


function pKey($table){
	require('connection.php');
	$sql ="
	SELECT a.attname
	FROM pg_class c, pg_class c2, pg_index i, pg_attribute a
	WHERE c.relname = '$table' AND c.oid = i.indrelid AND i.indexrelid = c2.oid
	AND i.indisprimary AND i.indisunique 
	AND a.attrelid=c2.oid
	AND a.attnum>0;";
	$sth = $pdo->prepare($sql);
	$sth->execute();
	$data=$sth->fetchAll(PDO::FETCH_ASSOC);

	if(count($data) >0){
		return $data[0]["attname"];
	}else{
		return "";
	}
}
function allRec($table){
	require('connection.php');
	$arr[0] = pKey($table);
	$sql = "SELECT * FROM $table";
    $sth = $pdo->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$arr;
	$i=1;
	if($arr[0]=="")$i=0;
	foreach ($result[0] as $key => $value) {
		if($arr[0]!=$key){
			$arr[$i++] =  $key ;
		}
	}

	return $arr;
}
function allRecord($table)
{
	require('connection.php');
	$sql = "SELECT * FROM $table";
    $sth = $pdo->query($sql);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$tabe = "<div class='tab'>";
	foreach ($result[0] as $key => $value) {
		$tabe .= "<div class = 'columns'>  $key </div>";
	}
	$tabe .= "</div>";
	$tabe .= "<div></div>";
	for($i=0; $i<count($result); $i++){
		$tabe .= "<div class='tab1'>";
		foreach ($result[$i] as $key => $value) {
			$tabe .= "  <div class = 'columns'> $value </div> ";
		}
		$tabe .= "</div>";
	}
	return $tabe;
}

function find($sql, $arg, &$satus){
	require('connection.php');
    $sth = $pdo->prepare($sql);
    $sth->execute([$arg]);
    $data = $sth->fetchAll();
	$satus = chek($data,$sth->errorInfo()[2]);
	return $data;
}
function insert($sql, $arr, &$status){
	require('connection.php');
	$sth = $pdo->prepare($sql);
    $sth->execute($arr);
	$data = $sth->fetchAll();
	$status = chek($data, $sth->errorInfo()[2]);
	$data = null;
}
function edit($editing, $sql, $arr, &$status){
	require('connection.php');
	if($editing !=""){
		$sth = $pdo->prepare($sql);
		$sth->execute($arr);
		$data = $sth->fetchAll();
		$status = chek($data, $sth->errorInfo()[2]);
		$data = null;
	}
}
function delete($sql, $deleting, &$status){
	require('connection.php');
	$sth = $pdo->prepare($sql);
	$sth->execute($deleting,);
	$data = $sth->fetch(PDO::FETCH_LAZY);
	$status = chek($sth->rowCount(),  $sth->errorInfo()[2])	;
}

function chek($data, $error){
	echo $error;
	if($data>0){
        $status =  "готово";
    }else{
        $status = "Результат: ". $error;
    }
	return $status;
}
?>





















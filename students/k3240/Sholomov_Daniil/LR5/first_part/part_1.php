<?php
	header("Content-Type: text/plain; charset=utf-8");
	
	//simple func
	function say_hello($name) 
	{
    		return 'Hello '.$name ;
	}
	
	//simple session
	session_start();
	$_SESSION['user_name'] = "IVAN";
	
	//types
	$b = true;
	echo 'Bool: ', $b, "\n";
	$n = 1;
	echo 'Int: ', $n, "\n";
	$d = 0.11111;
	echo 'Double: ', $d, "\n";
    	$s = 'Text';
    	echo 'String: ', $s, "\n";
	$nums = array(0,1,2,3,4,5,6,7,8,9);
	
	//if elif else
	if ($nums[0] < $nums[1]) {
		echo $nums[0] + $nums[1], "\n";
    		
	} elseif ($nums[0] > $nums[1]) {
		echo $nums[0] - $nums[1], "\n";
	} else {
		echo $nums[0] * $nums[1], "\n";
	}
	
	
	echo '   for', "\n";
	for($i=0; $i<10; $i++){
	echo $nums[$i], ' '; 
	}
	echo "\n";
	
	echo '   while', "\n";
	$i=0;
	while ($i++<10){
	echo $nums[$i-1], ' ';
	}
	echo "\n";
	
	echo '   do while', "\n";
	$i = 0;
	do {
		echo $nums[$i], ' ';
	} while ($i++<9);
    	echo "\n";

	echo '   function usage', "\n";
	echo say_hello('Ivan'), "\n";
	echo say_hello($_SESSION['user_name']);
	$_SESSION = array();
	session_destroy();
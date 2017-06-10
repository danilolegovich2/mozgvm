<?php
	$db=new mysqli("localhost","danilolegovich","Mashinka33&", "dbmozg");
	if($db->connect_error){
	    die('Ошибка при подключении ('.$db->connect_errno.') '.$db->connect_error);
    }

	$db->query("SET NAMES utf8");

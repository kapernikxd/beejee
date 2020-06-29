<?php 
	$host = 'localhost';
    $user = 'kapern_beejee';
    $pswd = '123456Qq';
    $database = 'kapern_beejee';
    
    
    $connect = mysql_connect($host, $user, $pswd, $database);
	mysql_set_charset('utf8', $connect);
	
	 if (!$connect || !mysql_select_db($database, $connect))

      {
          echo "Ошибка соединения!";
    	  exit(mysql_error());
      }
     
     else {

     }
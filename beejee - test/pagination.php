<?php
	
     // Переменная хранит число сообщений выводимых на станице
     $num = 3;
     // Извлекаем из URL текущую страницу
     $page = $_GET['page'];
     
     // Определяем общее число сообщений в базе данных
     $numCols = mysql_query("SELECT COUNT(id) FROM userDate");
     $data = mysql_fetch_row($numCols);
     
     //echo "Количество элементов: ".$data[0];
     
     
     // Находим общее число страниц
     $total = intval(($data[0] - 1)/$num) + 1 ;
     
     //echo "кОЛИЧЕСТВО СТРАНИЦ: ".$total;
     
     
     $page = $_GET['page'];
     $page = intval($page);
     
     //echo "Page: ".$page;
     
     
     if(empty($page) or $page < 0) $page = 1;
     
     if($page > $total) $page = $total;
     // Вычисляем начиная к какого номера
     // следует выводить сообщения
     $start = $page * $num - $num;
     
     //echo "Start:".$start;
     
?>   
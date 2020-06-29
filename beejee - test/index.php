<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:ital,wght@0,300;0,400;1,300#standard-styles" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>


<?php
    $admin_user;
    include('config.php'); 
    include('sentData.php');
    
    if(isset($_POST['log_in'])){
        include('login.php');
    }
    
    if(isset($_POST['log_out'])){
        include('logout.php');
    }
    
?>
<header>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">
            Bootstrap
        </a>

        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center">
                <p class="ml-2 mr-2"><?php include('check.php');?></p>
                <?php if($_COOKIE['id'] == 'admin') : ?>
                    <form method="POST">
                        <button type="submit" name="log_out" class="btn btn-primary">Выйти</button>
                    </form>
                <?php else : ?>
                    <button type="submit" name="log_in" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Войти</button>
                <?php endif; ?>
            
            </div>
        </div>

    </nav>
</header>


<section>
    <div class="container">
        <div class="row mt-2">
            <div class="col-12 mx-auto overflow-auto">
                <h1 class="">Список задач:</h1>

                <?php include('pagination.php'); ?>   
                 
                <?php include('sortData.php'); ?> 
                
                
                <table>
                    <form method="GET">
                    <tr>
                        <th>Сортировка</th>
                        <th>
                            <select name="name">
                                <option selected="" disabled="">Имя:</option>
                                <option value="ASC">Возрастание</option>
                                <option value="DESC">Убывние</option>
                            </select>
                        </th>
                        <th>
                            <select name="email">
                                <option selected="" disabled="">Email</option>
                                <option value="ASC">Возрастание</option>
                                <option value="DESC">Убывние</option>
                             </select>
                        </th>
                        <th>Текст задачи</th>
                        <th class="table__check">
                            <select name="check">
                                <option selected="" disabled="">Статус</option>
                                <option value="ASC">Не сделано</option>
                                <option value="DESC">Сделано</option>
                            </select>
                        </th>

                        <th>
                            <input type="submit"  name="" class="btn" value="Сортировать">
                        </th>

                    </tr>
                    </form>

                    <!-- Вывод данных -->
                    <form method="post"> 
                    
                    
                    <?php
                    	//ПОЛУЧЕНИЕ ДАННЫХ
                    	
                    	$query = mysql_query("SELECT * FROM userDate $query_filter LIMIT $start, $num");
                    	$row = mysql_fetch_array($query);
                    	
                    	echo $query_filter;
                    	
                    	
                    	$i = 1;
                    		do { ?>
                    		
                                <?php include 'userData.php';  // файл основного вывода массива ?>
                                
                                <?php
                                    if ($_POST['checkbox'.$row['id'].''] == ''){
                                        $checkbox = '0';}
                                    else {$checkbox = '1';}
                                                                    
                                   //если изменено поле text или checkbox
                                    if (isset($_POST['change-date'.$row['id'].'']) && ($_COOKIE['id'] == 'admin') ) {
                                        //проверяем одинаковые ли данные ввода и в бд
                                        if (($_POST['comment'.$row['id'].'']) !== $row['text']){
                                            $sql_changed = "UPDATE userDate SET changed = '1' WHERE id = '".$row['id']."'  "; 
                                            $update_changed = mysql_query($sql_changed);
                                        };
                                      
                                    $sql_text = "UPDATE userDate SET checkbox = '".$checkbox."', text = '".$_POST['comment'.$row['id'].'']."' WHERE id = '".$row['id']."'  "; 
                                    $update_text = mysql_query($sql_text);
                                    }
                                    
                                  
                                ?>        
                    	   

                        <?php	
                            	$i++;	
                    			}
                    		while ($row= mysql_fetch_array($query));
                         
                            
                        ?>
                    </form>
                    <!-- /Вывод данных -->
                    
                </table>

            </div>
        </div>
    </div>
</section>




<section class="pagination">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto mt-2">

                <?php
                    $getparametr=$_SERVER['QUERY_STRING'];
                
                    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
 
	
                    $parts = parse_url($url); 
                    parse_str($parts['query'], $query); 
                     
                     
                    if(isset($query['page'])) {
                      unset($query['page']);
                    }
                
            
                    if (!empty($getparametr)){
                        
                        if(isset($query['name']) || isset($query['email']) || isset($query['check']) ) {
                            $coverlink='?'.http_build_query($query).'&';  
                        }
                        else {
                            $coverlink='?'.http_build_query($query);
                        }
                    }
                    else {
                        $coverlink='?';
                    }
            
                    
                    // Проверяем нужны ли стрелки назад
                    if ($page != 1) $nazadpage = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page - 1) .'">«</a></li>';
                    // Проверяем нужны ли стрелки вперед
                    if ($page != $total) $nextpage = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page + 1) .'">»</a></li>';
                    // Находим две ближайшие станицы с обоих краев, если они есть
                    if($page - 5 > 0) $page5left = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page - 5) .'">'. ($page - 5) .'</a></li>';
                    if($page - 4 > 0) $page4left = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page - 4) .'">'. ($page - 4) .'</a></li>';
                    if($page - 3 > 0) $page3left = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page - 3) .'">'. ($page - 3) .'</a></li>';
                    if($page - 2 > 0) $page2left = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page - 2) .'">'. ($page - 2) .'</a></li>';
                    if($page - 1 > 0) $page1left = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page - 1) .'">'. ($page - 1) .'</a></li>';
                    
                    if($page + 5 <= $total) $page5right = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page + 5) .'">'. ($page + 5) .'</a></li>';
                    if($page + 4 <= $total) $page4right = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page + 4) .'">'. ($page + 4) .'</a></li>';
                    if($page + 3 <= $total) $page3right = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page + 3) .'">'. ($page + 3) .'</a></li>';
                    if($page + 2 <= $total) $page2right = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page + 2) .'">'. ($page + 2) .'</a></li>';
                    if($page + 1 <= $total) $page1right = '<li class="page-item"><a class="page-link" href="'.$coverlink.'page='. ($page + 1) .'">'. ($page + 1) .'</a></li>';
                    
                    // Вывод меню если страниц больше одной
                    
                           
                    if ($total > 1)
                    {
                    Error_Reporting(E_ALL & ~E_NOTICE);
                    
                    echo '
                        
                        
                        
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                
                                    '.$nazadpage.'
                                    '.$page5left.'
                                    '.$page4left.'
                                    '.$page3left.'
                                    '.$page2left.'
                                    '.$page1left.'
                                    <li class="active page-item"><a class="page-link active">'.$page.'</a></li>
                                    '.$page1right.'
                                    '.$page2right.'
                                    '.$page3right.'
                                    '.$page4right.'
                                    '.$page5right.'
                                    '.$nextpage.'
                
                                    
                                </ul>
                            </nav>
                            
                        
                    ';
                    }
              ?>   
            
            
            </div>
        </div>
    </div>
</section>


<hr>

<!-- Добавление данных -->
<section class="addData">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post" class="">

                    <div class="form-group" >
                        <label for="exampleFormControlInputName">Name</label>
                        <input name="name" type="name" class="form-control" id="exampleFormControlInputName" placeholder="Имя:" required>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>


                    <button type="submit"  name="submit" class="btn btn-primary mb-2">Добавить запись</button>
                </form>
            </div>
        </div>
    </div>
</section>



<!-- //Добавление данных -->


<!-- Модальные окна -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Войти в admin панель?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputText">Login</label>
                        <input type="text" name="login" class="form-control" id="exampleInputText" placeholder="admin">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="123">
                    </div>
                    <button type="submit" name="log_in" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  /Модальные окна -->

<!-- Bootstrap CSS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
<?php 
	//ОТПРАВКА ДАННЫХ
	
	$mysqli = new mysqli($host,$user,$pswd,$database);
	
	if ($mysqli->connect_error) {
        die('Ошибка : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
	
	
	if (isset($_POST['submit'])) {
		if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['text'])) {
			$errors = "Заполните все поля!";
		}else{
		    $name = strip_tags($_POST['name']);
		    $email = $_POST['email'];
			$text = strip_tags($_POST['text']);
			
			
			$sql = "INSERT INTO userDate (name, email, text) VALUES ('$name', '$email', '$text')";
			$result = $mysqli->query($sql);
			
			
			    if ($result == true){
                	echo '
                	    <div class="alert alert-success" role="alert">
                          Информация занесена в базу данных!
                        </div>';
                }
                else{
                	echo "<p>Информация НЕ занесена в базу данных</p>";
                }
		}
	}
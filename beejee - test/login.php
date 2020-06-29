<?php
        $user_name = trim($_POST['login']);
        $user_password = $_POST['password'];
        
        // Вытаскиваем из БД запись, у которой логин равняеться введенному
        $query_admin = mysql_query("SELECT * FROM admin WHERE name='$user_name' LIMIT 1");
        $row_admin = mysql_fetch_array($query_admin);
    	  
?>

<?php if($row_admin['password'] === $user_password) : ?>
    <script>
        document.cookie = "id=admin; max-age=1000000";
	</script>
	<div class="alert alert-success" role="alert">
         Вы успешно авторизовались!
     </div>
    <?php  $admin_user = 'Yes' ?> 
<?php else: ?>
    <div class="alert alert-warning" role="alert">
      Вы ввели неправильный логин/пароль!
    </div>
<?php endif; ?>


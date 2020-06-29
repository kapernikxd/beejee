<?
// Скрипт проверки cookie

    if (isset($_COOKIE['id'])){
        echo "Привет, ".$_COOKIE['id'];
    }
    
    else{
        print "Авторизуйтесь!";
    }

?>
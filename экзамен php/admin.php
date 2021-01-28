<?php 
    $pas = $_POST['password'];
    if ($pas == 12345)
    {
       session_start();
       $_SESSION['admin'] = true;
       $script = 'session.php';
    }
    else 
    echo '<h1>Неправильный пароль!</h1>';
    echo '<a href="index.php">Попробовать еще раз</a>';
    header("Location: $script");

?>
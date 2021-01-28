<!DOCTYPE html>
<html>

    <head>
        <title>PHP</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
    <div class="wrapper">
        <h1>Пожалуйста, введите пароль для входа!</h1>
        
   <form action="admin.php" method="post">
      <input type="password" name="password" require placeholder="Пароль">
      <input class="button" type="submit" value="Войти">
   </form>
   <form method="POST">
    <input type="submit" name="user" value="Я эксперт!" />
   </form>
   <?php
    if( isset( $_POST['user'] ) )
    {
        session_start();
        $_SESSION['admin'] = true;
        $script = 'user.php';
    }
    header("Location: $script");
   ?>
   <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Подсказка</a>

   <div id="modal1" class="modal">
       <div class="modal-content">
           <h4>Вход для админа</h4>
           <p>Если что пароль : 12345</p>
       </div>
       <div class="modal-footer">
           <a href="#!" class="modal-close waves-effect waves-green btn-flat">Оки-доки!</a>
       </div>
   </div>
   </div>


    



    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> 
    <script>
        $(document).ready(function () {
            $('.modal').modal({
                opacity:0.8,
            });
            $(".carousel.carousel-slider").carousel({
                fullWidth:true,
                indicators:true,
                duration:500,
    
            });
        });
    </script>   
      
    </body>
</html>
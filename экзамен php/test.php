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
     <div class="wrapper-2">  
        <a class="waves-effect waves-light btn modal-trigger" href="session.php"> < -- Назад</a>
        <h1>Пройти тестирование!</h1>
        <?php
           $mysqli = mysqli_connect('std-mysql', 'std_942', 'Ns120765003', 'std_942');
           if( mysqli_connect_errno() ) // проверяем корректность подключения
           echo 'Ошибка подключения к БД: '.mysqli_connect_error(); 
           $id = $_GET["id"];
           $sql_res = mysqli_query($mysqli, 'SELECT * FROM tests where id='.$id.'');
           while( $row=mysqli_fetch_assoc($sql_res) ) // пока есть записи
  {
 echo '<form class="form-1" method="post" action="result.php">
    <div>
    <label for="q1">'.$row['q1'].'</label>
    <input   required type="text" name="q1" placeholder="Ответ 1">
    <label for="q2">'.$row['q2'].'</label>
    <input   required type="text" name="q2" placeholder="Ответ 2">
    <label for="q3">'.$row['q3'].'</label>
    <input required  type="text" name="q3" placeholder="Ответ 3">
    <label for="q4">'.$row['q4'].'</label>
    <input required type="text" name="q4" placeholder="Ответ 4">
    <p>'.$row['q5'].'</p>
    <p><input name="q5" type="radio" value="'.$row['var1_5'].'">'.str_replace('+', '', $row['var1_5']).'</p>
    <p><input name="q5" type="radio" value="'.$row['var2_5'].'">'.str_replace('+', '', $row['var2_5']).'</p>
    <p>'.$row['q6'].'</p>
    <p><input type="checkbox" name="var1_6" value="'.$row['var1_6'].'">'.str_replace('+', '', $row['var1_6']).'</p>
    <p><input type="checkbox" name="var2_6" value="'.$row['var2_6'].'">'.str_replace('+', '', $row['var2_6']).'</p>
    <p><input type="checkbox" name="var3_6" value="'.$row['var3_6'].'">'.str_replace('+', '', $row['var3_6']).'</p>
    <input type="hidden" name="id" value="'.$id.'">
    <input type="hidden" name="datetime" value="'.date("Y-m-d H:i:s").'">
    <input type="hidden" name="ip" value="'.$_SERVER["REMOTE_ADDR"].'">
    <input type="submit" name="button" class="btn btn-outline-light float-right" value="Сохранить ответы">
    </form>
    ';
    
    
}


    
    ?>      
    </div> 

    



    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> 
    
      
    </body>
</html>
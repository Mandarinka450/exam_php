<!DOCTYPE html>
<html lang="ru">
<head>
<title>PHP</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
</head>
<body>
    <a class="waves-effect waves-light btn modal-trigger" href="session.php"> < -- Назад</a>
<?php 

    echo '<h1>Результаты тестирования</h1>';
    $mysqli = mysqli_connect('std-mysql', 'std_942', 'Ns120765003', 'std_942');
    $sql_res=mysqli_query($mysqli, 'SELECT * FROM answer where id='.$_GET['id'].'');
    $ret= '<table><tr><th>1 вопрос</th><th>2 вопрос</th><th>3 вопрос</th><th>4 вопрос</th><th>5 вопрос</th><th>6 вопрос</th><th>Сумма всех баллов</th><th>IP-адрес эксперта</th><th>Дата и время ответа</th></tr>';
    while( $row=mysqli_fetch_assoc($sql_res) ) // пока есть записи
    {
       $ret.='<tr><td>'.$row['q1'].'</td>
        <td>'.$row['q2'].'</td>
        <td>'.$row['q3'].'</td>
        <td>'.$row['q4'].'</td>
        <td>'.str_replace('+', '', $row['q5']).'</td>
        <td>'.str_replace('+', '', $row['var1_6']).' '.str_replace('+', '', $row['var2_6']).' '.str_replace('+', '', $row['var3_6']).'</td>
        <td>'.$row['ball'].'</td>
        <td>'.$row['ip'].'</td>
        <td>'.$row['datetime'].'</td></tr>'
       ;
    }
    $ret.='</table>';
    echo $ret;
    $ball =  mysqli_query($mysqli, 'SELECT avg(ball) from answer where id='.$_GET['id'].'');
    while( $row=mysqli_fetch_assoc($ball) ){
   echo '<h4>Средний балл экспертной сессии в целом: '.$row['avg(ball)'].'</h4>';
   
    }
   $notes =mysqli_query($mysqli, 'SELECT sum(good1),sum(good2) from answer where id='.$_GET['id'].'');
   while( $row=mysqli_fetch_assoc($notes) ){
       $good1 = $row['sum(good1)'];
       $good2 = $row['sum(good2)'];
   }
    $arr = array (
     'Правильно ответивших на 5 вопрос:'=>$good1,
     'Правильно ответивших на 6 вопрос:'=>$good2
    ); //Массив с парами данных "подпись"=>"значение"
    require_once('moduls/SimplePlot.php'); //Подключить скрипт
    $plot = new SimplePlot($arr); //Создать диаграмму
    $plot->show(); //И показать её
    echo ' <div style="width:100%; text-align:center;"><a href="test.php?id='.$_GET['id'].'">Пройти тестирование еще раз</a>';

   
       ?>
       </body>
</html>
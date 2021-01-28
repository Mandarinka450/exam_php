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
    if (!is_numeric($_POST['q1']))
    exit('<h4 style="color:red; font-weight:bolder;">Введенный ответ в 1 вопросе не является числом!</h4><div style="width:100%; text-align:center;"><a href="test.php?id='.$_POST['id'].'">Пройти тестирование еще раз</a>');
    if(!($_POST['q2']>=0))
    exit('<h4 style="color:red; font-weight:bolder;">Введенный ответ в 2 вопросе не является положительным числом!</h4><div style="width:100%; text-align:center;"><a href="test.php?id='.$_POST['id'].'">Пройти тестирование еще раз</a>');
    $q3len = mb_strlen($_POST['q3'], 'utf-8');
    if(!($q3len>=1) or !($q3len<=30))
    exit('<h4 style="color:red; font-weight:bolder;">Введенный ответ в 3 вопросе не заполнен или имеет больше 30 символов в длину!</h4><div style="width:100%; text-align:center;"><a href="test.php?id='.$_POST['id'].'">Пройти тестирование еще раз</a>');
    $q4len = mb_strlen($_POST['q4'], 'utf-8');
    if(!($q4len>=1) or !($q4len<=255))
    exit('<h4 style="color:red; font-weight:bolder;">Введенный ответ в 4 вопросе не заполнен или имеет больше 255 символов в длину!</h4><div style="width:100%; text-align:center;"><a href="test.php?id='.$_POST['id'].'">Пройти тестирование еще раз</a>');
    

    $mysqli = mysqli_connect('std-mysql', 'std_942', 'Ns120765003', 'std_942');
    $ball = 0;
    $default = mysqli_query($mysqli, 'SELECT right_answer_5, wrong_answer_5, right_answer_6, wrong_answer_6, var1_6, var2_6, var3_6 from tests where id='.$_POST['id'].'');
    while( $row=mysqli_fetch_assoc($default) ){
        $right_answer_5 = $row['right_answer_5'];
        $wrong_answer_5 = $row['wrong_answer_5'];
        $right_answer_6 = $row['right_answer_6'];
        $wrong_answer_6 = $row['wrong_answer_6'];
        if (strpos($row['var1_6'], '+') !== false) 
        $right1 = $row['var1_6'];
        else $right1 = '';
        if (strpos($row['var2_6'], '+') !== false) 
        $right2 = $row['var2_6'];
        else $right2 = '';
        if (strpos($row['var3_6'], '+') !== false) 
        $right3 = $row['var3_6'];
        else $right3 = '';
    }
    if (strpos($_POST['q5'], '+') !== false) {
        $ball += $right_answer_5; 
        $good1 = 1;
    }

else {$ball += $wrong_answer_5; 
    $good1 = 0;}

if (!strcmp($_POST['var1_6'],$right1) and !strcmp($_POST['var2_6'],$right2)  and !strcmp($_POST['var3_6'],$right3) ) {
$good2 = 1;
    $ball += $right_answer_6;
}

else {
    $ball += $wrong_answer_6;
    $good2 = 0;
}

 $sql_res=mysqli_query($mysqli, 'INSERT INTO answer VALUES ('.
 $_POST['id'].',"'.htmlspecialchars($_POST['q1']).'","'.htmlspecialchars($_POST['q2']).'","'.htmlspecialchars($_POST['q3']).'","'.htmlspecialchars($_POST['q4']).'","'.htmlspecialchars($_POST['q5']).'","'.htmlspecialchars($_POST['var1_6']).'","'.htmlspecialchars($_POST['var2_6']).'","'.htmlspecialchars($_POST['var3_6']).'","'.htmlspecialchars($ball).'","'.htmlspecialchars($_POST['ip']).'","'.htmlspecialchars($_POST['datetime']).'","'.htmlspecialchars($good1).'","'.htmlspecialchars($good2).'")');

 
 $sql_res=mysqli_query($mysqli, 'SELECT * FROM answer where id='.$_POST['id'].'');
 $ret= '<table><tr><th>1 вопрос</th><th>2 вопрос</th><th>3 вопрос</th><th>4 вопрос</th><th>5 вопрос</th><th>6 вопрос</th><th>Сумма всех баллов</th><th>IP-адрес эксперта</th><th>Дата и время ответа</th></tr>';
 while( $row=mysqli_fetch_assoc($sql_res) ) // пока есть записи
 {
    $ret.='
     <tr><td>'.$row['q1'].'</td>
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
 $ball =  mysqli_query($mysqli, 'SELECT avg(ball) from answer where id='.$_POST['id'].'');
 while( $row=mysqli_fetch_assoc($ball) ){
echo '<h4>Средний балл экспертной сессии: '.$row['avg(ball)'].'</h4>';

 }
$notes =mysqli_query($mysqli, 'SELECT sum(good1),sum(good2) from answer where id='.$_POST['id'].'');
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

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
         <a class="waves-effect waves-light btn modal-trigger" href="index.php"> < -- Выйти из учетной записи</a>
    <h1>Просмотр экспертных сессий</h1>
               <table>
                    <tr>
                        <th>ID</th>
                        <th>Вопрос №1</th>
                        <th>Вопрос №2</th>
                        <th>Вопрос №3</th>
                        <th>Вопрос №4</th>
                        <th>Вопрос №5</th>
                        <th>Балл правильный/неправильный ответ</th>
                        <th>Вопрос №6</th>
                        <th>Балл правильный/неправильный ответ</th>
                        <th colspan="4">Действия</th>
                    </tr>
       
           <?php
                require_once 'add_test.php';
            ?>

            <?php
                $mysqli = new mysqli('std-mysql', 'std_942', 'Ns120765003', 'std_942') or die(mysqli_error($mysqli));
                $result = $mysqli->query("SELECT * FROM tests") or die($mysqli->error);
            ?>
                    <?php
                        while ($row = $result->fetch_assoc()):

                    ?>
                    <tr>
                        <th><?php echo $row['id']; ?></th>
                        <th><i><?php echo $row['q1']; ?></i></th>
                        <th><i><?php echo $row['q2']; ?></i></th>
                        <th><i><?php echo $row['q3']; ?></i></th>
                        <th><i><?php echo $row['q4']; ?></i></th>
                        <th><i><?php echo $row['q5']; ?></i></th>
                        <th><?php echo $row['right_answer_5']; ?>/ <?php echo $row['wrong_answer_5']; ?></th>
                        <th><i><?php echo $row['q6']; ?></i></th>
                        <th><?php echo $row['right_answer_6']; ?>/ <?php echo $row['wrong_answer_6']; ?></th>
                        <th><a href="test.php?id=<?php echo $row['id']; ?>" >Ссылка на тестирование</a></th>
                        <th><a href="result_admin.php?id=<?php echo $row['id']; ?>">Просмотреть результаты</a></th>
                        <th><a href="session.php?edit=<?php echo $row['id']; ?>" >Редактировать</a></th>
                        <th><a href="session.php?delete=<?php echo $row['id']; ?>">Удалить</a></th>
                        

                    </tr>
                        <?php endwhile; ?>
                </table>
                
                <?php 
                function pre_r( $array ) {
                    echo '<pre>';
                    print_r( $array );
                    echo '</pre>';
                }
            ?>
            <?php if (isset($_SESSION['message'])):?>
                    <div class="message">
                        <p>
                        <?php 
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        ?>
                       </p>
                </div>
                <?php endif; ?>

            </div>
           
        <h4 class="reviews__title">Создать новую экспертную сессию</h4>
            <form method="POST" action="add_test.php">
                <input  name="id" value="<?php echo $id; ?>" type="hidden">
                <label for="q1">Придумайте вопрос 1</label>
                <input type="text" required name="q1" value="<?php echo $q1; ?>" placeholder="ответ на этот вопрос должен быть целым числом">
                <label for="q2">Придумайте вопрос 2 </label>
                <input type="text" required name="q2" value="<?php echo $q2; ?>" placeholder="ответ на этот вопрос должен быть положительным числом">
                <label for="q3">Придумайте вопрос 3</label>
                <input type="text"required  name="q3" value="<?php echo $q3; ?>" placeholder="ответом на этот вопрос должна быть строка (1-30 символов)">
                <label for="q4">Нахимичьте вопрос 4</label>
                <input type="text" required name="q4" value="<?php echo $q4; ?>" placeholder="ответом на этот вопрос должна быть строка (1-255 символов)">
                <label for="q5">Вопрос 5 появись! </label>
                <input type="text" required name="q5" value="<?php echo $q5; ?>" placeholder="множественный ответ на вопрос" >
                <label>Варианты ответа для вопроса 5 (где ответ правильный - +)</label>
                <input type="text" required name="var1_5" value="<?php echo $var1_5; ?>" placeholder="первый вариант">
                <input type="text" required name="var2_5" value="<?php echo $var2_5; ?>" placeholder="второй вариант">
                <label for="right_answer_5">Балл для правильного варианта ответа (от 0 до 100)</label>
                <input type="text" required name="right_answer_5" value="<?php echo $right_answer_5; ?>">
                <label for="wrong_answer_5">Балл для неправильного варианта ответа (от -100 до 0)</label>
                <input type="text" required name="wrong_answer_5" value="<?php echo $wrong_answer_5; ?>">
                <label for="q6">Сим салабим вопрос 6 явись к нам! </label>
                <input type="text" required name="q6" value="<?php echo $q6; ?>" placeholder="несколько вариантов ответа">
                <label>Варианты ответа для вопроса 6 (где ответ правильный - +)</label>
                <input type="text" required name="var1_6" value="<?php echo $var1_6; ?>" placeholder="первый вариант">
                <input type="text" required name="var2_6" value="<?php echo $var2_6; ?>" placeholder="второй вариант">
                <input type="text" required name="var3_6" value="<?php echo $var3_6; ?>" placeholder="третий вариант">
                <label for="right_answer_6">Балл для правильного варианта ответа (от 0 до 100)</label>
                <input type="text" required name="right_answer_6" value="<?php echo $right_answer_6; ?>">
                <label for="wrong_answer_6">Балл для неправильного варианта ответа (от -100 до 0)</label>
                <input type="text" required name="wrong_answer_6" value="<?php echo $wrong_answer_6; ?>">
                <?php
                    if ($update == true) :
                ?>
                    <button class="form__button" name="update" value="update" type="submit">Редактировать!</button>
                <?php
                    else :
                ?>
                    <button class="form__button" name="save" value="добавить" type="submit">Добавить!</button>
                <?php
                    endif;
                ?>
            </form>
        </div> 

    



    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> 
    
      
    </body>
</html>
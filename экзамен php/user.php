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
    <h1>Просмотр ccылок на тестирование</h1>
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
        </div> 

    



    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script> 
    
      
    </body>
</html>
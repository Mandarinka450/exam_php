<?php
   session_start();
   $mysqli = new mysqli('std-mysql', 'std_942', 'Ns120765003', 'std_942') or die(mysqli_error($mysqli));
   
   $id = 0;
   $q1 = '';
   $q2 = '';
   $q3 = '';
   $q4 = '';
   $q5 = '';
   $var1_5 = '';
   $var2_5 = '';
   $right_answer_5 = '';
   $wrong_answer_5 = '';
   $q6 = '';
   $var1_6 = '';
   $var2_6 = '';
   $var3_6 = '';
   $right_answer_6 = '';
   $wrong_answer_6 = '';
   $update = false;

   if (isset($_POST['save'])) {
       $q1 = $_POST['q1'];
       $q2 = $_POST['q2'];
       $q3 = $_POST['q3'];
       $q4 = $_POST['q4'];
       $q5 = $_POST['q5'];
       $var1_5 = $_POST['var1_5'];
       $var2_5 = $_POST['var2_5'];
       $right_answer_5 = $_POST['right_answer_5'];
       $wrong_answer_5 = $_POST['wrong_answer_5'];
       $q6 = $_POST['q6'];
       $var1_6 = $_POST['var1_6'];
       $var2_6 = $_POST['var2_6'];
       $var3_6 = $_POST['var3_6'];
       $right_answer_6 = $_POST['right_answer_6'];
       $wrong_answer_6 = $_POST['wrong_answer_6'];
       
       $mysqli->query("INSERT INTO tests (q1, q2, q3, q4, q5, var1_5, var2_5, right_answer_5, wrong_answer_5, q6, var1_6, var2_6, var3_6, right_answer_6, wrong_answer_6) VALUES 
       ('$q1', '$q2', '$q3', '$q4', '$q5', '$var1_5', '$var2_5', '$right_answer_5', '$wrong_answer_5', '$q6', '$var1_6', '$var2_6', '$var3_6', '$right_answer_6', '$wrong_answer_6')") or die($mysqli->error); 

       $_SESSION['message'] = "Сессия успешно добавлена!";
       $_SESSION['msg_type'] = "success";
            
       header("location: session.php");
    }
   if (isset($_GET['delete'])) {
       $id = $_GET['delete'];

       $mysqli->query("DELETE FROM tests WHERE id=$id") or die($mysqli->error());

       
       $_SESSION['message'] = "Сессия успешно удалена!";
       $_SESSION['msg_type'] = "Успешно!"; 

       header("location:session.php");
   }

   if (isset($_GET['edit'])) {
      $id = $_GET['edit'];
      $update = true;
      $result = $mysqli->query("SELECT * FROM tests WHERE id=$id") or die($mysqli->error());

      if (count($result==1)) {
          $update = true;
          $row = $result->fetch_array();
          $q1 = $row['q1'];
          $q2 = $row['q2'];
          $q3 = $row['q3'];
          $q4 = $row['q4'];
          $q5 = $row['q5'];
          $var1_5 = $row['var1_5'];
          $var2_5 = $row['var2_5'];
          $right_answer_5 = $row['right_answer_5'];
          $wrong_answer_5 = $row['wrong_answer_5'];
          $q6 = $row['q6'];
          $var1_6 = $row['var1_6'];
          $var2_6 = $row['var2_6'];
          $var3_6 = $row['var3_6'];
          $right_answer_6 = $row['right_answer_6'];
          $wrong_answer_6 = $row['wrong_answer_6'];
      }
   }
   if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $q5 = $_POST['q5'];
    $var1_5 = $_POST['var1_5'];
    $var2_5 = $_POST['var2_5'];
    $right_answer_5 = $_POST['right_answer_5'];
    $wrong_answer_5 = $_POST['wrong_answer_5'];
    $q6 = $_POST['q6'];
    $var1_6 = $_POST['var1_6'];
    $var2_6 = $_POST['var2_6'];
    $var3_6 = $_POST['var3_6'];
    $right_answer_6 = $_POST['right_answer_6'];
    $wrong_answer_6 = $_POST['wrong_answer_6'];

    $mysqli->query("UPDATE tests SET q1='$q1', q2='$q2', q3='$q3', q4='$q4', q5='$q5', var1_5='$var1_5', var2_5='$var2_5', right_answer_5='$right_answer_5', wrong_answer_5='$wrong_answer_5', q6='$q6', var1_6='$var1_6', var2_6='$var2_6', var3_6='$var3_6', right_answer_6='$right_answer_6', wrong_answer_6='$wrong_answer_6' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Сессия успешно отредактирована!";
    $_SESSION['msg_type'] = "Успешно!"; 

    header("location: session.php");
}

?>
<?php 
    session_start();
    $mysqli = mysqli_connect('std-mysql', 'std_942', 'Ns120765003', 'std_942') or die(mysqli_error($mysqli));
    
    $link = '';
    $id = 0;
    $update = false;

    if (isset($_POST['save'])) {
        $link = $_POST['link'];

        $mysqli->query("INSERT INTO session (link) VALUES ('$link')");

        header("location: session.php");
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
 
        $mysqli->query("DELETE FROM session WHERE id=$id") or die($mysqli->error());
 
        
        $_SESSION['message'] = "Сессия успешно удалена!";
        $_SESSION['msg_type'] = "Успешно!"; 
        header("location: session.php");
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM session WHERE id=$id") or die($mysqli->error());
  
        if (count($result==1)) {
            $row = $result->fetch_array();
            $link = $row['link'];
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $link = $_POST['link'];

        $mysqli->query("UPDATE session SET link='$link' WHERE id=$id") or die($mysqli->error);
        header("location: session.php");
    }

?>